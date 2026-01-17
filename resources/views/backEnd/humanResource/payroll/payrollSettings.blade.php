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
            padding: 10px 10px 20px 15px !important;
            white-space:nowrap;
        }

        table.dataTable thead .sorting::after {
            left: 10px !important;
            top: 10px;
        }
        table.dataTable thead .sorting_desc::after{
            left: 10px !important;
            top: 10px;
        }
        table.dataTable thead .sorting_asc::after {
            left: 10px !important;
            top: 10px;
        }
        #add-earnings{
            display:none;
        }
        #add-deductions{
            display:none;
        }               

        .deduction-title{
            color:#741692;
        }
        .earning-td{
            width:50%;
        }
        .pf-title{
            color:#741692;
        }
        @media (max-width: 556px) {
            table.dataTable tbody th,
            table.dataTable tbody td {
                padding: 10px 10px 20px 35px !important;
            }
        }


        .card-header-tabs .nav-earning-link.active{
            background-color: #741692;
            border-color: #741692;
            color: #ffffff;
            border-radius: 5px;
        }
        .card-header-tabs .nav-earning-link{
            color:#741692;
            border-radius: 5px;
        }
        .card-header-tabs .nav-earning-link:hover{
            border-color:#ffffff;
            border-radius: 5px;
        }

    </style>
@endpush
@section('mainContent')
    <section class="sms-breadcrumb mb-20 white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('hr.payroll_settings')</h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="{{ route('submenu-list',['sub_menu' =>'payroll']) }}">@lang('hr.payroll')</a>
                    <a href="#">@lang('hr.payroll_settings')</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    <!-- Add Earnings/Deduction-->
    @include('backEnd.humanResource.payroll.settings_add_earning')
    @include('backEnd.humanResource.payroll.settings_add_deduction')
    <!---->            
    <section class="earings-section mt-20 tab-card">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-20"> Settings </h3>
                    <div class="earning-deduction-box">
                        <div class="form-earings">
                            <ul class="nav nav-tabs card-header-tabs d-flex m-0" id="earing-deduction-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link nav-earning-link active position-relative" id="one-tab" data-toggle="tab" href="#earning-tab" role="tab" aria-controls="One" aria-selected="true"> Earnings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-earning-link position-relative" id="two-tab" data-toggle="tab" href="#deduction-tab" role="tab" aria-controls="Two" aria-selected="false">Deductions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-earning-link position-relative" id="three-tab" data-toggle="tab" href="#epfwages-tab" role="tab" aria-controls="Two" aria-selected="false">EPF Wages</a>
                                </li>
                            </ul> 
                            <div class="payroll-ctc-settings">
                                <label> CTC months Per Year </label>
                                <select class="form-control" name="ctc_months" id="ctc_months" onchange="save_ctc_format(this.value);">
                                    <option value="11"{{($ctc_salary_month==11)?'selected':''}}>11 months</option>
                                    <option value="12"{{($ctc_salary_month==12)?'selected':''}}>12 months</option>
                                </select>
                                <input type="hidden" name="url" id="url"
                                            value="{{ URL::to('/') }}">
                            </div>    
                        </div>  
                    </div>    
                </div>
                <!-- rightside -->
                <div class="col-lg-12 mt-20">
                    <div class="tab-content" id="earning-deduction">
                        
                        <input type="hidden" id="onloadpayroll" name="onloadpayroll" value="true">
                        <!--  Deductions tab -->
                        <!-- <div class="pull-right loader loader_style" id="load_payment_Settings">
                            <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                        </div> -->
                        <div id="load_payment_Settings">
                            
                        </div>

                        
                        <!--  Deductions tab -->
                    </div>   
                <!-- rightside -->
            </div>
        </div>            
    </section>
@endsection
@include('backEnd.partials.data_table_js')
@include('backEnd.partials.date_picker_css_js')

