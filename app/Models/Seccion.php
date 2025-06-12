<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seccion extends Model
{
    use HasFactory;

    protected $table = 'secciones'; // ← ESTA LÍNEA corrige el error

    protected $fillable = ['pagina_id', 'slug', 'titulo'];

    public function pagina()
    {
        return $this->belongsTo(Pagina::class);
    }

    public function contenidos()
    {
        return $this->hasMany(Contenido::class);
    }
}
