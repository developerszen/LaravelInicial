<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function index() {
        $records = Book::with(['category', 'authors'])->get();

        return $records;
    }

    function store(Request $request) {
        $request->validate([
            'authors' => 'required|array',
            'category_id' => 'required',
            'title' => 'required|string',
            'synopsis' => 'required|string',
            'image' => 'nullable|image'
        ]);

        $record = Book::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'synopsis' => $request->input('synopsis'),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/books', 'public');

            $record->update([
                'image' => $path,
            ]);
        }

        $record->authors()->attach($request->input('authors'));

        return $record;
    }

    function show($book) {
        $record = Book::findOrFail($book);

        return response()->json($record, 201);
    }

    function update(Request $request, $book) {
        $request->validate([
            'authors' => 'required|array',
            'category_id' => 'required',
            'title' => 'required|string',
            'synopsis' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $record = Book::findOrFail($book);

        $record->update([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'synopsis' => $request->input('synopsis'),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/books', 'public');

            $record->update([
                'image' => $path,
            ]);
        }

        $record->authors()->sync($request->input('authors'));

        return $record;
    }

    function destroy($book) {
        $record = Book::findOrFail($book);

        $record->delete();

        return response([], 204);
    }
}
