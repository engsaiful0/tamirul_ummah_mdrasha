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
        Schema::create('book_bulk_temporaries', function (Blueprint $table) {
            $table->id();
            $table->string('book_title', 200);
            $table->integer('book_category_id');
            $table->integer('book_subject_id');
            $table->string('book_number', 200);
            $table->string('isbn_no', 200);
            $table->string('publisher_name', 200);
            $table->string('author_name', 200);
            $table->string('rack_number', 50);
            $table->integer('quantity');
            $table->integer('book_price');
            $table->string('details', 200);
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_bulk_temporaries');
    }
};
