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
        // Drop the existing foreign key constraint
        Schema::table('sm_exam_attendances', function (Blueprint $table) {
            $table->dropForeign('sm_exam_attendances_exam_id_foreign');
        });

        // Add a new foreign key constraint
        Schema::table('sm_exam_attendances', function (Blueprint $table) {
            $table->foreign('exam_id')
                ->references('id')->on('sm_exam_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        // Drop the new foreign key constraint
        Schema::table('sm_exam_attendances', function (Blueprint $table) {
            $table->dropForeign('exam_id');
        });

        // Add back the old foreign key constraint
        Schema::table('sm_exam_attendances', function (Blueprint $table) {
            $table->foreign('exam_id')
                ->references('id')->on('sm_exam_types');
        });
    }
};
