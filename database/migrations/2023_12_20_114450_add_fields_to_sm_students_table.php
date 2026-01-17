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
            $table->string('fathers_email', 200)->nullable();
            $table->string('mothers_email', 200)->nullable();
            $table->text('parent_address')->nullable();
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
