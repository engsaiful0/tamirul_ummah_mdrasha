    <!--start footer-area-->
    <style>
        .footer_services{
            color: #741692;
            font-weight: 400;
            font-family: inherit !important;
            font-size:16px;
        }
    </style>
    @php
    $generalSetting = generalSetting();
    $school_config = schoolConfig();
    @endphp
    <footer class="footer-area">
        <!--start footer top area-->
        <div class="footer-top-area">
            <div class="container">
                <div class="row">
                    <!--start footer widget-->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget logo">
                            <a href="/">
                                @if (!is_null($school_config->logo))
                                    <img src="{{ asset($school_config->logo) }}" alt="logo">
                                @else
                                    <img src="{{asset('public/')}}/frontend/theme/images/logo.png" alt="logo">
                                @endif
                            </a>
                            <div class="footer-about-description">
                                 @if(isSignUpAllowed())
                                <p>Our comprehensive suite not only simplifies administrative processes and operations in schools, but also promotes inclusive learning by providing adaptive tools and resources for improved learning outcomes, catering to the diverse needs of students, including those with disabilities.</p>
                                @else
                                <p>Join Our Community Today!” </p>
                                @endif
                            </div>
                             @if(isSignUpAllowed())
                            <h6>Follow Us</h6>
                            <ul class="footer-social-icons">
                                <li><a target="_blank"  href="https://www.facebook.com/profile.php?id=61574806256641"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="ti ti-brand-x-filled"></i></a></li>
                                <li><a target="_blank" href="https://www.linkedin.com/company/edsere/"><i class="fa fa-linkedin"></i></a></li>
                                <li><a target="_blank" href="https://www.instagram.com/edseresoftware?igsh=YjQ4a3VvZ2ZvbHRi&utm_source=qr"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    <!--end footer widget-->
                     @if(isSignUpAllowed())
                    <!--start footer widget-->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-widget footer-cat">
                            <h4>Quick Links</h4>
                            <ul>
                                <li><a href="/"><i class="fa fa-angle-right"></i> Home</a></li>
                                <li><a href="/about"><i class="fa fa-angle-right"></i> About Us</a></li>
                                 @if(isSignUpAllowed())
                                <li><a href="{{ url('/#secmodules') }}"><i class="fa fa-angle-right"></i> Modules</a></li>
                                <li><a href="{{ url('/#secdemo') }}"><i class="fa fa-angle-right"></i> Demo</a></li>
                                @endif
                                <li><a href="{{ url('/#sectestimonials') }}"><i class="fa fa-angle-right"></i> Testimonials</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--end footer widget-->
                    <!--start footer widget-->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-widget footer-cat">
                            <h4>Our Services</h4>
                            <ul>
                                <li class="footer_services"><i class="fa fa-angle-right"></i> Academics</li>
                                <li class="footer_services"><i class="fa fa-angle-right"></i> Administration</li>
                                <li class="footer_services"><i class="fa fa-angle-right"></i> Accounts</li>
                                <li class="footer_services"><i class="fa fa-angle-right"></i> Human Resource</li>
                                <li class="footer_services"><i class="fa fa-angle-right"></i> Asset Management</li>
                            </ul>
                        </div>
                    </div>
                    <!--end footer widget-->
                    @endif
                    <!--start footer widget-->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget footer-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                @if(!isSignUpAllowed() && isset($school_config->address) && $school_config->address!='')
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    <p class="m-0"> {{ $school_config->address }} </p>
                                </li>
                                @else
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    <p class="m-0">3, Bright-Ese street,  </p>
                                    <p class="m-0">Evbukhu, off Sapele Road,</p>
                                    <p class="m-0">Benin city, Edo state.</p>
                                </li>
                                @endif
                                <li>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <p>{{ !isSignUpAllowed() && isset($school_config->email) && $school_config->email!='' ?  $school_config->email : 'edsereltd@gmail.com' }}</p>
                                </li>
                                <li>
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <p>{{ !isSignUpAllowed() && isset($school_config->phone) && $school_config->phone!='' ? $school_config->phone : '+2348072868289' }}</p>
                                </li>
                                <li class="p-0 info">Feel free to contact us
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end footer widget-->
                </div>
            </div>
        </div>
        <!--end footer top area-->
        <!--start footer bottom-->
        <div class="footer-bottom-area text-center d-none">
            <div class="container">
                @if(!isSignUpAllowed() && isset($school_config->copyright_text) && $school_config->copyright_text!='')
                    <p class="m-0"> {{ $school_config->copyright_text }}</p>
                @else
                    <p class="m-0">Copyright © {{ date('Y') }} All rights reserved | This application is made by Dreams Technologies</p>
                @endif
            </div>
        </div>
        <!--end footer bottom-->
    </footer>
    @if(isSignUpAllowed())
    <div class="tele-container">
        <a href="https://wa.me/2348072868289" target="_blank" class="">
            <i class="ti ti-brand-telegram"></i>
            <span>Send DM</span>
        </a>
    </div>
    @endif
    <!--end footer-->
    <!--jQuery js-->
    <script src="{{asset('public/')}}/frontend/theme/js/jquery-3.3.1.min.js"></script>
    <!--proper js-->
    <script src="{{asset('public/')}}/frontend/theme/js/popper.min.js"></script>
    <!--bootstrap js-->
    <script src="{{asset('public/')}}/frontend/theme/js/bootstrap.min.js"></script>
    <!--mainmenu js-->
    <script src="{{asset('public/')}}/frontend/theme/js/meanmenu.min.js"></script>
    <!--counterup js-->
    <script src="{{asset('public/')}}/frontend/theme/js/counterup.min.js"></script>
    <!--waypoints js-->
    <script src="{{asset('public/')}}/frontend/theme/js/waypoints.js"></script>
    <!--magnic popup js-->
    <script src="{{asset('public/')}}/frontend/theme/js/magnific-popup.min.js"></script>
    <!--owl carousel js-->
    <script src="{{asset('public/')}}/frontend/theme/js/owl.carousel.min.js"></script>
    <!--syotimer js-->
    <script src="{{asset('public/')}}/frontend/theme/js/syotimer.min.js"></script>
    <!--main js-->
    <script src="{{asset('public/')}}/frontend/theme/js/custom.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('public/')}}/frontend/js/registration_custom.js"></script>

    <script type="text/javascript">
        function contactForm(){
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var subject = document.getElementById("subject").value;
            var message = document.getElementById("message").value;
            var i = 0;
            if (name == "") {
                document.getElementById("name_err").innerHTML =
                    "Name field is required";
                i++;
            } else {
                document.getElementById("name_err").innerHTML = "";
            }
            if (email == "") {
                document.getElementById("email_err").innerHTML =
                    "Email field is required";
                i++;
            } else {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                // Check if the email matches the pattern
                if (emailRegex.test(email)) {
                    document.getElementById("email_err").innerHTML = "";
                } else if(email!='') {
                    document.getElementById("email_err").innerHTML =
                        "Invalid email address. Please enter a valid email.";
                        i++;
                }
            }
            if (subject == "") {
                document.getElementById("subject_err").innerHTML =
                    "Subject field is required";
                i++;
            } else {
                document.getElementById("subject_err").innerHTML = "";
            }
            if (message == "") {
                document.getElementById("message_err").innerHTML =
                    "Message field is required";
                i++;
            } else {
                document.getElementById("message_err").innerHTML = "";
            }            

            if (i > 0) {
                return false;
            }
        }
    </script>
    <script>
      @if(Session::has('message'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
            toastr.success("{{ session('message') }}");
      @endif

      @if(Session::has('error'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
            toastr.error("{{ session('error') }}");
      @endif

      @if(Session::has('info'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
            toastr.info("{{ session('info') }}");
      @endif

      @if(Session::has('warning'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
            toastr.warning("{{ session('warning') }}");
      @endif
    </script>
</body>

</html>