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
        Schema::create('sm_transport_fees_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('month_id')->nullable();
            $table->string('month')->nullable();
            $table->float('amount', 10, 2)->nullable();
            $table->float('assigned_route_fees', 10, 2)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_mode', 100)->nullable();
            $table->text('note')->nullable();
            $table->string('slip')->nullable();
            $table->tinyInteger('active_status')->default(1);

            $table->integer('bank_id')->nullable()->unsigned();
            $table->foreign('bank_id')->references('id')->on('sm_bank_accounts')->onDelete('cascade');
            
            $table->integer('route_id')->nullable();
            $table->integer('record_id')->nullable()->unsigned();
            $table->integer('student_id')->nullable()->unsigned();
            $table->foreign('student_id')->references('id')->on('sm_students')->onDelete('cascade');

            $table->integer('created_by')->nullable()->default(1)->unsigned();

            $table->integer('updated_by')->nullable()->default(1)->unsigned();

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('cascade');
            
            $table->integer('academic_id')->nullable()->default(1)->unsigned();
            $table->foreign('academic_id')->references('id')->on('sm_academic_years')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_transport_fees_payments');
    }
};
