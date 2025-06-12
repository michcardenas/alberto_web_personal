<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contenido extends Model
{
    use HasFactory;

    protected $fillable = ['seccion_id', 'clave', 'valor'];

    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }
}
