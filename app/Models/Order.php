<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status', // Add 'status' to the fillable fields
    ];

    // Define the allowed enum values for 'status'
    public static $statuses = [
        'pending',
        'processing',
        'completed',
        'canceled',
    ];

    // Specify that the 'status' column should be treated as an enum
    protected $casts = [
        'status' => 'string', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
