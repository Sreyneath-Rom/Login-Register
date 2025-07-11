<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'author_name'  => $this->author ? $this->author->name : null,
            'categories'   => $this->categories->map(fn($cat) => ['id' => $cat->id, 'name' => $cat->name]),
            'published_at' => $this->published_year,
            'summary'      => $this->summary,
            'cover_image'  => $this->cover_image,
        ];
    }
}