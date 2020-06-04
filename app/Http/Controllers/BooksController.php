<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Book::all();

        return response()->json([
            'records' => $records
        ]);
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
            'authors' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'synopsis' => 'required',
            'image' => 'nullable|image'
        ]);

        $record = Book::create([
            'user_id' => 1,
            'category_id' => $request->get('category_id'),
            'title' => $request->get('title'),
            'synopsis' => $request->get('synopsis'),
        ]);

        $record->authors()->attach($request->get('authors'));

        if($request->file('image')) {
            $path = Storage::disk('public')->put('images/books', $request->file('image'));
            $record->update([
                'image' => $path
            ]);
        }

        return response()->json([
            'record' => $record
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Book::find($id);

        return response()->json([
            'record' => $record
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'authors' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'synopsis' => 'required',
            'image' => 'nullable'
        ]);

        $record = Book::find($id);

        $record->update([
            'category_id' => $request->get('category_id'),
            'title' => $request->get('title'),
            'synopsis' => $request->get('synopsis')
        ]);

        $record->authors()->sync($request->get('authors'));

        if($request->file('image')) {
            $path = Storage::disk('public')->put('images/books', $request->file('image'));
            $record->update([
                'image' => $path
            ]);
        }

        return response()->json([
            'record' => $record
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Book::find($id);

        $record->delete();

        return response()->json([]);
    }
}
