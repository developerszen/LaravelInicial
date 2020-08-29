<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return $books;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'synopsis' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $book = Book::create([
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'synopsis' => $request->input('synopsis'),
        ]);

        if($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('images/books');

            $book->update([
                'image' => $path,
            ]);
        }

        $book->authors()->attach($request->input('authors'));

        return $book;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $book->load([
            'authors' => function($query) {
                return $query->select(['authors.id', 'name']);
            },
            'category' => function($query) {
                return $query->select(['id', 'name']);
            },
            'user' => function($query) {
                return $query->select(['id', 'name']);
            },
            'chapters'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        $request->validate([
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'synopsis' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $path = null;
        $book = Book::findOrFail($book);

        $book->update([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'synopsis' => $request->input('synopsis'),
        ]);

        if($request->hasFile('image')) {
            Storage::delete($book->image);

            $path = $request->file('image')->store('images/books');
        }

        $book->update([
            'image' => $path,
        ]);

        $book->authors()->sync($request->input('authors'));

        return $book;
    }

    function edit($book) {
        $book = Book::select('id', 'category_id', 'title', 'synopsis', 'image')
            ->findOrFail($book);

        $book->authors = $book->authors()->pluck('authors.id')->toArray();

        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([], 204);
    }

    function resources() {
        $categories = Category::all('id', 'name');
        $authors = Author::all('id', 'name');

        return response()->json([
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }
}
