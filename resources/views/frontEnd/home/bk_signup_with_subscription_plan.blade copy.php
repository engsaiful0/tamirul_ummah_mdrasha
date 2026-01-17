@extends('frontEnd.master')

<link rel="stylesheet" href="{{asset('public/')}}/frontend/css/new_style.css"/>


@section('mainContent')

    <section class="login-area login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-lg-offset-1 mx-auto">
                    <div class="login-form login-form-wrap">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- {{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => 'school_register','onsubmit' => "return planSettings()"])}} -->
                        <form method="POST" class="loginForm" action="{{route('school_register')}}" id="infix_form">
                            @csrf
                            <div class="school-info">
                                <div class="school-info-header text-center m-0">
                                    <h3 class="m-0">School Registration</h3>
                                    <p>Please fill below details and register your school</p>
                                </div>                       
                                <!-- content area -->
                                <div class="school-info-content">
                                    <h3>School Basic Information</h3>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">School Name <span class="text-danger">*</span></label>
                                                <input type="text" name="school_name" class="form-control primary_input_field {{ $errors->has('school_name') ? ' is-invalid' : '' }}" value="{{old('school_name')}}" id="school_name">
                                                
                                                @if ($errors->has('school_name'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('school_name') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">ID <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control primary_input_field" type="text" placeholder=""> -->
                                                <input type="text" name="school_id" class="form-control primary_input_field {{ $errors->has('school_id') ? ' is-invalid' : '' }}" value="{{old('school_id')}}" id="school_id">
                                                
                                                @if ($errors->has('school_id'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('school_id') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Contact Person <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control primary_input_field" type="text" placeholder=""> -->
                                                <input type="text" name="contact_person" class="form-control primary_input_field {{ $errors->has('contact_person') ? ' is-invalid' : '' }}" value="{{old('contact_person')}}" id="contact_person">
                                                
                                                @if ($errors->has('contact_person'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('contact_person') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>   
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Contact No <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control primary_input_field" type="text" placeholder=""> -->
                                                <input type="text" name="contact_number" class="form-control primary_input_field {{ $errors->has('contact_number') ? ' is-invalid' : '' }}" value="{{old('contact_number')}}" id="contact_number">
                                                @if ($errors->has('contact_number'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('contact_number') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">No of Students <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control primary_input_field" type="text" placeholder=""> -->
                                                <input type="text" name="no_of_students" class="form-control primary_input_field {{ $errors->has('no_of_students') ? ' is-invalid' : '' }}" value="{{old('no_of_students')}}" id="no_of_students">
                                                @if ($errors->has('no_of_students'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('no_of_students') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label"  for="primary_input_field">Major Module Requirement <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control primary_input_field" type="text" placeholder=""> -->
                                                <input type="text" name="major_module" class="form-control primary_input_field {{ $errors->has('major_module') ? ' is-invalid' : '' }}" value="{{old('major_module')}}" id="major_module">
                                                
                                                @if ($errors->has('major_module'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('major_module') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input in_single_input">
                                                <label class="primary_input_label" for="exampleInputEmail1">Workspace Name <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control primary_input_field" type="text" placeholder=""> -->
                                                <input type="text" name="workspace" class="form-control primary_input_field {{ $errors->has('workspace') ? ' is-invalid' : '' }}" value="{{old('workspace')}}" id="workspace" oninput="restrictInput(this)">
                                                @if ($errors->has('workspace'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('workspace') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Email <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control primary_input_field" type="text" placeholder=""> -->
                                                <input type="text" name="email" class="form-control primary_input_field {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" id="email">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Password <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control primary_input_field" type="text" placeholder=""> -->
                                                <input type="password" placeholder="@lang('auth.enter_password')" name="password" class="form-control primary_input_field {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}">
                                        
                                        @if ($errors->has('password'))
                                            <span class="text-danger text-left pl-3 d-block" role="alert">
                                                {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Confirm Password <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control primary_input_field" type="text" placeholder=""> -->
                                                <input type="password" placeholder="@lang('auth.enter_confirm_password')" name="password_confirmation"
                                                class="form-control primary_input_field {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{old('password_confirmation')}}">
                                                
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input in_single_input">
                                                <label class="primary_input_label" for="exampleInputEmail1">Referred By</label>
                                                <input type="text" name="referred_by" class="form-control primary_input_field {{ $errors->has('referred_by') ? ' is-invalid' : '' }}" value="{{old('referred_by')}}" id="referred_by">
                                                @if ($errors->has('referred_by'))
                                                    <span class="text-danger text-left pl-3 d-block" role="alert">
                                                        {{ $errors->first('referred_by') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>                               
                                </div>  
                                <!-- content area -->  
                                <!-- content area -->
                                <div class="school-info-content">
                                    <h3>Present System</h3>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Present System</label>
                                                <input class="form-control primary_input_field" type="text" name="present_system" placeholder="">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Pro's</label>
                                                <textarea class="form-control primary_input_field primary_textarea_field" name="pro_desc" id="exampleFormControlTextarea1" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Cons</label>
                                                <textarea class="form-control primary_input_field primary_textarea_field" name="cons_desc" id="exampleFormControlTextarea1" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>   
                                </div>  
                                <!-- content area -->
                                <!-- content area -->
                                <div class="school-info-content">
                                    <h3>Management Information</h3>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Management Type</label>
                                                <input class="form-control primary_input_field" type="text" name="management_type" placeholder="">
                                                <!-- <select class="primary_select ">
                                                    <option value="1">Centralized </option>
                                                    <option value="2">Autocratic </option>
                                                    <option value="3">Democratic </option>
                                                </select> -->
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input management-type">
                                                <label class="primary_input_label" for="primary_input_field">Management Category</label>
                                                <input class="form-control primary_input_field" type="text" name="management_category" placeholder="">
                                                <!-- <select class="primary_select ">
                                                    <option value="1">Public CBSE</option>
                                                    <option value="2">International</option>
                                                    <option value="3">Matriculation</option>
                                                </select> -->
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group primary_input management-type">
                                                <label class="primary_input_label" for="primary_input_field">School Category</label>
                                                <input class="form-control primary_input_field" type="text" name="school_category" placeholder="">
                                                <!-- <select class="primary_select ">
                                                    <option value="1">International school</option>
                                                    <option value="2">Private</option>
                                                    <option value="3">Infant school</option>
                                                </select> -->
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 mt-15">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Type of School</label>
                                                <input class="form-control primary_input_field" type="text" name="type_of_school" placeholder="">
                                                <!-- <select class="primary_select ">
                                                    <option value="1">International school</option>
                                                    <option value="2">Private</option>
                                                    <option value="3">Infant school</option>
                                                </select> -->
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 mt-15">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Address</label>
                                                <input class="form-control primary_input_field" type="text" name="address" placeholder="">
                                            </div>
                                        </div>  
                                        <div class="col-md-4 col-lg-4 mt-15">
                                            <div class="form-group primary_input">
                                                <label class="primary_input_label" for="primary_input_field">Year of establishment</label>
                                                <input class="form-control primary_input_field" type="text" name="year_establishment" placeholder="">
                                            </div>
                                        </div>
                                    </div> 
                                </div>  
                                <!-- content area -->       
                            </div>  
                            <!-- Plan -->  
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
                                                    @foreach($plan1_menu_list as $menu)
                                                    <div class="plan-list-content">
                                                        <p>{{$menu->menu_name}}</p>
                                                        <div class="default-checkbox">
                                                            <input type="checkbox" class="default-checkbox-input no-click" id="check1" name="check1" checked>
                                                            <label class="default-checkbox-label default-checkbox-label-grey no-click" for="check1"></label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    
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
                                                    @foreach($plan2_menu_list as $menu)
                                                    <div class="plan-list-content">
                                                        <p>{{$menu->menu_name}}</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input plan2" id="plan2_menu_{{$menu->id}}" name="plan2_menu" value="{{$menu->price}}">

                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="plan2_menu_{{$menu->id}}"></label>


                                                        </div>
                                                    </div> 
                                                    @endforeach

                                                    <!-- <div class="plan-list-content">
                                                        <p>Payroll Management</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="management" name="management">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="management"></label>
                                                        </div>
                                                    </div> 
                                                    <div class="plan-list-content">
                                                        <p>Transport Management</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="transport" name="transport">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="transport"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Inventory Management</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="inventory" name="inventory">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="inventory"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Chat - Communication</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="chatcheckbox" name="chatcheckbox">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="chatcheckbox"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Expense Management</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="expensecheckbox" name="expensecheckbox">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="expensecheckbox"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Report Management</p>
                                                        <div class="advanced-checkbox">
                                                            <input type="checkbox" class="advanced-checkbox-input" id="reportcheckbox" name="reportcheckbox">
                                                            <label class="advanced-checkbox-label advanced-checkbox-label-blue" for="reportcheckbox"></label>
                                                        </div>
                                                    </div> -->
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
                                                    @foreach($plan3_menu_list as $menu)
                                                    <div class="plan-list-content">
                                                        <p>{{$menu->menu_name}}</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="hidden" name="menu_price" id="plan_2_menu_price" value="">
                                                            <input type="checkbox" class="enterprise-checkbox-input plan3" id="plan3_menu_{{$menu->id}}" name="plan3_menu" value="{{$menu->price}}">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="plan3_menu_{{$menu->id}}"></label>
                                                        </div>
                                                    </div> 
                                                    @endforeach

                                                    <input type="hidden" name="hidmenu2_id" id="hidmenu2_id" value="">
                                                    <input type="hidden" name="hidmenu3_id" id="hidmenu3_id" value="">
                                                    <!-- <div class="plan-list-content">
                                                        <p>Individual Mobile App for School</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="checkbox" class="enterprise-checkbox-input" id="mobile-app" name="mobile-app">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="mobile-app"></label>
                                                        </div>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Branches - Individual School</p>
                                                        <div class="enterprise-checkbox">
                                                            <input type="checkbox" class="enterprise-checkbox-input" id="individual-school" name="individual-school">
                                                            <label class="enterprise-checkbox-label enterprise-checkbox-label-pink" for="individual-school"></label>
                                                        </div>
                                                    </div> -->
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
                            <input type="hidden" name="plan_selected" id="plan_selected" value="1">
                            <div class="login-btn text-center text-center mt-15 mb-20">
                                <button type="submit" class="w-25 text-white" id="btnsubmit" style="color: black;font-weight: bold;">
                                    @lang('auth.register_school')
                                </button>
                            </div>
                        <!-- {{ Form::close() }} -->
                        </form>
                    <!-- Plan -->    
                    </div>
                </div>    
            </div>    
        </div>
    </section>

@endsection
