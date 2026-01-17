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
        <div class="printing-body">
          <div class="admission-details">
            <div class="admission-details-lft text-left">
              <p>
                @lang('student.admission_no'): {{@$student->studentDetail->admission_no}}
              </p>
              <p>
                @lang('student.student_name'): {{@$student->studentDetail->full_name}} 
              </p>
              <p>
                @lang('common.class'): {{@$student->class->class_name}}
              </p>
              <!-- <p>
                @lang('student.roll'):{{@$student->roll_no}}
              </p> -->
            </div>
            <div class="admission-details-right">
              <span class="d-block"> Bill number : {{ $payment_info->bill_number }} </span>
              <span> @lang('common.date'): {{date('d/m/Y')}}</span>
              <span class="d-block"> Generatd by :{{ $fees_created_by }} </span>
            </div>   
          </div>
          <div class="transport-fees-print">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>@lang('fees.route')</th>
                    <th>@lang('fees.month')</th>
                    <th>@lang('fees.total_payable_amount')</th>
                    <th>@lang('fees.total_paid') ({{generalSetting()->currency_symbol}})</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($fee_detail)>0)
                    @foreach($fee_detail as $index =>$fee_data)  
                    @php 
                    $index++;
                    @endphp          
                    @foreach($fee_data as $fee)
                    @php            
                    $paid = $fee->total_amount;
                    $assigned_route_fees = $fee->assigned_route_fees;
                    $payable = $paid-$assigned_route_fees;
                    @endphp
                    <tr>
                      <td>{{$index}}</td>
                      <td>{{$fee->title}}</td>
                      <td>{{$fee->month}}</td>
                      <td>{{$assigned_route_fees}}</td>
                      <td>{{$paid}}</td>
                    </tr>
                      @endforeach
                      @endforeach
                      @else
                      <tr>
                        <td>No Records Found!</td>
                      </tr>
                    @endif
                </tbody>
            </table>
            </div>  
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
