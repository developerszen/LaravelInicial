<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index() {
        return Category::all();
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:80',
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
        ]);

        return $category;
    }

    function show($category) {
        $category = Category::findOrFail($category);

        return $category;
    }

    function edit($category) {
        $category = Category::select('id', 'name')->findOrFail($category);

        return $category;
    }

    function update(Request $request, $category) {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = Category::findOrFail($category);

        $category->update([
            'name' => $request->input('name'),
        ]);

        return $category;
    }

    function destroy(Category $category)
    {
        $category->delete();

        return response(null, 204);
    }
}
