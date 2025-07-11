<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\AuthorResource;
use App\Models\Author;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthorController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return $this->sendResponse(AuthorResource::collection($authors), 'Authors retrieved successfully.', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'biography' => 'nullable|string',
            'profile_picture' => 'nullable|string',
            'website' => 'nullable|url',
            'social_links' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors()->toArray(), 422);
        }

        $author = Author::create($request->only([
            'name',
            'email',
            'biography',
            'profile_picture',
            'website',
            'social_links',
        ]));

        return $this->sendResponse(new AuthorResource($author), 'Author created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::findOrFail($id);
        return $this->sendResponse(new AuthorResource($author), 'Author retrieved successfully.', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'nullable|email|max:255',
            'biography' => 'nullable|string',
            'profile_picture' => 'nullable|string',
            'website' => 'nullable|url',
            'social_links' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors()->toArray(), 422);
        }

        $author = Author::findOrFail($id);
        $author->update($request->only([
            'name',
            'email',
            'biography',
            'profile_picture',
            'website',
            'social_links',
        ]));

        return $this->sendResponse(new AuthorResource($author), 'Author updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return $this->sendResponse([], 'Author deleted successfully.', 200);
    }
}