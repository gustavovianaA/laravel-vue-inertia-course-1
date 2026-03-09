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
        'cover',
        'price',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
