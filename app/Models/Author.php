<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'profile_picture',
        'biography',
        'website',
        'social_links', // single JSON column
    ];

    protected $casts = [
        'social_links' => 'array', // Cast JSON to array automatically
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}