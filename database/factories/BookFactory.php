<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'author_id' => Author::factory(), // Will create an author automatically if needed
            'cover_image' => $this->faker->imageUrl(640, 480, 'books'),
            'published_at' => $this->faker->date(),
            'summary' => $this->faker->paragraph,
        ];
    }
}