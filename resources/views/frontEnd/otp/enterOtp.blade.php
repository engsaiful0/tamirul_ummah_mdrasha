@extends('frontEnd.master')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    

@section('mainContent')
<!--start register area-->
    <section class="login-area login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                    <div class="login-form login-form-wrap">
                    <h3>Enter otp to Continue</h3>
                    <!---Login Form-->
                    
                        <form method="POST" class="" action="<?php echo e(route('verify-otp')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-4">  
                                <div class="form-group mb-4">
                                    <span class="input-group-addon">
                                        <i class="ti-email"></i>
                                    </span>
                                    <input type="hidden" name="email" value="{{ $user->email }}">
                                    <input type="hidden" name="otp" value="">
                                    <input class="form-control"
                                        type="text" name='otp' id="otp" value="" />
                                        <span><a style="float:right" href="{{ route('login-otp') }}">Resend OTP</a></span>
                                        @if ($errors->has('otp'))
                                        <span class="text-danger text-left mb-15 form-validate" role="alert">
                                            {{ $errors->first('otp') }}
                                        </span>
                                @endif
                                </div>                               

                                <div class="login-btn text-center">
                                    <button type="submit" class="primary-btn login-bg" id="btnsubmit">
                                        <span class="ti ti-lock mr-2"></span>
                                        @lang('auth.verify_otp')
                                    </button>
                                </div>
                            </div>
                        </form>
                    <!---Login Form End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end register area-->
@endsection