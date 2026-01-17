<!DOCTYPE html>
@php
    $generalSetting = generalSetting();
    $school_config = schoolConfig();
@endphp
<html lang="{{ app()->getLocale() }}" @if(userRtlLtl()==1) dir="rtl" class="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
     <title>
     @if(!isSignUpAllowed())
        {{@schoolConfig()->school_name ? @schoolConfig()->school_name : 'School Management Software'}}
            @yield('title')
    
    @else
     @yield('title')
    @endif
    </title>
    <!--favicon-->
        @if (!is_null($school_config->favicon))
            <link rel="shortcut icon" type="image/png" href="{{ asset($school_config->favicon) }}">
        @else
            <link rel="shortcut icon" type="image/png" href="{{asset('public/')}}/frontend/theme/images/favicon.png">
        @endif
    
    <!--bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/css/bootstrap.min.css">
    <!--owl carousel css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/css/owl.carousel.min.css">
    <!--magnific popup css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/css/magnific-popup.css">
    <!--font awesome css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/fonts/tabler-icons.min.css" />
    <!--meanmenu css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/css/meanmenu.css">
    <!--animate css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/css/animate.css">
    <!--main css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/css/custom.css">
    <!--responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/')}}/frontend/theme/css/responsive.css">
    <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <!--star preloader-->
    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell align-middle">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div>
    </div>
    <!--end preloader-->
    <div class="sidebar-wrap">
        <div class="sidebar-inner">
            <div class="sidebar-close">
                <div class="sidebar-close-btn">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <div class="sidebar-content">
                <div class="sidebar-logo">
                @php
                    if (file_exists(@schoolConfig()->logo)) {
                        $tt = file_get_contents(base_path(@schoolConfig()->logo));
                    } else {
                        $tt = file_get_contents(base_path('public/uploads/settings/logo.png'));
                    }
                @endphp
                    <a href="/">
                        <img class="img-fluid" src="{{ base64_encode($tt) }}" alt="logo.png">
                    </a>
                </div>
                <div class="mobile-menu"></div>
                <!-- <div class="search-form">
                    <input type="text" placeholder="Search Courses" class="form-control">
                    <span><i class="fa fa-search"></i></span>
                </div> -->
                <!-- <div class="contact-info">
                    <ul>
                        <li><i class="fa fa-envelope"></i>raisun@dreamsschool.io</li>
                        <li><i class="fa fa-phone"></i> +91 7824931319</li>
                    </ul>
                </div> -->
                <!-- <div class="social-icon">
                    <ul>
                        <li><span>Follow Us:</span></li>
                        <li><a href="#"><i class="ti ti-brand-x-filled"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div> -->
                <div class="header-log-reg mt-2 mt-md-0">
                    <ul>
                        <li><a href="{{url('login')}}">Login</a></li>
                        @if(isSignUpAllowed())
                            <li><small>|</small></li>
                            <li><a href="{{url('signup')}}">Signup</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- start header-top-area -->
    <header class="header-area">
        <div class="header-top-area d-none">
            <div class="container">
                <div class="header-top-wrap">
                    <!--start header contact info-->
                    <div class="header-contact-info text-left">
                        <!-- <ul>
                            <li><i class="fa fa-envelope"></i> raisun@dreamsschool.io</li>
                            <li><i class="fa fa-phone"></i> 7824931319</li>
                        </ul> -->
                    </div>
                    <!--end header contact info-->
                    <!--start header-top-social-->
                    <div class="header-top-social text-right">
                        <ul>
                            <li><a href="#"><i class="ti ti-brand-x-filled"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                    <!--end header-top-social-->
                </div>
            </div>
        </div>
        <!--end header-top-area-->
        <!--start header-btm-area-->
        <div class="header-btm-area">
            <div class="container">
                <div class="main-menu-wrap">
                    <!--start site logo-->
                    <div class="site-logo">
                        <a href="/">
                            @if (!is_null($school_config->logo))
                                <img src="{{ asset($school_config->logo) }}" alt="logo">
                            @else
                                <img src="{{asset('public/')}}/frontend/theme/images/logo.png" alt="logo">
                            @endif
                        </a>
                    </div>
                    <!--end site logo-->
                    <!--start mainmenu-->
                    <div class="main-menu-area text-right">
                        <nav class="mainmenu">
                            <ul>
                                @php
                                $currentRouteName = \Route::currentRouteName();
                                @endphp
                                <li><a href="{{url('/')}}" class="{{ in_array($currentRouteName, ['/', 'home']) ? 'active' : '' }}">Home</a></li>
                                <li><a href="{{url('about')}}" class="{{ $currentRouteName === 'about' ? 'active' : '' }}">About Us</a></li>
                                <li><a href="{{url('contact')}}" class="{{ $currentRouteName === 'contact' ? 'active' : '' }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!--end mainmenu-->
                    <!--start login registration btn-->
                    <div class="header-log-reg text-right">
                        <ul>
                            <li><a href="{{url('login')}}">Login</a></li>
                            @if(isSignUpAllowed())
                                <li><small>|</small></li>
                                <li><a href="{{url('signup')}}">Signup</a></li>
                            @endif
                        </ul>
                    </div>
                    <!--end login registration btn-->
                    <!--start toggle button-->
                    <div class="header-toggle-btn">
                        <a class="sidebar-toggle-btn">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <!--end toggle button-->
                </div>
            </div>
        </div>
    </header>
    <!--end header-->