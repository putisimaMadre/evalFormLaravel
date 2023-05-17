<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoActividad extends Model
{
    protected $fillable = [
        'idAlumno',
        'idActividad',
        'status'
    ];
}
