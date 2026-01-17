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
        Schema::table('sm_exam_types', function (Blueprint $table) {
            $table->integer('name_of_the_type')->after('parent_id')->comment('1-Daily,2-Monthly-3-Weekly,4-Cycle,5-Term');
        });
    }

    public function down()
    {
        Schema::table('sm_exam_types', function (Blueprint $table) {
            $table->dropColumn('name_of_the_type');
        });
    }
};
