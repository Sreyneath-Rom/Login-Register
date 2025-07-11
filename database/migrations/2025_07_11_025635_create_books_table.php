<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method defines and creates the `books` table in the database.
     * It includes columns for the book title, foreign key to authors, publication date, summary, and timestamps.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (bigint)
            $table->string('title'); // Book title (required)
            $table->string('cover_image')->nullable(); // Optional cover image URL

            // Foreign key to authors table
            $table->foreignId('author_id')
                ->constrained('authors') // References 'id' on 'authors' table
                ->OnUpdate('cascade') // Updates author_id if the referenced author is updated
                ->onDelete('cascade');   // Deletes books when corresponding author is deleted

            $table->date('published_at'); // Publication date (required)
            $table->text('summary')->nullable(); // Optional summary of the book

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the `books` table if it exists.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};