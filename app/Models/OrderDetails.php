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

    public function users()
    {
        return $this->belongsTo(User::class, 'igredients_used_id', 'id');
    }

    public function item_master()
    {
        return $this->belongsTo(ItemMaster::class, 'item_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
