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
                'title' => 'Book_1',
                'author' => 'Author_1',
                'cover_image_url' => 'https://images-platform.99static.com//vGEbt__X8_WyHZstQwBt4DbrhoI=/883x227:1668x1012/fit-in/590x590/99designs-contests-attachments/80/80482/attachment_80482256',
                'description' => 'Description of Book 1',
                'price' => 1900,
            ],
                [
                'title' => 'Book_6',
                'author' => 'Author_1',
                'cover_image_url' => 'https://marketplace.canva.com/EAFIXDLLYuk/1/0/1003w/canva-beige-vintage-novel-book-cover-6g3oGeWsw4k.jpg',
                'description' => 'Description of Book 6',
                'price' => 1700,
            ],
            [
                'title' => 'Book_2',
                'author' => 'Author_2',
                'cover_image_url' => 'https://www.jdandj.com/uploads/8/0/0/8/80083458/nook-ebook-cover-design-orig-webp_orig.webp',
                'description' => 'Description of Book 2',
                'price' => 2400,
            ],
            [
                'title' => 'Book_3',
                'author' => 'Author_3',
                'cover_image_url' => 'https://www.creativindiecovers.com/wp-content/uploads/2013/08/5Christian.jpg',
                'description' => 'Description of Book 3',
                'price' => 2400,
            ],
            [
                'title' => 'Book_4',
                'author' => 'Author_4',
                'cover_image_url' => 'https://www.ts95studios.com/images/Subpage%20Images/graphic%20design/bookcovers/ARoseintheSnow_DarkFantasyBookCoverDesign.jpg',
                'description' => 'Description of Book 4',
                'price' => 2499,
            ],
            [
                'title' => 'Book_5',
                'author' => 'Author_5',
                'cover_image_url' => 'https://blog-cdn.reedsy.com/directories/gallery/78/large_649eadedf5dcdd97768824de1a48c6da.jpeg',
                'description' => 'Description of Book 5',
                'price' => 2000,
            ],
            [
                'title' => 'Book_5',
                'author' => 'Author_7',
                'cover_image_url' => 'https://img.buzzfeed.com/buzzfeed-static/static/2020-12/21/0/asset/f69da90b1e93/sub-buzz-5094-1608511484-18.jpg',
                'description' => 'Description of Book 5',
                'price' => 3000,
            ],
        ];


        \App\Models\User::factory(10)->create();

        $user=\App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password'=> 'admin@123',
        ]);

        
        $user->assignRole('Admin');

        
        DB::table('books')->insert($books);
    }
}

