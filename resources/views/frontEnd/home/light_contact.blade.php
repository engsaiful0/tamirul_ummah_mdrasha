@extends('frontEnd.master')
@section('title')
EDSERE | Contact Page
@endsection
@php
    $generalSetting = generalSetting();
    $school_config = schoolConfig();
@endphp
@section('mainContent')
@php
$host = request()->getHost();
$subdomain = explode('.', $host)[0];
@endphp
@if($subdomain)
<style>
    .page-banner-area {
        background-image: url(
            '{{ $subdomain === "mjhoperisingschool" ? asset("public/frontend/theme/images/banner-image-mjhoperisingschool-contact.jpg") : asset("public/frontend/theme/images/banner6.png") }}'
        );
    }
</style>
@endif
    <!--start hero area-->
    <section class="page-banner-area">
        <div class="container">
            <div class="row">
                <!--start heading-->
                <div class="col-lg-12">
                    <div class="banner-content text-center">
                        <h1>Contact</h1>
                        <p><a href="{{url('/')}}">Home</a> <span> > </span><a href="#">Contact</a> </p>
                    </div>
                </div>
                <!--end heading-->
            </div>
        </div>
    </section>
    <!--end hero area-->
    <!--start contact area-->
    <section class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-desc">
                        <h2>Reach out!</h2>
                        <p>We're just a click away from answering all your queries.</p>
                        
                    </div>

                    <div class="contact-info-single">
                        <div class="contact-icon">
                            <img src="{{asset('public/')}}/frontend/theme/images/icons/email.png" alt="image">
                        </div>
                        <div class="contact-cont">
                            <h3>Email Address :</h3>
                            <!-- <p class="m-0">raisun@dreamsschool.io</p> -->
                            <p>{{ !isSignUpAllowed() && isset($school_config->email) && $school_config->email!='' ?  $school_config->email : 'edsereltd@gmail.com' }}</p>
                        </div>
                    </div>
                    <div class="contact-info-single">
                        <div class="contact-icon">
                            <img src="{{asset('public/')}}/frontend/theme/images/icons/telephone.png" alt="image">
                        </div>
                        <div class="contact-cont">
                            <h3>Phone Number :</h3>
                            <p>{{ !isSignUpAllowed() && isset($school_config->phone) && $school_config->phone!='' ? $school_config->phone : '+2348072868289' }}</p>
                        </div>
                    </div>
                    <div class="contact-info-single">
                        <div class="contact-icon">
                            <img src="{{asset('public/')}}/frontend/theme/images/icons/map.png" alt="image">
                        </div>
                        <div class="contact-cont">
                            <h3>Our Location :</h3>
                                @if(!isSignUpAllowed() && isset($school_config->address) && $school_config->address!='')
                                    <p> {{ $school_config->address }} </p>
                                @else
                                    <p>3, Bright-Ese street,<br></p>
                                    <p>Evbukhu, off Sapele Road,</p>
                                    <p>Benin city, Edo state.</p>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
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
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'url' => 'contact-mail', 'id' => 'email_settings1', 'enctype' => 'multipart/form-data', 'onsubmit' => "return contactForm()"]) }}
                    @csrf
                        <!-- <form action="{{url('contact-mail')}}" method="post"> -->
                            <input type="text" placeholder="Your Name *" class="form-control" name="name" id="name">
                            <span class="text-danger" id="name_err"></span>
                            <!-- @if ($errors->has('name'))
                                <span class="text-danger" id="name_err">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif -->
                            <input type="text" placeholder="Email Address *" class="form-control" name="email" id="email">
                            <span class="text-danger" id="email_err"></span>
                            <!-- @if ($errors->has('email'))
                                <span class="text-danger" >
                                    {{ $errors->first('email') }}
                                </span>
                            @endif -->
                            <input type="text" placeholder="Subject *" class="form-control" name="subject" id="subject">
                            <span class="text-danger" id="subject_err"></span>
                            <!-- @if ($errors->has('subject'))
                                <span class="text-danger" >
                                    {{ $errors->first('subject') }}
                                </span>
                            @endif -->
                            <textarea rows="4" placeholder="Write Your Message *" class="form-control" name="message" id="message"></textarea>
                            <span class="text-danger" id="message_err"></span>
                            <!--  @if ($errors->has('message'))
                                <span class="text-danger" >
                                    {{ $errors->first('message') }}
                                </span>
                            @endif -->
                            <!-- <div class="submit-btn">
                                <a href="#">Submit Now</a>
                            </div> -->
                            <div class="submit-btn">
                            <button class="contact-submit-btn" type="submit"> <i class="ti-email"></i> Submit Now </button>
                            </div>
                            {{ Form::close() }}
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end contact area-->
  @endsection
