<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'address',
        'address',
        'country_code',
        'state',
        'city',
        'zip',
        'payment_method',
        'total',
        'status',
    ];

    public function order_details()
    {
        return $this->hasOne(OrderDetails::class, 'id', 'orderMaster_id');
    }
}
