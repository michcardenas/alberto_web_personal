<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Articulo extends Model
{
    protected $fillable = ['titulo', 'slug', 'descripcion', 'contenido', 'imagen'];

    protected static function booted()
    {
        static::creating(function ($articulo) {
            $articulo->slug = $articulo->slug ?? Str::slug($articulo->titulo);
        });
    }
}
