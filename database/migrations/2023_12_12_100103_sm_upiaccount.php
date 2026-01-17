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
        Schema::create('sm_upi_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('upi_id', 200)->nullable();
            $table->string('upi_name', 200)->nullable();
            $table->text('note');
            $table->integer('school_id');
            $table->integer('academic_id')->nullable();
            $table->integer('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_upi_accounts');
    }
};
