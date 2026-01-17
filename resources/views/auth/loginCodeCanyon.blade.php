@extends('frontEnd.master')
@section('title')
@lang('front_settings.login_page')
@endsection
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
@section('mainContent')
<!--start register area-->
    <section class="login-area login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="login-form login-form-wrap">
                                                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3>Login to Continue</h3>
                    <!---Login Form-->
                    <?php if(session()->has('message-success') != ""): ?>
                        <?php if(session()->has('message-success')): ?>
                        <p class="text-success"><?php echo e(session()->get('message-success')); ?></p>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->has('message-danger') != ""): ?>
                        <?php if(session()->has('message-danger')): ?>
                        <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
                        <?php endif; ?>
                        <?php endif; ?>
                        <form method="POST" class="" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group mb-4">

                                <input type="hidden" name="username" id="username-hidden">

                                 
                                <div class="form-group mb-4">
                                    <span class="input-group-addon">
                                        <i class="ti-email"></i>
                                    </span>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        type="text" name='email' id="email-address"
                                        placeholder="@lang('auth.enter_email_address')" value="{{ old('email') }}" />
                                        @if ($errors->has('email'))
                                <span class="text-danger text-left mb-15 form-validate" role="alert">
                                    {{ $errors->first('email') }}
                                </span>
                                @endif
                                </div>
                                

                                <div class="form-group mb-4">
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        type="password" name='password' id="password"
                                        placeholder="@lang('auth.enter_password')" />
                                        @if ($errors->has('password'))
                                <span class="text-danger text-left mb-15 form-validate" role="alert">
                                    {{ $errors->first('password') }}
                                </span>
                                @endif
                                </div>
                                

                                <div class="d-flex form-group justify-content-between align-items-center">
                                    <div class="checkbox ">
                                        <input type="checkbox" name="remember" id="rememberMe"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label for="rememberMe">@lang('auth.remember_me')</label>
                                    </div>
                                    <div>
                                        <a href="<?php echo e(route('recoveryPassord')); ?>">@lang('auth.forget_password')
                                            ?</a>
                                    </div>
                                </div>

                                <div class="login-btn text-center">
                                    <button type="submit" class="primary-btn login-bg" id="btnsubmit">
                                        <span class="ti ti-lock mr-2"></span>
                                        @lang('auth.login')
                                    </button>
                                </div>
                        </form>
                        <!---Login Form End -->
                            @php
                                $host = request()->getHost();
                                $parts = substr_count($host, '.');

                                if ($parts > 2 && filter_var($host, FILTER_VALIDATE_IP) === false) {
                                    $hostResult = false;
                                } else {
                                    $hostResult = true;
                                }
                            @endphp
                            @if(isSignUpAllowed())
                        <div class="text-center">
                            <h6 class="fw-normal text-dark mb-0">Don’t have an account? <a href="{{url('signup')}}">Signup</a></h6>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end register area-->
@endsection