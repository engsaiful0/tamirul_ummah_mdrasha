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
        Schema::create('bank_rejected_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('extracurricular_record_id');
            $table->float('amount');
            $table->text('reason');
            $table->timestamps(6);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bank_rejected_fees');
    }
};
