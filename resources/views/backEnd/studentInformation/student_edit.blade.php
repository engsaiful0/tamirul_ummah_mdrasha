@extends('backEnd.master')
@section('title')
    @lang('student.student_edit')
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backEnd/') }}/css/croppie.css">
@endsection
@push('css')
    <style>
        .ti-calendar:before {
            position: relative !important;
            top: -8px !important;
        }
    </style>
@endpush
@section('mainContent')

    <section class="sms-breadcrumb up_breadcrumb mb-40 white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('student.student_edit')</h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="{{ route('student_list') }}">@lang('common.student_list')</a>
                    <a href="#">@lang('student.student_edit')</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid">
            <div class="row mb-30">
                <div class="col-lg-6">
                    <div class="main-title">
                        <h3>@lang('student.student_edit')</h3>
                    </div>
                </div>
            </div>
            {{ Form::open([
                'class' => 'form-horizontal',
                'files' => true,
                'route' => 'student_update',
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
                'id' => 'student_form',
            ]) }}
            <div class="row">
                <div class="col-lg-12">

                    <div class="white-box">
                        <div class="">
                            <div class="row mb-4">
                                <div class="col-lg-12 text-center">

                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            @if ($error == 'The email address has already been taken.')
                                                <div class="error text-danger ">
                                                    {{ 'The email address has already been taken, You can find out in student list or disabled student list' }}
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div class="error text-danger ">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">@lang('student.personal_info')</h4>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">
                            <input type="hidden" name="id" id="id" value="{{ $student->id }}">

                            @php
                                // Get student's current academic year, class, and section
                                $studentRecord = $student->defaultClass;
                                $current_academic_id = $studentRecord ? $studentRecord->academic_id : ($student->academic_id ?? getAcademicId());
                                $current_class_id = $studentRecord ? $studentRecord->class_id : ($student->class_id ?? null);
                                $current_section_id = $studentRecord ? $studentRecord->section_id : ($student->section_id ?? null);
                                
                                // Get classes for current academic year
                                $edit_classes = DB::table('sm_classes')
                                    ->where('academic_id', '=', $current_academic_id)
                                    ->where('school_id', auth()->user()->school_id)
                                    ->get();
                                
                                // Get sections for current class
                                $edit_sections = [];
                                if ($current_class_id) {
                                    $edit_sections = DB::table('sm_class_sections')
                                        ->where('class_id', '=', $current_class_id)
                                        ->join('sm_sections', 'sm_class_sections.section_id', '=', 'sm_sections.id')
                                        ->where('sm_sections.school_id', auth()->user()->school_id)
                                        ->select('sm_sections.id', 'sm_sections.section_name')
                                        ->get();
                                }
                            @endphp

                            <div class="row mb-20">
                                <div class="col-lg-3">
                                    <div class="primary_input">
                                        <label class="primary_input_label" for="">@lang('common.academic_year') <span class="text-danger"> *</span></label>
                                        <select class="primary_select session" name="session" id="edit_academic_year">
                                            <option data-display="@lang('common.academic_year') *" value="">@lang('common.academic_year') *</option>
                                            @foreach ($sessions as $session)
                                                <option value="{{ $session->id }}" {{ $current_academic_id == $session->id ? 'selected' : '' }}>
                                                    {{ $session->year }}[{{ $session->title }}]</option>
                                            @endforeach
                                        </select>
                                        <span class="error text-danger d-none help-block"></span>
                                        @if ($errors->has('session'))
                                            <span class="text-danger">
                                                {{ $errors->first('session') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="primary_input" id="edit_class-div">
                                        <label class="primary_input_label" for="">@lang('common.class') <span class="text-danger"> *</span></label>
                                        <select class="primary_select class form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" id="edit_classSelectStudent">
                                            <option data-display="@lang('common.class') *" value="">@lang('common.class') *</option>
                                            @foreach ($edit_classes as $class)
                                                <option value="{{ $class->id }}" {{ $current_class_id == $class->id ? 'selected' : '' }}>
                                                    {{ $class->class_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="pull-right loader loader_style" id="edit_select_class_loader" style="display: none;">
                                            <img class="loader_img_style" src="{{ asset('public/backEnd/img/demo_wait.gif') }}" alt="loader">
                                        </div>
                                        <span class="error text-danger d-none help-block"></span>
                                        @if ($errors->has('class'))
                                            <span class="text-danger">
                                                {{ $errors->first('class') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="primary_input" id="edit_sectionStudentDiv">
                                        <label class="primary_input_label" for="">@lang('common.section') <span class="text-danger"> *</span></label>
                                        <select class="primary_select section form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" name="section" id="edit_sectionSelectStudent">
                                            <option data-display="@lang('common.section') *" value="">@lang('common.section') *</option>
                                            @foreach ($edit_sections as $section)
                                                <option value="{{ $section->id }}" {{ $current_section_id == $section->id ? 'selected' : '' }}>
                                                    {{ $section->section_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="pull-right loader loader_style" id="edit_select_section_loader" style="display: none;">
                                            <img class="loader_img_style" src="{{ asset('public/backEnd/img/demo_wait.gif') }}" alt="loader">
                                        </div>
                                        <span class="error text-danger d-none help-block"></span>
                                        @if ($errors->has('section'))
                                            <span class="text-danger">
                                                {{ $errors->first('section') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-20">
                                @if (is_show('admission_number'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.admission_number') @if (is_required('admission_number') == true)
                                                    *
                                                @endif
                                            </label>
                                            <input
                                                    class="primary_input_field form-control{{ $errors->has('admission_number') ? ' is-invalid' : '' }}"
                                                    type="text" name="admission_number" value="{{ $student->admission_no }}"
                                                    onkeyup="GetAdminUpdate(this.value,{{ $student->id }})">


                                            <span class="text-danger" id="Admission_Number" role="alert"></span>
                                            @if ($errors->has('admission_number'))
                                                <span class="text-danger">
                                                    {{ $errors->first('admission_number') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (generalSetting()->multiple_roll == 0)
                                    @if (is_show('roll_number'))
                                        <div class="col-lg-3">
                                            <div class="primary_input">
                                                <label>{{ moduleStatusCheck('Lead') ? __('student.id_number') : __('student.roll') }}
                                                    @if (is_required('roll_number') == true)
                                                        <span class="text-danger"> *</span>
                                                    @endif
                                                </label>
                                                <input class="primary_input_field read-only-input" type="text"
                                                    name="roll_number" value="{{ $student->getRawOriginal('roll_no') }}"
                                                    id="roll_number">


                                            </div>
                                        </div>
                                    @endif

                                @endif
                                @if (is_show('first_name'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.first_name') @if (is_required('first_name') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <input
                                                    class="primary_input_field form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                    type="text" name="first_name" value="{{ $student->first_name }}">


                                            @if ($errors->has('first_name'))
                                                <span class="text-danger">
                                                    {{ $errors->first('first_name') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('last_name'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.last_name')@if (is_required('last_name') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <input
                                                    class="primary_input_field form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                    type="text" name="last_name" value="{{ $student->last_name }}">


                                            @if ($errors->has('last_name'))
                                                <span class="text-danger">
                                                    {{ $errors->first('last_name') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif                                
                            </div>
                            <div class="row mb-20">
                                @if (is_show('gender'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('common.gender')
                                                @if (is_required('last_name') == true)
                                                    <span class="text-danger">
                                                        @if (is_required('gender') == true)
                                                            *
                                                        @endif
                                                    </span>
                                                @endif
                                            </label>
                                            <select
                                                    class="primary_select  form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                                    name="gender">
                                                <option
                                                        data-display="@lang('common.gender') @if (is_required('gender') == true) * @endif"
                                                        value="">@lang('common.gender') @if (is_required('gender') == true)
                                                        <span class="text-danger"> *</span>
                                                    @endif
                                                </option>
                                                @foreach ($genders as $gender)
                                                    @if (isset($student->gender_id))
                                                        <option value="{{ $gender->id }}"
                                                                {{ $student->gender_id == $gender->id ? 'selected' : '' }}>
                                                            {{ $gender->base_setup_name }}</option>
                                                    @else
                                                        <option value="{{ $gender->id }}">{{ $gender->base_setup_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has('gender'))
                                                <span class="text-danger">
                                                    {{ $errors->first('gender') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('date_of_birth'))
                                    <div class="col-lg-3">

                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label"
                                                   for="date_of_birth">{{ __('common.date_of_birth') }} <span
                                                        class="text-danger">*</span></label>
                                            <div class="primary_datepicker_input">
                                                <div class="no-gutters input-right-icon">
                                                    <div class="col">
                                                        <div class="">
                                                            <input
                                                                    class="primary_input_field  primary_input_field student_dob form-control"
                                                                    id="date_of_birth" type="text" name="date_of_birth"
                                                                    value="{{ date('m/d/Y', strtotime($student->date_of_birth)) }}"
                                                                    autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <button class="btn-date" data-id="#date_of_birth" type="button">
                                                        <label class="m-0 p-0" for="date_of_birth">
                                                            <i class="ti-calendar" id="date_of_birth"></i>
                                                        </label>
                                                    </button>
                                                </div>
                                            </div>
                                            <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('blood_group'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('common.blood_group')
                                                @if (is_required('blood_group') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <select
                                                    class="primary_select  form-control{{ $errors->has('blood_group') ? ' is-invalid' : '' }}"
                                                    name="blood_group">
                                                <option
                                                        data-display="@lang('student.blood_group') @if (is_required('blood_group') == true) * @endif"
                                                        value="">@lang('student.blood_group') @if (is_required('blood_group') == true)
                                                        <span class="text-danger"> *</span>
                                                    @endif
                                                </option>
                                                @foreach ($blood_groups as $blood_group)
                                                    @if (isset($student->bloodgroup_id))
                                                        <option value="{{ $blood_group->id }}"
                                                                {{ $blood_group->id == $student->bloodgroup_id ? 'selected' : '' }}>
                                                            {{ $blood_group->base_setup_name }}</option>
                                                    @else
                                                        <option value="{{ $blood_group->id }}">
                                                            {{ $blood_group->base_setup_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has('blood_group'))
                                                <span class="text-danger">
                                                    {{ $errors->first('blood_group') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('religion'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.religion')
                                                @if (is_required('religion') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <select class="primary_select" name="religion">
                                                <option
                                                        data-display="@lang('student.religion') @if (is_required('religion') == true) * @endif"
                                                        value="">@lang('student.religion') @if (is_required('religion') == true)
                                                        <span class="text-danger"> *</span>
                                                    @endif
                                                </option>
                                                @foreach ($religions as $religion)
                                                    <option value="{{ $religion->id }}"
                                                            {{ $student->religion_id != '' ? ($student->religion_id == $religion->id ? 'selected' : '') : '' }}>
                                                        {{ $religion->base_setup_name }}</option>
                                                    }
                                                @endforeach

                                            </select>

                                            @if ($errors->has('religion'))
                                                <span class="text-danger">
                                                    {{ $errors->first('religion') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif                                
                            </div>
                            <div class="row mb-20">
                                @if (is_show('caste'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.caste')
                                                @if (is_required('caste') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <input class="primary_input_field" type="text" name="caste"
                                                   value="{{ $student->caste }}">

                                        </div>
                                    </div>
                                @endif
                                @if (is_show('email_address'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('common.email_address')
                                                @if (is_required('email_address') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <input oninput="emailCheck(this)"
                                                   class="primary_input_field form-control{{ $errors->has('email_address') ? ' is-invalid' : '' }}"
                                                   type="text" name="email_address" value="{{ $student->email }}">


                                            @if ($errors->has('email_address'))
                                                <span class="text-danger">
                                                    {{ $errors->first('email_address') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('phone_number'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('common.phone_number')
                                                @if (is_required('phone_number') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <input oninput="phoneCheck(this)"
                                                   class="primary_input_field form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                                   type="text" name="phone_number" value="{{ $student->mobile }}">


                                            @if ($errors->has('phone_number'))
                                                <span class="text-danger">
                                                    {{ $errors->first('phone_number') }}
                                                </span>
                                            @endif
                                        </div>
                                        <code>@lang('admin.add_prefix_before_phone')</code>
                                    </div>
                                @endif
                                @if (is_show('admission_date'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.admission_date')
                                                @if (is_required('admission_date') == true)
                                                    <span class="text-danger"> *</span>
                                                    @endif
                                                    </span>
                                            </label>
                                            <div class="primary_datepicker_input">
                                                <div class="no-gutters input-right-icon">
                                                    <div class="col">
                                                        <div class="">
                                                            <input
                                                                    class="primary_input_field  primary_input_field admission_date form-control"
                                                                    id="admission_date" type="text" name="admission_date"
                                                                    value="{{ $student->admission_date != '' ? date('m/d/Y', strtotime($student->admission_date)) : date('m/d/Y') }}"
                                                                    autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <button class="btn-date" data-id="#admission_date" type="button">
                                                        <label class="m-0 p-0" for="admission_date">
                                                            <i class="ti-calendar" id="admission_date"></i>
                                                        </label>
                                                    </button>
                                                </div>
                                            </div>
                                            <span class="text-danger">{{ $errors->first('admission_date') }}</span>
                                        </div>
                                    </div>
                                @endif
                                @if (moduleStatusCheck('Lead') == true)
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <select
                                                    class="primary_select  form-control{{ $errors->has('route') ? ' is-invalid' : '' }}"
                                                    name="source_id" id="source_id">
                                                <option
                                                        data-display="@lang('lead::lead.source') @if (is_required('source_id') == true) * @endif"
                                                        value="">@lang('lead::lead.source') @if (is_required('source_id') == true)
                                                        <span class="text-danger"> *</span>
                                                    @endif
                                                </option>
                                                @foreach ($sources as $source)
                                                    <option value="{{ $source->id }}"
                                                            {{ $student->source_id == $source->id ? 'selected' : '' }}>
                                                        {{ $source->source_name }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('source_id'))
                                                <span class="text-danger invalid-select" role="alert">
                                                    {{ $errors->first('source_id') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-20">
                                @if (is_show('student_category_id'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for="">@lang('student.category')
                                                    @if (is_required('student_category_id') == true)
                                                        <span class="text-danger"> *</span>
                                                    @endif
                                                </label>
                                                <select
                                                        class="primary_select  form-control{{ $errors->has('student_category_id') ? ' is-invalid' : '' }}"
                                                        name="student_category_id">
                                                    <option
                                                            data-display="@lang('student.category') @if (is_required('student_category_id') == true) * @endif"
                                                            value="">@lang('student.category') @if (is_required('student_category_id') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </option>
                                                    @foreach ($categories as $category)
                                                        @if (isset($student->student_category_id))
                                                            <option value="{{ $category->id }}"
                                                                    {{ $student->student_category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->category_name }}</option>
                                                        @else
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->category_name }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>

                                                @if ($errors->has('student_category_id'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('student_category_id') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-3">
                                    <div class="primary_input ">
                                        <label class="primary_input_label" for="">@lang('student.mother_tongue')
                                            @if (is_required('mother_tongue') == true)
                                                <span class="text-danger"> *</span>
                                            @endif
                                        </label>
                                        <input class="primary_input_field mother_tongue" id="mother_tongue" type="text" name="mother_tongue"
                                            value="{{ $student->mother_tongue }}">
                                        @if ($errors->has('mother_tongue'))
                                            <span class="text-danger">
                                                {{ $errors->first('mother_tongue') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if (is_show('photo'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                        <label class="primary_input_label" for=""> @lang('common.student_photo')</label>
                                            <div class="primary_file_uploader">
                                                <input class="primary_input_field" type="text" id="placeholderPhoto"
                                                       placeholder="{{ $student->student_photo != '' ? getFilePath3($student->student_photo) : (is_required('student_photo') == true ? trans('common.student_photo') . '*' : trans('common.student_photo')) }}"
                                                       disabled>
                                                <button class="" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                        for="photo">{{ __('common.browse') }}</label>
                                                    <input type="file" class="d-none" name="photo" id="photo">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row mb-20">
                                
                                @if (generalSetting()->with_guardian)
                                    <div class="col-lg-6 text-right">
                                        <div class="row">
                                            <div class="col-lg-7 text-left" id="parent_info">
                                                <input type="hidden" name="parent_id" value="">

                                            </div>
                                            <!-- <div class="col-lg-5">
                                                <button class="primary-btn-small-input primary-btn small fix-gr-bg"
                                                        type="button" data-toggle="modal" data-target="#editStudent">
                                                    <span class="ti ti-plus pr-2"></span>
                                                    @lang('student.add_parent')
                                                </button>
                                            </div> -->
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @php
                                $extraclasses = DB::table('sm_extra_curricular_classes')
                                ->where('academic_id', '=', old('session', getAcademicId()))
                                ->get();
                            @endphp
                            <!-- <div class="row mb-15">
                                <div class="col-lg-12">
                                    <label class="primary_input_label" for="">@lang('common.extra_class')<span class="text-danger">
                                            *</span></label>
                                    @foreach ($extraclasses as $class)
                                            <div class="">
                                            <input type="checkbox" id="extraclass_{{ @$class->id }}"
                                                    value="{{ @$class->id }}" name="extraclass[]" {{ isset($extra_class_ids) ? (in_array($class->id, $extra_class_ids) ? 'checked' : '') : '' }}>
                                                <label for="extraclass_{{ @$class->id }}">{{ @$class->class_name }}</label>
                                            </div>
                                    @endforeach
                                </div>
                            </div> -->

                            @if (generalSetting()->with_guardian)
                                <!-- Start Sibling Add Modal -->
                                <div class="modal fade admin-query" id="editStudent">
                                    <div class="modal-dialog small-modal modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('common.select_sibling')</h4>
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <form action="">
                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="row">
                                                                    <div class="col-lg-12" id="sibling_required_error">

                                                                    </div>
                                                                </div>
                                                                <div class="row mt-15">
                                                                    <div class="col-lg-12" id="sibling_class_div">
                                                                        <label for="primary_input_label">@lang('common.class')
                                                                            <span class="text-danger"> *</span></label>
                                                                        <select class="primary_select "
                                                                                name="sibling_class"
                                                                                id="select_sibling_class">
                                                                            <option data-display="@lang('common.class') *"
                                                                                    value="">@lang('common.class') *
                                                                            </option>
                                                                            @foreach ($classes as $class)
                                                                                <option value="{{ $class->id }}">
                                                                                    {{ $class->class_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row mt-15">
                                                                    <div class="col-lg-12" id="sibling_section_div">
                                                                        <label for="primary_input_label">@lang('common.section')
                                                                            <span class="text-danger"> *</span></label>
                                                                        <select class="primary_select "
                                                                                name="sibling_section"
                                                                                id="select_sibling_section">
                                                                            <option data-display="@lang('common.section') *"
                                                                                    value="">@lang('common.section') *
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-15">
                                                                    <div class="col-lg-12" id="sibling_name_div">
                                                                        <label for="primary_input_label">@lang('student.sibling')
                                                                            <span class="text-danger"> *</span></label>
                                                                        <select class="primary_select "
                                                                                name="select_sibling_name"
                                                                                id="select_sibling_name">
                                                                            <option data-display="@lang('student.sibling') *"
                                                                                    value="">@lang('student.sibling') *
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row mt-15">
                                                                    <div class="col-lg-12" id="sibling_name_div">
                                                                        <label for="primary_input_label">@lang('common.relationship')
                                                                            <span class="text-danger"> *</span></label>
                                                                        <input
                                                            class="primary_input_field form-control"
                                                            type="text" name="relationship" id="relationship"
                                                            value="">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!-- <div class="col-lg-12 text-center mt-40">
                                                                <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                                                    <span class="ti ti-check"></span>
                                                                    save information
                                                                </button>
                                                            </div> -->
                                                            <input type="hidden" id="student_id" name="student_id" value="{{$student->id}}">
                                                            <div class="col-lg-12 text-center mt-40">
                                                                <div class="mt-40 d-flex justify-content-between">
                                                                    <button type="button" class="primary-btn tr-bg"
                                                                            data-dismiss="modal">@lang('common.cancel')</button>
                                                                    <button class="primary-btn fix-gr-bg"
                                                                            id="update_sibling_button" data-dismiss="modal"
                                                                            type="button">@lang('student.update_information')</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Sibling Add Modal -->
                                <input type="hidden" name="sibling_id" value="{{ count($siblings) > 1 ? 1 : 0 }}"
                                       id="sibling_id">
                                    <div class="row mt-40 mb-4" id="siblingTitle">
                                        <div class="col-lg-12 col-md-10">
                                            <div class="main-title">
                                                <h4 class="stu-sub-head">@lang('student.siblings')</h4>
                                            </div>
                                            <div class="mt-40 text-right">
                                            <button class="primary-btn-small-input primary-btn small fix-gr-bg"
                                                        type="button" data-toggle="modal" data-target="#editStudent">
                                                    <span class="ti ti-plus pr-2"></span>
                                                    @lang('student.add_sibling')
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                   
                                    <div id="loadSiblingInfo">
                                    </div>
                                    <div class="row mb-20 student-details" id="siblingInfo_test" style="display:none">
                                        @foreach ($siblings as $sibling)
                                            
                                                <div class="col-sm-12 col-md-6 col-lg-3 mb-30">
                                                    <div class="student-meta-box">
                                                        <div class="student-meta-top siblings-meta-top"></div>
                                                        <img class="student-meta-img img-100"
                                                             src="{{ asset($student->parents->fathers_photo) }}"
                                                             alt="{{ $student->parents->fathers_name }}">
                                                        <div class="white-box radius-t-y-0">
                                                            <div class="single-meta mt-10">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="name">
                                                                        @lang('student.full_name')
                                                                    </div>
                                                                    <div class="value">
                                                                        {{ $sibling->full_name }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="single-meta">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="name">
                                                                        @lang('student.admission_number')
                                                                    </div>
                                                                    <div class="value">
                                                                        {{ $sibling->admission_no }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="single-meta">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="name">
                                                                        @lang('common.class')
                                                                    </div>
                                                                    <div class="value">
                                                                        {{ $sibling->class != '' ? $sibling->class->class_name : '' }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="single-meta">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="name">
                                                                        @lang('common.section')
                                                                    </div>
                                                                    <div class="value">
                                                                        {{ $sibling->section != '' ? $sibling->section->section_name : '' }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>            
                                        @endforeach
                                    </div>
                               
                                <div class="parent_details" id="parent_details">
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <div class="main-title">
                                                <h4 class="stu-sub-head">@lang('student.parents_and_guardian_info')</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-20">
                                        @if (is_show('fathers_name'))
                                        <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.father_name')
                                                        @if (is_required('father_name') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input
                                                            class="primary_input_field form-control{{ $errors->has('fathers_name') ? ' is-invalid' : '' }}"
                                                            type="text" name="fathers_name" id="fathers_name"
                                                            value="{{ $student->parents->fathers_name }}">


                                                    @if ($errors->has('fathers_name'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('fathers_name') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if (is_show('fathers_occupation'))
                                        <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.occupation')
                                                        @if (is_required('fathers_occupation') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input class="primary_input_field form-control" type="text"
                                                           placeholder="" name="fathers_occupation" id="fathers_occupation"
                                                           value="{{ $student->parents->fathers_occupation }}">


                                                </div>
                                            </div>
                                        @endif
                                        @if (is_show('fathers_phone'))
                                        <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.father_phone')
                                                        @if (is_required('father_phone') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input oninput="phoneCheck(this)"
                                                           class="primary_input_field form-control{{ $errors->has('fathers_phone') ? ' is-invalid' : '' }}"
                                                           type="text" name="fathers_phone" id="fathers_phone"
                                                           value="{{ $student->parents->fathers_mobile }}">


                                                    @if ($errors->has('fathers_phone'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('fathers_phone') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <code>@lang('admin.add_prefix_before_phone')</code>
                                            </div>
                                        @endif
                                        
                                        <div class="col-lg-3">
                                                <div class="primary_input ">
                                                    <label class="primary_input_label" for="">@lang('student.fathers_email')
                                                        @if (is_required('fathers_email') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input oninput="emailCheck(this)"
                                                        class="primary_input_field form-control{{ $errors->has('fathers_email') ? ' is-invalid' : '' }}"
                                                        type="text" name="fathers_email" id="fathers_email"
                                                        value="{{ old('fathers_email', $student->parents->fathers_email ?? '') }}">

                                                    @if ($errors->has('fathers_email'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('fathers_email') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        
                                   
                                         @if (is_show('fathers_photo'))
                                        <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.fathers_photo')
                                                        @if (is_required('fathers_photo') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <div class="primary_file_uploader">
                                                        <input class="primary_input_field" type="text"
                                                            id="placeholderFathersName"
                                                            placeholder="{{ isset($student->parents->fathers_photo) && $student->parents->fathers_photo != '' ? getFilePath3($student->parents->fathers_photo) : (is_required('fathers_photo') == true ? __('common.photo') . '*' : __('common.photo')) }}"
                                                            disabled>
                                                        <button class="" type="button">
                                                            <label class="primary-btn small fix-gr-bg"
                                                                for="fathers_photo">{{ __('common.browse') }}</label>
                                                            <input type="file" class="d-none" name="fathers_photo"
                                                                id="fathers_photo">
                                                        </button>
                                                    </div>
                                                    <span class="text-danger">{{ $errors->first('fathers_photo') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row mb-20">
                                        @if (is_show('mothers_name'))
                                        <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.mother_name')
                                                        @if (is_required('mothers_name') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input
                                                            class="primary_input_field form-control{{ $errors->has('mothers_name') ? ' is-invalid' : '' }}"
                                                            type="text" name="mothers_name" id="mothers_name"
                                                            value="{{ $student->parents->mothers_name }}">


                                                    @if ($errors->has('mothers_name'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('mothers_name') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if (is_show('mothers_occupation'))
                                        <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.occupation')
                                                        @if (is_required('mothers_occupation') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input class="primary_input_field" type="text"
                                                           name="mothers_occupation" id="mothers_occupation"
                                                           value="{{ $student->parents->mothers_occupation }}">


                                                </div>
                                            </div>
                                        @endif
                                        @if (is_show('mothers_phone'))
                                        <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.mother_phone')
                                                        @if (is_required('mothers_phone') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input oninput="phoneCheck(this)"
                                                           class="primary_input_field form-control{{ $errors->has('mothers_phone') ? ' is-invalid' : '' }}"
                                                           type="text" name="mothers_phone" id="mothers_phone"
                                                           value="{{ $student->parents->mothers_mobile }}">


                                                    @if ($errors->has('mothers_phone'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('mothers_phone') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <code>@lang('admin.add_prefix_before_phone')</code>
                                            </div>
                                        @endif
                                        
                                        <div class="col-lg-3">
                                                <div class="primary_input ">
                                                    <label class="primary_input_label" for="">@lang('student.mothers_email')
                                                        @if (is_required('mothers_email') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input oninput="emailCheck(this)"
                                                        class="primary_input_field form-control{{ $errors->has('mothers_email') ? ' is-invalid' : '' }}"
                                                        type="text" name="mothers_email" id="mothers_email"
                                                        value="{{ old('mothers_email', $student->parents->mothers_email ?? '') }}">


                                                    @if ($errors->has('mothers_email'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('mothers_email') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                                                       
                                   
                                        @if (is_show('mothers_photo'))
                                            <div class="col-lg-3">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for="">@lang('student.mothers_photo')
                                                        @if (is_required('mothers_photo') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <div class="primary_file_uploader">
                                                        <input class="primary_input_field" type="text"
                                                               id="placeholderMothersName"
                                                               placeholder="{{ isset($student->parents->mothers_photo) && $student->parents->mothers_photo != '' ? getFilePath3($student->parents->mothers_photo) : (is_required('mothers_photo') == true ? __('common.photo') . '*' : __('common.photo')) }}"
                                                               disabled>
                                                        <button class="" type="button">
                                                            <label class="primary-btn small fix-gr-bg"
                                                                for="mothers_photo">{{ __('common.browse') }}</label>
                                                            <input type="file" class="d-none" name="mothers_photo"
                                                                id="mothers_photo">
                                                        </button>
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('mothers_photo') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row mb-15 mt-30">
                                        <!-- @if (is_show('guardians_address')) -->
                                            <div class="col-lg-6">
                                                <div class="primary_input ">
                                                    <label class="primary_input_label" for="">@lang('student.address')
                                                        @if (is_required('parent_address') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif </label>
                                                    <textarea class="primary_input_field form-control{{ $errors->has('parent_address') ? ' is-invalid' : '' }}" cols="0" rows="3" name="parent_address"
                                                        id="parent_address">{{ $student->parent_address }}</textarea>

                                                    @if ($errors->has('parent_address'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('parent_address') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        <!-- @endif -->
                                    </div>
                                    @if (is_show('guardians_phone') || is_show('guardians_email'))
                                        <div class="row mb-40 mt-5">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">@lang('student.relation_with_guardian') *</p>
                                                <div class="d-flex radio-btn-flex ml-40 mt-15">
                                                    <div class="mr-30">
                                                        <input type="radio" name="relationButton" id="relationFather"
                                                               value="F" class="common-radio relationButton"
                                                                {{ $student->parents->relation == 'F' ? 'checked' : '' }}>
                                                        <label for="relationFather">@lang('student.father')</label>
                                                    </div>
                                                    <div class="mr-30">
                                                        <input type="radio" name="relationButton" id="relationMother"
                                                               value="M" class="common-radio relationButton"
                                                                {{ $student->parents->relation == 'M' ? 'checked' : '' }}>
                                                        <label for="relationMother">@lang('student.mother')</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="relationButton" id="relationOther"
                                                               value="O" class="common-radio relationButton"
                                                                {{ $student->parents->relation == 'O' ? 'checked' : '' }}>
                                                        <label for="relationOther">@lang('student.Other')</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="row mb-20">
                                        @if (is_show('guardians_name'))
                                            <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.guardian_name')
                                                        @if (is_required('guardians_name') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input
                                                            class="primary_input_field form-control{{ $errors->has('guardians_name') ? ' is-invalid' : '' }}"
                                                            type="text" name="guardians_name" id="guardians_name"
                                                            value="{{ $student->parents->guardians_name }}">


                                                    @if ($errors->has('guardians_name'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('guardians_name') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        @php
                                            if ($student->parents->guardians_relation == 'F') {
                                                $show_relation = 'Father';
                                            }
                                            if ($student->parents->guardians_relation == 'M') {
                                                $relashow_relationtion = 'Mother';
                                            }
                                            if ($student->parents->guardians_relation == 'O') {
                                                $show_relation = 'Other';
                                            }
                                        @endphp
                                        @if (is_show('guardians_phone') || is_show('guardians_email'))
                                            <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.relation_with_guardian')
                                                        @if (is_required('relation') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input class="primary_input_field read-only-input" type="text"
                                                           placeholder="Relation" name="relation" id="relation"
                                                           value="{{ $student->parents != '' ? @$student->parents->guardians_relation : '' }}"
                                                           readonly>


                                                </div>
                                            </div>
                                        @endif
                                        @if (is_show('guardians_email'))
                                            <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.guardian_email')
                                                        @if (is_required('guardians_email') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input
                                                            class="primary_input_field form-control{{ $errors->has('guardians_email') ? ' is-invalid' : '' }}"
                                                            type="text" name="guardians_email" id="guardians_email"
                                                            value="{{ $student->parents->guardians_email }}">


                                                    @if ($errors->has('guardians_email'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('guardians_email') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if (is_show('guardians_photo'))
                                            <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.guardians_photo')
                                                        @if (is_required('guardians_photo') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <div class="primary_file_uploader">
                                                        <input class="primary_input_field" type="text"
                                                            id="placeholderGuardiansName"
                                                            placeholder="{{ isset($student->parents->guardians_photo) && $student->parents->guardians_photo != '' ? getFilePath3($student->parents->guardians_photo) : (is_required('guardians_photo') == true ? __('common.photo') . '*' : __('common.photo')) }}"
                                                            disabled>
                                                        <button class="" type="button">
                                                            <label class="primary-btn small fix-gr-bg"
                                                                for="guardians_photo">{{ __('common.browse') }}</label>
                                                            <input type="file" class="d-none" name="guardians_photo"
                                                                id="guardians_photo">
                                                        </button>
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('guardians_photo') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row mb-20">
                                        @if (is_show('guardians_phone'))
                                            <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.guardian_phone')
                                                        @if (is_required('guardians_phone') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input
                                                            class="primary_input_field form-control{{ $errors->has('guardians_phone') ? ' is-invalid' : '' }}"
                                                            type="text" name="guardians_phone" id="guardians_phone"
                                                            value="{{ $student->parents->guardians_mobile }}">
                                                    @if ($errors->has('guardians_phone'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('guardians_phone') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <code>@lang('admin.add_prefix_before_phone')</code>
                                            </div>
                                        @endif
                                        @if (is_show('guardians_occupation'))
                                            <div class="col-lg-3">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.guardian_occupation')
                                                        @if (is_required('guardians_occupation') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <input class="primary_input_field" type="text"
                                                           name="guardians_occupation" id="guardians_occupation"
                                                           value="{{ $student->parents->guardians_occupation }}">


                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if (is_show('guardians_address'))
                                        <div class="row mt-35">
                                            <div class="col-lg-6">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for="">@lang('student.guardian_address')
                                                        @if (is_required('guardians_address') == true)
                                                            <span class="text-danger"> *</span>
                                                        @endif
                                                    </label>
                                                    <textarea class="primary_input_field form-control" cols="0" rows="4" name="guardians_address"
                                                              id="guardians_address">{{ $student->parents->guardians_address }}</textarea>


                                                    @if ($errors->has('guardians_address'))
                                                        <span class="danger text-danger">
                                                            {{ $errors->first('guardians_address') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif


                            <div class="row mt-40">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">@lang('student.student_address_info')</h4>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-30 mt-30">
                                @if (moduleStatusCheck('Lead') == true)
                                    <div class="col-lg-4 ">
                                        <div class="primary_input" style="margin-top:53px !important">
                                            <select
                                                    class="primary_select  form-control{{ $errors->has('route') ? ' is-invalid' : '' }}"
                                                    name="lead_city" id="lead_city">
                                                <option
                                                        data-display="@lang('lead::lead.city') @if (is_required('lead_city') == true) * @endif"
                                                        value="">@lang('lead::lead.city') @if (is_required('lead_city') == true)
                                                        <span class="text-danger"> *</span>
                                                    @endif
                                                </option>
                                                @foreach ($lead_city as $city)
                                                    <option value="{{ $city->id }}"
                                                            {{ $student->lead_city_id == $city->id ? 'selected' : '' }}>
                                                        {{ $city->city_name }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('lead_city'))
                                                <span class="text-danger invalid-select" role="alert">
                                                    {{ $errors->first('lead_city') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('current_address'))
                                    <div class="col-lg-4">

                                        <div class="primary_input mt-20">
                                            <label class="primary_input_label" for="">@lang('student.current_address')
                                                @if (is_required('current_address') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <textarea class="primary_input_field form-control{{ $errors->has('current_address') ? ' is-invalid' : '' }}"
                                                      cols="0" rows="3" name="current_address" id="current_address">{{ $student->current_address }}</textarea>


                                        </div>
                                    </div>
                                @endif
                                @if (is_show('permanent_address'))
                                    <div class="col-lg-4">

                                        <div class="primary_input mt-20">
                                            <label class="primary_input_label" for="">@lang('student.permanent_address')
                                                @if (is_required('permanent_address') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <textarea class="primary_input_field form-control{{ $errors->has('current_address') ? ' is-invalid' : '' }}"
                                                      cols="0" rows="3" name="permanent_address" id="permanent_address">{{ $student->permanent_address }}</textarea>


                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-40 mb-4">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">@lang('student.transport_and_dormitory_info')</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-20">
                                @if (is_show('route'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label for="primary_input_label">@lang('student.route_list') <span>
                                                    @if (is_required('route') == true)
                                                        *
                                                    @endif
                                                </span>
                                            </label>
                                            <select
                                                    class="primary_select  form-control{{ $errors->has('route') ? ' is-invalid' : '' }}"
                                                    name="route" id="route">
                                                <option
                                                        data-display="@lang('student.route_list') @if (is_required('route') == true) * @endif"
                                                        value="">@lang('student.route_list') @if (is_required('route') == true)
                                                        *
                                                    @endif
                                                </option>
                                                @foreach ($route_lists as $route_list)
                                                    @if (isset($student->route_list_id))
                                                        <option value="{{ $route_list->id }}"
                                                                {{ $student->route_list_id == $route_list->id ? 'selected' : '' }}>
                                                            {{ $route_list->title }}</option>
                                                    @else
                                                        <option value="{{ $route_list->id }}">{{ $route_list->title }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has('route'))
                                                <span class="text-danger">
                                                    {{ $errors->first('route') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('vehicle'))
                                    <div class="col-lg-3">
                                        <div class="primary_input" id="select_vehicle_div">
                                            <label for="primary_input_label">@lang('student.vehicle_number') <span>
                                                    @if (is_required('vehicle') == true)
                                                        *
                                                    @endif
                                                </span>
                                            </label>
                                            <select
                                                    class="primary_select  form-control{{ $errors->has('vehicle') ? ' is-invalid' : '' }}"
                                                    name="vehicle" id="selectVehicle">
                                                <option
                                                        data-display="@lang('student.vehicle_number') @if (is_required('vehicle') == true) * @endif"
                                                        value="">@lang('student.vehicle_number') @if (is_required('vehicle') == true)
                                                        *
                                                    @endif
                                                </option>
                                                @foreach ($vehicles as $vehicle)
                                                    @if (isset($student->vechile_id) && $vehicle->id == $student->vechile_id)
                                                        <option value="{{ $vehicle->id }}"
                                                                {{ $student->vechile_id == $vehicle->id ? 'selected' : '' }}>
                                                            {{ $vehicle->vehicle_no }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="pull-right loader loader_style" id="select_transport_loader">
                                                <img class="loader_img_style"
                                                     src="{{ asset('public/backEnd/img/demo_wait.gif') }}"
                                                     alt="loader">
                                            </div>

                                            @if ($errors->has('vehicle'))
                                                <span class="text-danger">
                                                    {{ $errors->first('vehicle') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-20">
                                @if (is_show('dormitory_name'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label for="primary_input_label">@lang('dormitory.dormitory') <span>
                                                    @if (is_required('dormitory_name') == true)
                                                        *
                                                    @endif
                                                </span>
                                            </label>
                                            <select class="primary_select" name="dormitory_name" id="SelectDormitory">
                                                <option
                                                        data-display="@lang('dormitory.dormitory_name') @if (is_required('dormitory_name') == true) * @endif"
                                                        value="">@lang('dormitory.dormitory_name') @if (is_required('dormitory_name') == true)
                                                        *
                                                    @endif
                                                </option>
                                                @foreach ($dormitory_lists as $dormitory_list)
                                                    @if ($student->dormitory_id)
                                                        <option value="{{ $dormitory_list->id }}"
                                                                {{ $student->dormitory_id == $dormitory_list->id ? 'selected' : '' }}>
                                                            {{ $dormitory_list->dormitory_name }}</option>
                                                    @else
                                                        <option value="{{ $dormitory_list->id }}">
                                                            {{ $dormitory_list->dormitory_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has('dormitory_name'))
                                                <span class="text-danger">
                                                    {{ $errors->first('dormitory_name') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('room_number'))
                                    <div class="col-lg-3">
                                        <div class="primary_input" id="roomNumberDiv">
                                            <label for="primary_input_label">@lang('academics.room_number') <span>
                                                    @if (is_required('room_number') == true)
                                                        *
                                                    @endif
                                                </span>
                                            </label>
                                            <select
                                                    class="primary_select  form-control{{ $errors->has('room_number') ? ' is-invalid' : '' }}"
                                                    name="room_number" id="selectRoomNumber">
                                                <option
                                                        data-display="@lang('academics.room_number') @if (is_required('room_number') == true) <span class="text-danger"> *</span> @endif"
                                                value="">@lang('academics.room_number') @if (is_required('room_number') == true)
                                                    <span class="text-danger"> *</span>
                                                    @endif
                                                    </option>
                                                    @if ($student->room_id != '')
                                                        <option value="{{ $student->room_id }}" selected="true">
                                                            {{ $student->room != '' ? $student->room->name : '' }}</option>
                                                    @endif
                                            </select>
                                            <div class="pull-right loader loader_style" id="select_dormitory_loader">
                                                <img class="loader_img_style"
                                                     src="{{ asset('public/backEnd/img/demo_wait.gif') }}"
                                                     alt="loader">
                                            </div>

                                            @if ($errors->has('room_number'))
                                                <span class="text-danger">
                                                    {{ $errors->first('room_number') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row mt-40 mb-4">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head">@lang('student.document_info')</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-20">
                                @if (is_show('national_id_number'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.nin_number')
                                                @if (is_required('national_id_number') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                                <span>
                                                </span>
                                            </label>

                                            <input
                                                    class="primary_input_field form-control{{ $errors->has('national_id_number') ? ' is-invalid' : '' }}"
                                                    type="text" name="national_id_number"
                                                    value="{{ $student->national_id_no }}">

                                            @if ($errors->has('national_id_number'))
                                                <span class="text-danger">
                                                    {{ $errors->first('national_id_number') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('local_id_number'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.birth_certificate_number')
                                                @if (is_required('local_id_number') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <input class="primary_input_field form-control" type="text"
                                                   name="local_id_number" value="{{ $student->local_id_no }}">


                                        </div>
                                    </div>
                                @endif
                                @if (is_show('bank_account_number'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.bank_account_number')
                                                @if (is_required('bank_account_number') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <input class="primary_input_field form-control" type="text"
                                                   name="bank_account_number" value="{{ $student->bank_account_no }}">


                                        </div>
                                    </div>
                                @endif
                                @if (is_show('bank_name'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.bank_name')
                                                @if (is_required('bank_name') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>

                                            <input class="primary_input_field form-control" type="text"
                                                   name="bank_name" value="{{ $student->bank_name }}">

                                        </div>
                                    </div>
                                @endif
                            </div>
                             <div class="row mb-20">
                                @if (is_show('document_file_1'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.nin')
                                            @if (is_required('nin') == true)
                                                <span class="text-danger"> *</span>
                                            @endif 
                                        </label>
                                            <div class="primary_file_uploader">
                                                <input class="primary_input_field" type="text"
                                                    id="placeholderFileOneName"
                                                    placeholder="{{ $student->document_file_1 != '' ? showPicName($student->document_file_1) : (is_required('document_title_1') == true ? '01 *' : '01') }}"
                                                    disabled>
                                                <button class="" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                        for="document_file_1">{{ __('common.browse') }}</label>
                                                    <input type="file" class="d-none" name="document_file_1"
                                                        id="document_file_1">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('document_file_2'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.birth_certificate')
                                                @if (is_required('birth_certificate') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif 
                                            </label>
                                            <div class="primary_file_uploader">
                                                <input class="primary_input_field" type="text"
                                                    id="placeholderFileTwoName"
                                                    placeholder="{{ isset($student->document_file_2) && $student->document_file_2 != '' ? showPicName($student->document_file_2) : (is_required('document_title_2') == true ? '02 *' : '02') }}"
                                                    disabled>
                                                <button class="" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                        for="document_file_2">{{ __('common.browse') }}</label>
                                                    <input type="file" class="d-none" name="document_file_2"
                                                        id="document_file_2">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (is_show('document_file_3'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.transfer_certificate')
                                                @if (is_required('transfer_certificate') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif 
                                            </label>
                                            <div class="primary_file_uploader">
                                                <input class="primary_input_field" type="text"
                                                    id="placeholderFileThreeName"
                                                    placeholder="{{ isset($student->document_file_3) && $student->document_file_3 != '' ? showPicName($student->document_file_3) : (is_required('document_title_3') == true ? '03 *' : '03') }}"
                                                    disabled>
                                                <button class="" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                        for="document_file_3">{{ __('common.browse') }}</label>
                                                    <input type="file" class="d-none" name="document_file_3"
                                                        id="document_file_3">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                 @if (is_show('ifsc_code'))
                                    <div class="col-lg-3">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.ifsc_code')
                                                @if (is_required('ifsc_code') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <input class="primary_input_field form-control" type="text"
                                                   name="ifsc_code"
                                                   value="{{ old('ifsc_code') }}{{ $student->ifsc_code }}">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row mb-20 mt-40">
                                @if (is_show('previous_school_details'))
                                    <div class="col-lg-6">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.previous_school_details')
                                                @if (is_required('previous_school_details') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <textarea class="primary_input_field form-control" cols="0" rows="4" name="previous_school_details">{{ $student->previous_school_details }}</textarea>


                                        </div>
                                    </div>
                                @endif
                                @if (is_show('additional_notes'))
                                    <div class="col-lg-6">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('student.additional_notes')
                                                @if (is_required('additional_notes') == true)
                                                    <span class="text-danger"> *</span>
                                                @endif
                                            </label>
                                            <textarea class="primary_input_field form-control" cols="0" rows="4" name="additional_notes">{{ $student->aditional_notes }}</textarea>


                                        </div>
                                    </div>
                                @endif                               
                            </div>
                            
                            
                           

                            <!--Dormitary and Other Info-->
                            @include('backEnd.studentInformation.student_other_info_edit')
                            <!--Other Info End-->

                            @if (is_show('custom_field'))
                                {{-- Custom Field Start --}}
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h4 class="stu-sub-head">@lang('student.custom_field')</h4>
                                        </div>
                                    </div>
                                </div>

                                @include('backEnd.studentInformation._custom_field')
                                {{-- Custom Field End --}}
                            @endif


                            <div class="row mt-5">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg submit">
                                        <span class="ti ti-check"></span>
                                        @lang('student.update_student')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </section>


    


    {{-- student photo --}}
    <input type="text" id="STurl" value="{{ route('student_update_pic', $student->id) }}" hidden>
    <div class="modal" id="LogoPic">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Crop Image And Upload</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="resize"></div>
                    <button class="btn rotate float-lef" data-deg="90">
                        <i class="ti-back-right"></i></button>
                    <button class="btn rotate float-right" data-deg="-90">
                        <i class="ti-back-left"></i></button>
                    <hr>
                    <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="upload_logo">Crop</a>
                </div>
            </div>
        </div>
    </div>
    {{-- end student photo --}}

    {{-- father photo --}}

    <div class="modal" id="FatherPic">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Crop Image And Upload</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="fa_resize"></div>
                    <button class="btn rotate float-lef" data-deg="90">
                        <i class="ti-back-right"></i></button>
                    <button class="btn rotate float-right" data-deg="-90">
                        <i class="ti-back-left"></i></button>
                    <hr>
                    <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="FatherPic_logo">Crop</a>
                </div>
            </div>
        </div>
    </div>
    {{-- end father photo --}}
    {{-- mother photo --}}

    <div class="modal" id="MotherPic">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Crop Image And Upload</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="ma_resize"></div>
                    <button class="btn rotate float-lef" data-deg="90">
                        <i class="ti-back-right"></i></button>
                    <button class="btn rotate float-right" data-deg="-90">
                        <i class="ti-back-left"></i></button>
                    <hr>
                    <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="Mother_logo">Crop</a>
                </div>
            </div>
        </div>
    </div>
    {{-- end mother photo --}}
    {{-- mother photo --}}

    <div class="modal" id="GurdianPic">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Crop Image And Upload</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="Gu_resize"></div>
                    <button class="btn rotate float-lef" data-deg="90">
                        <i class="ti-back-right"></i></button>
                    <button class="btn rotate float-right" data-deg="-90">
                        <i class="ti-back-left"></i></button>
                    <hr>

                    <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="Gurdian_logo">Crop</a>
                </div>
            </div>
        </div>
    </div>
    {{-- end mother photo --}}

@endsection
@include('backEnd.partials.date_picker_css_js')
@section('script')
    <script src="{{ asset('public/backEnd/') }}/js/croppie.js"></script>
    <script src="{{ asset('public/backEnd/') }}/js/st_addmision.js"></script>
    <script>
        $(document).ready(function() {
            var studentDob = new Date();
            var minDobDate = new Date('1900-01-01');
            $('.student_dob').datepicker({
                Default: {
                    leftArrow: '<i class="fa fa-long-arrow-left"></i>',
                    rightArrow: '<i class="fa fa-long-arrow-right"></i>'
                },
                autoclose: true,
                endDate: studentDob,
                startDate: minDobDate,
                todayHighlight: true,
                format: 'mm/dd/yyyy',
                toggleActive: false,
                clearBtn: true
            });
            var admissionDate = new Date();
            $('.admission_date').datepicker({
                Default: {
                    leftArrow: '<i class="fa fa-long-arrow-left"></i>',
                    rightArrow: '<i class="fa fa-long-arrow-right"></i>'
                },
                autoclose: true,
                endDate: admissionDate,
                todayHighlight: true,
                format: 'mm/dd/yyyy',
                toggleActive: false,
                clearBtn: true
            });
            $(document).on('change', '.cutom-photo', function() {
                let v = $(this).val();
                let v1 = $(this).data("id");
                console.log(v, v1);
                getFileName(v, v1);

            });

            function getFileName(value, placeholder) {
                if (value) {
                    var startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
                    var filename = value.substring(startIndex);
                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                        filename = filename.substring(1);
                    }
                    $(placeholder).attr('placeholder', '');
                    $(placeholder).attr('placeholder', filename);
                }
            }

            // Academic year change - load classes
            $("#edit_academic_year").on("change", function() {
                var url = $("#url").val();
                var formData = {
                    id: $(this).val(),
                };
                
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: url + "/" + "academic-year-get-class",
                    beforeSend: function() {
                        $('#edit_select_class_loader').show();
                    },
                    success: function(data) {
                        $("#edit_classSelectStudent").empty().append(
                            $("<option>", {
                                value: '',
                                text: window.jsLang('select_class') + ' *',
                            })
                        );

                        if (data[0] && data[0].length) {
                            $.each(data[0], function(i, className) {
                                $("#edit_classSelectStudent").append(
                                    $("<option>", {
                                        value: className.id,
                                        text: className.class_name,
                                    })
                                );
                            });
                        }
                        $('#edit_classSelectStudent').niceSelect('update');
                        $('#edit_classSelectStudent').trigger('change');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                    complete: function() {
                        $('#edit_select_class_loader').hide();
                    }
                });
            });

            // Class change - load sections
            $("#edit_classSelectStudent").on("change", function() {
                var url = $("#url").val();
                var class_id = $(this).val();

                $("#edit_sectionSelectStudent").empty().append(
                    $("<option>", {
                        value: '',
                        text: window.jsLang('select_section') + ' *',
                    })
                );

                if (!class_id) {
                    $("#edit_sectionSelectStudent").trigger('change').niceSelect('update');
                    return;
                }

                var formData = {
                    id: class_id,
                };
                
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: url + "/" + "ajaxSectionStudent",
                    beforeSend: function() {
                        $('#edit_select_section_loader').show();
                    },
                    success: function(data) {
                        $.each(data, function(i, item) {
                            if (item && item.length) {
                                $.each(item, function(i, section) {
                                    $("#edit_sectionSelectStudent").append(
                                        $("<option>", {
                                            value: section.id,
                                            text: section.section_name,
                                        })
                                    );
                                });
                            }
                        });
                        $("#edit_sectionSelectStudent").trigger('change').niceSelect('update');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                    complete: function() {
                        $('#edit_select_section_loader').hide();
                    }
                });
            });

        })
    </script>
@endsection
