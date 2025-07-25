<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    use HasFactory;
    
    protected $table = 'orderdetail';
    
    protected $fillable = [
        'order_id', 'product_id', 'price', 'qty', 'discount', 'amount'
    ];
}
