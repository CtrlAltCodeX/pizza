<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientsMaster extends Model
{
    protected $table = 'ingredients_master';
    protected $fillable = [
      'based_on',
      'used_in',
      'name',
      'price',
      'img',
    ];
}
