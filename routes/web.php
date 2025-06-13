<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\BlogController;



Route::get('/', [PageController::class, 'showEnglish'])->name('home');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');


Route::prefix('admin/paginas')->middleware(['auth'])->group(function () {
    // EXISTENTES
    Route::get('/en', [PaginaController::class, 'editarEn'])->name('paginas.editar.en');
    Route::get('/es', [PaginaController::class, 'editarglobal'])->name('paginas.editar.es');
    Route::post('/en', [PaginaController::class, 'updateEn'])->name('contenido-ingles.update');

    // NUEVAS: para trabajar el sistema dinámico
    Route::get('/', [PaginaController::class, 'index'])->name('paginas.index');
    Route::get('/{pagina}/secciones', [PaginaController::class, 'secciones'])->name('paginas.secciones');
    Route::get('/{pagina}/secciones/{seccion}/edit', [PaginaController::class, 'editSeccion'])->name('paginas.secciones.edit');
    Route::post('/{pagina}/secciones/{seccion}/update', [PaginaController::class, 'updateSeccion'])->name('paginas.secciones.update');
});


// web.php

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/articulos', [BlogController::class, 'adminIndex'])->name('admin.blog.index');
    Route::get('/articulos/crear', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/articulos', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/articulos/{articulo}/editar', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/articulos/{articulo}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/articulos/{articulo}', [BlogController::class, 'destroy'])->name('blog.destroy');
});

Route::post('/blog/upload', [BlogController::class, 'upload'])->name('blog.upload');


Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/sobre-mi', [PageController::class, 'sobreMi'])->name('sobre-mi');
Route::get('/lo-que-hago', [PageController::class, 'loQueHago'])->name('lo-que-hago');
Route::get('/hostella', [PageController::class, 'hostella'])->name('hostella');
Route::get('/prensa-eventos', [PageController::class, 'prensaEventos'])->name('prensa-eventos');
Route::get('/contacto', [PageController::class, 'contacto'])->name('contacto');


Route::get('/admin/global', [GlobalController::class, 'index'])->name('global.index');
Route::post('/admin/global/update', [GlobalController::class, 'update'])->name('global.update');


Route::get('/Alberto Ascencion', [PageController::class, 'showEnglish'])->name('Alberto Ascencion');


require __DIR__.'/auth.php';
