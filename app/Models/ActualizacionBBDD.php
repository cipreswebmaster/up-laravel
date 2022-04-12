<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualizacionBBDD extends Model
{
    use HasFactory;
    protected $table = "actualizaciones";
    protected $primaryKey = "id_actualizacion";
    protected $guarded = [];
}
