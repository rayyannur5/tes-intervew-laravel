<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkoItem extends Model
{
    use HasFactory;

    protected $primaryKey = ['idm', 'ordinal'];
    public $incrementing = false;

    protected $fillable = [
        'idm',
        'ordinal',
        'id_product',
        'qty'
    ];

    public function getKeyName()
    {
        return $this->primaryKey;
    }

    function spko()
    {
        return $this->belongsTo(Spko::class, 'idm');
    }

    function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
