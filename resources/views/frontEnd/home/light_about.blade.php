@extends('frontEnd.master')
@section('title')
EDSERE | About Page
@endsection
@section('mainContent')
@php
$host = request()->getHost();
$subdomain = explode('.', $host)[0];
@endphp
@if($subdomain)
<style>
    .page-banner-area {
        background-image: url(
            '{{ $subdomain === "mjhoperisingschool" ? asset("public/frontend/theme/images/banner-image-mjhoperisingschool.jpg") : asset("public/frontend/theme/images/banner6.png") }}'
        );
    }
</style>
@endif
    <!--start hero area-->
    <section class="page-banner-area">
        <div class="container">
            <div class="row">
                <!--start heading-->
                <div class="col-lg-10 offset-lg-1">
                    <div class="banner-content text-center">
                        <h1>About Us</h1>
                        <p><a href="{{url('/')}}">Home</a> <span> > </span>About Us</p>
                    </div>
                </div>
                <!--end heading-->
            </div>
        </div>
    </section>
    <!--end hero area-->
    <!--start about area-->
    <section class="about-area four">
        <div class="container">
             @if(!isSignUpAllowed() && isset($about) && $about->image!='')
                @php
                            $image1 = $about->image ? asset($about->image) : asset('public/frontend/theme/images/about-img-1.jpg');
                            $image2 = $about->main_image ? asset($about->main_image) : asset('public/frontend/theme/images/about-img-2.jpg');
                            $image3 = $about->main_image_2 ? asset($about->main_image_2) : asset('public/frontend/theme/images/about-img-3.jpg');
                @endphp
            @else
             @php
                $image1 = asset('public/frontend/theme/images/about-img-1.jpg');
                $image2 = asset('public/frontend/theme/images/about-img-2.jpg');
                $image3 = asset('public/frontend/theme/images/about-img-3.jpg');
                @endphp
            @endif
            <div class="row">
                <!--start about-img-->
                <div class="col-md-4">
                    <div class="about-img-four">
                        <img src="{{ $image1 }}" class="img-fluid" alt="image">
                    </div>
                </div>
                <!--end about-img-->
                <!--start about-img-->
                <div class="col-md-4">
                    <div class="about-img-four margin">
                        <img src="{{ $image2 }}" class="img-fluid" alt="image">
                    </div>
                </div>
                <!--end about-img-->
                <!--start about-img-->
                <div class="col-md-4">
                    <div class="about-img-four">
                        <img src="{{ $image3 }}" class="img-fluid" alt="image">
                    </div>
                </div>
                <!--end about-img-->
            </div>
            <div class="row">
                <!--start sec-heading-->
                <div class="col-lg-12">
                    <div class="sec-heading text-center">
                        @if(!isSignUpAllowed() && isset($about) && $about->title!='')
                            <h4>{{ $about->title }}</h4>
                            <h2>{{ $about->main_title }}</h2>
                            <p>{{ $about->main_description }}</p>
                        @else
                            <h4>about us</h4>
                            <h2>We Handle the Administrative Complexities, freeing you to prioritize what truly counts!</h2>
                            <p>EDSERE is an educational technology company that provides a comprehensive school management software for K-12 schools and organizations. Our SDMS is designed not only to simplify administrative processes, improve record keeping, and foster collaboration among staff and students, but also to promote inclusive learning by providing adaptive tools and resources for improved learning outcomes, catering to the diverse needs of students.</p>
                            <p>With a centralized management system, experience the ease of overseeing workflows in real-time, and seamlessly manage students, staff, and parents from anywhere in the world, empowering you to make informed decisions, faster!</p>
                        @endif
                    </div>
                </div>
                <!--end sec-heading-->
            </div>
            @if(isSignUpAllowed())
            <div class="row">
                <div class="col-lg-4 mx-auto about-detail">
                    <div class="about-content-inner">
                        <div class="about-content">
                            <h4>Streamlined Payroll: </h4>
                            <p>Our software guarantees seamless payroll procedures, including automated Pension calculations, eliminating hassles and ensuring accuracy.</p>
                        </div>  
                    </div>  
                </div>
                <div class="col-lg-4 mx-auto about-detail">  
                    <div class="about-content">
                        <h4>Complete Dashboard Suite:</h4>
                        <p>Experience a panoramic view of your school's activities using our intuitive dashboard. With just a click, track and manage all aspects effortlessly.</p>
                    </div>
                </div>
                <div class="col-lg-4 mx-auto about-detail">  
                    <div class="about-content">
                        <h4>Boost Productivity:</h4>
                        <p>Empower teachers to focus on teaching, not paper work, and enable students to access learning resources and submit assignments effortlessly, maximizing time and potential.</p>
                    </div>
                </div>
            </div>
            <div class="row about-counter-wrap">
                <!--start counter-single-->
                <div class="col-md-4">
                    <div class="counter-single text-center">
                        <div class="counter-number">
                            <h2><span>800</span>+</h2>
                        </div>
                        <div class="counter-title">
                            <p>Students</p>
                        </div>
                    </div>
                </div>
                <!--end counter-single-->
                <!--start counter-single-->
                <div class="col-md-4">
                    <div class="counter-single text-center">
                        <div class="counter-number">
                            <h2><span>100</span>+</h2>
                        </div>
                        <div class="counter-title">
                            <p>Educators</p>
                        </div>
                    </div>
                </div>
                <!--end counter-single-->
                <!--start counter-single-->
                <div class="col-md-4">
                    <div class="counter-single text-center">
                        <div class="counter-number">
                            <h2><span>500</span>+</h2>
                        </div>
                        <div class="counter-title">
                            <p>Parents</p>
                        </div>
                    </div>
                </div>
                <!--end counter-single-->
            </div>
            @endif
        </div>
    </section>
    <!--end about us-->
    @if(isSignUpAllowed())
    <!--start why choose area-->
    <section class="why-choose-area three bg-gray" id="abtperks">
        <div class="container">
            <div class="row">
                <!--start why choose heading-->
                <div class="col-lg-8 offset-lg-2">
                    <div class="sec-heading  text-center">
                        <h4>state-of-the-art school software</h4>
                        <h2>The Perks</h2>
                    </div>
                </div>
                <!--end why choose heading-->
            </div>
            <div class="row text-center justify-content-center">
                <!--start choose single-->
                <div class="col-md-4">
                    <div class="choose-single three h-100">
                        <div class="why-choose-icon three w-100">
                            <img src="{{asset('public/')}}/frontend/theme/images/icons/ribbon.png" alt="image">
                        </div>
                        <div class="why-choose-cont three w-100">
                            <h3>Personalized Experience</h3>
                            <p>Enjoy a customizable experience, where you can tailor EDSERE to your unique needs and preferences.</p>
                        </div>
                    </div>
                </div>
                <!--end choose single-->
                <!--start choose single-->
                <div class="col-md-4">
                    <div class="choose-single three h-100">
                        <div class="why-choose-icon three w-100">
                            <img src="{{asset('public/')}}/frontend/theme/images/icons/customer.png" alt="image">
                        </div>
                        <div class="why-choose-cont three w-100">
                            <h3>Exceptional Customer Service</h3>
                            <p>Our dedicated support team ensures prompt and effective solutions to any questions or concerns, so you can focus on what matters most.</p>
                        </div>
                    </div>
                </div>
                <!--end choose single-->
                <!--start choose single-->
                <div class="col-md-4">
                    <div class="choose-single three">
                        <div class="why-choose-icon three w-100">
                            <img src="{{asset('public/')}}/frontend/theme/images/icons/track.png" alt="image">
                        </div>
                        <div class="why-choose-cont three w-100">
                            <h3>Free Curriculum-Tailored Resources</h3>
                            <p>Enjoy instant access to high-quality, curriculum-aligned resources, carefully crafted to support teaching needs and enhance student learning.</p>
                        </div>
                    </div>
                </div>
                <!--end choose single-->
            </div>
        </div>
    </section>
    <!--end why choose area-->
    @endif
     <!--start testimonial area-->
     <section class="testimonial-area two">
        <div class="container">
            <div class="row">
                <!--start sec-heading-->
                <div class="col-lg-8 offset-lg-2">
                    <div class="sec-heading  tesimonial-text text-center">
                        <h4>testimonial</h4>
                        <h2>Voices from the Field</h2>
                    </div>
                </div>
                <!--end sec-heading-->
            </div>
            <div class="testi-carousel owl-carousel">
                 @if(!isSignUpAllowed())
                @foreach($testimonial as $testimonials)
                <div class="testi-single two">
                    <div class="testi-cont-inner">
                        <div class="testi-quote">
                            <i class="fa fa-quote-left"></i>
                        </div>
                        <p style="word-break: break-all;">{{ $testimonials->description ?? '' }}</p>
                    </div>
                    <div class="testi-client-info">
                        <!-- <div class="testi-client-img">
                            <img src="{{ asset($testimonials->image) }} " alt="image">
                        </div> -->
                        <div class="testi-client-details">
                            <h4>{{ $testimonials->name ?? '' }}</h4>
                            <h6>{{ $testimonials->designation ?? '' }} {{ $testimonials->institution_name ? ','.$testimonials->institution_name : '' }}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <!--start testimonial single-->
                    <div class="testi-single two">
                        <div class="testi-cont-inner">
                            <div class="testi-quote">
                                <i class="fa fa-quote-left"></i>
                            </div>
                            <div class="testi-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>"Thank you EDSERE. For this will make the running of our schools easy"</p>
                        </div>
                        <div class="testi-client-info">
                            <!-- <div class="testi-client-img">
                                <img src="{{asset('public/')}}/frontend/theme/images/client-2.jpg" alt="image">
                            </div> -->
                            <div class="testi-client-details">
                                <h4>Proprietress</h4>
                                <h6>Ogun state</h6>
                            </div>
                        </div>
                    </div>
                    <!--end testimonial single-->
                    <!--start testimonial single-->
                    <div class="testi-single two">
                        <div class="testi-cont-inner">
                            <div class="testi-quote">
                                <i class="fa fa-quote-left"></i>
                            </div>
                            <div class="testi-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>"Thank you EDSERE for the great opportunity to be part of this"</p>
                        </div>
                        <div class="testi-client-info">
                            <!-- <div class="testi-client-img">
                                <img src="{{asset('public/')}}/frontend/theme/images/client-1.jpg" alt="image">
                            </div> -->
                            <div class="testi-client-details">
                                <h4>Proprietress</h4>
                                <h6>Ogun state</h6>
                            </div>
                        </div>
                    </div>
                    <!--end testimonial single-->
                    <!--start testimonial single-->
                    <div class="testi-single two">
                        <div class="testi-cont-inner">
                            <div class="testi-quote">
                                <i class="fa fa-quote-left"></i>
                            </div>
                            <div class="testi-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>"Thank you EDSERE for providing a system that makes running a school less difficult"</p>
                        </div>
                        <div class="testi-client-info">
                            <!-- <div class="testi-client-img">
                                <img src="{{asset('public/')}}/frontend/theme/images/client-3.jpg" alt="image">
                            </div> -->
                            <div class="testi-client-details">
                                <h4>Proprietress</h4>
                                <h6>Lagos</h6>
                            </div>
                        </div>
                    </div>
                    <!--end testimonial single-->
                @endif
            </div>
        </div>
    </section>
    <!--end testimonial area-->
  @endsection
