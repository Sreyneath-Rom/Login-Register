<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Fiction', 'Science', 'Technology', 'History'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}