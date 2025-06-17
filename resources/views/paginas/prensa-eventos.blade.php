@extends('layouts.app')

@section('title', 'Prensa y Eventos')

@section('content')
@php
$pagina = \App\Models\Pagina::where('slug', 'prensa-eventos')->with('secciones.contenidos')->first();
$seccion = $pagina?->secciones?->firstWhere('slug', 'timeline');
$contenidos = $seccion?->contenidos?->sortBy('clave') ?? collect();

$contenidosEncabezado = $pagina?->secciones?->firstWhere('slug', 'encabezado')?->contenidos?->pluck('valor', 'clave') ?? collect();
$contenidosTimeline = $pagina?->secciones?->firstWhere('slug', 'timeline')?->contenidos?->sortBy('clave') ?? collect();



$eventos = $contenidosTimeline
    ->filter(fn($item) => Str::startsWith($item->clave, 'evento_'))
    ->mapWithKeys(fn($item) => [Str::after($item->clave, 'evento_') => ['texto' => $item->valor]]);

$eventos = $eventos->map(function ($item, $anio) use ($contenidosTimeline) {
    $imagen = $contenidosTimeline->firstWhere('clave', 'img_' . $anio)?->valor;
    return array_merge($item, ['imagen' => $imagen]);
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
        font-weight: 700;
        color: var(--brand-dark);
    }

    .timeline-wrapper {
        position: relative;
        padding: 2rem 0;
        margin-top: 2rem;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2.5rem;
        width: 50%;
        padding: 1rem 2rem;
    }

    .timeline-item.left {
        left: 0;
        text-align: right;
    }

    .timeline-item.right {
        left: 50%;
        text-align: left;
    }

    .timeline-content {
        background-color: var(--brand-light);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .timeline-dot {
        width: 18px;
        height: 18px;
        background-color: var(--brand-primary);
        border-radius: 50%;
        position: absolute;
        top: 20px;
        left: -9px;
    }

    .timeline-year {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--brand-dark);
    }

    .timeline-content p {
        color: var(--brand-gray);
        margin-bottom: 0;
    }

    @media (max-width: 992px) {
        .section-title {
            font-size: 2rem;
            text-align: center;
        }

        .timeline-item,
        .timeline-item.left,
        .timeline-item.right {
            left: 0 !important;
            width: 100%;
            text-align: left;
            padding: 1rem 1.2rem;
        }

        .timeline-dot {
            left: -10px;
        }

        .timeline-content {
            padding: 1.25rem;
        }

        .timeline-year {
            font-size: 1.1rem;
        }
    }
</style>

<section class="py-5" style="background-color: var(--brand-light); overflow-x: hidden;">
    <div class="container">
<h1 class="section-title text-center mb-4" data-aos="fade-down">
    {{ $contenidosEncabezado['titulo_prensa'] ?? 'Prensa y eventos' }}
</h1>
<p class="lead text-center" data-aos="fade-up" data-aos-delay="100">
    {{ $contenidosEncabezado['descripcion_prensa'] ?? 'Una mirada a los hitos que han consolidado nuestro camino en el mundo del diseño.' }}
</p>

        <div class="timeline-wrapper">
            @foreach ($eventos as $anio => $datos)
            @php
            // Extraer solo el año desde la clave '2024_1', '2023_2', etc.
            preg_match('/^(\d{4})/', $anio, $match);
            $anioVisible = $match[1] ?? $anio;
            $left = $loop->index % 2 === 0;
            @endphp

            <div class="timeline-item {{ $left ? 'left' : 'right' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <div class="timeline-content">
                    <h4 class="timeline-year">{{ $anioVisible }}</h4>
                    <p>{{ $datos['texto'] }}</p>

                    @if (!empty($datos['imagen']))
                    <div class="mt-3">
                        <img src="{{ asset($datos['imagen']) }}" alt="Imagen {{ $anioVisible }}"
                            class="img-fluid rounded shadow-sm"
                            style="max-height: 250px; object-fit: cover; width: 100%;">
                    </div>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endsection