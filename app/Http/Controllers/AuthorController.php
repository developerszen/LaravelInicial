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
            'name' => 'required'
        ]);


    }
}
