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
            $table->integer('emis_id')->nullable();
            $table->string('pin_code', 200)->nullable();
            $table->string('medium_of_instruction', 200)->nullable();
            $table->string('disability_group_name', 200)->nullable();
            $table->string('group_code', 200)->nullable();
            $table->string('medium', 200)->nullable();

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
