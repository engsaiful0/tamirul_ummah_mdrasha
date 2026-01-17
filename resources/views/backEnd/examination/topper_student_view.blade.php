@extends('backEnd.master')
@section('title')
@lang('student.topper_student')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-20 white-box">
    <div class="container-fluid">
    <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
            <h1>@lang('student.topper_student_marks_each_subjects')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('exam.examination')</a>
                <a href="#">@lang('student.topper_student')</a>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('common.select_criteria') </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'topper-student', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                           
                            <div class="col-lg-3 mt-30-md infix_up_mt">
                                <select class="primary_select  form-control{{ $errors->has('class_error') ? ' is-invalid' : '' }}" id="select_class" name="class_id">
                                    <option data-display="@lang('common.select_class')" value="">@lang('common.select_class')*</option>
                                    @if(isset($classes) && $classes!='')
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}" >{{$class->class_name}}</option>
                                    @endforeach
                                    @endif
                                </select>

                                <span class="text-danger"  id="class_error"></span>
                                @if ($errors->has('class_error'))
                                    <span class="text-danger invalid-select" role="alert">
                                        {{ $errors->first('class_error') }}
                                    </span>
                                @endif
                            </div>
                            
                            

                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti ti-search pr-2"></span>
                                    @lang('common.search')
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
            
        @if(isset($assignSubjects))
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'enctype' => 'multipart/form-data'])}}
                <div class="row mt-40">
                    <div class="col-lg-12">
                       
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <x-table>
                                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                            <thead>
                                                <th>Subjects</th>
                                                <th colspan="{{ count($assignSubjects) }}">Students</th>
                                            </thead>
                                            <tbody >
                                                @forelse($assignSubjects as $subject)
                                                    <tr style="border: 1px solid grey">
                                                        
                                                        @php
                                                            $max_marks_subjects = App\SmExamMarksRegister::maxMarks($subject->subject_id, $subject->class_id, $current_exam);
                                                            $getTopperStudentRecords = App\SmExamMarksRegister::getTopStudent($max_marks_subjects, $subject->subject_id, $subject->class_id, $current_exam);

                                                            $getTotalMarks = App\SmExamMarksRegister::getTotalMarks($subject->subject_id, $subject->class_id, $current_exam);
                                                            
                                                        @endphp

                                                        <td style="border: 1px solid grey">{{$subject->subject_name}} 

                                                            @if(!empty($getTotalMarks))
                                                                ({{$getTotalMarks}})
                                                            @endif
                                                        </td>

                                                        
                                                        @if(count($getTopperStudentRecords) > 0)
                                                            <td style="border: 1px solid grey">
                                                                @foreach($getTopperStudentRecords as $index => $topper)
                                                                        @if($topper->full_name)
                                                                            {{$topper->full_name}} ({{$max_marks_subjects}})
                                                                            @if($index < count($getTopperStudentRecords) - 1)<br> @endif
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    
                                                                @endforeach
                                                            </td>
                                                        @else
                                                            <td style="border: 1px solid grey" >-</td>
                                                        @endif
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="{{ count($assignSubjects) }}" >No subjects available</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                    </x-table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        @endif
    </div>
</section>
@endsection
@include('backEnd.partials.data_table_js')
