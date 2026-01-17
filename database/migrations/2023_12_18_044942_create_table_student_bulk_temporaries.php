<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_bulk_temporaries', function (Blueprint $table) {
            //
            $table->id();
            $table->string('admission_number')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->string('caste')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('national_identification_no')->nullable();
            $table->string('local_identification_no')->nullable();
            $table->string('previous_school_details')->nullable();
            $table->string('note')->nullable();
            $table->string('user_id')->nullable();
            $table->date('bmi_date')->nullable();
            $table->string('bmi_height')->nullable();
            $table->string('bmi_weight')->nullable();
            $table->date('vision_date')->nullable();
            $table->string('vision_left')->nullable();
            $table->string('vision_right')->nullable();
            $table->date('medical_date')->nullable();
            $table->string('medical_name')->nullable();
            $table->string('medical_comment')->nullable();
            $table->date('clinical_date')->nullable();
            $table->string('clinical_name')->nullable();
            $table->string('clinical_comment')->nullable();
            $table->date('chest_date')->nullable();
            $table->string('chest_size')->nullable();
            $table->date('dental_date')->nullable();
            $table->string('dental_hygiene')->nullable();
            $table->date('allergies_date')->nullable();
            $table->string('allergies_name')->nullable();
            $table->text('allergies_comment')->nullable();
            $table->date('health_issue_date')->nullable();
            $table->string('health_issue_type')->nullable();
            $table->text('health_issue_comment')->nullable();
            $table->string('health_issue_doctor')->nullable();
            $table->date('immunization_date')->nullable();
            $table->string('immunization_name')->nullable();
            $table->string('immunization_type')->nullable();
            $table->text('immunization_comment')->nullable();
            $table->string('name_in_tamil')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->integer('emis_id')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('medium_of_instruction')->nullable();
            $table->string('disability_group_name')->nullable();
            $table->string('group_code')->nullable();
            $table->string('medium')->nullable();
            $table->string('mother_tounge')->nullable();
            $table->string('father_education')->nullable();
            $table->string('mother_education')->nullable();
            $table->string('class_name')->nullable();
            $table->string('section_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_bulk_temporaries');
    }
};