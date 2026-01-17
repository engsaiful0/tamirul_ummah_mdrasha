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
        Schema::table('sm_schools', function (Blueprint $table) {
            $table->integer('primary_school_id')->nullable()->default(null)->after('contact_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sm_schools', function (Blueprint $table) {
            $table->dropColumn('primary_school_id');
        });
    }
};
