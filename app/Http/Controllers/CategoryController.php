<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index() {
        $categories = Category::withCount('book')->get();

        return $categories;
    }

    function show($id) {
        $category = Category::findOrFail($id);

        return $category;
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = Category::create([
           'name' => $request->input('name'),
        ]);

        return $category;
    }

    function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
           'name' => $request->input('name'),
        ]);

        return $category;
    }

    function edit($id) {
        $category = Category::select('id', 'name')->findOrFail($id);

        return $category;
    }

    function destroy($id) {
        $category = Category::findOrFail($id);

        $relation = $category->book()->exists();

        if($relation) {
            return response()->json([
                'error' => 'Integrity violation',
            ], 500);
        }

        $category->delete();

        return response([], 204);
    }
}
