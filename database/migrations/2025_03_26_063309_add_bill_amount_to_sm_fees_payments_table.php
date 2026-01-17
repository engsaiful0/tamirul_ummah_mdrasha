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
        Schema::table('sm_fees_payments', function (Blueprint $table) {
            $table->string('bill_amount')->nullable()->after('installment_payment_id'); // Replace 'column_name' with the actual column name you want to position it after.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sm_fees_payments', function (Blueprint $table) {
            $table->dropColumn('bill_amount');
        });
    }
};
