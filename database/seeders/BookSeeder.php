<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        $books = Book::factory(50)->make();

        $books->each(function ($book) use ($categories) {
            $book->category_id = $categories->random()->id;
            $book->save();

            $book->authors()->attach([1, 6]);
        });
    }
}
