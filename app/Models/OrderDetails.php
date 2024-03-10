<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_details';
    protected $fillable = [
        'orderMaster_id',
        'item_id',
        'name',
        'quantity',
        'price',
        'size',
        'category_id',
        'category_name',
        'igredients_used_id',
    ];
}
