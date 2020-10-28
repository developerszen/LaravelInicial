<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(Request $request) {
        return Category::latest()
            ->when($request->has('name'), function ($query) use ($request) {
                $name = $request->query('name');
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->select('id', 'name', 'created_at')
            ->withCount('book')
            ->paginate(5);
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
        $relation = $category->book()->exists();

        if($relation) {
            return response([
                'error' => 'Integrity violation',
            ], 500);
        }

        $category->delete();

        return response(null, 204);
    }
}
