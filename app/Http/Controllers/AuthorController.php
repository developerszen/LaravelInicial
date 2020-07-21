<?php


namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    function index() {
        $records = Author::all();

        return $records;
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);

        $record = Author::create([
            'name' => $request->input('name'),
        ]);

        return $record;
    }

    function show($author) {
        $record = Author::findOrFail($author);

        return response()->json($record, 201);
    }

    function update(Request $request, $author) {

        $request->validate([
            'name' => 'required',
        ]);

        $record = Author::findOrFail($author);

        $record->update([
            'name' => $request->input('name'),
        ]);

        return $record;
    }

    function destroy($author) {
        $record = Author::findOrFail($author);

        $record->delete();

        return response([], 204);
    }
}
