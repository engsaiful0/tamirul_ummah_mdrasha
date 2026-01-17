@extends('backEnd.master')
@section('title')
    @lang('hr.generate_payroll')
@endsection
@push('css')
    <style>
        element.style {
            width: 190px !important;
        }

        table.dataTable thead th {
            /* padding: 10px 30px !important; */
            padding-left: 25px !important;
        }

        table.dataTable tbody th,
        table.dataTable tbody td {
            padding: 20px 10px 20px 15px !important;
        }

        table.dataTable thead .sorting::after {
            left: 10px !important;
            top: 10px;
        }

        table.dataTable thead .sorting_asc::after {
            left: 10px !important;
            top: 10px;
        }
    </style>
@endpush
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('hr.payroll')</h1>
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
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid">
            @if (isset($staffs))
                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="row mb-20">
                            <div class="col-lg-8 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-0">@lang('hr.verify_payout')</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg col-6 text_sm_right">
                                <button type="submit" class="primary-btn small fix-gr-bg" data-toggle="modal" data-target="#generate-payroll">
                                    <span class="ti-receipt pr-2"></span>
                                    Generate Payroll                                
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="table_id" class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>@lang('hr.staff_no')</th>
                                            <th>@lang('common.name')</th>
                                            <th>@lang('hr.attendance')</th>
                                            <th>@lang('common.month')</th>
                                            <th>@lang('hr.salary')</th>
                                            <th>@lang('hr.earnings')</th>
                                            <th>@lang('hr.deductions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staffs as $value)
                                                @php
                                                    $getPayrollDetails = $value->payrollStatus;
                                                    $numberOfDays = App\SmStaffAttendence::getAttendence($value->id, $payroll_month, $payroll_year);
                                                    $workingDays=30;

                                                    $earnings = App\SmStaffEarnings::getEarnings($value->id, $payroll_month, $payroll_year);
                                                    $deductions = App\SmStaffDeductions::getDeductions($value->id, $payroll_month, $payroll_year);
                                                @endphp
                                            <tr>
                                                <td>{{ $value->staff_no }}</td>
                                                <td>{{ $value->first_name }}&nbsp;{{ $value->last_name }}</td>
                                                <td>{{ $numberOfDays }}/{{$workingDays}}</td>
                                                <td>{{ $payroll_month }}</td>
                                                <td>{{ $value->basic_salary }}</td>
                                                <td>{{ isset($earnings->amount) && $earnings->amount!='' ? $earnings->amount : '-' }}</td>
                                                <td>{{ isset($deductions->amount) && $deductions->amount!='' ? $deductions->amount : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- earning modal -->
    <div class="modal fade" id="addEarningModal" tabindex="-1" role="dialog" aria-labelledby="addEarningModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEarningModalLabel">Add Earning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="earning-modal">
                    {{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => 'staff-earnings-store'])}}
                        <input type="hidden" id="earnings_staff_id" name="earnings_staff_id" value="">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group d-block">
                                        <label for="setting-percentage">Reason</label>
                                        <!-- <select class="nice-select primary_select form-control" id="setting-percentage" name="reason">
                                            <option>Best Performance</option>
                                            <option>Good Attendance </option>
                                            <option>Bonus</option>
                                            <option>Yearly Performance</option>
                                            <option>Topper of School 
                                            {{ isset($earningsData->group_name) && $earningsData->group_name == '3' ? 'selected' : '' }}</option>
                                        </select> -->


                                        <select class="nice-select primary_select form-control" id="reason" name="reason">
                                        <option value="">select</option>
                                        <option value="1">Best Performance</option>
                                        <option value="2">Good Attendance</option>
                                        <option value="3">Bonus</option>
                                        <option value="4">Yearly Performance</option>
                                        <option value="5">Topper of School</option>
                                        
                                    </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-block mt-20">
                                        <label for="setting-name">Payment</label>
                                        <input type="text" class="primary_input_field form-control" placeholder="Enter Name" name="amount" value="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-block">
                                        <label for="setting-name">Remarks</label>
                                        <input type="text" class="primary_input_field form-control" placeholder="Enter Name" name="remarks" value="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg w-50 mr-10" data-dismiss="modal">Cancel</button>
                                        <button class="primary-btn fix-gr-bg submit w-50" id="save_button_query" type="submit">Save</button>
                                    </div>
                                </div>        
                            </div>    
                        </div>    
                       {{ Form::close() }}
                    </div>    
                </div>
            </div>
        </div>    
    </div>
    <!-- earning modal -->

    <!-- deduction modal -->
    <div class="modal fade" id="addDeductionModal" tabindex="-1" role="dialog" aria-labelledby="addDeductionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeductionModalLabel">Add Deduction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deduction-modal">
                    {{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => 'staff-deductions-store'])}}
                        <input type="hidden" id="deductions_staff_id" name="deductions_staff_id" value="">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group d-block">
                                        <label for="setting-percentage">Reason</label>
                                        <!-- <select class="nice-select primary_select form-control" id="setting-percentage" name="reason">
                                            <option>Best Performance</option>
                                            <option>Good Attendance </option>
                                            <option>Bonus</option>
                                            <option>Yearly Performance</option>
                                            <option>Topper of School 
                                            {{ isset($earningsData->group_name) && $earningsData->group_name == '3' ? 'selected' : '' }}</option>
                                        </select> -->


                                        <select class="nice-select primary_select form-control" id="reason" name="reason">
                                        <option value="">select</option>
                                        <option value="1">Best Performance</option>
                                        <option value="2">Good Attendance</option>
                                        <option value="3">Bonus</option>
                                        <option value="4">Yearly Performance</option>
                                        <option value="5">Topper of School</option>
                                        
                                    </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-block mt-20">
                                        <label for="setting-name">Payment</label>
                                        <input type="text" class="primary_input_field form-control" placeholder="Enter Name" name="amount" value="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-block">
                                        <label for="setting-name">Remarks</label>
                                        <input type="text" class="primary_input_field form-control" placeholder="Enter Name" name="remarks" value="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg w-50 mr-10" data-dismiss="modal">Cancel</button>
                                        <button class="primary-btn fix-gr-bg submit w-50" id="save_button_query" type="submit">Save</button>
                                    </div>
                                </div>        
                            </div>    
                        </div>    
                       {{ Form::close() }}
                    </div>    
                </div>
            </div>
        </div>    
    </div>
    <!-- deduction modal -->

    <!-- confirm payroll modal -->
    <div class="modal fade" id="generate-payroll" tabindex="-1" role="dialog" aria-labelledby="payrollmodal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ Form::open(['class' => 'form-horizontal', 'route' => 'payroll_generate', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            <div class="modal-body generatepayroll-body bg-white rounded-2xl text-center mx-auto w-100">
                <button type="button" class="close payroll-btn" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <img src="{{ asset('public/backEnd/img/payroll-generate.png') }}">
                <h3 class="mt-40 text-uppercase">Are you Sure want generate Payroll</h3>
                <p>If okay please click to generate payslip</p>
                <div class="d-flex justify-content-between mt-40">
                    <button type="button" class="primary-btn tr-bg w-50 mr-10" data-dismiss="modal">Cancel</button>
                    <button class="primary-btn fix-gr-bg submit w-50" id="save_button_query" type="submit">Generate</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
      </div>
    </div>
    <!-- confirm payroll modal -->

    </section>
@endsection
@include('backEnd.partials.data_table_js')
@include('backEnd.partials.date_picker_css_js')
