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
        Schema::create('sm_extra_curricular_fees_payments', function (Blueprint $table) {
            $table->id();
            $table->double('discount_amount', 8, 2)->nullable();
            $table->double('fine', 8, 2)->nullable();
            $table->double('amount', 10, 2)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_mode', 100)->nullable();
            $table->text('note')->nullable();
            $table->string('slip', 191)->nullable();
            $table->string('fine_title', 191)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();
            $table->integer('assign_id')->nullable();
            $table->integer('bank_id')->nullable();
            $table->integer('extra_curricular_record_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->integer('school_id')->default(1);
            $table->integer('academic_id')->default(1);
            $table->integer('installment_payment_id')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sm_extra_curricular_fees_payments');
    }
};
