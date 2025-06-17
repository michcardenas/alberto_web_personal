@extends('layouts.app')

@section('title', 'Lo que hago')

@section('content')
@php
$pagina = \App\Models\Pagina::where('slug', 'lo-que-hago')->with('secciones.contenidos')->first();
$seccionServicios = $pagina?->secciones?->firstWhere('slug', 'servicios');
$servicios = $seccionServicios?->contenidos->groupBy(function($item) {
return Str::after($item->clave, '_');
});
@endphp

<style>
    :root {
        --brand-primary: #2d3c43;
        --brand-dark: #0c3b3b;
        --brand-beige: #d5c6b1;
        --brand-gray: #2a2a2a;
        --brand-light: #f5f4ef;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--brand-dark);
    }

    .service-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: var(--brand-light);
        border-radius: 20px;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    }

    .icon-circle {
        width: 80px;
        height: 80px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: var(--brand-beige);
        color: var(--brand-gray);
        transition: all 0.3s ease;
        font-size: 2rem;
    }

    .service-card:hover .icon-circle {
        background-color: var(--brand-primary);
        color: white;
        transform: scale(1.1);
    }

    .card-title {
        color: var(--brand-dark);
    }

    .card-text {
        color: var(--brand-gray);
        font-size: 0.95rem;
    }
</style>

<section class="py-5" style="background-color: var(--brand-light);">
    <div class="container">
        <h1 class="section-title text-center mb-3" data-aos="fade-up">
            {{ $contenidos['h1_lo_que_hago'] ?? 'Lo que hago' }}
        </h1>

        <h2 class="text-center mb-5" data-aos="fade-up" data-aos-delay="100">
            {{ $contenidos['h2_subtitulo_lo_que_hago'] ?? 'Acompañándote en cada paso del diseño' }}
        </h2>

        <div class="row g-4">
            @foreach ($servicios ?? [] as $grupo)
    @php
        $index = Str::after($grupo->first()->clave, '_');
        $titulo = $grupo->firstWhere('clave', 'titulo_' . $index);
        $descripcion = $grupo->firstWhere('clave', 'descripcion_' . $index);
        $icono = $grupo->firstWhere('clave', 'icono_' . $index);
    @endphp
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 100 * $loop->index }}">
        <div class="card service-card shadow-sm p-4 h-100 border-0">
            <div class="text-center mb-3">
                <div class="icon-circle">
                    <i class="{{ $icono->valor ?? 'fas fa-star' }}"></i>
                </div>
            </div>
            <div class="text-center">
                <h5 class="card-title">{{ $titulo->valor ?? 'Servicio' }}</h5>
                <p class="card-text">{{ $descripcion->valor ?? '' }}</p>
            </div>
        </div>
    </div>
@endforeach
        </div>
    </div>
</section>

@endsection