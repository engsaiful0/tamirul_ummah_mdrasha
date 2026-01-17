@extends('backEnd.master')
@section('title')
    @lang('hr.generate_payroll')
@endsection
@push('css')
    <style>
        
    </style>
@endpush
@section('mainContent')
    <section class="sms-breadcrumb mb-20 white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('hr.generate_payroll')</h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="{{ route('submenu-list',['sub_menu' =>'human_resource']) }}">@lang('hr.human_resource')</a>
                    <a href="#">@lang('hr.generate_payroll')</a>
                </div>
            </div>
        </div>
</div>
</div>
    </section>


    <section class="payslip-section">
        @foreach($payroll_records as $payroll)
        <div class="container-fluid">
            <div class="white-box w-100">
                <div class="row p-0">
                    <!-- payslip title -->
                    <div class="col-lg-12 p-0">
                        <div class="text-center mx-auto">
                            <h3 class="text-uppercase payslip-title">
                            @php
                            $payslip_month = \Carbon\Carbon::parse($payroll->payslip_date)->format('F Y'); // 'F' for full month name
                            @endphp
                            @lang('hr.payslip_for') {{$payslip_month}}</h3> 
                        </div>    
                    </div> 
                    <!-- payslip no -->
                    <div class="col-lg-12">
                        <div class="payslip-no d-flex align-items-center justify-content-between">
                            <div class="payslipno-left">
                                <h4>@lang('hr.payslip_no')</h4>
                                <p>{{$payroll->payslip_number}}</p>
                            </div>   
                            <div class="payslipno-right text-right">
                                @php
                                    $carbonInstance = \Carbon\Carbon::parse($payroll->payslip_date);
                                    $formattedTimestamp_payslip_date = $carbonInstance->format('M d, Y - h:i A');
                                @endphp
                                <h4>@lang('hr.created_date')</h4>
                                <p>{{ $formattedTimestamp_payslip_date }}</p>
                            </div> 
                        </div>    
                    </div> 
                    <!-- Payslip address -->
                    <div class="col-lg-12 mt-20">
                        <div class="payslip-address d-flex align-items-center justify-content-between">
                            <div class="payslip-address-left">
                                <img src="{{ asset('public/uploads/settings/5d7c2053b045219224192567fb6cea25.png') }}">
                                <p class="mt-10">{{$school->address}}</p>
                                <p>{{$school->phone}}</p>
                                <span class="add-email">{{$school->email}}</span>
                            </div>
                            <div class="payslip-address-right text-right">
                                <h5>@lang('hr.payment_to')</h5>
                                <p>{{$payroll->full_name}}</p>
                                <p>{{$payroll->role_name}}</p>
                                <span class="add-email mr-10">{{$payroll->mobile}}</span>
                                <span class="add-email">{{$payroll->email}}</span>
                            </div>
                        </div>    
                    </div>    
                </div> 
                    <!-- earning and deduction -->
                <div class="row mt-20">
                    <div class="col-lg-6">
                        <!-- earning -->
                        <div class="earning-section">
                            <div class="earning-title p-15">
                                <h5 class="m-0">Earnings</h5>
                            </div>
                            <div class="earning-body">
                                @php
                                //$json_earnings = json_decode($payroll->earnings);
                                $emp_earnings = json_decode($payroll->earnings, true);
                                // Get the keys of the array
                                $earnings_keys = array_keys($emp_earnings);
                                $total_earnings=0;
                                @endphp
                                @foreach($earnings_keys as $keys)
                                <div class="earning-body-hr">
                                    <div class="d-flex align-items-center justify-content-between p-10">
                                        <p>
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
                                        </p>
                                        <p class="pay-amt">
                                        {{ generalSetting() ? generalSetting()->currency_symbol : ''}} {{ number_format((float)$emp_earnings[$keys], 2, '.', '') }}</p>
                                    </div>    
                                </div>
                                @php
                                $total_earnings += $emp_earnings[$keys];
                                @endphp
                                @endforeach
                                <div class="earning-body-hr">
                                    <div class="d-flex align-items-center justify-content-between p-10">
                                        <p class="total-earnings font-weight-bold">Total Earnings</p>
                                        <p class="total-earnings font-weight-bold">
                                        {{ number_format((float)$total_earnings, 2, '.', '') }}</p>
                                    </div>    
                                </div>
                            </div>   
                             <!-- earning -->  
                        </div>   
                    </div>  
                    <div class="col-lg-6">
                        <!-- deduction -->
                        <div class="earning-section">
                            <div class="earning-title p-15">
                                <h5 class="m-0">Deduction</h5>
                            </div>
                            <div class="earning-body">
                                @php
                                $emp_deductions = json_decode($payroll->deductions, true);
                                // Get the keys of the array
                                $deductions_keys = array_keys($emp_deductions);
                                $total_deductions=0;
                                @endphp
                                @foreach($deductions_keys as $keys)
                                <div class="earning-body-hr">
                                    <div class="d-flex align-items-center justify-content-between p-10">
                                        <p>
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

                                        </p>
                                        <p class="pay-amt">
                                        {{ generalSetting() ? generalSetting()->currency_symbol : ''}} {{ number_format((float)$emp_deductions[$keys], 2, '.', '') }}</p>
                                    </div>    
                                </div>
                                @php
                                $total_deductions += $emp_deductions[$keys];
                                @endphp
                                @endforeach
                            </div>
                            @if($payroll->additional_deduction!='') 
                            @php
                            $total_deductions=$total_deductions+$payroll->additional_deduction;
                            @endphp
                            <div class="earning-title p-15">
                                    <h5 class="m-0">Additional Deductions</h5>
                            </div> 
                            <div class="earning-body">
                                <div class="earning-body-hr">
                                    <div class="d-flex align-items-center justify-content-between p-10">
                                        <p>{{$payroll->reason}}</p>
                                        <p class="pay-amt">{{ generalSetting() ? generalSetting()->currency_symbol : ''}} {{$payroll->additional_deduction}}</p>
                                    </div>    
                                </div> 
                            </div>
                            @endif
                           <div class="earning-body-hr">
                                <div class="d-flex align-items-center justify-content-between p-10">
                                    <p class="total-earnings font-weight-bold">Total Deductions</p>
                                    <p class="total-earnings font-weight-bold">{{ generalSetting() ? generalSetting()->currency_symbol : ''}} {{ number_format((float)$total_deductions, 2, '.', '') }}
                                    </p>
                                </div>    
                            </div>  
                            <!-- deduction -->  
                        </div>  

                        <!-- Other Deduction -->
                        <div class="earning-section">
                            <div class="earning-title p-15">
                                <h5 class="m-0">Other Deduction</h5>
                            </div>
                            <div class="earning-body">
                                @php

                                 //print_r($payroll->other_deductions);
                                 //exit;
                                $emp_other_deductions = json_decode($payroll->other_deductions, true);

                                //print_r($emp_other_deductions);
                                //exit;
                                // Get the keys of the array
                                $other_deductions_keys = array_keys($emp_other_deductions);
                                $total_other_deductions=0;

                                //print_r($other_deductions_keys);
                                //exit;
                                @endphp
                                @foreach($other_deductions_keys as $keys)
                                <div class="earning-body-hr">
                                    <div class="d-flex align-items-center justify-content-between p-10">
                                        <p>
                                        @if($keys=='epf_wages')
                                        @lang('hr.epf_wages')
                                        @elseif($keys=='eps_wages')
                                        @lang('hr.eps_wages')
                                        @elseif($keys=='edli_wages')
                                        @lang('hr.edli_wages')

                                        @elseif($keys=='epf_remitted')
                                        @lang('hr.epf_remitted')

                                        @elseif($keys=='eps_remitted')
                                        @lang('hr.eps_remitted')

                                        @elseif($keys=='epf_eps_diff')
                                        @lang('hr.epf_eps_diff')
                                        @endif

                                        </p>
                                        <p class="pay-amt">
                                        {{ generalSetting() ? generalSetting()->currency_symbol : ''}} {{ number_format((float)$emp_other_deductions[$keys], 2, '.', '') }}</p>
                                    </div>    
                                </div>
                                @php
                                $total_other_deductions += $emp_other_deductions[$keys];
                                @endphp
                                @endforeach
                            </div>
                            @php
                                $total_deductions += $total_other_deductions;
                            @endphp
                           <div class="earning-body-hr">
                                <div class="d-flex align-items-center justify-content-between p-10">
                                    <p class="total-earnings font-weight-bold">Total Deductions</p>
                                    <p class="total-earnings font-weight-bold">{{ generalSetting() ? generalSetting()->currency_symbol : ''}} {{ number_format((float)$total_deductions, 2, '.', '') }}
                                    </p>
                                </div>    
                            </div>  
                            <!-- deduction -->  
                        </div>  
                    </div>  
                </div>

                <!-- earning and deduction -->
                <div class="row mt-20">
                    <div class="col-lg-12">
                        <div class="text-right p-15 payslip-footer">
                            @php
                                $net_salaray = $total_earnings - $total_deductions;
                            @endphp
                            <h5 class="font-weight-bold">Net Pay : {{ generalSetting() ? generalSetting()->currency_symbol : ''}} {{ number_format((float)$net_salaray, 2, '.', '') }}</h5>
                            <!-- <p>Eighty Five Hundred Twenty Dollars</p> -->
                        </div>    
                    </div>    
                </div> 
            </div>    
        </div>
        @endforeach    
    </section> 

 
@endsection
@include('backEnd.partials.data_table_js')
@include('backEnd.partials.date_picker_css_js')
<script>
    $(document).ready(function() {
        $('.data-table').DataTable();
    })
</script>    