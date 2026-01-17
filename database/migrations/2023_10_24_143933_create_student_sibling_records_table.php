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
        Schema::create('student_sibling_records', function (Blueprint $table) {
            $table->id();            
            $table->integer('student_id')->nullable();   
            $table->integer('sibling_class_id')->nullable();
            $table->integer('sibling_section_id')->nullable();
            $table->integer('sibling_id')->nullable();
            $table->string('relationship', 200)->nullable();
            $table->integer('school_id')->nullable();
            $table->integer('academic_id')->nullable();
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
        Schema::dropIfExists('student_sibling_records');
    }
};
