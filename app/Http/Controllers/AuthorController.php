<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    function index() {
        return Author::latest()->get();
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
        $author->delete();

        return response(null, 204);
    }
}
