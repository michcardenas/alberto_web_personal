@extends('layouts.app')

@section('title', 'Hostella')

@section('content')
@php
    use Illuminate\Support\Str;

    $pagina = \App\Models\Pagina::where('slug', 'hostella')->with('secciones.contenidos')->first();
    $seccion = $pagina?->secciones?->firstWhere('slug', 'contenido');
    $contenidos = $seccion?->contenidos?->pluck('valor', 'clave') ?? collect();
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

    .feature-icon {
        color: var(--brand-primary);
    }

    .img-hover-zoom {
        transition: transform 0.5s ease;
    }

    .img-hover-zoom:hover {
        transform: scale(1.05);
    }

    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s forwards;
    }

    .fade-delay-1 { animation-delay: 0.2s; }
    .fade-delay-2 { animation-delay: 0.4s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<section class="py-5" style="background-color: var(--brand-light);">
    <div class="container">
        <div class="text-center mb-5 fade-in">
            <h1 class="section-title">{{ $contenidos['titulo'] ?? 'Hostella' }}</h1>
            <p class="lead">{{ $contenidos['descripcion'] ?? 'Una plataforma moderna para la gestión de hospedajes.' }}</p>
        </div>

        <div class="row align-items-center g-5">
            <div class="col-md-6 fade-in fade-delay-1">
                <img src="{{ asset($contenidos['img_demo'] ?? 'images/hostella-demo.png') }}" alt="Demo Hostella"
                     class="img-fluid rounded shadow img-hover-zoom">
            </div>
            <div class="col-md-6 fade-in fade-delay-2">
                <h4 class="fw-bold mb-3" style="color: var(--brand-dark);">¿Qué es Hostella?</h4>
                <p class="text-muted">{{ $contenidos['detalle'] ?? 'Una plataforma integral para la gestión de propiedades, reservas y más.' }}</p>
                <ul class="list-unstyled">
                    @foreach ($contenidos as $clave => $valor)
                        @if (Str::startsWith($clave, 'feature_'))
                            <li class="mb-2">
                                <i class="fas fa-check feature-icon me-2"></i> {{ $valor }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
