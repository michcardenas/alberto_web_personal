<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Articulo;

class BlogController extends Controller
{
    // Vista pública del blog
    public function index()
    {
        $articulos = Articulo::latest()->get();
        return view('paginas.blog', compact('articulos')); // vista pública
    }

    // Vista pública de un artículo individual
    public function show($slug)
    {
        $articulo = Articulo::where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('articulo'));
    }

    // Vista del panel admin: listar artículos
    public function adminIndex()
    {
        $articulos = Articulo::latest()->get();
        return view('admin.blog.index', compact('articulos'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:articulos,slug',
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        // Slug automático si no se especifica
        $data['slug'] = $data['slug'] ?? \Str::slug($data['titulo']);

          // 🔥 Limpia enlaces tipo <a> con nombres de imágenes
        $data['contenido'] = preg_replace('/<a[^>]*>[^<]+\.(jpg|jpeg|png|gif)<\/a>/i', '', $data['contenido']);

        if ($request->hasFile('imagen')) {
            $nombreArchivo = uniqid() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(public_path('uploads/articulos'), $nombreArchivo);
            $data['imagen'] = 'uploads/articulos/' . $nombreArchivo;
        }

        Articulo::create($data);

        return redirect()->route('admin.blog.index')->with('success', 'Artículo creado correctamente.');
    }



    // Mostrar formulario de edición
    public function edit(Articulo $articulo)
    {
        return view('admin.blog.edit', compact('articulo'));
    }

    public function update(Request $request, Articulo $articulo)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:articulos,slug,' . $articulo->id,
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        // Si no se provee slug, lo generamos del título
        $data['slug'] = $data['slug'] ?? \Str::slug($data['titulo']);
        // 🔥 Limpia enlaces tipo <a> con nombres de imágenes
    $data['contenido'] = preg_replace('/<a[^>]*>[^<]+\.(jpg|jpeg|png|gif)<\/a>/i', '', $data['contenido']);

        if ($request->hasFile('imagen')) {
            // Elimina la imagen anterior si existe
            if ($articulo->imagen && \File::exists(public_path($articulo->imagen))) {
                \File::delete(public_path($articulo->imagen));
            }

            // Guarda nueva imagen en public/uploads/articulos/
            $nombreArchivo = uniqid() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(public_path('uploads/articulos'), $nombreArchivo);
            $data['imagen'] = 'uploads/articulos/' . $nombreArchivo;
        }

        $articulo->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Artículo actualizado correctamente.');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nombreArchivo = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/articulos'), $nombreArchivo);

            return response()->json([
                'url' => asset('uploads/articulos/' . $nombreArchivo),
            ]);
        }

        return response()->json(['error' => 'No se subió ningún archivo'], 400);
    }


    // Eliminar artículo
    public function destroy(Articulo $articulo)
    {
        if ($articulo->imagen && \Storage::disk('public')->exists($articulo->imagen)) {
            \Storage::disk('public')->delete($articulo->imagen);
        }

        $articulo->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Artículo eliminado.');
    }
}
