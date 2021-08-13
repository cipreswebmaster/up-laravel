<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = "paises";
    protected $primaryKey = "id_pais";

    public function universidades() {
      return $this->hasMany(Universidad::class, "id_pais");
    }
}
