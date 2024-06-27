<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = "id_product";

    protected $fillable = [
        'id_product',
        'sub_category',
        'serial_no',
        'description',
        'carat'
    ];

    function spko_items()
    {
        return $this->hasMany(SpkoItem::class, 'id_product');
    }
}
