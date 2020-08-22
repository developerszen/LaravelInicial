<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    function index() {
        $authors = Author::all();

        return $authors;
    }

    function show($id) {
        $author = Author::findOrFail($id);

        return response($author);
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

    function update(Request $request, $id) {
        $request->validate([
           'name' => 'required|string|max:80',
        ]);

        $author = Author::findOrFail($id);

        $author->update([
            'name' => $request->input('name'),
        ]);

        return $author;
    }

    function edit($id) {
        $author = Author::select('id', 'name')->findOrFail($id);

        return $author;
    }

    function destroy($id) {
        $author = Author::findOrFail($id);

        $author->delete();

        return response([], 204);
    }
}
















