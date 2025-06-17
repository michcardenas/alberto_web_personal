<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pagina;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    // Listar páginas con su SEO
    public function index()
    {
        $paginas = Pagina::with('seo')->get();
        return view('admin.seo.index', compact('paginas'));
    }

    // Formulario de edición SEO por página
    public function edit(Pagina $pagina)
    {
        $seo = $pagina->seo ?? new Seo();
        return view('admin.seo.edit', compact('pagina', 'seo'));
    }

    // Guardar cambios SEO
    public function update(Request $request, Pagina $pagina)
    {
        $validated = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|max:2048',
            'og_url' => 'nullable|string|max:255',
            'og_type' => 'nullable|string|max:50',
            'canonical' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);

        // Guardar imagen si viene
        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('uploads/seo', 'public');
        }

        // Crear o actualizar SEO
        $seo = $pagina->seo ?? new Seo(['pagina_id' => $pagina->id]);
        $seo->fill($validated);
        $seo->pagina_id = $pagina->id;
        $seo->save();

        return redirect()->route('admin.seo.index')->with('success', 'SEO actualizado correctamente.');
    }
}
