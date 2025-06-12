@extends('layouts.app')

@section('title', 'Prensa y Eventos')

@section('content')
@php
    $pagina = \App\Models\Pagina::where('slug', 'prensa-eventos')->with('secciones.contenidos')->first();
    $seccion = $pagina?->secciones?->firstWhere('slug', 'timeline');
    $eventos = $seccion?->contenidos
        ?->sortBy('clave')
        ?->mapWithKeys(fn($item) => [Str::after($item->clave, 'evento_') => $item->valor])
        ?? collect();
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

    .lead {
        color: var(--brand-gray);
    }

    .card-evento {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 5px solid var(--brand-beige);
    }

    .card-evento:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 24px rgba(0,0,0,0.1);
    }

    .evento-fecha {
        font-size: 1.5rem;
        color: var(--brand-primary);
        min-width: 80px;
    }
</style>

<section class="py-5" style="background-color: var(--brand-light);">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title">{{ $pagina->nombre ?? 'Prensa y eventos' }}</h1>
            <p class="lead">Una mirada a los hitos que han consolidado nuestro camino en el mundo del diseño.</p>
        </div>

        <div class="timeline">
            @foreach($eventos as $año => $evento)
                <div class="mb-4 fade-in">
                    <div class="card shadow-sm card-evento">
                        <div class="card-body d-flex align-items-center">
                            <div class="evento-fecha fw-bold me-4">{{ $año }}</div>
                            <div class="evento-desc">
                                <p class="mb-0">{{ $evento }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
