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
        Schema::table('sm_general_settings', function (Blueprint $table) {
            $table->text('email_footer_content')->nullable()->default(null)->after('teacher_phone_view');
        });
    }

    public function down()
    {
        Schema::table('sm_general_settings', function (Blueprint $table) {
            $table->dropColumn('email_footer_content');
        });
    }
};
