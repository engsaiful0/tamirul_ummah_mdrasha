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
        Schema::table('sm_schools', function (Blueprint $table) {
            //
            $table->string('contact_person')->nullable();
            $table->integer('no_of_students')->nullable();
            $table->string('major_mudule')->nullable();
            $table->string('present_system')->nullable();
            $table->text('pro_desc')->nullable();
            $table->text('cons_desc')->nullable();
            $table->string('management_type')->nullable();
            $table->string('management_category')->nullable();
            $table->string('school_category')->nullable();
            $table->string('type_of_school')->nullable();
            $table->string('year_of_establishment')->nullable();
            $table->integer('plan_id')->nullable();
            $table->double('plan_price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sm_schools', function (Blueprint $table) {
            //
        });
    }
};
