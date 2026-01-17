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
    .transport-fees-print p{
      margin-bottom:2px;
    }
    @media print {
      body {-webkit-print-color-adjust: exact;}
    }
    .transport-fees-print .table thead th{
      background-color:#8332FB !important;
      -webkit-print-color-adjust: exact;
      color:#fff !important;
      font-size: 11px;
      font-weight: 500;
    }
  </style>
  <style type="text/css" media="print">
      @page { size: A4 landscape; }
  </style>
  </head>
  <script>
    var is_chrome = function () { return Boolean(window.chrome); }
      if(is_chrome){
          //  window.print();
          //  setTimeout(function(){window.close();}, 10000);
           //give them 10 seconds to print, then close
        }else{
           window.print();
        }
  </script>
  <body onLoad="loadHandler();">
        @php  
          $setting = generalSetting();
        @endphp
      <div class="student_marks_table print" >
        <div class="print-logo">
          <p>
            @if (file_exists($setting->logo))
              <img src="{{url($setting->logo)}}" style="width:120px; height:auto" alt="">
            @endif
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
            <p>
              @lang('student.student_name'): {{@$student->studentDetail->full_name}} 
            </p>
            <p>
              @if(moduleStatusCheck('University'))
              @lang('university::un.department'): {{@$student->unDepartment->name}}
              @else 
              @lang('common.class'): {{@$studentRecord->class->class_name}}
              @endif 
            </p>
            <p>
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
            </p> 
          </div>
          <div class="admission-details-right">
            <span> @lang('common.date'): {{date('d/m/Y')}}</span>
            <span> @lang('student.roll'):{{@$student->roll_no}}</span>
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
                    <!-- space  -->
                    <!--<th class="border-0" rowspan="{{7+count($fees_assigneds)}}"></th>-->
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

      @if(moduleStatusCheck('University'))
      @foreach($fees_assigneds as $feesInstallment)
      @php
      if(($feesInstallment->active_status == 0)){
        $totalpayable += discountFeesAmount($feesInstallment->id);
      }
      $total_grand_paid += $feesInstallment->paid_amount;
      $grand_total += discountFeesAmount($feesInstallment->id); 
      
      @endphp
      <tr>
          {{-- 1st warp start here  --}}
            <td class="border-top fees-invoice-print">
                <p>
                  {{@$feesInstallment->installment->title }}
                </p>
                @if ($feesInstallment->discount_amount>0)
                  <p>
                    <strong>
                      @lang('fees.discount')(-)
                    </strong> 
                  </p>
                @endif
                @if ($fine>0)
                  <p> 
                    <strong>
                      @lang('fees.fine')(+)
                    </strong> 
                  </p>
                @endif
                @if ($feesInstallment->paid_amount != 0)
                  <p> 
                    <strong>
                      @lang('fees.submit')(+) 
                    </strong> 
                  </p>
                  @if($feesInstallment->active_status == 1)
                  <p> 
                    <strong>
                      [@lang('fees.paid')]
                    </strong> 
                  </p>
                  @endif
                  @else 
                  <p> 
                    <strong>
                      [@lang('fees.unpaid')]  
                    </strong> 
                  </p>

                @endif

                  
            </td>
            <td class="border-top" style="text-align: right">
                {{number_format($feesInstallment->amount, 2, '.', '') }}
                @if ($feesInstallment->discount_amount>0)
                  <br>
                  {{number_format($feesInstallment->discount_amount, 2, '.', '')}}
                @endif
                @if ($fine>0)
                  <br>
                  {{number_format($fine, 2, '.', '')}}
                @endif
                @if ($feesInstallment->paid_amount != 0 )
                  <br>
                  {{number_format($feesInstallment->paid_amount, 2, '.', '')}}
                @endif
                <br>
            </td>
        {{-- 1st warp End  --}}
      </tr>
      @endforeach

      {{-- University End Here  --}}


      {{-- direct fees start here --}}
      @elseif(directFees())
      @foreach($fees_assigneds as $feesInstallment)
      @php
      if(($feesInstallment->active_status == 0)){
        $totalpayable += discountFees($feesInstallment->id);
      }
      $grand_total += discountFees($feesInstallment->id); 
      $total_grand_paid +=  $feesInstallment->paid_amount;
      
      @endphp
      <tr>
          {{-- 1st warp start here  --}}
            <td class="border-top">
                <p>
                  {{@$feesInstallment->installment->title }}
                </p>
                @if ($feesInstallment->discount_amount>0)
                  <p>
                    <strong>
                      @lang('fees.discount')(-)
                    </strong> 
                  </p>
                @endif
                @if ($fine>0)
                  <p> 
                    <strong>
                      @lang('fees.fine')(+)
                    </strong> 
                  </p>
                @endif
                @if ($feesInstallment->active_status == 1)
                  <p> 
                    <strong>
                      @lang('fees.submit')(+) 
                    </strong> 
                  </p>
                  <p> 
                    <strong>
                      [@lang('fees.paid')]
                    </strong> 
                  </p>
                  @else 
                  <p> 
                    <strong>
                      [@lang('fees.unpaid')]  
                    </strong> 
                  </p>

                @endif

                  
            </td>
            <td class="border-top" style="text-align: right">
                {{number_format($feesInstallment->amount, 2, '.', '') }}
                @if ($feesInstallment->discount_amount>0)
                  <br>
                  {{number_format($feesInstallment->discount_amount, 2, '.', '')}}
                @endif
                @if ($fine>0)
                  <br>
                  {{number_format($fine, 2, '.', '')}}
                @endif
                @if ($feesInstallment->active_status ==1 )
                  <br>
                  {{number_format($feesInstallment->paid_amount, 2, '.', '')}}
                @endif
                <br>
            </td>
          {{-- 1st warp End  --}}
                    {{-- 1st warp start here  --}}
                    <td class="border-top">
                      <p>
                        {{@$feesInstallment->installment->title }}
                      </p>
                      @if ($feesInstallment->discount_amount>0)
                        <p>
                          <strong>
                            @lang('fees.discount')(-)
                          </strong> 
                        </p>
                      @endif
                      @if ($fine>0)
                        <p> 
                          <strong>
                            @lang('fees.fine')(+)
                          </strong> 
                        </p>
                      @endif
                      @if ($feesInstallment->active_status == 1)
                        <p> 
                          <strong>
                            @lang('fees.submit')(+) 
                          </strong> 
                        </p>
                        <p> 
                          <strong>
                            [@lang('fees.paid')]
                          </strong> 
                        </p>
                        @else 
                        <p> 
                          <strong>
                            [@lang('fees.unpaid')]  
                          </strong> 
                        </p>
      
                      @endif
      
                        
                  </td>
                  <td class="border-top" style="text-align: right">
                      {{number_format($feesInstallment->amount, 2, '.', '') }}
                      @if ($feesInstallment->discount_amount>0)
                        <br>
                        {{number_format($feesInstallment->discount_amount, 2, '.', '')}}
                      @endif
                      @if ($fine>0)
                        <br>
                        {{number_format($fine, 2, '.', '')}}
                      @endif
                      @if ($feesInstallment->active_status ==1 )
                        <br>
                        {{number_format($feesInstallment->paid_amount, 2, '.', '')}}
                      @endif
                      <br>
                  </td>
                {{-- 1st warp End  --}}
                          {{-- 1st warp start here  --}}
            <td class="border-top">
              <p>
                {{@$feesInstallment->installment->title }}
              </p>
              @if ($feesInstallment->discount_amount>0)
                <p>
                  <strong>
                    @lang('fees.discount')(-)
                  </strong> 
                </p>
              @endif
              @if ($fine>0)
                <p> 
                  <strong>
                    @lang('fees.fine')(+)
                  </strong> 
                </p>
              @endif
              @if ($feesInstallment->active_status == 1)
                <p> 
                  <strong>
                    @lang('fees.submit')(+) 
                  </strong> 
                </p>
                <p> 
                  <strong>
                    [@lang('fees.paid')]
                  </strong> 
                </p>
                @else 
                <p> 
                  <strong>
                    [@lang('fees.unpaid')]  
                  </strong> 
                </p>

              @endif

                
          </td>
          <td class="border-top" style="text-align: right">
              {{number_format($feesInstallment->amount, 2, '.', '') }}
              @if ($feesInstallment->discount_amount>0)
                <br>
                {{number_format($feesInstallment->discount_amount, 2, '.', '')}}
              @endif
              @if ($fine>0)
                <br>
                {{number_format($fine, 2, '.', '')}}
              @endif
              @if ($feesInstallment->active_status ==1 )
                <br>
                {{number_format($feesInstallment->paid_amount, 2, '.', '')}}
              @endif
              <br>
          </td>
        {{-- 1st warp End  --}}
      </tr>
      @endforeach

      {{-- direct fees end here  --}}

      @else 
        @foreach($fees_assigneds as $fees_assigned)
          @php 
            $grand_total += $fees_assigned->fees_amount; 
            $discount_amount = 0;
              $total_discount += $discount_amount;
              $student_id = $fees_assigned->student_id;
              //Sum of total paid amount of single fees type
              $paid = App\SmExtraclassFees::feespaidSum($fees_assigned->student_id, 'amount' ,$fees_assigned->extra_curricular_record_id);
              if(empty($paid))
              { 
                  $paid=0;
              }
              $total_grand_paid += $paid;
              //Sum of total fine for single fees type
            $fine = App\SmExtraclassFees::feespaidSum($fees_assigned->student_id, 'fine', $fees_assigned->record_id);
            if(empty($fine))
            { 
                $fine=0;
            }
            $total_fine += $fine;
            $total_paid = $discount_amount + $paid;
          @endphp
          <tr>
            @php
              $assigned_main_fees=number_format((float)@$fees_assigned->fees_amount, 2, '.', '');
              $p_amount= $assigned_main_fees-$paid + $fine-$discount_amount;
              //  $totalpayable+=number_format((float)@$fees_assigned->fees_amount, 2, '.', '');
              $totalpayable+=$p_amount;
            @endphp
             <!-- first td wrap  -->
             {{-- @if ($p_amount>0) --}}
                <td class="border-top">
                    <p>
                      {{$fees_assigned->feesExtraClass!=""?$fees_assigned->feesExtraClass->class_name:""}}
                    </p>
                    @if ($discount_amount>0)
                      <p>
                        <strong>
                          @lang('fees.discount')(-)
                        </strong> 
                      </p>
                    @endif
                    @if ($fine>0)
                      <p> 
                        <strong>
                          @lang('fees.fine')(+)
                        </strong> 
                      </p>
                    @endif
                    @if ($paid>0)
                      <p> 
                        <strong>
                          @lang('fees.submit')(+)
                        </strong> 
                      </p>
                    @endif
                      <p> 
                        <strong>
                          @lang('fees.unpaid')
                        </strong> 
                      </p>
                </td>
                <td class="border-top" style="text-align: right">
                    {{@$assigned_main_fees}}
                    @if ($discount_amount>0)
                      <br>
                      {{number_format($discount_amount, 2, '.', '')}}
                    @endif
                    @if ($fine>0)
                      <br>
                      {{number_format($fine, 2, '.', '')}}
                    @endif
                    @if ($paid>0)
                      <br>
                      {{number_format($paid, 2, '.', '')}}
                    @endif
                    <br>
                  {{number_format(@$p_amount, 2, '.', '')}}
                </td>
             {{-- @endif --}}
          
          </tr>
          @endforeach

        @endif 
          @php
              $totalpayable=$totalpayable;
              if ($totalpayable<0) {
                  $totalpayable=0.00;
              } else {
                $totalpayable=$totalpayable;
              }
          @endphp
          <tr>
            <td>
              <p>
                <strong>
                  @lang('fees.grand_total')
                </strong>
              </p>
            </td>
            <td style="text-align: right">
              {{-- {{ number_format((float) $unapplied_discount_amount, 2, '.', '')}}<br> --}}
              <strong> {{ number_format((float) $grand_total, 2, '.', '')}} </strong>
             </td>
          </tr>
          <tr>
            <td>
              <p>
                <strong>
                  @lang('fees.total_paid')
                </strong>
              </p>
            </td>
            <td style="text-align: right">
              {{-- {{ number_format((float) $unapplied_discount_amount, 2, '.', '')}}<br> --}}
              <strong> {{ number_format((float) $total_grand_paid, 2, '.', '')}} </strong>
             </td>
          </tr>
          <tr>
            <td>
              <p>
                <strong>
                  @lang('fees.total_payable_amount')
                </strong>
              </p>
            </td>
            <td style="text-align: right">
              {{-- {{ number_format((float) $unapplied_discount_amount, 2, '.', '')}}<br> --}}
              <strong> {{ number_format((float) ($grand_total - $total_grand_paid - $discount_amount), 2, '.', '')}} </strong>
             </td>
          </tr>
          <tr>
          </tr>

          <tr>
                <td colspan="2" >
                  @lang('fees.if_unpaid_admission_will_be_cancelled_after')
                </td>
          </tr>

          <tr>
                <td colspan="2">
                  <p class="parents_num text_center"> 
                    @lang('fees.parents_phone_number') : 
                    <span>
                      {{@$parent->guardians_mobile}}
                    </span> 
                  </p>
                </td>
          </tr>
              </tbody>  
            </table>
          </div>
        </div>    
        <footer class="footer-transport-fees">
        <div class="footer_widget">
          <ul class="copyies_text">
            <li>@lang('fees.parent/student')</li>
            <li>@lang('fees.cashier')</li>
            <li>@lang('fees.officer')</li>
          </ul>
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
