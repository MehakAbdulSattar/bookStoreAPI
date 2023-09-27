<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'book_id' => 'integer',
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
