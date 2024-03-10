<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    protected $table = 'item_master';
    protected $fillable = [
        'category_master_id',
        'name',
        'description',

        'sauces',
        'cheese',
        'meat_ingredients',
        'veggies',
        'extra',
        'have_bread',
        'allowedExtraTopping',
        'as_anOption',
        'sauce_on_the_side',

        'calories',

        'price',

        'size',

        'img',
        'status',
    ];
}
