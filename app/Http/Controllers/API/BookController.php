<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return $this->sendResponse(BookResource::collection($books), 'Books retrieved successfully.', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'cover_image' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'published_at' => 'required|date',
            'summary' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors()->toArray(), 422);
        }

        $book = Book::create($request->only('title', 'cover_image', 'author_id', 'published_at', 'summary'));

        return $this->sendResponse(new BookResource($book), 'Book created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return $this->sendResponse(new BookResource($book), 'Book retrieved successfully.', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'cover_image'=> 'nullable|string',
            'author_id' => 'sometimes|required|exists:authors,id',
            'published_at' => 'sometimes|required|date',
            'summary' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors()->toArray(), 422);
        }

        $book = Book::findOrFail($id);
        $book->update($request->only('title', 'cover_image','author_id', 'published_at', 'summary'));

        return $this->sendResponse(new BookResource($book), 'Book updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return $this->sendResponse([], 'Book deleted successfully.', 200);
    }
}