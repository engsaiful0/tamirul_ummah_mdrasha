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
        Schema::create('payroll_generate', function (Blueprint $table) {
            $table->id();
            $table->string('payslip_number', 200)->nullable();
            $table->integer('staff_id')->nullable();
            $table->string('attendance', 200)->nullable();
            $table->integer('salary')->nullable();
            $table->string('ctc', 200)->nullable();
            $table->text('earnings')->nullable();
            $table->text('deductions')->nullable();
            $table->text('other_deductions')->nullable();
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('school_id')->nullable();
            $table->integer('academic_id')->nullable();
            $table->date('payroll_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_generate');
    }
};
