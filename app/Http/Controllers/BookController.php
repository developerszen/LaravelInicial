<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    function index() {
        $books = Book::all();

        return $books;
    }

    function store(Request $request) {
        $request->validate([
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'synopsis' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $book = Book::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'synopsis' => $request->input('synopsis'),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/books');

            $book->update([
                'image' => $path,
            ]);
        }

        $book->authors()->attach($request->input('authors'));

        return $book;
    }

    function show($book) {
        $book = Book::with([
            'authors' => function($query) {
                return $query->select('authors.id', 'name');
            },
            'category' => function($query) {
                return $query->select('id', 'name');
            },
            'user' => function($query) {
                return $query->select('id', 'name');
            },
        ])->findOrFail($book);

        return $book;
    }

    function edit($book) {
        return Book::with([
            'authors' => function($query) {
                return $query->select('authors.id', 'name');
            },
            'category' => function($query) {
                return $query->select('id', 'name');
            },
        ])
            ->select('id', 'category_id', 'title', 'synopsis', 'image')
            ->findOrFail($book);
    }

    function update(Request $request, Book $book) {
        $request->validate([
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'synopsis' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $path = null;

        $book->update([
           'category_id' => $request->input('category_id'),
           'title' => $request->input('title'),
           'synopsis' => $request->input('synopsis'),
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($book->image);

            $path = $request->file('image')->store('images/books');
        }

        $book->update([
            'image' => $path,
        ]);

        $book->authors()->sync($request->input('authors'));

        return $book;
    }

    function destroy(Book $book) {
        $book->delete();

        return response(null, 204);
    }
}
