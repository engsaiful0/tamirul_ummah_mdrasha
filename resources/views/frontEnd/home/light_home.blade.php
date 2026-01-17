@extends('frontEnd.master')
@section('title')
@if(isSignUpAllowed())
School Management Software
@endif
@endsection
@php
    $generalSetting = generalSetting();
    $school_config = schoolConfig();
    $defaultImage = asset('public/frontend/theme/images/banner-5.png');
    $backgroundImage = (!isSignUpAllowed() && isset($homePage) && $homePage->image)
        ? asset($homePage->image)
        : $defaultImage;
@endphp
@section('mainContent')
    <!--start hero area-->
    <section class="hero-area two" id="secdemo"  style="background-image: url('{{ $backgroundImage }}');">
        <div class="container">
            <div class="row">
                <!--start heading-->
                <div class="col-lg-10">
                    <div class="caption-content two">
                        @if(!isSignUpAllowed() && isset($homePage) && $homePage->title!='')
                            <h2>{{$homePage->title}}</h2>
                        @else
                            <h2>The Optimal School Management System</h2>
                        @endif
                       
                        @if(!isSignUpAllowed() && isset($homePage) && $homePage->short_description!='')
                            <p>{{$homePage->short_description}}</p>
                        @else
                           <p>Streamline school operations, amplify academic excellence, free up time, and eliminate paperwork hassles with EDSERE.</p>
                        @endif  
                        <ul>
                             @if(isSignUpAllowed())
                            <li><a class="btn-bg" href="javascript:void(0);" data-toggle="modal" data-target="#bookform">Book a Demo</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!--end heading-->
            </div>
        </div>
    </section>
    <!--end hero area-->

    <div class="modal fade" id="bookform" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="bookformLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookformLabel">Book a Demo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 80vh;">
                    <iframe src="https://forms.gle/YPv28AAaZCfkk4ar6" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                </div>
            </div>
        </div>
    </div>
    <!--start about-area-->
    <section class="about-area">
        <div class="container">
            <div class="row">
                <!--start about-img-->
                <div class="col-sm-6 col-lg-6">
                    <div class="about-img">
                        @if(!isSignUpAllowed() && isset($about) && $about->image!='')
                           @php
                            $image1 = $about->image ? asset($about->image) : asset('public/frontend/theme/images/about-img-1.jpg');
                            $image2 = $about->main_image ? asset($about->main_image) : asset('public/frontend/theme/images/about-img-2.jpg');
                            $image3 = $about->main_image_2 ? asset($about->main_image_2) : asset('public/frontend/theme/images/about-img-3.jpg');
                        @endphp
                        @if($image1 && $image2 && $image3)
                            <img src="{{ url($image1) }}" class="img-fluid" alt="school image1">
                            <div class="about-img-inner">
                                <img src="{{ url($image2) }}" class="img-fluid" alt="school image2">
                            </div>
                            <div class="about-img-two">
                                <img src="{{ url($image3) }}" class="img-fluid" alt="school image3">
                            </div>
                            @endif
                        @else
                            <img src="{{asset('public/')}}/frontend/theme/images/about-img-1.jpg" class="img-fluid" alt="school image 1">
                            <div class="about-img-inner">
                                <img src="{{asset('public/')}}/frontend/theme/images/about-img-2.jpg" class="img-fluid" alt="school image 2">
                            </div>
                            <div class="about-img-two">
                                <img src="{{asset('public/')}}/frontend/theme/images/about-img-3.jpg" class="img-fluid" alt="school image 3">
                            </div>
                        @endif
                    </div>
                </div>
                <!--end about-img-->
                <!--start about-cont-->
                <div class="col-sm-6 col-lg-6">
                    <div class="about-cont">
                        <div class="align-middle d-table-cell">
                        @if(!isSignUpAllowed() && isset($about) && $about->title!='')
                            <h4>{{ $about->title }}</h4>
                            <h2>{{ $about->main_title }}</h2>
                            <p>{{ $about->main_description }}</p>
                            <div class="btn-default">
                               <a href="{{ $about->button_url ? url($about->button_url) : '#' }}">{{ $about->button_text }}</a>
                            </div>
                        @else
                            <h4>about us</h4>
                            <h2>We Handle the Administrative Complexities, freeing you to prioritize what truly counts!</h2>
                            <p>EDSERE is an educational technology company that provides a comprehensive school management software for K-12 schools and organizations. Our SDMS is designed not only to simplify administrative processes, improve record keeping, and foster collaboration among staff and students, but also to promote inclusive learning by providing adaptive tools and resources for improved learning outcomes, catering to the diverse needs of students.</p>
                            <p>With a centralized management system, experience the ease of overseeing workflows in real-time, and seamlessly manage students, staff, and parents from anywhere in the world, empowering you to make informed decisions, faster!</p>
                            <div class="btn-default">
                                <a href="{{url('/about')}}">Learn More</a>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                <!--end about-cont-->
            </div>
        </div>
    </section> 
    <!--end about-area-->
    @if(isSignUpAllowed())
    <!--start category area-->
    <section class="category-area two bg-gray">
        <div class="container">
            <div class="row">
                <!--start heading-->
                <div class="col-lg-8 offset-lg-2">
                    <div class="sec-heading text-center">
                        <h4>Features</h4>
                        <h2>Explore Our Features</h2>
                    </div>
                </div>
                <!--end heading-->
            </div>
             <div class="row">
                <!--start features card-->
                <div class="col-lg-3 col-md-6">
                    <div class="course-card h-90">
                        <div class="course-thumbnail">
                            <a href="#">
                                <img src="{{asset('public/')}}/frontend/theme/images/features1.jpg" class="img-fluid" alt="image">
                            </a>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="#">Dashboard</a>
                            </h3>
                            <div class="course-rating d-flex align-middle">
                                <p>Your command center for optimal school performance.</p>
                            </div>
                        </div>
                        <div class="course-h-content">
                            <p>Get a unified view of your school’s key metrics, all in one place. Our intuitive dashboard provides real-time insights into financial performance and accounting reports, staff management and HR metrics, student enrollment and progress, parent engagement and communication trends, empowering you to make data-driven decisions, optimize resources, and drive school success.</p>
                        </div>
                    </div>
                </div>
                <!--end features card-->
                <!--start features card-->
                <div class="col-lg-3 col-md-6">
                    <div class="course-card h-90">
                        <div class="course-thumbnail">
                            <a href="#">
                                <img src="{{asset('public/')}}/frontend/theme/images/features2.jpg" class="img-fluid" alt="image">
                            </a>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="#">Admin Management</a>
                            </h3>
                            <div class="course-rating">
                                <p>Customizable controls for seamless operations.</p>
                            </div>
                        </div>                        
                        <div class="course-h-content">
                            <p>Tailor EDSERE to your school’s unique needs with our robust admin management features. Define roles, permissions, and access controls with user management, ensuring sensitive information is secure. Configure the system to align with your school’s policies, procedures and branding, maintaining the highest standards of security and compliance.</p>
                        </div>
                    </div>
                </div>
                <!--end features card-->
                <!--start features card-->
                <div class="col-lg-3 col-md-6">
                    <div class="course-card h-90">
                        <div class="course-thumbnail">
                            <a href="#">
                                <img src="{{asset('public/')}}/frontend/theme/images/features3.jpg" class="img-fluid" alt="image">
                            </a>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="#">Academics</a>
                            </h3>
                            <div class="course-rating">
                                <p>Access comprehensive curriculum management and lesson planning tools, and CBT center.</p>
                            </div>
                        </div>                        
                        <div class="course-h-content">
                            <p>Access a centralized repository for curriculum information to ensure easy access and consistency. Lesson planning tools to help teachers create standards-aligned lessons, with access to a library of free resources, including worksheets and edu games. CBT center that enables schools to administer, track and analyze digital exams and assessments with ease.</p>
                        </div>
                    </div>
                </div>
                <!--end features card-->
                <!--start features card-->
                <div class="col-lg-3 col-md-6">
                    <div class="course-card h-90">
                        <div class="course-thumbnail">
                            <a href="#">
                                <img src="{{asset('public/')}}/frontend/theme/images/features4.jpg" class="img-fluid" alt="image">
                            </a>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="#">Bulk Print</a>
                            </h3>
                            <div class="course-rating">
                                <p>Efficient mass printing solution for student ID cards and certificates.</p>
                            </div>
                        </div>                        
                        <div class="course-h-content">
                            <p>Quickly and easily print in bulk, customized student ID cards and certificates, reports, resources, and documents, saving time and reducing administrative workload.</p>
                        </div>
                    </div>
                </div>
                <!--end features card-->
                <!--start features card-->
                <div class="col-lg-3 col-md-6">
                    <div class="course-card h-90">
                        <div class="course-thumbnail">
                            <a href="#">
                                <img src="{{asset('public/')}}/frontend/theme/images/features5.jpg" class="img-fluid" alt="image">
                            </a>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="#">Report Management</a>
                            </h3>
                            <div class="course-rating">
                                <p>Reporting tools for academic, financial and administrative data.</p>
                            </div>
                        </div>                        
                        <div class="course-h-content">
                            <p>Access reporting tools for academic performance and progress, financial management and transactions, administrative operations and trends. Easily generate, customize, and analyze reports to gain valuable insights and drive success.</p>
                        </div>
                    </div>
                </div>
                <!--end features card-->
                <!--start features card-->
                <div class="col-lg-3 col-md-6">
                    <div class="course-card h-90">
                        <div class="course-thumbnail">
                            <a href="#">
                                <img src="{{asset('public/')}}/frontend/theme/images/features6.jpg" class="img-fluid" alt="image">
                            </a>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="#">Human Resources</a>
                            </h3>
                            <div class="course-rating">
                                <p>Employment management functionalities with payroll automation.</p>
                            </div>
                        </div>                        
                        <div class="course-h-content">
                            <p>Manage HR operations including employments, employee benefits, remunerations, leaves, and performance evaluations.</p>
                        </div>
                    </div>
                </div>
                <!--end features card-->
                <!--start features card-->
                <div class="col-lg-3 col-md-6">
                    <div class="course-card h-90">
                        <div class="course-thumbnail">
                            <a href="#">
                                <img src="{{asset('public/')}}/frontend/theme/images/features7.jpg" class="img-fluid" alt="image">
                            </a>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="#">Fees Management</a>
                            </h3>
                            <div class="course-rating">
                                <p>Simplified fee tracking and payment.</p>
                            </div>
                        </div>                        
                        <div class="course-h-content">
                            <p>Effortlessly manage school fees with fee structure and payment management tools for easy configuration and tracking. Payment tracking and reminders to ensure timely payments and minimize arrears.</p>
                        </div>
                    </div>
                </div>
                <!--end features card-->
                <!--start features card-->
                <div class="col-lg-3 col-md-6">
                    <div class="course-card h-90">
                        <div class="course-thumbnail">
                            <a href="#">
                                <img src="{{asset('public/')}}/frontend/theme/images/features8.jpg" class="img-fluid" alt="image">
                            </a>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="#">Inventory</a>
                            </h3>
                            <div class="course-rating">
                                <p>Inventory management system for tracking and maintaining school resources and assets.</p>
                            </div>
                        </div>                        
                        <div class="course-h-content">
                            <p>Access a comprehensive system for monitoring, tracking, and maintenance of school resources, supplies, and assets with automated reporting.</p>
                        </div>
                    </div>
                </div>
                <!--end features card-->
                
            </div>
            <div class="row">
               <div class="col-lg-12">
                    <div class="category-btn btn-default text-center">
                        <a href="{{url('contact')}}">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end Features area-->
    <!--start why choose area-->
    <section class="why-choose-area">
        <div class="container">
            <div class="row">
                <!--start why choose heading-->
                <div class="col-lg-3">
                    <div class="why-choose-intro mb-lg-0 mb-3">
                        <h2>Why EDSERE?</h2>
                        <!-- <p>The Prime Educational Enterprise Software.</p>
                        <p>The Superlative Learning ERP</p> -->
                        <div class="why-choose-btn">
                            <a href="{{url('about#abtperks')}}">Learn More</a>
                        </div>
                    </div>
                </div>
                <!--end why choose heading-->
                <div class="col-lg-9">
                    <div class="row">
                        <!--start why choose single-->
                        <div class="col-lg-6">
                            <div class="why-choose-single">
                                <div class="why-choose-icon">
                                    <img src="{{asset('public/')}}/frontend/theme/images/icons/solution.png" class="img-fluid" alt="image">
                                </div>
                                <div class="why-choose-cont">
                                    <h3>Robust Data Protection:</h3>
                                    <p>EDSERE uses a secure cloud infrastructure (AWS),with advanced security measures, to ensure your data is protected, providing lifetime access to your information while safeguarding it against unauthorized access or breaches.</p>
                                </div>
                            </div>
                        </div>
                        <!--end why choose single-->
                        <!--start why choose single-->
                        <div class="col-lg-6">
                            <div class="why-choose-single">
                                <div class="why-choose-icon">
                                    <img src="{{asset('public/')}}/frontend/theme/images/icons/technology.png" class="img-fluid" alt="image">
                                </div>
                                <div class="why-choose-cont">
                                    <h3>Advanced Innovation:</h3>
                                    <p>We stay ahead of the curve, incorporating the latest advancements to provide you with state-of-the-art features, unparalleled performance, and a competitive edge in your industry.</p>
                                </div>
                            </div>
                        </div>
                        <!--end why choose single-->
                        <!--start why choose single-->
                        <div class="col-lg-6">
                            <div class="why-choose-single">
                                <div class="why-choose-icon">
                                    <img src="{{asset('public/')}}/frontend/theme/images/icons/customer.png" class="img-fluid" alt="image">
                                </div>
                                <div class="why-choose-cont">
                                    <h3>Customer-Centric Approach:</h3>
                                    <p>Our commitment to your success goes beyond providing a product or service. We take a customer-centric approach, prioritizing your satisfaction and success. Our dedicated support team is always ready to assist you, ensuring a seamless experience from onboarding to ongoing support.</p>
                                </div>
                            </div>
                        </div>
                        <!--end why choose single-->
                        <!--start why choose single-->
                        <div class="col-lg-6">
                            <div class="why-choose-single">
                                <div class="why-choose-icon">
                                    <img src="{{asset('public/')}}/frontend/theme/images/icons/track.png" class="img-fluid" alt="image">
                                </div>
                                <div class="why-choose-cont">
                                    <h3>Free Curriculum-tailored teaching and learning resources:</h3>
                                    <p>Access a library of professional resources, including e-lesson notes, multimedia textbooks, interactive and printable worksheets, puzzles, and educational games to keep students engaged, while developing vital learning skills, empowering teachers to create engaging lessons and foster a love of learning in students.</p>
                                </div>
                            </div>
                        </div>
                        <!--end why choose single-->
                    </div>
                </div>
                <!--end choose single-->
            </div>
        </div>
    </section>
    <!--end why choose area-->
   
    <!--start modules area-->
    <section class="modules-areas d-none">
        <div class="container">
            <div class="row">
                <!--start sec-heading-->
                <div class="col-lg-8 offset-lg-2">
                    <div class="sec-heading text-center">
                        <h4>Modules</h4>
                        <h2>Modules</h2>
                    </div>
                </div>
                <!--end sec-heading-->
            </div>
            <div class="row">
                <div class="col-lg-4 modules-list">
                    <div class="modules-header">
                        <h5>Academics</h5>
                    </div>
                    <div class="modules-content">
                        <ul>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Extra curricular Class
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Optional Subject
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Section
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Class
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Subjects
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Assign Class Teacher
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Assign Subject
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Class Room
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Class Routine
                            </li>
                        </ul>
                    </div>
                </div>
                 <div class="col-lg-4 modules-list">
                    <div class="modules-header">
                        <h5>Students</h5>
                    </div>
                    <div class="modules-content">
                        <ul>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student Category
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Add Student

                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student List
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student Attendance

                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student Promote
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Disabled Students
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student Export
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Assign Extra Curricular Class
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Lesson Plan
                            </li>
                        </ul>
                    </div>
                </div>
                 <div class="col-lg-4 modules-list">
                    <div class="modules-header">
                        <h5>Reports</h5>
                    </div>
                    <div class="modules-content">
                        <ul>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student Attendance Report
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Summary
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student Transport Report
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student Dormitory Report
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Guardian Reports
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student Listings
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Class Report
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Student Login Report
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                Class Routine
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                    <div class="category-btn btn-default text-center">
                        <a href="#">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mod-sections" id="secmodules">
        <div class="container">
            <div class="row">
                <!--start heading-->
                <div class="col-lg-8 offset-lg-2">
                    <div class="sec-heading text-center">
                        <h2>Modules</h2>
                    </div>
                </div>
                <!--end heading-->
            </div>
             <div class="row justify-content-center card-module-list">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>Administration</h2>
                        <p>Streamline your school operations, academics, and admissions through efficient data management and automation.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>Finance</h2>
                        <p>Effortlessly manage your school’s finances with features for fee collection, invoicing, payment tracking, and financial reporting.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>Human Resources</h2>
                        <p>Simplify HR processes with tools for staff profiling, payroll integration, leave tracking, and performance monitoring, all in one place.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>Academics</h2>
                        <p>Elevate academic excellence with tools for curriculum and lesson planning, class scheduling/timetables, progress and attendance tracking, grading, student performance and academic analysis and reporting.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>CBT</h2>
                        <p>Deliver secure and efficient online exams with features for creating, administering, and grading tests and exams, with real-time results tracking and analytics.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>Library</h2>
                        <p>Optimize library operations with integrated tools for book cataloging, circulation, patron management and tracking, improving resource accessibility and utilization.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>Communication</h2>
                        <p>Unite teams and stakeholders with a centralized communication hub for email, in-app messaging, SMS, announcements and notices.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>Hostel</h2>
                        <p>Hostel administration made easy with our centralized system for dormitory management and allocation, scheduling, and facility maintenance.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>Transportation</h2>
                        <p>Effectively manage transportation with tools for transportation monitoring, route planning, vehicle tracking, student transportation coordination.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-module">
                        <h2>Inventory</h2>
                        <p>Efficiently monitor and manage school supplies and assets with our inventory tracking system.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end modules area-->
    <!--start video area-->
    <section class="video-area bg-gray">
        <div class="container">
            <div class="row">
                <!--start video player-->
                <div class="col-lg-12">
                    <div class="video-player-wrap text-center">
                        <div class="video-player d-table">
                            <div class="d-table-cell align-middle">
                                <img src="{{asset('public/')}}/frontend/theme/images/banner-6.png" alt="image"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end video player-->
            </div>
            <div class="row">
                <!--start video content-->
                <div class="col-lg-10 offset-lg-1 text-center">
                    <div class="video-cont">
                        <h2 class="fc-p">EDSERE in numbers</h2>
                    </div>
                </div>
                <!--end video content-->
            </div>
            <div class="row counter-wrap">
                <!--start counter-single-->
                <div class="col-md-4">
                    <div class="counter-single text-center">
                        <h2><span>800</span>+</h2>
                        <p>Students</p>
                    </div>
                </div>
                <!--end counter-single-->
                <!--start counter-single-->
                <div class="col-md-4">
                    <div class="counter-single text-center">
                        <h2><span>100</span>+</h2>
                        <p>Educators</p>
                    </div>
                </div>
                <!--end counter-single-->
                <!--start counter-single-->
                <div class="col-md-4">
                    <div class="counter-single text-center">
                        <h2><span>500</span>+</h2>
                        <p>Parents</p>
                    </div>
                </div>
                <!--end counter-single-->
            </div>
        </div>
    </section>
    <!--end video area-->
    @endif
    
    <!--start testimonial area-->
    <section class="testimonial-area two" id="sectestimonials">
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
                            <img src="{{ asset($testimonials->image) }} " class="img-fluid" alt="image">
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
   
