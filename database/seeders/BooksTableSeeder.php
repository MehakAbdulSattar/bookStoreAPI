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
                'cover_image_url' => 'https://images-platform.99static.com//vGEbt__X8_WyHZstQwBt4DbrhoI=/883x227:1668x1012/fit-in/590x590/99designs-contests-attachments/80/80482/attachment_80482256',
                'description' => 'Description of Book 1',
                'price' => 1900,
            ],
            [
                'title' => 'Book 2',
                'author' => 'Author 2',
                'cover_image_url' => 'https://www.jdandj.com/uploads/8/0/0/8/80083458/nook-ebook-cover-design-orig-webp_orig.webp',
                'description' => 'Description of Book 2',
                'price' => 2400,
            ],
            [
                'title' => 'Book 3',
                'author' => 'Author 3',
                'cover_image_url' => 'https://www.creativindiecovers.com/wp-content/uploads/2013/08/5Christian.jpg',
                'description' => 'Description of Book 3',
                'price' => 2500,
            ],
            [
                'title' => 'Book 4',
                'author' => 'Author 4',
                'cover_image_url' => 'https://www.ts95studios.com/images/Subpage%20Images/graphic%20design/bookcovers/ARoseintheSnow_DarkFantasyBookCoverDesign.jpg',
                'description' => 'Description of Book 4',
                'price' => 2499,
            ],
            [
                'title' => 'Book 5',
                'author' => 'Author 5',
                'cover_image_url' => 'https://blog-cdn.reedsy.com/directories/gallery/78/large_649eadedf5dcdd97768824de1a48c6da.jpeg',
                'description' => 'Description of Book 5',
                'price' => 2000,
            ],
        ];

        DB::table('books')->insert($books);
    }
}

