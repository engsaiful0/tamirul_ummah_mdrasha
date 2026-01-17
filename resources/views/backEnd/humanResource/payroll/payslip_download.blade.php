<style type="text/css">
.column {
  float: left;
  width: 50%;
  padding: 5px;
}
.table-row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
  </head>
  <body>

        <!-- table view -->
    <table style="background-color:#ffffff;padding:15px;width:100%;">
        <tbody>
            <tr>
                <td style="text-align:center;text-decoration:underline;color:#741692;font-weight:bold;">PAYSLIP FOR NOVEMBER 2023</td>
            </tr>
        </tbody>        
    </table>    
    <table style="width:100%; margin-top:20px;border-bottom:1px solid #DADCE8; padding-bottom:15px;">
        <tbody>
            <tr>
                <td align="left" style="padding-bottom:15px;">
                    <p style="margin:0;color:#741692;font-weight:bold;">@lang('hr.payslip_no')</p>
                    <span style="margin:0;display:block;font-size:13px;">85269</span>
                </td>
                <td align="right" style="padding-bottom:15px;">
                    @php
                        $carbonInstance = \Carbon\Carbon::parse($payroll->payslip_date);
                        $formattedTimestamp_payslip_date = $carbonInstance->format('M d, Y - h:i A');
                    @endphp
                    <p style="margin:0;color:#741692;font-weight:bold;">@lang('hr.created_date')</p>
                    <span style="margin:0;display:block;font-size:13px;">{{ $formattedTimestamp_payslip_date }}</span>
                </td>
            </tr> 
        </tbody>       
    </table> 
    <table style="width:100%;">
        <tbody>
            <tr>
                <td align="left" style="padding-bottom:15px;">
                    <img src="{{ asset('public/uploads/settings/5d7c2053b045219224192567fb6cea25.png') }}" style="width: 100px;">
                    <p style="margin:0;color:#741692;font-weight:normal;color:#828BB2;">{{$school->address}}</p>
                    <p style="margin:0;color:#741692;font-weight:normal;color:#828BB2;">{{$school->phone}}</p>
                    <span style="color:#741692;font-size:13px;">{{$school->email}}</span>
                </td>
                <td align="right" style="padding-bottom:15px;">
                    <h5 style="color:#741692;">@lang('hr.payment_to')</h5>
                    <p style="margin:0;color:#741692;font-weight:normal;color:#828BB2;">{{$payroll->full_name}}</p>
                    <p style="margin:0;color:#741692;font-weight:normal;color:#828BB2;">{{$payroll->role_name}}</p>
                    <span style="color:#741692;font-size:13px;">{{$payroll->mobile}}</span>
                    <span style="color:#741692;font-size:13px;">{{$payroll->email}}</span>
                </td>
            </tr>
        </tbody>     
    </table>
    <div class="table-row">   
        <div class="column">
            <table style="width:97%;border: 1px solid #DADCE8;">
                <tr>
                    <th colspan="2" style="background-color:#E9ECEF;padding:15px;">
                        <p style="margin:0;color:#741692;font-weight:bold;">Earnings</th>    
                    </th>
                </tr>
                @php
                $emp_earnings = json_decode($payroll->earnings, true);
                // Get the keys of the array
                $earnings_keys = array_keys($emp_earnings);
                $total_earnings=0;
                @endphp
                @foreach($earnings_keys as $keys)
                <tr style="border-bottom: 1px solid #DADCE8;">
                    <td style="padding:10px;font-size:14px;">
                        @if($keys=='emp_basic_salary')
                        @lang('hr.emp_basic_salary')
                        @elseif($keys=='emp_hra')
                        @lang('hr.hra')
                        @elseif($keys=='bonus')
                        @lang('hr.bonus')
                        @elseif($keys=='conveyance')
                        @lang('hr.conveyance')
                        @elseif($keys=='medical')
                        @lang('hr.medical')
                        @elseif($keys=='other_allawance')
                        @lang('hr.other_allawance')
                        @elseif($keys=='performance_allawance')
                        @lang('hr.performance_allawance')
                        @endif
                    </td>
                    <td style="padding:10px;text-align:right;color:#828BB2;font-size:14px;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>
                        {{ number_format((float)$emp_earnings[$keys], 2, '.', '') }}
                    </td>
                </tr>
                @php
                $total_earnings += $emp_earnings[$keys];
                
                @endphp
                @endforeach
                    <tr style="border-bottom: 1px solid #DADCE8;">
                        <td style="padding:10px;font-size:15px;font-weight:bold;color:#741692;">Total Earnings</td>
                        <td style="padding:10px;text-align:right;color:#741692;font-size:15px;font-weight:bold;">
                            <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>
                        {{ number_format((float)$total_earnings, 2, '.', '') }}
                    </td>
                    </tr>
                    
                </table>    
            </div>
            <div class="column">
                <table style="width:92%;border: 1px solid #DADCE8;">
                    <tr>
                        <th colspan="2" style="background-color:#E9ECEF;padding:15px;">
                            <p style="color:#741692;font-weight:bold;margin:0;">Deductions</th>    
                        </th>
                    </tr>
                    @php
                    $emp_deductions = json_decode($payroll->deductions, true);
                    // Get the keys of the array
                    $deductions_keys = array_keys($emp_deductions);
                    $total_deductions=0;
                    @endphp
                    @foreach($deductions_keys as $keys)
                    <tr style="border-bottom: 1px solid #DADCE8;">
                        <td style="padding:10px;font-size:14px;">
                        @if($keys=='tds')
                        @lang('hr.tds')
                        @elseif($keys=='esi')
                        @lang('hr.esi')
                        @elseif($keys=='bank_loan')
                        @lang('hr.bank_loan')
                        @elseif($keys=='employer_contribution')
                        @lang('hr.employer_contribution')
                        @elseif($keys=='employee_contribution')
                        @lang('hr.employee_contribution')
                        @endif
                    </td>
                        <td style="padding:10px;text-align:right;color:#828BB2;font-size:14px;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>
                        {{ number_format((float)$emp_deductions[$keys], 2, '.', '') }}
                    </td>
                    </tr>
                    @php
                    $total_deductions += $emp_deductions[$keys];
                    @endphp
                    @endforeach
                    @if($payroll->additional_deduction!='') 
                    @php
                    $total_deductions=$total_deductions+$payroll->additional_deduction;
                    @endphp
                    <tr style="border-bottom: 1px solid #DADCE8;">
                        <td colspan="2" style="background-color:#E9ECEF;padding:10px;color:#741692;font-weight:bold;">Additional Deductions</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #DADCE8;">
                        <td style="padding:10px;font-size:14px;">{{$payroll->reason}}</td>
                        <td style="padding:10px;text-align:right;color:#828BB2;font-size:14px;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>
                            {{$payroll->additional_deduction}}
                        </td>
                    </tr>
                    @endif
                    <tr style="border-bottom: 1px solid #DADCE8;">
                        <td style="padding:10px;font-size:15px;font-weight:bold;color:#741692;">Total Deductions</td>
                        <td style="padding:10px;text-align:right;color:#741692;font-size:15px;font-weight:bold;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>
                        {{ number_format((float)$total_deductions, 2, '.', '') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <div style="margin-top:20px;">  
        <table style="width:100%;">
            <tbody>
                <tr align="right">
                    <td style="padding-bottom:15px;">
                        @php
                            $net_salaray = $total_earnings - $total_deductions;
                        @endphp
                        <div style="border:1px solid #DADCE8;padding:10px;">
                            <p style="margin:0;color:#741692;font-weight:bold;">Net Pay : <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> 
                            {{ number_format((float)$net_salaray, 2, '.', '') }}
                        </p>
                            <!-- <span style="margin:0;display:block;font-size:13px;">Eighty Five Hundred Twenty Dollars</span> -->
                        </div>    
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- table view --> 