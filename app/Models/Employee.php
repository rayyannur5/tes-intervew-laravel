<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_employee',
        'entry_date',
        'nama',
        'rank',
        'gender',
    ];

    function spkos()
    {
        return $this->hasMany(Spko::class, 'employee');
    }
}
