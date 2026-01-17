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
        Schema::table('sm_exams', function (Blueprint $table) {
            $table->string('exam_code', 50)->after('academic_id');
            $table->string('exam_name', 100)->after('exam_code');
        });
    }

    public function down()
    {
        Schema::table('sm_exams', function (Blueprint $table) {
            $table->dropColumn('exam_code');
            $table->dropColumn('exam_name');
        });
    }
};
