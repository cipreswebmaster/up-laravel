<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;

    protected $table = "carreras";
    protected $primaryKey = "id_carrera";

    public static $shortWordsException = [
      "tv"
    ];
}
