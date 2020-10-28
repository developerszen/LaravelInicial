<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    function index(Request $request) {
        return Author::latest()
            ->when($request->has('name'), function ($query) use ($request) {
                $name = $request->query('name');
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->select('id', 'name', 'created_at')
            ->withCount('books')
            ->paginate(5);
    }

    function store(AuthorRequest $request) {
        $author = Author::create([
            'name' => $request->input('name'),
        ]);

        return $author;
    }

    function show($author) {
        $author = Author::findOrFail($author);

        return $author;
    }

    function edit($author) {
        $author = Author::select('id', 'name')->findOrFail($author);

        return $author;
    }

    function update(AuthorRequest $request, $author) {
        $author = Author::findOrFail($author);

        $author->update([
            'name' => $request->input('name'),
        ]);

        return $author;
    }

    function destroy(Author $author)
    {
        $relation = $author->books()->count();

        if ($relation) {
            return response([
                'error' => 'Integrity violation',
            ], 500);
        }

        $author->delete();

        return response(null, 204);
    }
}
