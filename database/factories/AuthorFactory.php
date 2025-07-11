<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'biography' => $this->faker->paragraph,
            'profile_picture' => $this->faker->imageUrl(200, 200, 'people'),
            'website' => $this->faker->url,
            'social_links' => json_encode([
                'twitter' => $this->faker->url,
                'facebook' => $this->faker->url,
                'instagram' => $this->faker->url,
                'linkedin' => $this->faker->url,
            ]),
        ];
    }
}