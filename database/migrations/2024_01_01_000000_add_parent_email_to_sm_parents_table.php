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
        Schema::table('sm_parents', function (Blueprint $table) {
            // Remove parent_email if it exists
            if (Schema::hasColumn('sm_parents', 'parent_email')) {
                $table->dropColumn('parent_email');
            }
            // Add fathers_email and mothers_email if they don't exist
            if (!Schema::hasColumn('sm_parents', 'fathers_email')) {
                $table->string('fathers_email', 200)->nullable()->after('fathers_mobile');
            }
            if (!Schema::hasColumn('sm_parents', 'mothers_email')) {
                $table->string('mothers_email', 200)->nullable()->after('mothers_mobile');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sm_parents', function (Blueprint $table) {
            if (Schema::hasColumn('sm_parents', 'fathers_email')) {
                $table->dropColumn('fathers_email');
            }
            if (Schema::hasColumn('sm_parents', 'mothers_email')) {
                $table->dropColumn('mothers_email');
            }
            // Restore parent_email if needed
            if (!Schema::hasColumn('sm_parents', 'parent_email')) {
                $table->string('parent_email', 200)->nullable()->after('guardians_email');
            }
        });
    }
};

