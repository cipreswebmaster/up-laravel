<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversidadCarrera extends Model
{
    use HasFactory;

    protected $table = "universidad_carrera";
    protected $primaryKey = "id_universidad_carrera";
}
