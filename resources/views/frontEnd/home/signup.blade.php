@extends('frontEnd.master')
@section('title')
@lang('front_settings.signup_page')
@endsection
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
                                                <input type="text" placeholder="Enter school name" name="school_name" class="form-control primary_input_field {{ $errors->has('school_name') ? ' is-invalid' : '' }}" value="{{old('school_name')}}" id="school_name">
                                                
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
                                                <input type="text" placeholder="Enter school id" name="school_id" class="form-control primary_input_field {{ $errors->has('school_id') ? ' is-invalid' : '' }}" value="{{old('school_id')}}" id="school_id">
                                                
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
                                                <input type="text" placeholder="Contact person name" name="contact_person" class="form-control primary_input_field {{ $errors->has('contact_person') ? ' is-invalid' : '' }}" value="{{old('contact_person')}}" id="contact_person">
                                                
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
                                                <input type="text" placeholder="Contact person number" name="contact_number" class="form-control primary_input_field {{ $errors->has('contact_number') ? ' is-invalid' : '' }}" value="{{old('contact_number')}}" id="contact_number">
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
                                                <input type="text" placeholder="Minimum 100 students" name="no_of_students" class="form-control primary_input_field {{ $errors->has('no_of_students') ? ' is-invalid' : '' }}" value="{{old('no_of_students')}}" id="no_of_students">
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
                                                <input type="text" placeholder="Example: HRMS" name="major_module" class="form-control primary_input_field {{ $errors->has('major_module') ? ' is-invalid' : '' }}" value="{{old('major_module')}}" id="major_module">
                                                
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
                                                <input type="text" placeholder="Domain name (small letters only allowed)" name="workspace" class="form-control primary_input_field {{ $errors->has('workspace') ? ' is-invalid' : '' }}" value="{{old('workspace')}}" id="workspace" oninput="restrictInput(this)">
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
                                                <input type="text" name="email" placeholder="Login Email Id" class="form-control primary_input_field {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" id="email">
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
                                    <p>Premium Suite (Our Comprehensive package with full access to all modules)                                    </p>
                                </div>    
                                <div class="subscription-plan-content">
                                    <div class="row">
                                        <div class="col-lg-4">&nbsp;</div>
                                        <!-- first row -->
                                        <div class="col-lg-4">
                                            <div class="subscription-plan-details">
                                                <div class="subscription-header default-plan d-flex align-items-center justify-center">
                                                    <img src="public\frontend\img\default.svg">
                                                    <h4>Premium Suite</h4>
                                                </div> 
                                                <div class="plan-list">
                                                    <div class="plan-list-content">
                                                        <p>Administration</p>
                                                    </div> 
                                                    <div class="plan-list-content">
                                                        <p>Academics</p>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>CBT</p>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Human Resources</p>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Finance & Accounting</p>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Transportation</p>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Library</p>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Communication</p>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Hostel</p>
                                                    </div>
                                                    <div class="plan-list-content">
                                                        <p>Inventory</p>
                                                    </div>
                                                    <div class="plan-button">
                                                        <button type="button" class="btn btn-plan" disabled>Default Plan Selected</button>
                                                    </div>            
                                                </div>          
                                            </div>
                                        </div>    
                                        <!-- first row -->
                                     
                                        <div class="col-lg-4">&nbsp;</div>    
                                    </div>    
                                </div>     
                            </div> 
                            <!-- End Plan -->
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
