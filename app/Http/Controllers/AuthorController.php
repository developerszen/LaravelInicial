<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    function index() {
        $authors = Author::all();
        return $authors;
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
        ]);

        return 'Autor';
    }
}
