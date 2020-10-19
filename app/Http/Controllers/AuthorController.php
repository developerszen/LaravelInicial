<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    function index() {
        return Author::all();
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:80',
        ]);

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

    function update(Request $request, $author) {
        $request->validate([
            'name' => 'required|string|max:80',
        ]);

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
