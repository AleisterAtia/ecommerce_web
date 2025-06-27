<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $table = 'arhab_products';
    protected $guarded = []; // tidak ada field yang dilindungi, semua bisa diisi

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
