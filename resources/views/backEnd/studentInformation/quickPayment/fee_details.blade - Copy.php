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
                <div class="col-lg-12">
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
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

             <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-20">@lang('fees.student_fees')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="student-meta-box">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="single-meta mt-20">
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
                                        <div class="single-meta mt-20">
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
                        <div class="row">                            
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student.save-billing', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'billing_form', 'onsubmit' => 'return validatePayForm()']) }}

                        <table id="table_id_table" class="table dataTable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                        @php $i = 0; @endphp
                        @foreach ($fees_assign_groups as $fees_assign_group)
                        @php $i++; @endphp
                        @if ($i == 1)
                            <th>{{ @$fees_assign_group->feesGroups->name }}</th>
                            <th>@lang('fees.amount')</th>
                            <th>Pay</th>
                            <th>Balance</th>
                        @endif
                        @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($fees_assign_groups as $fees_assign_group)
                        <tr>
                        <td>{{ @$fees_assign_group->feesTypes != '' ? @$fees_assign_group->feesTypes->name : '' }}</td>
                        <td><input type="number" name="amount[]" required disabled value="{{ @$fees_assign_group->amount }}"></td>
                        <td><input type="number" name="paid[]" required></td>
                        <td><input type="text" name="balance[]" disabled></td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        <div id="common-error-message" style="display: none;" class="error-message">At least one row must have a paid amount greater than 0.</div>
                        <button type="submit" class="primary-btn small fix-gr-bg" id="btnPaySubmit">
                        <span class="ti ti-search pr-2"></span>
                        Save
                        </button>
                        {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection

@push('script')


