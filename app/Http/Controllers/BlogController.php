<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Articulo;
use App\Models\Seccion;

class BlogController extends Controller
{
    // Vista pública del blog
    public function index()
    {
        $articulos = Articulo::latest()->get();

        $seccion = Seccion::where('pagina_id', 4)->where('slug', 'encabezado')->first();
        $contenidos = $seccion?->contenidos()->pluck('valor', 'clave')->toArray() ?? [];

        return view('paginas.blog', compact('articulos', 'contenidos'));
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

        $seccion = Seccion::where('pagina_id', 4)->where('slug', 'encabezado')->first();
        $contenidos = $seccion?->contenidos()->pluck('valor', 'clave')->toArray() ?? [];

        return view('admin.blog.index', compact('articulos', 'seccion', 'contenidos'));
    }

    public function actualizarEncabezado(Request $request, Seccion $seccion)
    {
        $seccion->contenidos()->updateOrCreate(['clave' => 'titulo_blog'], ['valor' => $request->input('titulo_blog')]);
        $seccion->contenidos()->updateOrCreate(['clave' => 'descripcion_blog'], ['valor' => $request->input('descripcion_blog')]);

        return back()->with('success', 'Encabezado actualizado correctamente.');
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
        $data['slug'] = $data['slug'] ?? Str::slug($data['titulo']);

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

        $data['slug'] = $data['slug'] ?? Str::slug($data['titulo']);
        $data['contenido'] = preg_replace('/<a[^>]*>[^<]+\.(jpg|jpeg|png|gif)<\/a>/i', '', $data['contenido']);

        if ($request->hasFile('imagen')) {
            if ($articulo->imagen) {
                $rutaCompleta = '/home/u274930358/domains/navajowhite-locust-675711.hostingersite.com/alberto_web_personal/public_html/' . $articulo->imagen;
                if (File::exists($rutaCompleta)) {
                    File::delete($rutaCompleta);
                }
            }

            $nombreArchivo = uniqid() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move('/home/u274930358/domains/navajowhite-locust-675711.hostingersite.com/alberto_web_personal/public_html/uploads/articulos', $nombreArchivo);
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
            $file->move('/home/u274930358/domains/navajowhite-locust-675711.hostingersite.com/alberto_web_personal/public_html/uploads/articulos', $nombreArchivo);

            return response()->json([
                'url' => asset('uploads/articulos/' . $nombreArchivo),
            ]);
        }

        return response()->json(['error' => 'No se subió ningún archivo'], 400);
    }



    public function destroy(Articulo $articulo)
    {
        if ($articulo->imagen) {
            $rutaCompleta = '/home/u274930358/domains/navajowhite-locust-675711.hostingersite.com/alberto_web_personal/public_html/' . $articulo->imagen;
            if (File::exists($rutaCompleta)) {
                File::delete($rutaCompleta);
            }
        }

        $articulo->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Artículo eliminado.');
    }
}
