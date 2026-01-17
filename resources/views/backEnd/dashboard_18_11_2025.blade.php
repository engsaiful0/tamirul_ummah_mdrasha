@extends('backEnd.master')
@section('title')
    {{ @Auth::user()->roles->name }} @lang('common.dashboard')
@endsection
@php
    $generalSetting = generalSetting();
@endphp
@push('css')
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/css/fullcalendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/calender_js/core/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/calender_js/daygrid/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/calender_js/timegrid/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/calender_js/list/main.css') }}" />
@endpush
@section('mainContent')

<section class="mb-40 dashboard-section">
        <a class="announcement-btn d-none" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <img src="public\backEnd\img\dashboard\announcement.svg">
        </a>
        <div class="container-fluid">
            <div class="dashboard-left">

                <div class="card primarybg">
                    <div class="overlay-img">
                        <img src="public/frontend/theme/images/bg/shape-04.png" alt="img" class="img-fluid shape-01">
                        <img src="public/frontend/theme/images/bg/shape-01.png" alt="img" class="img-fluid shape-02">
                        <img src="public/frontend/theme/images/bg/shape-02.png" alt="img" class="img-fluid shape-03">
                        <img src="public/frontend/theme/images/bg/shape-03.png" alt="img" class="img-fluid shape-04">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-xl-center justify-content-xl-between flex-xl-row flex-column">
                            <div class="mb-3 mb-xl-0">
                                <div class="d-flex align-items-center flex-wrap mb-2">
                                    <h1 class="text-white mr-2">Welcome Back</h1>
                                    <!-- <a href="profile.html" class="avatar avatar-sm img-rounded bg-gray-800 dark-hover"><i class="ti ti-edit text-white"></i></a> -->
                                </div>
                                <p class="text-white">Have a Good day at work</p>
                            </div>
                            <p class="text-white d-none"><i class="ti ti-refresh mr-1"></i>Updated Recently on 15 Jun
                                2024</p>
                        </div>
                    </div>
                </div>
                <div class="row">

					<!-- Total Students -->
                    @if (userPermission('number-of-student'))
					<div class="col-xl-3 col-sm-6 d-flex">
						<div class="card flex-fill animate-card border-0">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="avatar avatar-xl  mr-2">
										<img src="public/frontend/theme/images/icons/graduated.png" alt="img">
									</div>
									<div class="overflow-hidden flex-fill">
										<div class="d-flex align-items-center justify-content-between">
											<h2 class="counter">@if (isset($totalStudents))
                                        {{ $totalStudents }}
                                        @endif</h2>
											<!-- <span class="badge bg-danger">1.2%</span> -->
										</div>
										<p>Total Students</p>
									</div>
								</div>
								<div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">
									<p class="mb-0"><a href="{{route('student_admission')}}" class="fw-semibold">@lang('student.add_student')</a></p>
									<!-- <span class="text-light">|</span>
									<p>Inactive : <span class="text-dark fw-semibold">11</span></p> -->
								</div>
							</div>
						</div>
					</div>
                    @endif
					<!-- /Total Students -->

					<!-- Total Teachers -->
                    @if (userPermission('number-of-teacher'))
					<div class="col-xl-3 col-sm-6 d-flex">
						<div class="card flex-fill animate-card border-0">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="avatar avatar-xl mr-2">
										<img src="public/frontend/theme/images/icons/lecture.png" alt="img">
									</div>
									<div class="overflow-hidden flex-fill">
										<div class="d-flex align-items-center justify-content-between">
											<h2 class="counter">@if (isset($totalTeachers))
                                        {{ $totalTeachers }}
                                        @endif</h2>
											<!-- <span class="badge bg-skyblue">1.2%</span> -->
										</div>
										<p>Total Teachers</p>
									</div>
								</div>
								<div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">
									<p class="mb-0"><a href="{{route('addStaff')}}" class="fw-semibold">@lang('hr.add_teacher')</a></p>
								</div>
							</div>
						</div>
					</div>
                    @endif
					<!-- /Total Teachers -->

					<!-- Total Staff -->
                    @if (userPermission('number-of-staff'))
					<div class="col-xl-3 col-sm-6 d-flex">
						<div class="card flex-fill animate-card border-0">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="avatar avatar-xl mr-2">
										<img src="public/frontend/theme/images/icons/staff.png" alt="img">
									</div>
									<div class="overflow-hidden flex-fill">
										<div class="d-flex align-items-center justify-content-between">
											<h2 class="counter">@if (isset($totalStaffs))
                                        {{ $totalStaffs }}
                                        @endif</h2>
											<!-- <span class="badge bg-warning">1.2%</span> -->
										</div>
										<p>Total Staff</p>
									</div>
								</div>
								<div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">
									<p class="mb-0"><a href="{{route('addStaff')}}" class="fw-semibold">@lang('common.add_staff')</a></p>
								</div>
							</div>
						</div>
					</div>
                    @endif
					<!-- /Total Staff -->

					<!-- Total Subjects -->
                    @if (userPermission('number-of-parent'))
					<div class="col-xl-3 col-sm-6 d-flex">
						<div class="card flex-fill animate-card border-0">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="avatar avatar-xl mr-2">
										<img src="public/frontend/theme/images/icons/family.png" alt="img">
									</div>
									<div class="overflow-hidden flex-fill">
										<div class="d-flex align-items-center justify-content-between">
											<h2 class="counter">@if (isset($totalParents))
                                        {{ $totalParents }}
                                        @endif</h2>
											<!-- <span class="badge bg-success">1.2%</span> -->
										</div>
										<p>Total Parents</p>
									</div>
								</div>
								<div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">
									<p class="mb-0"><a href="{{route('student_list')}}" class="fw-semibold"> @lang('common.add_parents')</a></p>
								</div>
							</div>
						</div>
					</div>
                    @endif
					<!-- /Total Subjects -->

				</div>
                @if(auth()->user()->role_id == '25')
                <div class="row">
                    <div class="col-xl-6 d-flex flex-column">
                        <div class="card flex-fill">
                            <div class="card-header  d-flex align-items-center justify-content-between">
                                <h4 class="card-title">Class Attendance</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-scrl">
                                    @php $i = 0; @endphp
                                    @foreach($class_attandance as $attendance)
                                        @php
                                            if(isset($class_attandance[$i]) && $class_attandance[$i]['class'] != '') {
                                                $class = App\Models\StudentRecord::getStudentclass1($class_attandance[$i]['class']);
                                                $total_present = $class_attandance[$i]['total_present'];
                                                $total_students = $class_attandance[$i]['total_student'];
                                                $attendance_percentage = ($total_students > 0) ? ($total_present / $total_students) * 100 : 0;
                                        @endphp
                                        @if(isset($class) && $class != '')
                                            <li class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-sm-4">
                                                        <p class="text-dark">{{ $class->class_name }}</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="progress progress-xs flex-grow-1">
                                                            <div class="progress-bar bg-primary rounded" role="progressbar" 
                                                                 style="width: {{ $attendance_percentage }}%;" 
                                                                 aria-valuenow="{{ $attendance_percentage }}" 
                                                                 aria-valuemin="0" 
                                                                 aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                        @php
                                            }
                                            $i++;
                                        @endphp
                                    @endforeach
                                </ul>                                
                            </div>                    
                        </div>
                    </div>
                    <div class="col-xl-6 d-flex flex-column">
                    @if (userPermission('notice-board'))
                        <div class="card flex-fill">
                            <div class="card-header  d-flex align-items-center justify-content-between">
                                <h4 class="card-title">Notice Board</h4>
                            </div>
                            <div class="card-body">
                                <div class="notice-widget list-group-scrl">
                                    @foreach($allNotices as $notice)
                                        @php
                                            $date = new DateTime($notice->publich_on);
                                            $publich_on = $date->format('d M Y');
                                            $now = new DateTime();
                                            $interval = $now->diff($date);
                                            $days_difference = $interval->days; // Get difference in days
                                        @endphp
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                            <div class="d-flex align-items-center overflow-hidden mr-2 mb-2 mb-sm-0">
                                                <span class="bg-primary-transparent avatar avatar-md mr-2 rounded-circle flex-shrink-0">
                                                    <i class="ti ti-books fs-16"></i>
                                                </span>
                                                <div class="overflow-hidden">
                                                    <h6 class="text-truncate mb-1">{{ $notice->notice_title }}</h6>
                                                    <p>{{ $notice->notice_message }}</p>
                                                    <p><i class="ti ti-calendar mr-2"></i>Added on: {{ $publich_on }}</p>
                                                </div>
                                            </div>
                                            <!-- <span class="badge bg-light text-dark">
                                                <i class="ti ti-clock mr-1"></i>{{ $days_difference }} Days
                                            </span> -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
              
                </div>
                @endif
                <!-- first row -->
                
                @if(auth()->user()->role_id == '1')


                    <div class="row row-equal">
                        <!-- 1st coloumn -->
                        <div class="col-lg-12 bg-red">
                            <div class="institute-overview bg-white">
                                <!-- title -->
                                <div class="admin-overview-title leave-title fees-expanse-title p-15 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center justify-center">
                                        <h3 class="m-0">@lang('common.on_leave') ({{$total_leave_today}})</h3>
                                    </div>  
                                </div>
                                <!-- title -->

                            
                                <div class="p-15">     
                                    <a href="{{route('approve-leave')}}">@lang('common.view_report')</a>
                                </div>
                            </div>        
                        </div> 
                        <!-- 1st coloumn -->   
                        <!-- 2nd -->
                        <!-- 2nd coloumn -->
                        <div class="col-lg-6 bg-red d-none">
                            <div class="institute-overview bg-white">
                                <!-- title -->
                                <div class="admin-overview-title homework-title fees-expanse-title p-15 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center justify-center">
                                        <span>
                                            <img src="public\backEnd\img\dashboard\homework.svg">
                                        </span>    
                                        <h3 class="m-0">Home Work</h3>
                                    </div>  
                                    <a href="{{route('dashboard')}}"><img src="public\backEnd\img\dashboard\load.svg"></a>  
                                </div>
                                <!-- title -->
                                <div class="homr-work-list">
                                    @foreach($all_homeworks as $hw)
                                    <div class="homework-list p-15 d-flex align-items-center justify-content-between">
                                        <div class="homework-class d-flex align-items-center justify-center">
                                            <h4 class="m-0">{{$hw['classes']->class_name}} - {{$hw['sections']->section_name}}</h4>
                                            <p class="ml-10">{{$hw->marks}} <span>/ {{$hw['subjects']->subject_name}}</span></p>
                                        </div> 
                                        <div class="d-flex align-items-center justify-center">
                                            
                                            @foreach($hw_submit as $submitted)
                                            @foreach($submitted as $submit_student)
                                             <ul class="dashboard-student-list d-inline">
                                                <li>
                                                    <img class="student-meta-img img-100" src="{{ file_exists(@$submit_student->student_photo)? asset(@$submit_student->student_photo): asset('public/uploads/staff/demo/staff.jpg') }}"
                                                alt="">
                                                </li>                                                
                                            </ul>
                                            @endforeach
                                            @endforeach
                                            <a href="{{route('homework-list')}}"><img src="public\backEnd\img\dashboard\arrow-circle-right.svg"></a>  
                                        </div>       
                                    </div> 
                                    @endforeach
                                </div>    
                            </div>
                        </div>        
                        <!-- 2nd -->
                    </div>
                    <div class="row row-equal mt-20 d-none">
                    <div class="col-lg-6 bg-red">
                        <div class="institute-overview bg-white">
                            <div class="admin-overview-title attendance-title p-15 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center justify-center">
                                    <span>
                                        <img src="public\backEnd\img\dashboard\attendance.svg">
                                    </span>    
                                    <h3 class="m-0">Class Attendance </h3>
                                </div>  
                                <a href="{{route('dashboard')}}"><img src="public\backEnd\img\dashboard\load.svg"></a>  
                            </div>
                            
                            <div class="info-details p-15">
                                <div class="row">
                                    @php
                                    $i=0;
                                    @endphp
                                    @foreach($class_attandance as $attendance)
                                    
                                        @php
                                        if(isset($class_attandance[$i]) && $class_attandance[$i]['class']!='')
                                        {
                                            $class = App\Models\StudentRecord::getStudentclass1($class_attandance[$i]['class']);

                                            @endphp
                                                @if(isset($class) && $class!='')
                                                <div class="col-lg-6">
                                                    <div class="column class-attendance std-red p-15 d-flex align-items-center justify-center">                                                    
                                                        <h4 class="m-0">{{$class->class_name}}</h4>
                                                        <p class="ml-10">{{$class_attandance[$i]['total_present']}} <span>/ {{$class_attandance[$i]['total_student']}}</span></p>
                                                    </div>
                                                </div> 
                                                @endif
                                            @php
                                        }
                                        
                                        $i++;
                                        @endphp
                                    @endforeach
                                </div>                                
                            </div>      
                        </div>    
                    </div>

                    <!-- 2nd -->
                    <div class="col-lg-6">
                        <div class="institute-overview accounts-lock">
                            <div class="admin-overview-title accounts-lock-title fees-expanse-title p-15 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center justify-center">
                                    <span>
                                        <img src="public\backEnd\img\dashboard\accounts.svg">
                                    </span>    
                                    <h3 class="m-0">Accounts</h3>
                                </div>  
                                <a href="{{route('dashboard')}}"><img src="public\backEnd\img\dashboard\load.svg"></a>  
                            </div> 
                            <div class="info-details account-info-details">
                               <div class="lock-info d-flex align-items-center justify-content-between">
                                    <div class="d-block text-center mx-auto lock-section">
                                        <img class="text-center mx-auto" src="public\backEnd\img\dashboard\lock.svg">
                                        <p>Please upgrade to advanced plan to view</p>
                                        <a href="javascript;">@lang('common.view_report')</a>
                                    </div>
                                </div>         
                            </div> 
                        </div>
                        <!-- 2nd -->
                    </div>  
                    <!-- third row -->
                @endif
                
           
            <!-- Announcement -->
            <div class="dashboard-right collapse" id="collapseExample">
                <div class="announcement-section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="announcement-title d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center justify-center announcement-title-img">
                                        <span><img src="public\backEnd\img\dashboard\announcement-img.svg"></span>
                                        <h4 class="text-white mb-0 ml-10">Announcement</h3>
                                    </div>    
                                    <a href="{{route('notice-list')}}" class="text-white">@lang('common.view_report')</a>
                                </div>
                                <div class="announcement-week-list">
                                    <div class="announcement-week mt-15">
                                        <!-- <h5>Last Week</h5> -->
                                        <!-- announcement 1st -->
                                        @foreach($allNotices as $notice)
                                        @php
                                        $date = new DateTime($notice->publich_on);
                                        $publich_on = $date->format('d M Y');
                                        $publich_on_d = $date->format('d');
                                        $publich_on_m = $date->format('M');
                                        @endphp
                                        <div class="announcement-list d-flex align-items-start justify-center mt-10">
                                            <div class="announcement-date">
                                                <p><span class="d-block">{{$publich_on_d}}</span>{{$publich_on_m}}</p>
                                            </div>
                                            <div class="announcement-content">
                                                <p class="text-white">{{$notice->notice_title}}</p>
                                                <div class="announcement-img d-flex align-items-start justify-center">
                                                    <!-- <img src="public\backEnd\img\dashboard\image1.png"> -->
                                                    <div class="announcement-info">
                                                        <h6 class="text-white">{{$notice->notice_message}}</h6>
                                                        <!-- <span class="text-white teaching-level">VI Std</span> -->
                                                    </div>    
                                                </div>    
                                                <span class="announcement-datedetails">
                                                    {{$publich_on}}
                                                </span>    
                                            </div>        
                                        </div>  
                                        @endforeach
                                        <!-- announcement 1st -->  
                                    </div>
                                          
                                </div>    
                            </div>    
                        </div>
                    </div>    
                </div>       
            </div>
            <!-- Announcement -->       
            </div>
            </div>
            @if (userPermission('to-do-list'))
            <!-- Todo -->
            <div class="modal fade admin-query" id="add_to_do">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">@lang('dashboard.add_to_do')</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                {{ Form::open([
                                    'class' => 'form-horizontal',
                                    'files' => true,
                                    'route' => 'saveToDoData',
                                    'method' => 'POST',
                                    'enctype' => 'multipart/form-data',
                                    'onsubmit' => 'return validateToDoForm()',
                                ]) }}

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row mt-25">
                                            <div class="col-lg-12" id="sibling_class_div">
                                                <div class="primary_input">
                                                    <label class="primary_input_label"
                                                        for="">@lang('dashboard.to_do_title') *<span></span>
                                                    </label>
                                                    <input class="primary_input_field form-control" type="text"
                                                        name="todo_title" id="todo_title">

                                                    <span class="modal_input_validation red_alert"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-30">
                                            <div class="col-lg-12 primary_datepicker_input" id="">
                                                <div class="no-gutters input-right-icon">
                                                    <div class="col">
                                                        <div class="primary_input">
                                                            <label class="primary_input_label"
                                                                for="">@lang('common.date') <span></span>
                                                            </label>
                                                            <input
                                                                class="primary_input_field  primary_input_field date form-control form-control"
                                                                id="startDate" type="text" autocomplete="off"
                                                                readonly="true" name="date"
                                                                value="{{ date('m/d/Y') }}">
                                                            @if ($errors->has('date'))
                                                                <span class="text-danger">
                                                                    {{ $errors->first('date') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 text-center">
                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg"
                                                    data-dismiss="modal">@lang('common.cancel')</button>
                                                <button class="primary-btn fix-gr-bg submit" type="submit"
                                                    value="@lang('admin.save')">@lang('admin.save')</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="white-box school-table mt-4">
                        @if (userPermission('to-do-list'))
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="main-title">
                                        <h3 class="mb-15">@lang('dashboard.to_do_list')</h3>
                                    </div>
                                </div>
                                <div class="col-lg-6 text-right col-md-6 col-6">
                                    <a href="#" data-toggle="modal" class="primary-btn small fix-gr-bg"
                                        data-target="#add_to_do" title="Add To Do" data-modal-size="modal-md">
                                        <i class="ti-plus pr-2"></i>
                                        @lang('common.add')
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="row to-do-list mb-20">
                            <div class="col-md-12 d-flex align-items-center justify-content-between ">
                                <button class="primary-btn small fix-gr-bg"
                                    id="toDoList">@lang('dashboard.incomplete')</button>
                                <button class="primary-btn small tr-bg"
                                    id="toDoListsCompleted">@lang('dashboard.completed')</button>
                            </div>
                        </div>
                        <input type="hidden" id="url" value="{{ url('/') }}">
                        <div class="toDoList">
                            @if (count(@$toDos->where('complete_status', 'P')) > 0)
                                @foreach ($toDos->where('complete_status', 'P') as $toDoList)
                                    <div class="single-to-do d-flex justify-content-between toDoList"
                                        id="to_do_list_div{{ @$toDoList->id }}">
                                        <div>
                                            <input type="checkbox" id="midterm{{ @$toDoList->id }}"
                                                class="common-checkbox complete_task" name="complete_task"
                                                value="{{ @$toDoList->id }}">

                                            <label for="midterm{{ @$toDoList->id }}">
                                                <input type="hidden" id="id"
                                                    value="{{ @$toDoList->id }}">
                                                <input type="hidden" id="url"
                                                    value="{{ url('/') }}">
                                                <h5 class="d-inline">{{ @$toDoList->todo_title }}</h5>
                                                <p>
                                                    {{ $toDoList->date != '' ? dateConvert(@$toDoList->date) : '' }}

                                                </p>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="single-to-do d-flex justify-content-between">
                                    @lang('dashboard.no_do_lists_assigned_yet')
                                </div>
                            @endif
                        </div>


                        <div class="toDoListsCompleted">
                            @if (count(@$toDos->where('complete_status', 'C')) > 0)
                                @foreach ($toDos->where('complete_status', 'C') as $toDoListsCompleted)
                                    <div class="single-to-do d-flex justify-content-between"
                                        id="to_do_list_div{{ @$toDoListsCompleted->id }}">
                                        <div>
                                            <h5 class="d-inline">{{ @$toDoListsCompleted->todo_title }}</h5>
                                            <p class="">

                                                {{ @$toDoListsCompleted->date != '' ? dateConvert(@$toDoListsCompleted->date) : '' }}

                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="single-to-do d-flex justify-content-between">
                                    @lang('dashboard.no_do_lists_assigned_yet')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Todo -->
            @endif
       
      
        <div class="chart_grid chart_container">

        @if (userPermission('month-income-expense'))
            <section class="" id="incomeExpenseDiv">
                <div class="container-fluid p-0">
                    <div class="white-box mt-4">
                        <div class="row justify-content-between">
                            <div class="col-lg-8 col-md-9 col-8">
                                <div class="main-title">
                                    <h3 class="mb-0"> @lang('dashboard.income_and_expenses_for') {{ date('M') }} {{ $year }} </h3>
                                </div>
                            </div>
                            <div class="col-lg-4 text-right col-md-3 col-4 nowrap">
                                <!-- <button type="button" class="primary-btn small tr-bg icon-only  dashboard_collapse"
                                    id="barChartBtn">
                                    <span class="pr ti-angle-down"></span>
                                </button>

                                <button type="button" class="primary-btn small fix-gr-bg icon-only ml-10"
                                    id="barChartBtnRemovetn">
                                    <span class="pr ti-close"></span>
                                </button> -->
                            </div>
                            <div class="col-lg-12">
                                <div id="barChartDiv" class="mt-15">
                                    <div class="row padding4 row-gap-24">
                                        <div class="col-lg-2 col-md-6 col-6">
                                            <div class="text-center">

                                                <h1>({{ generalSetting()->currency_symbol }})
                                                    {{ number_format($m_total_income) }}
                                                </h1>
                                                <p>@lang('dashboard.total_income')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>({{ generalSetting()->currency_symbol }})
                                                    {{ number_format($m_total_expense) }}</h1>
                                                <p>@lang('dashboard.total_expenses')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>({{ generalSetting()->currency_symbol }})
                                                    {{ number_format($m_total_income - $m_total_expense) }}</h1>
                                                <p>@lang('dashboard.total_profit')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>({{ generalSetting()->currency_symbol }})
                                                    {{ number_format($m_total_income) }}
                                                </h1>
                                                <p>@lang('dashboard.total_revenue')</p>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-12">
                                            <div id="commonBarChart" style="height: 350px; padding-right: 20px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif


        @if (userPermission('year-income-expense'))
            <section id="incomeExpenseSessionDiv">
                <div class="container-fluid p-0">
                    <div class="white-box mt-4">
                        <div class="row">
                            <div class="col-lg-8 col-md-9 col-8">
                                <div class="main-title">
                                    <h3 class="mb-0">@lang('dashboard.income_and_expenses_for') {{ $year }}</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 text-right col-md-3 col-4 nowrap">
                                <!-- <button type="button" class="primary-btn small tr-bg icon-only dashboard_collapse"
                                    id="areaChartBtn">
                                    <span class="pr ti-angle-down"></span>
                                </button>

                                <button type="button" class="primary-btn small fix-gr-bg icon-only ml-10"
                                    id="areaChartBtnRemovetn">
                                    <span class="pr ti-close"></span>
                                </button> -->
                            </div>
                            <div class="col-lg-12">
                                <div id="areaChartDiv" class="mt-15">
                                    <div class="row padding4 row-gap-24">
                                        <div class="col-lg-3 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>({{ generalSetting()->currency_symbol }})
                                                    {{ number_format($y_total_income) }}
                                                </h1>
                                                <p>@lang('dashboard.total_income')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-6">
                                            <div class="text-center">

                                                <h1>({{ generalSetting()->currency_symbol }})
                                                    {{ number_format($y_total_expense) }}</h1>
                                                <p>@lang('dashboard.total_expenses')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>({{ generalSetting()->currency_symbol }})
                                                    {{ number_format($y_total_income - $y_total_expense) }}</h1>
                                                <p>@lang('dashboard.total_profit')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>({{ generalSetting()->currency_symbol }})
                                                    {{ number_format($y_total_income) }}
                                                </h1>
                                                <p>@lang('dashboard.total_revenue')</p>
                                            </div>
                                        </div>
                                    

                                        <div class="col-lg-12">
                                            <div id="commonAreaChart" style="height: 350px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>    
    </div>
    </section>
@endsection
@include('backEnd.partials.date_picker_css_js')
@include('backEnd.communicate.academic_calendar_css_js')
@section('script')
    <script type="text/javascript" src="{{ asset('public/backEnd/') }}/vendors/js/fullcalendar.min.js"></script>
    <script src="{{ asset('public/backEnd/vendors/js/fullcalendar-locale-all.js') }}"></script>

    <script type="text/javascript">
        function barChart(idName) {
            window.barChart = Morris.Bar({
                element: 'commonBarChart',
                data: [<?php echo $chart_data; ?>],
                xkey: 'day',
                ykeys: ['income', 'expense'],
                labels: [jsLang('income'), jsLang('expense')],
                barColors: ['#8a33f8', '#f25278'],
                resize: true,
                redraw: true,
                gridTextColor: 'var(--base_color)',
                gridTextSize: 12,
                gridTextFamily: '"Poppins", sans-serif',
                barGap: 4,
                barSizeRatio: 0.3
            });
        }

        const monthNames = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];

        function areaChart() {
            window.areaChart = Morris.Area({
                element: 'commonAreaChart',
                data: [<?php echo $chart_data_yearly; ?>],
                xkey: 'y',
                parseTime: false,
                ykeys: ['income', 'expense'],
                labels: [jsLang('income'), jsLang('expense')],
                xLabelFormat: function(x) {
                    var index = parseInt(x.src.y);
                    return monthNames[index];
                },
                xLabels: "month",
                labels: [jsLang('income'), jsLang('expense')],
                hideHover: 'auto',
                lineColors: ['rgba(124, 50, 255, 0.5)', 'rgba(242, 82, 120, 0.5)'],
            });
        }
    </script>

    <script type="text/javascript">
        if ($('.common-calendar').length) {
            $('.common-calendar').fullCalendar({
                locale: _locale,
                rtl: _rtl,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                eventClick: function(event, jsEvent, view) {
                    console.log(event);
                    $('#modalTitle').html(event.title);
                    let url = event.url;
                    let description = event.description;
                    if (!url) {
                        $('#image').addClass('d-none');
                    }
                    if (url.includes('lead')) {
                        $('#image').addClass('d-none');
                        $('#modalBody').html(event.description);
                    } else {
                        $('#image').attr('src', event.url);
                    }
                    $('#fullCalModal').modal();
                    return false;
                },
                height: 650,
                events: <?php echo json_encode($calendar_events); ?>,
            });
        }
    </script>
@endsection
