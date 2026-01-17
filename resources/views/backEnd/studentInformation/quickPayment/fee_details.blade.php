@extends('backEnd.master')
@section('title')
    @lang('student.extra_curricular_student')
@endsection
@push('css')
    <style>
        .student_rec_card {
            border-radius: 6px;
            border: 1px solid var(--border_color);
            width: 100%;
        }

        .student_rec_header {
            padding: 12px;
            background: -webkit-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
            background: -moz-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
            background: -o-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
            background: -ms-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
            background: linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
        }

        .student_rec_footer {
            padding: 12px;
            margin-top: 16px;
            border-top: 1px solid var(--border_color);
        }

        .student_rec_content {
            padding: 16px;
            max-height: 300px;
            min-height: 300px;
        }

        .primary-btn.icon-only {
            padding: 1px 8px !important;
            right: 15px !important;
            bottom: 13px !important;
        }

        .common-checkbox~label {
            bottom: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            text-align: left;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 5px;
            text-align: right;
        }
        input[type="text"]:disabled, input[type="number"]:disabled {
            background-color: #f2f2f2;
        }
        .btn-save {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-save:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            display: block;
            margin-top: 5px;
        }
    </style>

@endpush
@section('mainContent')
    <input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">
    <section class="sms-breadcrumb mb-20 up_breadcrumb white-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('fees.fee_assign_pay') </h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="{{ route('submenu-list',['sub_menu' =>'student_info']) }}">@lang('student.student_information')</a>
                    <a href="#">@lang('fees.fee_assign_pay')</a>
                </div>
            </div>
        </div>
        </div>
    </div>
    </section>


    <!--Fees Payment Student Information-->

    <!--Fees Payment Student Information-->

    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="main-title xs_mt_0 mt_0_sm">
                        <h3 class="mb-20">@lang('common.select_criteria')</h3>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-12 ">
                   {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student.payment-details', 'method' => 'GET', 'enctype' => 'multipart/form-data', 'id' => 'infix_form', 'onsubmit' => "return validateFeesDetails()"]) }}
                    <div class="white-box">
                        <div class="row">                            
                            @include('backEnd.studentInformation.search.search_criteria', [
                                'div' => 'col-lg-3',
                                'visiable' => ['academic', 'class', 'section', 'student'],
                            ])
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg" id="btnSubmitFeeDetails" >
                                    <span class="ti ti-search pr-2"></span>
                                    @lang('common.search')
                                </button>
                            </div>
                            <div class="edu-transport">
                                <div class="edu-fees">
                                    <input type="radio" id="education" name="fee_type" value="education" checked>
                                    <label for="education">Education Fees</label>
                                </div>
                                <div class="trans-fees">
                                    <input type="radio" id="transport" name="fee_type" value="transport">
                                    <label for="transport">Transport Fees</label>
                                </div>    
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

             <div class="container-fluid p-0 mt-4">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-20">@lang('fees.student_info')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="student-meta-box">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('common.name')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@$student->studentDetail->full_name}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @if(moduleStatusCheck('University'))
                                                        @lang('university::un.semester_label')
                                                        @else 
                                                        @lang('student.father_name')
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        @if(moduleStatusCheck('University'))
                                                        {{@$student->unSemesterLabel->name }} 
                                                        @else 
                                                        {{@$student->studentDetail->parents != ""? @$student->studentDetail->parents->fathers_name:""}}
                                                        @endif  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('fees.mobile')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@$student->studentDetail->mobile}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('student.category')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@$student->studentDetail->category !=""?@$student->studentDetail->category->category_name:""}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-lg-2 col-lg-5 col-md-6">
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @if(moduleStatusCheck('University'))
                                                        @lang('university::un.department')
                                                        @else
                                                       @lang('common.class_sec')
                                                       @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name"> 
                                                        @if(moduleStatusCheck('University'))
                                                            {{@$student->unDepartment->name}}
                                                        @else 
                                                             {{@$student->class->class_name .'('.@$student->section->section_name.')'}}
                                                        
                                                        @endif 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('student.admission_no')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@$student->studentDetail->admission_no}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                       @lang('student.roll_no')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@$student->roll_no}}
                                          
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

         
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="white-box p-3">
                        <div id="education-fees" class="fee-type">    
                            <div class="fees-table-add">
                                <div class="no-gutters">
                                    <div class="d-flex justify-content-between">
                                        <div class="main-title">
                                            <h3 class="addFees_title">@lang('fees.add_fees')</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="" id="quick_fees_groups_invoice_print_button" class="primary-btn small fix-gr-bg" target="">
                                        <i class="ti-printer pr-2"></i>
                                        @lang('fees.invoice_print')
                                    </a>
                                </div>    
                            </div>  
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student.save-billing', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'billing_form', 'onsubmit' => 'return validatePayForm()']) }}

                        <input type="hidden" name="student_id" id="student_id" value="{{ @$student->studentDetail->id }}">
                        <input type="hidden" name="student_record_id" id="student_record_id" value="{{ @$student->id }}">
                        
                        <div class="table-responsive">
                            <table id="table_id_table" class="table dataTable table-bordered feesTable_add" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                            @php $i = 0; @endphp
                            @foreach ($fees_assign_groups as $fees_assign_group)
                            @php $i++; @endphp
                            @if ($i == 1)
                                <th>{{ @$fees_assign_group->feesGroups->name }}</th>
                                <th>@lang('fees.amount')</th>
                                <th>Note</th>
                                <th>Discount</th>
                                <th>Pay</th>
                                <th>Balance</th>
                            @endif
                            @endforeach
                            </tr>
                            </thead>
                            <tbody>

                            @php
                            $total_amount = 0;
                            $total_balance = 0;
                            @endphp
                        @foreach ($fees_assign_groups as $index => $fees_assign_group)

                            @php
                            //$balance_amount = $fees_assign_group->amount - $student_fees_paid[$index];

                            $balance_amount_debit = $student_fees_paid[$index] + $student_fees_discount[$index];

                            $balance_amount = $fees_assign_group->amount - $balance_amount_debit;
                            if ($balance_amount < 0) {
                                $balance_amount = 0;
                            }
                            
                            @endphp
                                <tr>
                                    <td>{{ $fees_assign_group->feesTypes ? $fees_assign_group->feesTypes->name : '' }}</td>
                                    <td>
                                        <input type="hidden" name="amount[]" value="{{ $fees_assign_group->amount }}">
                                        <input type="hidden" name="fees_type_id[]" value="{{ $fees_assign_group->fees_type_id }}">
                                        <input type="hidden" name="fees_master_id[]" value="{{ $fees_assign_group->id }}">
                                        <input type="number" name="amount[]" required disabled value="{{ $fees_assign_group->amount }}">
                                    </td>
                                    <td>
                                        <input type="text" name="note[]" placeholder="note" value="">
                                    </td>
                                    <td>                                 
                                        <input type="number" name="discount[]" id="discount_amt" class="check_payment" value="0.00">
                                    </td>
                                    <td>                                 
                                        <input type="number" name="paid[]" id="paid_amt" class="check_payment" required value="0.00">
                                    </td>
                                    <td>    
                                        <input type="hidden" id="bal_amt" name="balance_amount[]" value="{{ $balance_amount }}">
                                        <input type="number" name="balance[]" disabled value="{{ $balance_amount }}">
                                    </td>
                                </tr>
                                @php
                                    $total_amount += $fees_assign_group->amount;
                                    $total_balance += $balance_amount;
                                @endphp
                            @endforeach
                            <tr>
                                <td>Total amount :</td> 
                                <td class="amtFees">{{ $total_amount }}</td>
                                <td></td>
                                <td></td>
                                <td>Balance amount :</td>
                                <td class="amtFees">{{ $total_balance }}</td>
                            </tr>

                            </tbody>
                            </table>
                        </div>
                        <div id="common-error-message" style="display: none;" class="error-message">At least one row must have a paid amount greater than 0.</div>
                        <div class="save-feesBtns text-right mt-4">           
                            <button type="submit" class="primary-btn small fix-gr-bg" id="btnPaySubmit">
                            <span class="ti ti-search pr-2"></span>
                            Save
                            </button>
                        </div>    
                        {{ Form::close() }}
                        </div>

                        @if(isset($sm_student->route_list_id) && $sm_student->route_list_id!='')
                        <div id="transport-fees" class="fee-type" style="display: none;">                
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student.save-transport-billing', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'billing_form', 'onsubmit' => 'return validateTransportPayForm()']) }}
                            
                                <div class="fees-table-add">
                                    <div class="no-gutters">
                                        <div class="d-flex justify-content-between">
                                            <div class="main-title">
                                                <h3>@lang('fees.transport_fees')</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="" id="quick_transport_fees_groups_invoice_print_button" class="primary-btn small fix-gr-bg" target="">
                                        <i class="ti-printer pr-2"></i>
                                        @lang('fees.invoice_print')
                                    </a>
                                </div>        
                            <input type="hidden" name="student_id" id="student_id" value="{{ @$student->studentDetail->id }}">
                            <input type="hidden" name="student_record_id" id="student_record_id" value="{{ @$student->id }}">

                            <input type="hidden" name="route_list_id" id="route_list_id" value="{{ @$sm_student->route_list_id }}">

                            <div class="table-responsive">
                                <table class="table table-bordered transFess-table" cellspacing="0" width="100%">
                                    <thead>                               
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('fees.month')</th>
                                            <th>@lang('fees.route')</th>
                                            <th>@lang('common.status')</th>
                                            <th>@lang('fees.amount') ({{generalSetting()->currency_symbol}})</th>
                                            <th>@lang('fees.paid') ({{generalSetting()->currency_symbol}})</th>
                                            <th>@lang('fees.balance')</th>
                                            <th>Not paid reason</th>
                                            <th>Action</th>
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
                                            $fee_amount=0;
                                            $print_ids = '';

                                            $monthsArray = ["January","February","March","April","May","June","July","August","September","October","November","December"
                                            ];

                                            //$jsonString = json_encode($monthsArray);
                                            $route = App\SmFeesAssign::transportRouteFees($student->student_id);
                                            $route_name = $route->title;
                                            $route_id = $route->id;

                                            $recordId = $student->id;
                                        @endphp                                
                                        @foreach($monthsArray as $index => $month)
                                        @php
                                            $index++;
                                            $paidInfo = App\SmFeesAssign::transportRouteFeesPaid($index, $student->student_id, $recordId);
                                            if($paidInfo){
                                                $paidRoutes = App\SmFeesAssign::paidTransportRoute($paidInfo->route_id);
                                                if(isset($paidRoutes->title) && $paidRoutes->title != ''){
                                                    $route_name = $paidRoutes->title;
                                                }
                                                $fee_amount = $paidInfo->assigned_route_fees;
                                                $paid_status = $paidInfo->active_status;
                                                $inactive_reason = $paidInfo->note;

                                            } else {
                                                $route_name = $route->title;
                                                $fee_amount = $route->far;
                                                $paid_status = 1;
                                                $inactive_reason = '-';
                                            }
                                            $monthlyPaid = App\SmFeesAssign::transportPaymentSum($index, $student->student_id, 'amount', $recordId);
                                            $balance_amount = $fee_amount - $monthlyPaid;
                                            $total_paid = $monthlyPaid;

                                            if($balance_amount == 0){
                                                if ($print_ids == '') {
                                                    $print_ids = $index;
                                                } else {
                                                    $print_ids = $print_ids . '-' . $index;
                                                }
                                            }
                                        @endphp
                                        <tr>
                                            <td>

                                                @if($paid_status==1)
                                                <input type="checkbox" id="fees_group.{{$index}}" class="common-checkbox fees-groups-print" name="fees_group[]" value="{{$index}}" {{ isset($balance_amount) ? ($balance_amount == 0 ? 'disabled' : '') : '' }}>
                                                <label for="fees_group.{{$index}}"></label>
                                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                                @endif
                                            </td>
                                            <td>{{$month}}</td>
                                            <td>{{$route_name}}</td>
                                            <td>
                                                @if($balance_amount == 0 && $paid_status==1)
                                                    <button class="primary-btn small bg-success text-white border-0">@lang('fees.paid')</button>
                                                @elseif($monthlyPaid != 0)
                                                    <button class="primary-btn small bg-warning text-white border-0">@lang('fees.partial')</button>
                                                @elseif($monthlyPaid == 0)
                                                    <button class="primary-btn small bg-danger text-white border-0">@lang('fees.unpaid')</button>
                                                @endif
                                            </td>
                                            <td>{{$fee_amount}}</td>
                                            <td>{{$monthlyPaid}}</td>
                                            <td>{{$balance_amount}}</td>
                                            <td> {{ $inactive_reason }}</td>
                                            <td>

                                                <select class="transport_fees_status" name="transport_fees_status" data-index="{{$index}}" data-student-id="{{$student->student_id}}" data-record-id="{{$recordId}}" data-month-value="{{$month}}" data-route-id="{{$route_id}}" data-transport-fee="{{$fee_amount}}">
                                                    <option value="1" {{ $paid_status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $paid_status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>                           
                                </table>
                            </div>    
                            <input type="hidden" id="transport_amount" name="transport_amount" required value="{{$fee_amount}}">
                            <input type="hidden" id="print_ids" name="print_ids" required value="{{$print_ids}}">
                            <div class="save-feesBtns text-right mt-4">
                                <button type="submit" class="primary-btn small fix-gr-bg" id="btnPaySubmit">
                                <span class="ti ti-search pr-2"></span>
                                Save
                                </button>
                            </div>             
                            {{ Form::close() }}
                        </div>                        
                        @else
                        <div id="transport-fees" class="fee-type" style="display:none;"> 
                            <div class="col-lg-4 no-gutters">
                                <div class="d-flex justify-content-between">
                                    <div class="main-title">
                                        <h3>@lang('fees.transport_fees')</h3>
                                    </div>
                                </div>
                            </div>
                            <div>No transport assigned to this student!</div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
    </section>

    <div id="transportFeeModal" class="modal reason-modal">
        <div class="modal-content">
            <div class="text-right"><span class="close">&times;</span></div>
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees-transport-status',
                'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm', 'onsubmit' => "return validateFormFees()"]) }}
                <label for="reason">Reason for Inactive:</label>
                <input type="hidden" id="hid_month" name="hid_month">
                <input type="hidden" id="hid_student_id" name="hid_student_id">
                <input type="hidden" id="hid_record_id" name="hid_record_id">
                <input type="hidden" id="hid_month_value" name="hid_month_value">
                <input type="hidden" id="hid_route_id" name="hid_route_id">
                <input type="hidden" id="hid_status_id" name="hid_status_id">
                <input type="hidden" id="hid_transport_fee" name="hid_transport_fee">
                <textarea id="inactive_reason" name="inactive_reason" rows="4" cols="50"></textarea>
                <div class="text-left mt-2">
                    <button type="submit" class="primary-btn small fix-gr-bg transBtn">Submit</button>
                </div>    
            {{ Form::close() }}
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            margin: 20px;
        }

        label {
            margin-right: 10px;
        }

        select {
            padding: 5px;
        }

        button {
            margin-left: 10px;
            padding: 5px 10px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

@section('script')
<script>
    $(document).on('keyup','.check_payment',function() {
        var discount_amount = parseFloat($('#discount_amt').val());
        var paid_amount = parseFloat($('#paid_amt').val());
        var balance_amount = parseFloat($('#bal_amt').val());
        var tot_paid_amount = parseFloat(discount_amount) + parseFloat(paid_amount);
        if(discount_amount > balance_amount) {
            toastr.error("Discount & Pay amount should be less than balance amount");
            $('#discount_amt').val('');
            $('#paid_amt').val('');
        } else if(paid_amount > balance_amount) {
            toastr.error("Discount & Pay amount should be less than balance amount");
            $('#discount_amt').val('');
            $('#paid_amt').val('');
        } else if(tot_paid_amount > balance_amount) {
            toastr.error("Discount & Pay amount should be less than balance amount");
            $('#discount_amt').val('');
            $('#paid_amt').val('');
        }
    });
</script>
@endsection
@endsection

@push('script')


