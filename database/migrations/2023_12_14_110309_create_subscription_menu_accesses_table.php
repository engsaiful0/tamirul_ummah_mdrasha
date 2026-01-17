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
        Schema::create('subscription_menu_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name')->nullable();
            $table->integer('plan_id')->nullable();
            $table->integer('permission_id')->nullable();//menu_id
            $table->double('price')->default(0);
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_menu_accesses');
    }
};
