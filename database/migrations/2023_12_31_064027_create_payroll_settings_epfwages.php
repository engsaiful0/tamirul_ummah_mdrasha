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
        Schema::create('payroll_settings_epfwages', function (Blueprint $table) {
            $table->id();
            $table->double('epfwages')->default(0);
            $table->double('epf')->default(0);
            $table->double('eps')->default(0);
            $table->string('esi_salary_limit', 200)->nullable();
            $table->string('da_allawance', 200)->nullable();
            $table->integer('school_id')->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_settings_epfwages');
    }
};
