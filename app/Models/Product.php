<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategory_id',
        'product_name',
        'description',
        'image',
        'old_price',
        'new_price',
        'product_slug',
    ];


    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

}
