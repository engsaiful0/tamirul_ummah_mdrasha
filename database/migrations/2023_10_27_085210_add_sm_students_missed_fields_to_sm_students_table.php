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
        Schema::table('sm_students', function (Blueprint $table) {
            //
            $table->date('bmi_date')->nullable();
            $table->string('bmi_height', 200)->nullable();
            $table->string('bmi_weight', 200)->nullable();

            $table->date('vision_date')->nullable();
            $table->string('vision_left', 200)->nullable();
            $table->string('vision_right', 200)->nullable();

            $table->date('medical_date')->nullable();
            $table->string('medical_name', 200)->nullable();
            $table->text('medical_comment')->nullable();

            $table->date('clinical_date')->nullable();
            $table->string('clinical_name', 200)->nullable();
            $table->text('clinical_comment')->nullable();

            $table->date('chest_date')->nullable();
            $table->string('chest_size', 200)->nullable();

            $table->date('dental_date')->nullable();
            $table->string('dental_hygiene', 200)->nullable();

            
            $table->date('allergies_date')->nullable();
            $table->string('allergies_name', 200)->nullable();
            $table->text('allergies_comment')->nullable();

            $table->date('health_issue_date')->nullable();
            $table->string('health_issue_name', 200)->nullable();
            $table->string('health_issue_type', 200)->nullable();
            $table->text('health_issue_comment')->nullable();
            $table->string('health_issue_doctor')->nullable();

            
            $table->date('immunization_date')->nullable();
            $table->string('immunization_name', 200)->nullable();
            $table->string('immunization_type', 200)->nullable();
            $table->text('immunization_comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sm_students', function (Blueprint $table) {
            //
        });
    }
};
