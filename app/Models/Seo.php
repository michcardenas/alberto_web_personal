<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';

    protected $fillable = [
        'pagina_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'og_url',
        'og_type',
        'canonical',
        'slug',
    ];

    public function pagina()
    {
        return $this->belongsTo(Pagina::class, 'pagina_id');
    }
}
