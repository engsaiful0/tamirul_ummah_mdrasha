<h4 class="stu-sub-head mt-40">@lang('student.other_information')</h4>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.dental_date')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->dental_date) ? @$student_detail->dental_date : '' }}
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.dental_hygiene')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->dental_hygiene) ? @$student_detail->dental_hygiene : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.chest_date')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->chest_date) ? @$student_detail->chest_date : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.chest_size')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->chest_size) ? @$student_detail->chest_size : '' }}
            </div>
        </div>
    </div>
</div>
<!--BMI-->
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.bmi_date')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->bmi_date) ? @$student_detail->bmi_date : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.bmi_height')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->bmi_height) ? @$student_detail->bmi_height : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.bmi_weight')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->bmi_weight) ? @$student_detail->bmi_weight : '' }}
            </div>
        </div>
    </div>
</div>

<!--Vision-->

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.vision_date')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->vision_date) ? @$student_detail->vision_date : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.vision_left')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->vision_left) ? @$student_detail->vision_left : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.vision_right')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->vision_right) ? @$student_detail->vision_right : '' }}
            </div>
        </div>
    </div>
</div>

<!--Medical History-->
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.medical_date')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->medical_date) ? @$student_detail->medical_date : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.medical_name')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->medical_name) ? @$student_detail->medical_name : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.medical_comment')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->medical_comment) ? @$student_detail->medical_comment : '' }}
            </div>
        </div>
    </div>
</div>

<!--Clinical Evolution-->
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.clinical_date')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->clinical_date) ? @$student_detail->clinical_date : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.clinical_name')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->clinical_name) ? @$student_detail->clinical_name : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.clinical_comment')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->clinical_comment) ? @$student_detail->clinical_comment : '' }}
            </div>
        </div>
    </div>
</div>

<!--Allergies -->
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.allergies_date')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->allergies_date) ? @$student_detail->allergies_date : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.allergies_name')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->allergies_name) ? @$student_detail->allergies_name : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.allergies_comment')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->allergies_comment) ? @$student_detail->allergies_comment : '' }}
            </div>
        </div>
    </div>
</div>

<!--Health Issue-->
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.health_issue_date')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->health_issue_date) ? @$student_detail->health_issue_date : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.health_issue_type')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->health_issue_type) ? @$student_detail->health_issue_type : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.health_issue_comment')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->health_issue_comment) ? @$student_detail->health_issue_comment : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.health_issue_doctor')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->health_issue_doctor) ? @$student_detail->health_issue_doctor : '' }}
            </div>
        </div>
    </div>
</div>

<!--Health Immunization-->
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.immunization_date')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->immunization_date) ? @$student_detail->immunization_date : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.immunization_name')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->immunization_name) ? @$student_detail->immunization_name : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.immunization_type')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->immunization_type) ? @$student_detail->immunization_type : '' }}
            </div>
        </div>
    </div>
</div>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                @lang('student.immunization_comment')
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                {{ isset($student_detail->immunization_comment) ? @$student_detail->immunization_comment : '' }}
            </div>
        </div>
    </div>
</div>
