<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spko extends Model
{
    use HasFactory;

    protected $primaryKey = "id_spko";

    protected $fillable = [
        'remarks',
        'employee',
        'trans_date',
        'process',
        'sw',
    ];

    function employee_user()
    {
        return $this->belongsTo(Employee::class, 'employee', ownerKey:'id_employee');
    }

    function spko_items()
    {
        return $this->hasMany(SpkoItem::class, 'idm');
    }
}
