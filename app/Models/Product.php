<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //Optional database name definition
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price'
    ];
}
