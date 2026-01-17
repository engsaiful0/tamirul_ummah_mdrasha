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
        Schema::table('sm_parents', function (Blueprint $table) {
            //
            $table->string('father_education', 200)->nullable();
            $table->string('mother_education', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sm_parents', function (Blueprint $table) {
            //
        });
    }
};
