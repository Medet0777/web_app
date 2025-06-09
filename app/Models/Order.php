<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_NEW = 'новый';
    const STATUS_COMPLETED = 'выполнен';


    protected $fillable = [
        'customer_name',
        'product_id',
        'quantity',
        'status',
        'comment',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->product->price * $this->quantity;
    }
}
