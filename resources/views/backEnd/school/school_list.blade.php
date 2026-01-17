@extends('backEnd.master')
@section('title') 
School List
@endsection
@section('mainContent')

@php
    $breadCrumbs = 
    [
        'h1'=> 'School List',
        
    ];


@endphp
<link rel="stylesheet" href="{{asset('public/')}}/frontend/css/new_style.css"/>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid">
       
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'school-query-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'school_list_form']) }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">


                            <div class="col-lg-3">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">@lang('admin.date_from') <span
                                            class="text-danger"> *</span></label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input name="school_date_from" readonly
                                                        class="primary_input_field  primary_input_field date form-control {{ $errors->has('school_date_from') ? ' is-invalid' : '' }}"
                                                        type="text" autocomplete="off" id="school_date_from"
                                                        value="{{ isset($school_date_from) ? ($school_date_from != '' ? $school_date_from : '') : '' }}">
                                                </div>
                                            </div>
                                            <button class="btn-date" data-id="#school_date_from" type="button">
                                                <label class="m-0 p-0" for="school_date_from">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </label>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('school_date_from') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">@lang('admin.date_to') <span
                                            class="text-danger"> *</span></label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input name="school_date_to" readonly
                                                        class="primary_input_field  primary_input_field date form-control {{ $errors->has('school_date_to') ? ' is-invalid' : '' }}"
                                                        type="text" autocomplete="off" id="school_date_to"
                                                        value="{{ isset($school_date_to) ? ($school_date_to != '' ? $school_date_to : '') : '' }}">
                                                </div>
                                            </div>
                                            <button class="btn-date" data-id="#school_date_to" type="button">
                                                <label class="m-0 p-0" for="school_date_to">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </label>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('school_date_to') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">@lang('admin.search') <span
                                            class="text-danger"> *</span></label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                   <input class="primary_input_field form-control" type="text" name="searchtxt" autocomplete="off" id="searchtxt" value="{{ isset($searchtxt) ? $searchtxt : ''}}"> 
                                                </div>
                                            </div>               
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('searchtxt') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="primary_input mb-15 reset-button">
                                    <a href="{{route('school_list')}}">Reset</a>
                                </div>
                            </div>
                            
 
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg" id="schoolbtnsubmit">
                                    <span class="ti ti-search pr-2"></span>
                                    @lang('admin.search')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}

        <div class="row">
           

           

            <div class="col-lg-12 mt-20">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('student.school_list')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                        <x-table>
                            <table id="table_id" class="table table-type" cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th>@lang('common.id')</th>
                                        <th>@lang('common.school_id')</th>
                                        <th>@lang('student.school_name')</th>
                                        <th>@lang('student.domain')</th>
                                        <th>@lang('common.contact_person')</th>
                                        <th>@lang('common.email')</th>
                                        <th>@lang('common.contact_no')</th>
                                        <th>@lang('common.no_of_students')</th>
                                        <th>@lang('common.major_module')</th>
                                        <!-- <th>@lang('common.plan')</th> -->
                                        <th>@lang('common.active_status')</th>
                                        <th>@lang('common.payment_status')</th>
                                        <th>@lang('common.referred_by')</th>
                                        <th>@lang('common.action')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @if(isset($school_list) && $school_list!='')
                                    @foreach($school_list as $school)
                                    
                                    @php
                                    $planname='Default Plan';
                                    $plan = App\Models\subscription_menu_access::getplan($school->plan_id);
                                    if($plan){
                                        $planname=$plan->plan_nmae;
                                    }

                                    @endphp

                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$school->school_code}}</td>
                                        <td>{{$school->school_name}}</td>
                                        @php
                                        $protocol = app()->environment('local') ? 'http://' : 'https://';
                                        @endphp
                                        <td>{{$protocol.$school->domain.'.'.$rootDomain = config('app.domain');}}</td>

                                        <td>{{$school->contact_person}}</td>
                                        <td>{{$school->email}}</td>

                                        <td>{{$school->phone}}</td>
                                        
                                        <td>{{$school->no_of_students}}</td>
                                       
                                        <td>{{$school->major_mudule}}</td>
 
                                        <!-- <td>{{$planname}}</td> -->
                                        <td class="{{ $school->active_status === 1 ? 'text-success' : 'text-danger' }}">{{ $school->active_status === 1 ? 'Active' : 'Deactivate' }}</td>
                                        <td>{{ $school->payment_status === 1 ? 'Paid' : 'Not Paid' }}</td>
                                        <td>{{$school->referred_by}}</td>      
                                        <td valign="top">
                                            @php
                                            $routeList = [];

                                            if ($school->payment_status === 0) {
                                               $routeList[] = '<a class="dropdown-item" data-toggle="modal" data-target="#paymentClassModal'.$school->id.'">'.__('common.payment_status').'</a>';
                                            }
if($school->active_status === 1) {
                                            $routeList[] = '<a class="dropdown-item" data-toggle="modal" data-target="#InActiveClassModal'.$school->id.'">'.__('common.in_active_status').'</a>';
} else {
    $routeList[] = '<a class="dropdown-item" data-toggle="modal" data-target="#activeClassModal'.$school->id.'">'.__('common.active_status').'</a>';
}

                                           @endphp

                                           <x-drop-down-action-component :routeList="$routeList"/>
                                        </td>
                                       
                                    </tr>
                                    
                                    <div class="modal fade admin-query" id="paymentClassModal{{$school->id}}" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('common.payment_confirm')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('common.are_you_sure_confirm_to_pay')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.cancel')</button>
                                                        <a href="{{route('school_payment_status', [$school->id])}}"><button class="primary-btn fix-gr-bg" type="submit">@lang('common.confirm')</button></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                     <div class="modal fade admin-query" id="activeClassModal{{$school->id}}" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('common.active_status')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('common.are_you_sure_to_change_active_status')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.cancel')</button>
                                                        <a href="{{route('school_active_status', [$school->id])}}"><button class="primary-btn fix-gr-bg" type="submit">@lang('common.yes')</button></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade admin-query" id="InActiveClassModal{{$school->id}}" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('common.in_active_status')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('common.are_you_sure_to_change_in_active_status')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.cancel')</button>
                                                        <a href="{{route('school_active_status', [$school->id])}}"><button class="primary-btn fix-gr-bg" type="submit">@lang('common.yes')</button></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!--- Plan Modal-->

                                    <div class="modal fade admin-query" id="planModal{{$school->id}}" >
                                        <div class="modal-dialog modal-dialog-centered plan-modal">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('common.plan_info')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="subscription-plan">
                                <div class="subscription-plan-header school-info-header text-center">
                                    <h2 class="mb-0">Subscription Plan</h2>
                                    <p>You have a default plan and choose upgrade your plan</p>
                                </div>    
                                <div class="subscription-plan-content">
                                    <div class="row">
                                        <!-- first row -->
                                        <div class="col-lg-4">
                                            <div class="subscription-plan-details">
                                                <div class="subscription-header default-plan d-flex align-items-center justify-center">
                                                    <img src="public\frontend\img\default.svg">
                                                    <h4>Default Plan</h4>
                                                </div> 
                                                <div class="plan-list">
                                                    @if(isset($plan1_menu_list) && $plan1_menu_list!='')
                                                    @foreach($plan1_menu_list as $menu)
                                                    <div class="plan-list-content">
                                                        <p>{{$menu->menu_name}}</p>
                                                        <div class="default-checkbox">
                                                            <input type="checkbox" class="default-checkbox-input no-click" id="check1" name="check1" checked>
                                                            <label class="default-checkbox-label default-checkbox-label-grey no-click" for="check1"></label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                    <div class="price-calculation text-center">
                                                        <p id="plan1_price">{{ generalSetting() ? generalSetting()->currency_symbol : ''}} 49/ <small>Per Month</small></p>
                                                    </div>  
                                                    <div class="plan-button">
                                                        <button type="button" class="btn btn-plan" disabled>Default Plan Selected</button>
                                                    </div>            
                                                </div>          
                                            </div>
                                        </div>    
                                        <!-- first row -->
                                        <!-- second row -->
                                        <div class="col-lg-4">
                                            <div class="subscription-plan-details">
                                                <div class="subscription-header advanced-plan d-flex align-items-center justify-center">
                                                    <img src="public\frontend\img\advanced.svg">
                                                    <h4>Advanced Plan</h4>
                                                </div> 
                                                <div class="plan-list">

                                                    @if(isset($plan2_menu_list) && $plan1_menu_list!='')
                                                    @foreach($plan2_menu_list as $menu)
                                                    <div class="plan-list-content">
                                                        <p>{{$menu->menu_name}}</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input plan2" id="plan2_menu_{{$menu->id}}" name="plan2_menu" value="{{$menu->price}}"
                                                            @if(in_array($menu->id, explode(',', $school->subscription_menu_id))) checked @endif 
                                                            >
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="plan2_menu_{{$menu->id}}"></label>
                                                        </div>
                                                    </div> 
                                                    @endforeach
                                                    @endif
                                                    <div class="plan-list-content invisible">
                                                        <p>Transport Management</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="management" name="management">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="management"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content invisible">
                                                        <p>Transport Management</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="management" name="management">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="management"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content invisible">
                                                        <p>Transport Management</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="management" name="management">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="management"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content invisible">
                                                        <p>Transport Management</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="management" name="management">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="management"></label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="price-calculation advanced-price-calculation text-center">
                                                        <p id="plan2_price">{{ generalSetting() ? generalSetting()->currency_symbol : ''}} 0/ <small>Per Month</small></p>
                                                    </div>  
                                                    <div class="plan-button advanced-plan-button text-center">
                                                        <!-- <p class="plan2_selected">You have selected Advanced Plan</p> -->
                                                        <button type="button" class="btn btn-plan plan2_btn" disabled>Choose Plan</button>
                                                    </div>            
                                                </div>          
                                            </div>
                                        </div>    
                                        <!-- second row -->
                                        <!-- third row -->
                                        <div class="col-lg-4">
                                            <div class="subscription-plan-details">
                                                <div class="subscription-header enterprise-plan d-flex align-items-center justify-center">
                                                    <img src="public\frontend\img\enterprise.svg">
                                                    <h4>Enterprise Plan</h4>
                                                </div> 
                                                <div class="plan-list">
                                                    @if(isset($plan3_menu_list) && $plan1_menu_list!='')
                                                    @foreach($plan3_menu_list as $menu)
                                                    <div class="plan-list-content">
                                                        <p>{{$menu->menu_name}}</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="hidden" name="menu_price" id="plan_2_menu_price" value="">
                                                            <input type="checkbox" class="enterprise-checkbox-input plan3" id="plan3_menu_{{$menu->id}}" name="plan3_menu" value="{{$menu->price}}" 
                                                            @if(in_array($menu->id, explode(',', $school->subscription_menu_id))) checked @endif 
                                                            >
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="plan3_menu_{{$menu->id}}"></label>
                                                        </div>
                                                    </div> 
                                                    @endforeach
                                                    @endif
                                                    <div class="plan-list-content invisible">
                                                        <p>School Domain</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="checkbox" class="enterprise-checkbox-input" id="school-domain" name="school-domain">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="school-domain"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content invisible">
                                                        <p>School Domain</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="checkbox" class="enterprise-checkbox-input" id="school-domain" name="school-domain">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="school-domain"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content invisible">
                                                        <p>School Domain</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="checkbox" class="enterprise-checkbox-input" id="school-domain" name="school-domain">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="school-domain"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content invisible">
                                                        <p>School Domain</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="checkbox" class="enterprise-checkbox-input" id="school-domain" name="school-domain">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="school-domain"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content invisible">
                                                        <p>School Domain</p>
                                                        <div class="enterprise-checkbox invisible">
                                                            <input type="checkbox" class="enterprise-checkbox-input" id="school-domain" name="school-domain">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="school-domain"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content invisible">
                                                        <p>School Domain</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="checkbox" class="enterprise-checkbox-input" id="school-domain" name="school-domain">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="school-domain"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content invisible">
                                                        <p>School Domain</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="checkbox" class="enterprise-checkbox-input" id="school-domain" name="school-domain">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="school-domain"></label>
                                                        </div>
                                                    </div>


                                                    <div class="price-calculation enterprise-price-calculation text-center">
                                                        <p id="plan3_price">{{ generalSetting() ? generalSetting()->currency_symbol : ''}} 0/ <small>Per Month</small></p>
                                                    </div>  
                                                    <div class="plan-button enterprise-plan-button">
                                                        <!-- <p class="plan3_selected">You have selected Enterprise Plan</p> -->
                                                        <button type="button" class="btn btn-plan plan3_btn" disabled>Choose Plan</button>
                                                    </div>            
                                                </div>          
                                            </div>
                                        </div>    
                                        <!-- third row -->
                                    </div>    
                                </div>     
                            </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </x-table>
                                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@include('backEnd.partials.data_table_js')

