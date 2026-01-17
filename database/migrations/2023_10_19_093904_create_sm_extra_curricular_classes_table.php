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
        Schema::create('sm_extra_curricular_classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name', 200)->nullable();
            $table->integer('school_id')->nullable();
            $table->integer('academic_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->tinyInteger('created_by')->default(1);
            $table->tinyInteger('updated_by')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_extra_curricular_classes');
    }
};
