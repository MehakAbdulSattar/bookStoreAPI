<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        $books = [
            [
                'title' => 'Book 1',
                'author' => 'Author 1',
                'cover_image' => 'book1.jpg',
                'description' => 'Description of Book 1',
                'price' => 1900,
            ],
            [
                'title' => 'Book 2',
                'author' => 'Author 2',
                'cover_image' => 'book2.jpg',
                'description' => 'Description of Book 2',
                'price' => 2400,
            ],
            [
                'title' => 'Book 3',
                'author' => 'Author 3',
                'cover_image' => 'book3.jpg',
                'description' => 'Description of Book 3',
                'price' => 2500,
            ],
            [
                'title' => 'Book 4',
                'author' => 'Author 4',
                'cover_image' => 'book4.jpg',
                'description' => 'Description of Book 4',
                'price' => 2499,
            ],
            [
                'title' => 'Book 5',
                'author' => 'Author 5',
                'cover_image' => 'book5.jpg',
                'description' => 'Description of Book 5',
                'price' => 2000,
            ],
        ];

        DB::table('books')->insert($books);
    }
}

