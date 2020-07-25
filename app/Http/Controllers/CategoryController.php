<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index() {
        $records = Category::latest()->get();

        return $records;
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);

        $record = Category::create([
            'name' => $request->input('name'),
        ]);

        return $record;
    }

    function show($category) {
        $record = Category::findOrFail($category);

        return response()->json($record, 201);
    }

    function update(Request $request, $category) {

        $request->validate([
            'name' => 'required',
        ]);

        $record = Category::findOrFail($category);

        $record->update([
            'name' => $request->input('name'),
        ]);

        return $record;
    }

    function destroy($category) {
        $record = Category::findOrFail($category);

        $record->delete();

        return response([], 204);
    }
}
