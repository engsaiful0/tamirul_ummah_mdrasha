
 @if (isMenuAllowToShow('dormitory'))
    <div class="row mt-40">
        <div class="col-lg-12">
            <div class="main-title">
                <h4 class="stu-sub-head">@lang('student.Other_info')</h4>
            </div>
        </div>
    </div>
    <div class="row mb-15 mt-30">
        <!--Dental-->
    <div class="col-lg-3">
        <div class="primary_input">
            <label class="primary_input_label"
                for="bmi_date">{{ __('student.dental_date') }}</label>
            <div class="primary_datepicker_input">
                <div class="no-gutters input-right-icon">
                    <div class="col">
                        <div class="">
                            <input
                            class="primary_input_field primary_input_field date form-control"
                            id="dental_date" type="text" name="dental_date"
                            value="{{ $student->dental_date }}"
                            autocomplete="off">
                        </div>
                    </div>
                    <button class="btn-date" style="top: 55% !important;" data-id="#dental_date" type="button">
                        <label class="m-0 p-0" for="dental_date">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger">{{ $errors->first('dental_date') }}</span>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="primary_input_label ">
            <label> @lang('student.dental_hygiene')</label>
            <input class="primary_input_field form-control" type="text" name="dental_hygiene" value="{{ $student->dental_hygiene }}">

            @if ($errors->has('dental_hygiene'))
                <span class="text-danger">
                    {{ $errors->first('dental_hygiene') }}
                </span>
            @endif
        </div>
    </div> 
        <div class="col-lg-3">
            <div class="primary_input">
                <label class="primary_input_label"
                    for="chest_date">{{ __('student.chest_date') }}</label>
                <div class="primary_datepicker_input">
                    <div class="no-gutters input-right-icon">
                        <div class="col">
                            <div class="">
                                <input
                                class="primary_input_field primary_input_field date form-control"
                                id="chest_date" type="text" name="chest_date"
                                value="{{ $student->chest_date }}"
                                autocomplete="off">
                            </div>
                        </div>
                        <button class="btn-date" style="top: 55% !important;" data-id="#chest_date" type="button">
                            <label class="m-0 p-0" for="chest_date">
                                <i class="ti-calendar" id="start-date-icon"></i>
                            </label>
                        </button>
                    </div>
                </div>
                <span class="text-danger">{{ $errors->first('chest_date') }}</span>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="primary_input_label ">
                <label> @lang('student.chest_size')</label>
                <input class="primary_input_field form-control" type="text" name="chest_size" value="{{ $student->chest_size }}">

                @if ($errors->has('chest_size'))
                    <span class="text-danger">
                        {{ $errors->first('chest_size') }}
                    </span>
                @endif
            </div>
        </div>
    </div>
@endif

<!--BMI-->
<div class="row mb-30 mt-30">
    <div class="col-lg-4">
        <div class="primary_input">
            <label class="primary_input_label"
                for="bmi_date">{{ __('student.bmi_date') }}</label>
            <div class="primary_datepicker_input">
                <div class="no-gutters input-right-icon">
                    <div class="col">
                        <div class="">
                            <input
                            class="primary_input_field primary_input_field date form-control"
                            id="bmi_date" type="text" name="bmi_date"
                            value="{{ $student->bmi_date }}"
                            autocomplete="off">
                        </div>
                    </div>
                    <button class="btn-date" style="top: 55% !important;" data-id="#bmi_date" type="button">
                        <label class="m-0 p-0" for="bmi_date">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger">{{ $errors->first('bmi_date') }}</span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input_label ">
            <label> @lang('student.bmi_height')</label>
            <input class="primary_input_field form-control" type="text" name="bmi_height" value="{{ $student->bmi_height }}">

            @if ($errors->has('bmi_height'))
                <span class="text-danger">
                    {{ $errors->first('bmi_height') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input ">
            <label class="primary_input_label" for="">@lang('student.bmi_weight')</label>
            <input class="primary_input_field form-control" type="text" name="bmi_weight" value="{{ $student->bmi_weight }}">
            @if ($errors->has('bmi_weight'))
                <span class="text-danger">
                    {{ $errors->first('bmi_weight') }}
                </span>
            @endif
        </div>
    </div>

<!--Vision-->
    <div class="col-lg-4">
        <div class="primary_input">
            <label class="primary_input_label"
                for="bmi_date">{{ __('student.vision_date') }}</label>
            <div class="primary_datepicker_input">
                <div class="no-gutters input-right-icon">
                    <div class="col">
                        <div class="">
                            <input
                            class="primary_input_field primary_input_field date form-control"
                            id="vision_date" type="text" name="vision_date"
                            value="{{ date('m/d/Y', strtotime($student->vision_date)) }}"
                            autocomplete="off">
                        </div>
                    </div>
                    <button class="btn-date" style="top: 55% !important;" data-id="#vision_date" type="button">
                        <label class="m-0 p-0" for="vision_date">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger">{{ $errors->first('vision_date') }}</span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input_label ">
            <label> @lang('student.vision_left')</label>
            <input class="primary_input_field form-control" type="text" name="vision_left" value="{{ $student->vision_left }}">

            @if ($errors->has('vision_left'))
                <span class="text-danger">
                    {{ $errors->first('vision_left') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input ">
            <label class="primary_input_label" for="">@lang('student.vision_right')</label>
            <input class="primary_input_field form-control" type="text" name="vision_right" value="{{ $student->vision_right }}">
            @if ($errors->has('vision_right'))
                <span class="text-danger">
                    {{ $errors->first('vision_right') }}
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row mb-30 mt-30">
<!--Medical Hoistory-->
    <div class="col-lg-4">
        <div class="primary_input">
            <label class="primary_input_label"
                for="bmi_date">{{ __('student.medical_date') }}</label>
            <div class="primary_datepicker_input">
                <div class="no-gutters input-right-icon">
                    <div class="col">
                        <div class="">
                            <input
                            class="primary_input_field primary_input_field date form-control"
                            id="medical_date" type="text" name="medical_date"
                            value="{{ $student->medical_date }}"
                            autocomplete="off">
                        </div>
                    </div>
                    <button class="btn-date" style="top: 55% !important;" data-id="#medical_date" type="button">
                        <label class="m-0 p-0" for="medical_date">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger">{{ $errors->first('medical_date') }}</span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input_label ">
            <label> @lang('student.medical_name')</label>
            <input class="primary_input_field form-control" type="text" name="medical_name" value="{{ $student->medical_name }}">

            @if ($errors->has('medical_name'))
                <span class="text-danger">
                    {{ $errors->first('medical_name') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input_label ">
            <label class="primary_input_label" for="">@lang('student.medical_comment')</label>
            <input class="primary_input_field form-control" type="text" name="medical_comment" value="{{ $student->medical_comment }}">
            @if ($errors->has('medical_comment'))
                <span class="text-danger">
                    {{ $errors->first('medical_comment') }}
                </span>
            @endif
        </div>
    </div>

    <!--Clinical Evolution-->
    <div class="col-lg-4">
        <div class="primary_input">
            <label class="primary_input_label"
                for="bmi_date">{{ __('student.clinical_date') }}</label>
            <div class="primary_datepicker_input">
                <div class="no-gutters input-right-icon">
                    <div class="col">
                        <div class="">
                            <input
                            class="primary_input_field primary_input_field date form-control"
                            id="clinical_date" type="text" name="clinical_date"
                            value="{{ $student->clinical_date }}"
                            autocomplete="off">
                        </div>
                    </div>
                    <button class="btn-date" style="top: 55% !important;" data-id="#clinical_date" type="button">
                        <label class="m-0 p-0" for="clinical_date">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger">{{ $errors->first('clinical_date') }}</span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input_label ">
            <label> @lang('student.clinical_name')</label>
            <input class="primary_input_field form-control" type="text" name="clinical_name" value="{{ $student->clinical_name }}">

            @if ($errors->has('clinical_name'))
                <span class="text-danger">
                    {{ $errors->first('clinical_name') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input_label ">
            <label class="primary_input_label" for="">@lang('student.clinical_comment')</label>
            <input class="primary_input_field form-control" type="text" name="clinical_comment" value="{{ $student->clinical_comment }}">
            @if ($errors->has('clinical_comment'))
                <span class="text-danger">
                    {{ $errors->first('clinical_comment') }}
                </span>
            @endif
        </div>
    </div>
</div>


<div class="row mb-30 mt-30">
<!--Allergies Hoistory-->
    <div class="col-lg-4">
        <div class="primary_input">
            <label class="primary_input_label"
                for="bmi_date">{{ __('student.allergies_date') }}</label>
            <div class="primary_datepicker_input">
                <div class="no-gutters input-right-icon">
                    <div class="col">
                        <div class="">
                            <input
                            class="primary_input_field primary_input_field date form-control"
                            id="allergies_date" type="text" name="allergies_date"
                            value="{{ $student->allergies_date }}"
                            autocomplete="off">
                        </div>
                    </div>
                    <button class="btn-date" style="top: 55% !important;" data-id="#allergies_date" type="button">
                        <label class="m-0 p-0" for="allergies_date">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger">{{ $errors->first('allergies_date') }}</span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input_label ">
            <label> @lang('student.allergies_name')</label>
            <input class="primary_input_field form-control" type="text" name="allergies_name" value="{{ $student->allergies_name }}">

            @if ($errors->has('allergies_name'))
                <span class="text-danger">
                    {{ $errors->first('allergies_name') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="primary_input_label ">
            <label class="primary_input_label" for="">@lang('student.allergies_comment')</label>
            <input class="primary_input_field form-control" type="text" name="allergies_comment" value="{{ $student->allergies_comment }}">
            @if ($errors->has('allergies_comment'))
                <span class="text-danger">
                    {{ $errors->first('allergies_comment') }}
                </span>
            @endif
        </div>
    </div>
</div>


<div class="row mb-30 mt-30">
<!--Health Issues-->
    <div class="col-lg-3">
        <div class="primary_input">
            <label class="primary_input_label"
                for="bmi_date">{{ __('student.health_issue_date') }}</label>
            <div class="primary_datepicker_input">
                <div class="no-gutters input-right-icon">
                    <div class="col">
                        <div class="">
                            <input
                            class="primary_input_field primary_input_field date form-control"
                            id="health_issue_date" type="text" name="health_issue_date"
                            value="{{ $student->health_issue_date }}"
                            autocomplete="off">
                        </div>
                    </div>
                    <button class="btn-date" style="top: 55% !important;" data-id="#health_issue_date" type="button">
                        <label class="m-0 p-0" for="health_issue_date">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger">{{ $errors->first('health_issue_date') }}</span>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="primary_input_label ">
            <label> @lang('student.health_issue_doctor')</label>
            <input class="primary_input_field form-control" type="text" name="health_issue_doctor" value="{{ $student->health_issue_doctor }}">

            @if ($errors->has('health_issue_doctor'))
                <span class="text-danger">
                    {{ $errors->first('health_issue_doctor') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
        <div class="primary_input_label ">
            <label class="primary_input_label" for="">@lang('student.health_issue_type')</label>
            <input class="primary_input_field form-control" type="text" name="health_issue_type" value="{{ $student->health_issue_type }}">
            @if ($errors->has('health_issue_type'))
                <span class="text-danger">
                    {{ $errors->first('health_issue_type') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
        <div class="primary_input_label ">
            <label class="primary_input_label" for="">@lang('student.health_issue_comment')</label>
            <input class="primary_input_field form-control" type="text" name="health_issue_comment" value="{{ $student->health_issue_comment }}">
            @if ($errors->has('health_issue_comment'))
                <span class="text-danger">
                    {{ $errors->first('health_issue_comment') }}
                </span>
            @endif
        </div>
    </div>
</div>


<div class="row mb-30 mt-30">
<!--Health Immunization-->
    <div class="col-lg-3">
        <div class="primary_input">
            <label class="primary_input_label"
                for="bmi_date">{{ __('student.health_immunization_date') }}</label>
            <div class="primary_datepicker_input">
                <div class="no-gutters input-right-icon">
                    <div class="col">
                        <div class="">
                            <input
                            class="primary_input_field primary_input_field date form-control"
                            id="health_immunization_date" type="text" name="health_immunization_date"
                            value="{{ $student->immunization_date }}"
                            autocomplete="off">
                        </div>
                    </div>
                    <button class="btn-date" style="top: 55% !important;" data-id="#health_immunization_date" type="button">
                        <label class="m-0 p-0" for="health_immunization_date">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </label>
                    </button>
                </div>
            </div>
            <span class="text-danger">{{ $errors->first('health_immunization_date') }}</span>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="primary_input_label ">
            <label> @lang('student.health_immunization_name')</label>
            <input class="primary_input_field form-control" type="text" name="health_immunization_name" value="{{ $student->immunization_name }}">

            @if ($errors->has('health_immunization_name'))
                <span class="text-danger">
                    {{ $errors->first('health_immunization_name') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
        <div class="primary_input_label ">
            <label class="primary_input_label" for="">@lang('student.health_immunization_type')</label>
            <input class="primary_input_field form-control" type="text" name="health_immunization_type" value="{{ $student->immunization_type }}">
            @if ($errors->has('health_immunization_type'))
                <span class="text-danger">
                    {{ $errors->first('health_immunization_type') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
        <div class="primary_input_label ">
            <label class="primary_input_label" for="">@lang('student.health_immunization_comment')</label>
            <input class="primary_input_field form-control" type="text" name="health_immunization_comment" value="{{ $student->immunization_comment }}">
            @if ($errors->has('health_immunization_comment'))
                <span class="text-danger">
                    {{ $errors->first('health_immunization_comment') }}
                </span>
            @endif
        </div>
    </div>
</div>
