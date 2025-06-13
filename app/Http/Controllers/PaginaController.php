<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\GlobalSetting;
use App\Models\Pagina;
use App\Models\Seccion;
use App\Models\Contenido;
use Illuminate\Support\Str;


class PaginaController extends Controller
{
    public function updateEn(Request $request)
    {
        try {
            // LIMPIAR LA SESIÓN DE OLD INPUT CORRUPTO
            session()->forget('_old_input');

            // Debug los datos reales del request
            \Log::info('=== DATOS REALES DEL REQUEST ===', $request->all());

            // Buscar si existe un registro
            $contenido = DB::table('contenido_ingles')->first();

            $data = [];

            // Procesar Hero Carousel (1 a 4) - VERSIÓN DIRECTA SIN FILTROS
            for ($i = 1; $i <= 4; $i++) {
                // Solo agregar si existe en el request (sin validar null)
                if ($request->has("h1_hero_carrusel_$i")) {
                    $data["h1_hero_carrusel_$i"] = $request->input("h1_hero_carrusel_$i");
                }
                if ($request->has("p_hero_carrusel_$i")) {
                    $data["p_hero_carrusel_$i"] = $request->input("p_hero_carrusel_$i");
                }
                if ($request->has("a_hero_carrusel_$i")) {
                    $data["a_hero_carrusel_$i"] = $request->input("a_hero_carrusel_$i");
                }

                // Procesar imagen del carrusel
                if ($request->hasFile("img_hero_carrusel_$i")) {
                    // Eliminar imagen anterior si existe
                    if ($contenido && isset($contenido->{"img_hero_carrusel_$i"})) {
                        $oldImage = $contenido->{"img_hero_carrusel_$i"};
                        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }

                    $file = $request->file("img_hero_carrusel_$i");
                    $filename = time() . "_hero_$i." . $file->getClientOriginalExtension();
                    $path = $file->storeAs('contenido_ingles/hero', $filename, 'public');
                    $data["img_hero_carrusel_$i"] = $path;
                }
            }

            // Procesar About Us
            if ($request->has('h2_about_us')) {
                $data['h2_about_us'] = $request->input('h2_about_us');
            }
            if ($request->has('p_about_us')) {
                $data['p_about_us'] = $request->input('p_about_us');
            }

            if ($request->hasFile('img_about_us')) {
                // Eliminar imagen anterior si existe
                if ($contenido && $contenido->img_about_us && Storage::disk('public')->exists($contenido->img_about_us)) {
                    Storage::disk('public')->delete($contenido->img_about_us);
                }

                $file = $request->file('img_about_us');
                $filename = time() . "_about." . $file->getClientOriginalExtension();
                $path = $file->storeAs('contenido_ingles/about', $filename, 'public');
                $data['img_about_us'] = $path;
            }

            for ($i = 1; $i <= 4; $i++) {
                if ($request->has("i__about_us_$i")) {
                    $data["i__about_us_$i"] = $request->input("i__about_us_$i");
                }
                if ($request->has("h5__about_us_$i")) {
                    $data["h5__about_us_$i"] = $request->input("h5__about_us_$i");
                }
            }

            // Procesar Services
            if ($request->has('h2_services')) {
                $data['h2_services'] = $request->input('h2_services');
            }

            for ($i = 1; $i <= 4; $i++) {
                if ($request->has("i_services_$i")) {
                    $data["i_services_$i"] = $request->input("i_services_$i");
                }
                if ($request->has("h4__services_$i")) {
                    $data["h4__services_$i"] = $request->input("h4__services_$i");
                }
                if ($request->has("p__services_$i")) {
                    $data["p__services_$i"] = $request->input("p__services_$i");
                }
            }

            // Procesar Portfolio
            if ($request->has('h2_portfolio')) {
                $data['h2_portfolio'] = $request->input('h2_portfolio');
            }

            for ($i = 1; $i <= 6; $i++) {
                if ($request->hasFile("img_portfolio_$i")) {
                    // Eliminar imagen anterior si existe
                    if ($contenido && isset($contenido->{"img_portfolio_$i"})) {
                        $oldImage = $contenido->{"img_portfolio_$i"};
                        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }

                    $file = $request->file("img_portfolio_$i");
                    $filename = time() . "_portfolio_$i." . $file->getClientOriginalExtension();
                    $path = $file->storeAs('contenido_ingles/portfolio', $filename, 'public');
                    $data["img_portfolio_$i"] = $path;
                }
            }

            // Procesar Testimonials
            if ($request->has('h2_testimonials')) {
                $data['h2_testimonials'] = $request->input('h2_testimonials');
            }

            for ($i = 1; $i <= 3; $i++) {
                if ($request->hasFile("img_testimonials_$i")) {
                    // Eliminar imagen anterior si existe
                    if ($contenido && isset($contenido->{"img_testimonials_$i"})) {
                        $oldImage = $contenido->{"img_testimonials_$i"};
                        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }

                    $file = $request->file("img_testimonials_$i");
                    $filename = time() . "_testimonial_$i." . $file->getClientOriginalExtension();
                    $path = $file->storeAs('contenido_ingles/testimonials', $filename, 'public');
                    $data["img_testimonials_$i"] = $path;
                }

                if ($request->has("h5_testimonials_$i")) {
                    $data["h5_testimonials_$i"] = $request->input("h5_testimonials_$i");
                }
                if ($request->has("p_testimonials_city_$i")) {
                    $data["p_testimonials_city_$i"] = $request->input("p_testimonials_city_$i");
                }
                if ($request->has("p_testimonials_$i")) {
                    $data["p_testimonials_$i"] = $request->input("p_testimonials_$i");
                }
            }

            // Procesar Call to Action
            if ($request->has('h2_call')) {
                $data['h2_call'] = $request->input('h2_call');
            }
            if ($request->has('btn_call')) {
                $data['btn_call'] = $request->input('btn_call');
            }

            // Procesar Contact
            if ($request->has('h2_contact_title')) {
                $data['h2_contact_title'] = $request->input('h2_contact_title');
            }
            if ($request->has('p_contact_title')) {
                $data['p_contact_title'] = $request->input('p_contact_title');
            }
            if ($request->has('h4_contact_1')) {
                $data['h4_contact_1'] = $request->input('h4_contact_1');
            }
            if ($request->has('p_contact_1')) {
                $data['p_contact_1'] = $request->input('p_contact_1');
            }
            if ($request->has('h4_contact_email_1')) {
                $data['h4_contact_email_1'] = $request->input('h4_contact_email_1');
            }
            if ($request->has('p_contact_email_1')) {
                $data['p_contact_email_1'] = $request->input('p_contact_email_1');
            }

            // Debug datos finales
            \Log::info('=== DATOS FINALES PARA GUARDAR ===', $data);

            // Agregar timestamp
            $data['updated_at'] = now();

            if ($contenido) {
                $result = DB::table('contenido_ingles')->where('id', $contenido->id)->update($data);
                \Log::info('=== RESULTADO UPDATE ===', ['affected_rows' => $result]);
                $message = 'Contenido en inglés actualizado exitosamente.';
            } else {
                $data['created_at'] = now();
                $result = DB::table('contenido_ingles')->insert($data);
                \Log::info('=== RESULTADO INSERT ===', ['success' => $result]);
                $message = 'Contenido en inglés creado exitosamente.';
            }

            // IMPORTANTE: No usar withInput() para evitar corrupción
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            \Log::error('=== ERROR EN updateEn ===', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'data' => $data ?? [],
                'request_data' => $request->all()
            ]);

            // NO USAR withInput() - esto causa el problema
            return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function editarEn()
    {
        // return view('admin.paginas.editar-en');

        $contenido = DB::table('contenido_ingles')->first();
        return view('admin.paginas.editar-en', compact('contenido'));
    }

    public function editarglobal()

    {
        $global = GlobalSetting::getSettings();

        return view('admin.paginas.editar-es', compact('global'));

        // return view('admin.paginas.editar-es');
    }

    public function index()
    {
        $paginas = Pagina::all();
        return view('admin.paginas.index', compact('paginas'));
    }

    public function secciones(Pagina $pagina)
    {
        // Si es la página del blog, redirige al index del módulo blog
        if ($pagina->slug === 'blog') {
            return redirect()->route('admin.blog.index');
        }

        // De lo contrario, carga las secciones normales
        $secciones = $pagina->secciones()->with('contenidos')->get();
        return view('admin.paginas.secciones', compact('pagina', 'secciones'));
    }


    public function editSeccion(Pagina $pagina, Seccion $seccion)
    {
        $contenidos = $seccion->contenidos->pluck('valor', 'clave');
        return view('admin.paginas.edit-seccion', compact('pagina', 'seccion', 'contenidos'));
    }

    public function updateSeccion(Request $request, Pagina $pagina, Seccion $seccion)
    {
        foreach ($request->all() as $clave => $valor) {
            if ($clave === '_token') continue;

            // Si se subió una nueva imagen
            if ($request->hasFile($clave)) {
                $archivo = $request->file($clave);
                $nombreArchivo = uniqid() . '.' . $archivo->getClientOriginalExtension();
                $ruta = 'uploads/' . $nombreArchivo;
                $archivo->move(public_path('uploads'), $nombreArchivo);

                // Buscar contenido anterior
                $contenidoAnterior = $seccion->contenidos()->where('clave', $clave)->first();
                if ($contenidoAnterior && File::exists(public_path($contenidoAnterior->valor))) {
                    File::delete(public_path($contenidoAnterior->valor)); // borrar imagen anterior
                }

                $seccion->contenidos()->updateOrCreate(['clave' => $clave], ['valor' => $ruta]);
            }

            // Si es texto normal y no imagen
            elseif (!Str::startsWith($clave, 'img_')) {
                $seccion->contenidos()->updateOrCreate(['clave' => $clave], ['valor' => $valor]);
            }
        }

        return redirect()->route('paginas.secciones', $pagina)->with('success', 'Sección actualizada correctamente.');
    }
}
