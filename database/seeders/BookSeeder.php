<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::factory()->count(10)->create()->each(function ($book) {
            $categoryIds = Category::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray();

            if (!empty($categoryIds)) {
                $book->categories()->attach($categoryIds);
            }
        });
    }
}