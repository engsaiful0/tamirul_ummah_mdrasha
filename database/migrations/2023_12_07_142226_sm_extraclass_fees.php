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
        Schema::create('sm_extraclass_fees', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();
            $table->double('fees_amount')->default(0);
            $table->integer('extra_class_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('extra_curricular_record_id')->nullable();
            $table->integer('school_id')->default(1);
            $table->integer('academic_id')->default(1);
            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);

        });
    }

    public function down()
    {
        Schema::dropIfExists('sm_extraclass_fees');
    }

};
