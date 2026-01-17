@extends('backEnd.master')
@section('title')
    @lang('student.extra_curricular_student')
@endsection
@push('css')
    <style>
        .student_rec_card {
            border-radius: 6px;
            border: 1px solid var(--border_color);
            width: 100%;
        }

        .student_rec_header {
            padding: 12px;
            background: -webkit-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
            background: -moz-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
            background: -o-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
            background: -ms-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
            background: linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_3) 51%, var(--gradient_2) 100%);
        }

        .student_rec_footer {
            padding: 12px;
            margin-top: 16px;
            border-top: 1px solid var(--border_color);
        }

        .student_rec_content {
            padding: 16px;
            max-height: 300px;
            min-height: 300px;
        }

        .primary-btn.icon-only {
            padding: 1px 8px !important;
            right: 15px !important;
            bottom: 13px !important;
        }

        .common-checkbox~label {
            bottom: 13px;
        }
    </style>
@endpush
@section('mainContent')
    <input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">
    <section class="sms-breadcrumb mb-20 up_breadcrumb white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('student.extra_curricular_student')</h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="{{ route('submenu-list',['sub_menu' =>'student_info']) }}">@lang('student.student_information')</a>
                    <a href="#">@lang('student.extra_curricular_student')</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="main-title xs_mt_0 mt_0_sm">
                        <h3 class="mb-20">@lang('common.select_criteria')</h3>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student.assign-extra-curricular', 'method' => 'GET', 'enctype' => 'multipart/form-data', 'id' => 'infix_form', 'onsubmit' => "return validateAddExtraactivities()"]) }}
                    <div class="white-box">
                        <div class="row">
                            @if (moduleStatusCheck('University'))
                                @includeIf(
                                    'university::common.session_faculty_depart_academic_semester_level',
                                    ['mt' => 'mt-30', 'hide' => ['USUB'], 'required' => ['USEC']]
                                )
                                <div class="col-lg-3 mt-25">
                                    <div class="primary_input ">
                                        <input class="primary_input_field" type="text" name="name"
                                            value="{{ isset($name) ? $name : '' }}">
                                        <label class="primary_input_label" for="">@lang('student.search_by_name')</label>
                                    </div>
                                </div>
                                <div class="col-lg-3 mt-25">
                                    <div class="primary_input md_mb_20">
                                        <input class="primary_input_field" type="text" name="roll_no"
                                            value="{{ isset($roll_no) ? $roll_no : '' }}">
                                        <label class="primary_input_label" for="">@lang('student.search_by_roll_no')</label>
                                    </div>
                                </div>
                            @else
                                @include('backEnd.common.search_criteria', [
                                    'div' => 'col-lg-3',
                                    'visiable' => ['academic', 'class', 'section', 'student'],
                                ])
                            @endif
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg" id="btnsubmit" >
                                    <span class="ti ti-search pr-2"></span>
                                    @lang('common.search')
                                </button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

            @if (@$students)
                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="white-box p-3">
                            <div class="row">
                                @foreach ($students as $student)
                                    <div class="col-xl-6 col-12 mb-20 d-flex">
                                        {!! Form::open([
                                            'route' => 'extra-curricular-record-store',
                                            'method' => 'POST',
                                            'class' => 'w-100 d-flex',
                                            'id' => 'form_' . $student->id,
                                        ]) !!}

                                        <div class="student_rec_card">
                                            <div
                                                class="student_rec_header d-flex align-items-center justify-content-between mb-3">
                                                <h5 class="mb-0 text-white">{{ $student->full_name }}
                                                    {{ $student->admission_no ? '(' . $student->admission_no . ')' : '' }}</h5>
                                            </div>
                                            <input type="hidden" id="student_id" name="student_id"
                                                value="{{ $student->id }}">
                                            <input type="hidden" id="std_class_id" name="std_class_id"
                                                value="{{$selected['class_id']}}">
                                            
                                            <div class="student_rec_content" id="student_rec_content_{{ $student->id }}">


<div class="col-lg-12">
    <label class="primary_input_label" for="">@lang('student.extra_class')<span class="text-danger">
    *</span></label><br>
    @foreach ($extraclasses as $extraclass)
            <div class="">
            <input type="checkbox" id="extraclass_{{ @$extraclass->id }}"
                    value="{{ @$extraclass->id }}" name="extraclass_id[]"
                    {{ isset($extra_class_ids) ? (in_array($extraclass->id, $extra_class_ids) ? 'checked' : '') : '' }}
                    >
                <label for="extraclass_{{ @$extraclass->id }}">{{ @$extraclass->class_name }}</label>
            </div>
    @endforeach
    @if ($errors->has('section'))
        <span class="text-danger">
            {{ $errors->first('section') }}
        </span>
    @endif
</div>


                                                <div id="appendDiv_{{ $student->id }}">

                                                </div>

                                            </div>
                                            <div
                                                class="student_rec_footer d-flex align-items-center justify-content-center">
                                                <button class="primary-btn small fix-gr-bg updateStudentRecord"
                                                    type="submit" data-student_id="{{ $student->id }}"
                                                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> Updating...">
                                                    <i class="ti-check"></i> {{ __('common.update') }}</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    </section>

@endsection
@push('script')
