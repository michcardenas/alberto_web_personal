<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Seo;

class Pagina extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug'];

    public function secciones()
    {
        return $this->hasMany(Seccion::class);
    }

    public function seo()
    {
        return $this->hasOne(Seo::class, 'pagina_id');
    }
}
