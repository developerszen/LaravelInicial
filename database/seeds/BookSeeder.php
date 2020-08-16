<?php

use App\Book;
use App\Category;
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
        $books = factory(Book::class, 40)->make();

        $books->each(function ($book) use ($categories) {
            $category_id = $categories->random()->id;

            $book->category_id = $category_id;
            $book->save();

            $book->authors()->attach([1, 6]);
        });
    }
}
