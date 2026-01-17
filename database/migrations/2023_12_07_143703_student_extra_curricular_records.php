<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('student_extra_curricular_records', function (Blueprint $table) {
            $table->id();
            $table->integer('extra_class_id')->nullable();
            $table->string('roll_no', 191)->nullable();
            $table->tinyInteger('is_promote')->default(0);
            $table->tinyInteger('is_default')->default(0);
            $table->integer('session_id')->nullable();
            $table->integer('school_id')->default(1);
            $table->integer('academic_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('active_status')->default(1);
            $table->timestamps();
            $table->integer('class_id')->nullable();
            $table->integer('status')->default(1)->comment('1-Paid, 2-Unpaid');
            $table->float('paid_amount')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_extra_curricular_records');
    }
};
