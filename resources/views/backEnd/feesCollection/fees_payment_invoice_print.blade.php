
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('/')}}/public/backEnd/css/report/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/')}}/public/backEnd/assets/css/backend_static_style.css">
    <title>@lang('fees.student_fees')</title>
  <style>
    *{
      margin: 0;
      padding: 0;
    }
    body{
      font-size: 12px;
      font-family: 'Poppins', sans-serif;
    }
    @media print {
      body {-webkit-print-color-adjust: exact;}
    }
    .transport-fees-print p{
      margin-bottom:2px;
    }
  </style>
  <style type="text/css" media="print">
      @page { size: A4 landscape; }
  </style>
  </head>
  <script>
    var is_chrome = function () { return Boolean(window.chrome); }
      if(is_chrome){
           window.print();
           setTimeout(function(){window.close();}, 10000);
        }else{
           window.print();
        }
  </script>
  <body>
        @php  
        $setting = generalSetting(); 
        @endphp
      <div class="student_marks_table print" >
        <div class="print-logo">
          <p>
              <img src="{{ asset('public/uploads/settings/logo_old.png') }}" style="width:120px; height:auto" alt="logo">
          </p>
          <div class="school-print-details text-right">
            <h4 class="school_name">{{$setting->school_name}}</h4>
            <p>{{$setting->address}}</p>
          </div>    
        </div>
        <div class="admission-details">
          <div class="admission-details-lft text-left">
            <p>
              @lang('student.admission_no'): {{@$student->studentDetail->admission_no}}

            </p>
            <!-- <p>
              @lang('common.date'): {{date('d/m/Y')}}
            </p> -->
            <p>
              @lang('student.student_name'): {{@$student->studentDetail->full_name}} 
            </p>
            <p>
              @if(moduleStatusCheck('University'))
              @lang('university::un.department'): {{@$student->unDepartment->name}}
              @else 
              @lang('common.class'): {{@$student->class->class_name}} ({{@$student->section->section_name}})
              @endif 
            </p>
            <p>
              Father name : {{ $parent ? ($parent->fathers_name ?? $parent->mothers_name ?? '') : '' }} 
            </p>
           
            <p>
              Phone number : {{ $student->studentDetail->mobile ?? ($parent ? ($parent->fathers_mobile ?? $parent->mothers_mobile ?? '') : '') }} 
            </p>
            <p>
              Location : {{ $routeInfo->title ?? '' }}
            </p>
            
            @if(@moduleStatusCheck('University'))
              <p>
                @lang('common.section'): {{@$student->section->section_name}}
              </p> 
              @endif 
              @if(moduleStatusCheck('University') || directFees())
              @if(count($fees_assigneds) == 1)
              <p>
                @lang('fees.payment_id'):
                <strong> {{@universityFeesInvoice($feesInstallment->invoice_no)}}</strong>
              </p>
              @endif
            @endif  
          </div>
          <div class="admission-details-right text-right">
            <span class="d-block"> @lang('common.date'): {{date('d/m/Y')}} </span>
          </div>   
        </div>

         <div class="transport-fees-print">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                <!-- first header  -->
                  <th>@lang('fees.fees_details')</th>
                  <th class="text-right">@lang('accounts.amount') ({{generalSetting()->currency_symbol}})</th>
                  <th class="text-right">PAID ({{generalSetting()->currency_symbol}})</th>
                </tr>
                </thead>
                <tbody>
        @php
          $grand_total = 0;
          $total_fine = 0;
          $total_discount = 0;
          $total_paid = 0;
          $total_grand_paid = 0;
          $total_balance = 0;
          $totalpayable=0;
          $discount_amount = 0;
          $fine  = 0;
          $paid  = 0;
        @endphp

       @foreach($fees_assigneds as $fees_assigned)
          @php 
            $grand_total += $fees_assigned->feesGroupMaster->amount; 
            $discount_amount = $fees_assigned->applied_discount;
              $total_discount += $discount_amount;
              $student_id = $fees_assigned->student_id;
              //Sum of total paid amount of single fees type
              $paid = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id, $fees_assigned->record_id)->sum('amount');
              $total_grand_paid += $paid;
              //Sum of total fine for single fees type
            $fine = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id, $fees_assigned->record_id)->sum('fine');
            $total_fine += $fine;
            $total_paid = $discount_amount + $paid;


          @endphp
          <tr>
            @php
              $assigned_main_fees=number_format((float)@$fees_assigned->feesGroupMaster->amount, 2, '.', '');
              $p_amount= $assigned_main_fees-$paid + $fine-$discount_amount;
              //  $totalpayable+=number_format((float)@$fees_assigned->feesGroupMaster->amount, 2, '.', '');
              $totalpayable+=$p_amount;
            @endphp
             <!-- first td wrap  -->
             {{-- @if ($p_amount>0) --}}
                <td class="border-top">
                    <p>
                      {{$fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesGroups->name:""}} 
                      [{{$fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesTypes->name:""}}]
                    </p>
                    @if ($discount_amount>0)
                      <!-- <p>
                        <strong>
                          @lang('fees.discount')(-)
                        </strong> 
                      </p> -->
                    @endif
                    @if ($fine>0)
                      <p> 
                        <strong>
                          @lang('fees.fine')(+)
                        </strong> 
                      </p>
                    @endif
                    @if ($paid>0)
                     <!--  <p> 
                        <strong>
                          @lang('fees.submit')(+)
                         Paid
                        </strong> 
                      </p> -->
                    @endif
                      <!-- <p> 
                        <strong>
                          @lang('fees.unpaid')
                        </strong> 
                      </p> -->
                </td>
                
                <td class="border-top" style="text-align: right">
                    {{@$assigned_main_fees}}
                    <br>
                  <!-- {{number_format(@$p_amount, 2, '.', '')}} -->
                </td>
                <td class="border-top" style="text-align: right">                    
                    @if ($fine>0)
                      {{number_format($fine, 2, '.', '')}}
                    @endif
                    @if ($paid>0)
                      {{number_format($paid, 2, '.', '')}}
                    @else 
                    -
                    @endif
                    <br>
                  <!-- {{number_format(@$p_amount, 2, '.', '')}} -->
                </td>
               
             {{-- @endif --}}
          </tr>
          @endforeach
             
             @php
              $totalpayable=$totalpayable;
              if ($totalpayable<0) {
                  $totalpayable=0.00;
              } else {
                $totalpayable=$totalpayable;
              }

              $transport_total_paid_amount = $transportPaymentInfo->total_amount ?? 0;

              $transport_total_payable_amount = $transport_total_amount - $transport_total_paid_amount
          @endphp
           
          <tr>
            <td>
              <strong> Transport fees </strong>
            </td>
            <td style="text-align: right">
              {{ number_format((float) $transport_total_amount, 2, '.', '') }}
            </td>
            <td style="text-align: right">
              {{ number_format((float) $transport_total_paid_amount, 2, '.', '') }} 
            </td>
          </tr>

          <!-- Grand Details-->
         
         <!--  <thead>
          <tr>
            
            <th>Grand Total</th>
            <th class="text-right">Total Paid</th>
            <th class="text-right">Total Balance</th>
          </tr>
          </thead> -->
         <!--  <tr>
            <td style="text-align: right">
              <strong> {{ number_format((float) $grand_total ?? 0, 2, '.', '')}} </strong>
             </td>
             <td style="text-align: right">
              <strong> {{ number_format((float) $total_grand_paid, 2, '.', '')}} </strong>
             </td>
             <td style="text-align: right">
              <strong> {{ number_format((float) ($grand_total - $total_grand_paid), 2, '.', '')}} </strong>
             </td>
          </tr> -->

          <!---->
          
          <!--Check <tr>
            <td></td>
            <td>
              <p>
                <strong>
                  <p class="text-right"> @lang('fees.grand_total')  :  {{ number_format((float) $grand_total, 2, '.', '')}} </p>
                </strong>
              </p>
            </td>

            <td style="text-align: right">
              <strong> @lang('fees.total_paid') : {{ number_format((float) $total_grand_paid, 2, '.', '')}} </strong>
             </td>
          </tr> -->

          <tr>
            <td></td>
            <td>
              <p>
                <strong>
                  @lang('fees.grand_total')
                </strong>
              </p>
            </td>

            <td style="text-align: right">
              {{-- {{ number_format((float) $unapplied_discount_amount, 2, '.', '')}}<br> --}}
              <strong> {{ number_format((float) $grand_total + $transport_total_amount , 2, '.', '')}}</strong>
             </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <p>
                <strong>
                  @lang('fees.total_paid')
                </strong>
              </p>
            </td>            
            <td style="text-align: right">
              {{-- {{ number_format((float) $unapplied_discount_amount, 2, '.', '')}}<br> --}}
              <strong> {{ number_format((float) $total_grand_paid + $transport_total_paid_amount , 2, '.', '')}} </strong>
             </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <p>
                <strong>
                  Total Balance
                  <!-- @lang('fees.total_payable_amount') -->
                </strong>
              </p>
            </td>            
            <td style="text-align: right">
              {{-- {{ number_format((float) $unapplied_discount_amount, 2, '.', '')}}<br> --}}
              @php
              // Define and calculate your variables
              $total_fee_payable_amount = '0.00';
              $total_fee_payable_amount = $grand_total + $transport_total_amount;
              $total_fee_paid_amount = $total_grand_paid + $transport_total_paid_amount;

              $total_pending_amount = $total_fee_payable_amount - $total_fee_paid_amount;
          @endphp

          <strong>{{ number_format((float) ($total_pending_amount - $total_discount), 2, '.', '') }}</strong>

             </td>
          </tr>
          <!-- Check <tr>
            <td></td>
            <td>
              
            </td>            
            <td style="text-align: right">
              <strong> Total Balance : {{ number_format((float) ($grand_total - $total_grand_paid), 2, '.', '')}} </strong>
             </td>
          </tr> -->

          <!-- <tr>
            <td></td>
            <td>
              <p>
                <strong>
                  @lang('fees.discount')(-)
                </strong>
              </p>
            </td>

            <td style="text-align: right">
              <strong> {{ number_format((float) $total_discount, 2, '.', '')}} </strong>
             </td>
          </tr> -->


          <tr>
          </tr>
        </tbody>
      </table>
          <footer class="footer-transport-fees">
            <div class="footer_widget">
              <!-- <ul class="copyies_text">
                <li>@lang('fees.parent/student')</li>
                <li>@lang('fees.cashier')</li>
                <li>@lang('fees.officer')</li>
              </ul> -->
              <p class="text-right">@lang('fees.cashier')</p>
               <p class="text-right"><strong>[{{ $fees_created_by }}]</strong></p>
              <p class="copy_collect">
                @lang('fees.parent/student_copy')
              </p>
            </div>    
          </footer>
            </div>
  <script>
    function printInvoice() {
      window.print();
    }
  </script>
  <script src="{{ asset('/') }}/public/backEnd/js/fees_invoice/jquery-3.2.1.slim.min.js"></script>
  <script src="{{ asset('/') }}/public/backEnd/js/fees_invoice/popper.min.js"></script>
  <script src="{{ asset('/') }}/public/backEnd/js/fees_invoice/bootstrap.min.js"></script>
</body>
</html>