@extends('backEnd.master')

@section('title')
@lang('student.my_profile')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/css/fullcalendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/calender_js/core/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/calender_js/daygrid/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/calender_js/timegrid/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/calender_js/list/main.css') }}" />
@endpush
@section('mainContent')
@php  @$setting = generalSetting(); if(!empty(@$setting->currency_symbol)){ @$currency = @$setting->currency_symbol; }else{ @$currency = '$'; }   @endphp 
<section class="student-details">
    <div class="container-fluid">
        <div class="row"> 
            <div class="col-lg-12">
                <!-- Start Student Meta Information -->
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
                                    <h1 class="text-white mr-2">Welcome Back {{@$student_detail->full_name}}</h1>
                                    <!-- <a href="profile.html" class="avatar avatar-sm img-rounded bg-gray-800 dark-hover"><i class="ti ti-edit text-white"></i></a> -->
                                </div>
                                <p class="text-white">Have a Good day</p>
                            </div>
                            <p class="text-white d-none"><i class="ti ti-refresh mr-1"></i>Updated Recently on 15 Jun
                                2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(userPermission("dashboard-subject"))
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('student_subject') }}" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>@lang('common.subject')</h3>
                                    <p class="mb-0">@lang('student.total_subject')</p>
                                </div>
                                <h1 class="gradient-color2">

                                    @if(isset($totalSubjects))
                                        {{count(@$totalSubjects)}}
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if(userPermission("dashboard-notice"))
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('student_noticeboard') }}" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>@lang('student.notice')</h3>
                                    <p class="mb-0">@lang('student.total_notice')</p>
                                </div>
                                <h1 class="gradient-color2">
                                    @if(isset($totalNotices))
                                        {{count(@$totalNotices)}}
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if(userPermission("dashboard-exam"))
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('student_exam_schedule') }}" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>@lang('student.exam')</h3>
                                    <p class="mb-0">@lang('student.total_exam')</p>
                                </div>
                                <h1 class="gradient-color2">
                                    @if(isset($exams))
                                        {{count(@$exams)}}
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if(userPermission("dashboard-online-exam"))
                <div class="col-lg-3 col-md-6">
                    @if(moduleStatusCheck('OnlineExam'))
                        <a href="{{ route('om_student_online_exam') }}" class="d-block">
                    @else
                        <a href="{{ route('student_online_exam') }}" class="d-block">
                    @endif
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>@lang('student.online_exam')</h3>
                                        <p class="mb-0">@lang('student.total_online_exam')</p>
                                    </div>
                                    <h1 class="gradient-color2">
                                        @if(isset($online_exams))
                                            {{count(@$online_exams)}}
                                        @endif
                                    </h1>
                                </div>
                            </div>
                        </a>
                </div>
            @endif
            @if(userPermission("dashboard-teachers"))
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('student_teacher') }}" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>@lang('student.teachers')</h3>
                                    <p class="mb-0">@lang('student.total_teachers')</p>
                                </div>
                                <h1 class="gradient-color2"> @if(isset($teachers))
                                        {{count(@$teachers)}}
                                    @endif</h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if(userPermission("dashboard-issued-books"))
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('student_book_issue') }}" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>@lang('student.issued_book')</h3>
                                    <p class="mb-0">@lang('student.total_issued_book')</p>
                                </div>
                                <h1 class="gradient-color2">
                                    @if(isset($issueBooks))
                                        {{count(@$issueBooks)}}
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if(userPermission("dashboard-pending-homeworks"))
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('student_homework') }}" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>@lang('student.pending_home_work')</h3>
                                    <p class="mb-0">@lang('student.total_pending_home_work')</p>
                                </div>
                                <h1 class="gradient-color2">
                                    @if(isset($homeworkLists))
                                        {{count(@$homeworkLists)}}
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if(userPermission("dashboard-attendance-in-current-month"))
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('student_my_attendance') }}" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>@lang('student.attendance_in_current_month')</h3>
                                    <p class="mb-0">@lang('student.total_attendance_in_current_month')</p>
                                </div>
                                <h1 class="gradient-color2">
                                    @if(isset($attendances))
                                        {{count(@$attendances)}}
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
        <div class="row">
            @include('backEnd.studentPanel._class_routine_content', ['sm_weekends' => $sm_weekends, 'records' => $records, 'routineDashboard' => $routineDashboard])
        </div>
        <div class="row mt-20">
            <div class="col-lg-12 col-md-12 mt-20">
                <div class="main-title">
                    <h3 class="mb-30">@lang('exam.exam_routine')</h3>
                </div>
            </div>
            <div class="col-lg-12 student-details up_admin_visitor">
                <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                    @php
                        $exams = [];
                    @endphp
                    @foreach($records as $record)
                        @if($record->Exam)
                            @foreach($record->Exam as $key => $exam)
                                @php
                                    $s = $exam->exam_type_id.$exam->class_id.$exam->section_id;
                                @endphp
                                @if(!in_array($s, $exams))
                                    @php
                                        array_push($exams, $s);
                                    @endphp
                                    <li class="nav-item">
                                        <a class="nav-link @if ($key == 0) active @endif" href="#tabExam{{ $key }}" role="tab"
                                            data-toggle="tab">{{$exam->examType->title}}
                                            - {{$record->class->class_name}}
                                            ({{$record->section->section_name}})</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($records as $key => $record)
                        @if($record->Exam)
                            @foreach($record->Exam as $key => $exam)
                                @php
                                    $exam_routines = App\SmExamSchedule::getAllExams($exam->class_id, $exam->section_id, $exam->exam_type_id);
                                @endphp
                                <div role="tabpanel" class="tab-pane fade  @if ($key == 0) active show @endif" id="tabExam{{ $key }}">
                                    <div class="container-fluid">
                                        <div class="col-lg-12">
                                            <x-table>
                                                <table id="default_table" class="table" cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th style="width:10%;">
                                                            @lang('exam.date_&_day')
                                                        </th>
                                                        <th>@lang('exam.subject')</th>
                                                        <th>@lang('common.class_Sec')</th>
                                                        <th>@lang('exam.teacher')</th>
                                                        <th>@lang('exam.time')</th>
                                                        <th>@lang('exam.duration')</th>
                                                        <th>@lang('exam.room')</th>
                    
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($exam_routines as $date => $exam_routine)
                                                        <tr class="{{Carbon::parse($exam_routine->date)->format('Y-m-d') == Carbon::now()->format('Y-m-d') ? 'main-border-color' : '' }}">
                                                            <td>{{ dateConvert($exam_routine->date) }}
                                                                <br>{{ Carbon::createFromFormat('Y-m-d', $exam_routine->date)->format('l') }}
                                                            </td>
                                                            <td>
                                                                <strong> {{ $exam_routine->subject ? $exam_routine->subject->subject_name :'' }} </strong> {{ $exam_routine->subject ? '('.$exam_routine->subject->subject_code .')':'' }}
                                                            </td>
                                                            <td>{{ $exam_routine->class ? $exam_routine->class->class_name :'' }} {{ $exam_routine->section ? '('. $exam_routine->section->section_name .')':'' }}</td>
                                                            <td>{{ $exam_routine->teacher ? $exam_routine->teacher->full_name :'' }}</td>
                    
                                                            <td> {{ date('h:i A', strtotime(@$exam_routine->start_time))  }}
                                                                - {{ date('h:i A', strtotime(@$exam_routine->end_time))  }} </td>
                                                            <td>
                                                                @php
                                                                    $duration=strtotime($exam_routine->end_time)-strtotime($exam_routine->start_time);
                                                                @endphp
                    
                                                                {{ timeCalculation($duration)}}
                                                            </td>
                    
                                                            <td>{{ $exam_routine->classRoom ? $exam_routine->classRoom->room_no :''  }}</td>
                    
                                                        </tr>
                                                    @endforeach
                    
                                                    </tbody>
                                                </table>
                                            </x-table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
           @if(userPermission("dashboard-calendar"))
                <section class="mt-20">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">@lang('student.calendar')</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <div class='common-calendar'>
                                </div>
                            </div>
                        </div>
                    </div>                            
                </section>
            @endif
    </div> 
</div>
</section>

<br>
<!-- Bar Chart - Start -->
<section class="" id="incomeExpenseDiv">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-9 col-8">
                        <div class="main-title">
                            <h3 class="mb-30"> &nbsp;&nbsp; Chart Comparison of Previous exam with Current Exam  </h3>
                        </div>

                        
                    </div>
                    <div class="offset-lg-2 col-lg-2 text-right col-md-3 col-4">
                        <button type="button" class="primary-btn small tr-bg icon-only" id="barChartBtn">
                            <span class="pr ti-move"></span>
                        </button>

                        <button type="button" class="primary-btn small fix-gr-bg icon-only ml-10" id="barChartBtnRemovetn">
                            <span class="pr ti-close"></span>
                        </button>
                    </div>
                    @if($chart_data!='')
                    <div class="col-lg-12">
                        <div class="white-box" id="barChartDiv">
                            <div class="row">
                                
                                <div class="col-lg-12">
                                    <div id="commonBarChart" style="height: 350px; padding-right: 20px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-12">
                        <div class="white-box" id="barChartDiv">
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                <p>@lang('student.no_record_found')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
<!-- Bar Chart - End -->

<div id="fullCalModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body text-center">
                    <img src="" alt="There are no image" id="image" height="150" width="auto">
                    <div id="modalBody"></div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    
<?php

$count_event =0;
@$calendar_events = array();

foreach($holidays as $k => $holiday) {

    @$calendar_events[$k]['title'] = $holiday->holiday_title;
    
    $calendar_events[$k]['start'] = $holiday->from_date;
    
    $calendar_events[$k]['end'] = Carbon::parse($holiday->to_date)->addDays(1)->format('Y-m-d');

    $calendar_events[$k]['description'] = $holiday->details;

    $calendar_events[$k]['url'] = $holiday->upload_image_file;

    $count_event = $k;
    $count_event++;
}



foreach($events as $k => $event) {
    @$calendar_events[$count_event]['title'] = $event->event_title;
    
    $calendar_events[$count_event]['start'] = $event->from_date;
    
    $calendar_events[$count_event]['end'] = Carbon::parse($event->to_date)->addDays(1)->format('Y-m-d');
    $calendar_events[$count_event]['description'] = $event->event_des;
    $calendar_events[$count_event]['url'] = $event->uplad_image_file;
    $count_event++;
}





?>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('public/backEnd/') }}/vendors/js/fullcalendar.min.js"></script>
<script src="{{ asset('public/backEnd/vendors/js/fullcalendar-locale-all.js') }}"></script>

<script type="text/javascript">
    /*-------------------------------------------------------------------------------
       Full Calendar Js 
    -------------------------------------------------------------------------------*/
    if ($('.common-calendar').length) {
        $('.common-calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventClick:  function(event, jsEvent, view) {
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#image').attr('src',event.url);
                    $('#fullCalModal').modal();
                    return false;
                },
            height: 650,
            events: <?php echo json_encode($calendar_events);?> ,
        });
    }

    $(document).ready(function () {
        barChart();
    })

    // var data = [
    //       { y: 'Tamil', a: 50,  b: 90},
    //       { y: 'English', a: 65,  b: 75},
    //       { y: 'Maths', a: 50,  b: 50},
    //     ];

    var data = [
          // { y: 'Tamil', a: 50,  b: 90},
          <?php echo $chart_data; ?>
        ];

        function barChart(idName) {
            window.barChart = Morris.Bar({
                element: 'commonBarChart',
                data: data,
                  xkey: 'y',
                  ykeys: ['a', 'b'],
                  labels: ['Prev Exam', 'Current Exam'],
                  fillOpacity: 0.6,
                  hideHover: 'auto',
                  behaveLikeLine: true,
                  resize: true,
                  pointFillColors:['#ffffff'],
                  pointStrokeColors: ['black'],
                  lineColors:['gray','red']
            });
        }


</script>

@endsection
