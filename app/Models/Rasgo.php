<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rasgo extends Model
{
    protected $fillable = [
        'rasgo',
        'porcentaje',
        'idAsignatura',
        'status'
    ];
}
