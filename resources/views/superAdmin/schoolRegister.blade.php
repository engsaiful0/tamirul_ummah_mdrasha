@extends('backEnd.master')
@section('title') 
School Register
@endsection
@section('mainContent')

@php
    $breadCrumbs = 
    [
        'h1'=> 'School Register',
        
    ];
@endphp
<link rel="stylesheet" href="{{asset('public/')}}/frontend/css/new_style.css"/>
<link rel="stylesheet" href="{{asset('public/backEnd/login2')}}/css/bootstrap.min.css">
<link rel="stylesheet" href="{{asset('public/backEnd/login2')}}/themify-icons.css">
<link rel="stylesheet" href="{{asset('public/backEnd/login2')}}/css/style.css">

<style>

.loginButton {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.loginButton{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.singleLoginButton{
    flex: 22% 0 0;
}

.loginButton .get-login-access {
    display: block;
    width: 100%;
    border: 1px solid #fff;
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 5px;
    white-space: nowrap;
}
@media (max-width: 576px) {
  .singleLoginButton{
    flex: 49% 0 0;
  }
}
@media (max-width: 576px) {
    .singleLoginButton{
        flex: 49% 0 0;
    }
    .loginButton .get-login-access {
        margin-bottom: 10px;
    }
}
.create_account a {
    color: #828bb2;
    font-weight: 500;
    text-decoration: none;
}

    #select-school{
        border: 0px;
        border-radius: 0px;
        border-bottom: 1px solid #d3cddd;
    }

    .nice-select:after {
    
    transform: rotate(0deg);
    margin-top: -10px;
    font-size: 12px;
    font-weight: 500;
    right: 18px;
    transform-origin: none;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -o-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;
}

.nice-select.open:after {
    -webkit-transform: rotate(180deg);
    -moz-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    -o-transform: rotate(180deg);
    transform: rotate(180deg);
    margin-top: 4px;
}
.niceSelect {
    border: 0px;
    border-bottom: 1px solid rgba(130, 139, 178, 0.3);
    border-radius: 0px;
    -webkit-appearance: none;
    -moz-appearance: none;
    color: #828bb2;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    padding: 0;
    background: transparent;
}
.niceSelect:focus,.niceSelect:hover{
    border-color: rgba(130, 139, 178, 0.3);
    outline: none;
    box-shadow: none !important;
}
.mb-26{
    margin-bottom: 26px;
}

.nice-select.open .list {
    left: 0;
    position: absolute;
    right: 0;
}
.nice-select .nice-select-search {
    box-sizing: border-box;
    background-color: #fff;
    border: 1px solid rgba(130, 139, 178, 0.3);
    border-radius: 3px;
    box-shadow: none;
    color: #333;
    display: inline-block;
    vertical-align: middle;
    padding: 0px 8px;
    width: 100% !important;
    height: 36px;
    line-height: 36px;
    outline: 0 !important;
}
.nice-select .list {
    margin-top: 5px;
    top: 100%;
    border-top: 0;
    border-radius: 0 0 5px 5px;
    max-height: 210px;
    overflow-y: scroll;
    padding: 52px 0 0;
    left: 0 !important;
    right: 0 !important;
}
.niceSelect span.current {
    width: 85% !important;
    overflow: hidden !important;
    display: block !important;
}
.reg-dropdown
{
    text-align: center;
    margin: 0 auto;
}
.in_login_part_admin{
    min-height: 100vh;
    background-image: url(../img/login-bg.png);
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    /* display: flex; */
    align-items: center;
    padding: 50px 0;
}
</style>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid">
       
        <div class="row">
           <div class="in_login_part_admin mb-40 col-lg-6 col-offset-3 reg-dropdown">
            <div class="justify-content-center reg-dropdown">
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
                    <div class="in_login_content">
                        @if(!empty($setting->logo))<img src="{{asset($setting->logo)}}" alt="Login Panel">@endif
                        <div class="in_login_page_iner">
                            <!-- <div class="in_login_page_header">
                                <h5>{{__('Registration')}} @lang('common.details')</h5>
                            </div> -->
                            <form method="POST" class="loginForm" action="{{route('school-register')}}" id="infix_form">
                                @csrf

                                <input type="hidden" name="school_id" value="1">
                                <input type="hidden" name="username" id="username-hidden">

                                <?php if(session()->has('message-danger') != ""): ?>
                                    <?php if(session()->has('message-danger')): ?>
                                    <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <input type="hidden" id="url" value="{{url('/')}}">

                                <div class="in_single_input">
                                    <select name="schoolname" id="schoolname" class="nice_Select primary_input_field form-control">
                                        <option value="">Select School *</option>
                                        @foreach($registered_schools as $rs)
                                            <option value="{{$rs->id}}">{{$rs->school_name}}</option>
                                        @endforeach
                                    </select>
                                    
                                    @if ($errors->has('schoolname'))
                                        <span class="text-danger text-left pl-3 d-block" role="alert">
                                            {{ $errors->first('schoolname') }}
                                        </span>
                                    @endif
                                </div>

                                

                                {{-- <div class="d-flex justify-content-between">
                                    <div class="in_checkbox">
                                        <div class="boxes">
                                            <input type="checkbox" id="Remember">
                                            <label for="Remember">@lang('auth.remember_me')</label>
                                        </div>
                                    </div>
                                    <div class="in_forgot_pass">
                                        <a href="{{url('recovery/passord')}}">@lang('auth.forget_password') ? </a>
                                    </div>
                                </div> --}}
                                <div class="in_login_button text-center mt-25">
                                    <button type="submit" class="in_btn" id="btnsubmit" style="font-weight: bold;">
                                        @lang('auth.register')
                                        <span class="ti-lock"></span>
                                       <!-- {{__('Registred')}} -->
                                    </button>
                                </div>
                                <!-- <div class="create_account text-center">
                                    <p>Already have an account? <a href="{{url('login')}}">Login Here</a></p>
                                </div> -->
                            </form>
                        </div>
                    </div>
            </div>
    </div>

        </div>
    </div>
</section>
 <script src="{{asset('public/backEnd/login2')}}/js/jquery-3.4.1.min.js"></script>
    <script src="{{asset('public/backEnd/login2')}}/js/popper.min.js"></script>
    <script src="{{asset('public/backEnd/login2')}}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('public/backEnd/')}}/vendors/js/toastr.min.js"></script>
    <script src="{{asset('public/backEnd/')}}/vendors/js/nice-select.min.js"></script>

@endsection
@include('backEnd.partials.data_table_js')