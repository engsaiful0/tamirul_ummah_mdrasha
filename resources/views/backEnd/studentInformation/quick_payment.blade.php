@extends('backEnd.master')
@section('title')
    @lang('fees.fee_assign_pay')
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
    </style>
@endpush
@section('mainContent')
    <input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">
    <section class="sms-breadcrumb mb-20 up_breadcrumb white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('fees.fee_assign_pay')</h1>
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
                <!--, 'onsubmit' => "return validateAddExtraactivities()"-->
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
           
    </section>

@endsection
@push('script')
