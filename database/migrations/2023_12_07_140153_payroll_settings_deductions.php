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
        Schema::create('payroll_settings_deductions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->integer('group_id')->nullable();
            $table->string('type_name', 255)->nullable();
            $table->double('percentage')->default(0);
            $table->integer('school_id')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payroll_settings_deductions');
    }
};
