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
        Schema::create('sm_staff_earnings', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id')->nullable();
            $table->string('reason', 255)->nullable();
            $table->string('amount', 200)->nullable();
            $table->string('remarks', 255)->nullable();
            $table->timestamps();
            $table->integer('school_id')->nullable();
            $table->integer('academic_id')->nullable();
            $table->tinyInteger('active_status')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sm_staff_earnings');
    }
};
