@extends('layouts.app')

@section('title', 'Hostella')

@section('content')
@php
    use Illuminate\Support\Str;

    $pagina = \App\Models\Pagina::where('slug', 'hostella')->with('secciones.contenidos')->first();
    $seccion = $pagina?->secciones?->firstWhere('slug', 'contenido');
    $contenidos = $seccion?->contenidos?->pluck('valor', 'clave') ?? collect();

    $features = $contenidos->filter(fn($val, $key) => Str::startsWith($key, 'feature_') && is_numeric(Str::after($key, 'feature_')));
    $techs = $contenidos->filter(fn($val, $key) => Str::startsWith($key, 'tech_') && is_numeric(Str::after($key, 'tech_')));
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
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--brand-dark);
    }

    .lead {
        font-size: 1.15rem;
        color: var(--brand-gray);
        max-width: 800px;
        margin: 0 auto;
    }

    .feature-icon {
        color: var(--brand-primary);
    }

    .img-hover-zoom {
        transition: transform 0.5s ease;
        border-radius: 12px;
        width: 100%;
        max-height: 400px;
        object-fit: cover;
    }

    .img-hover-zoom:hover {
        transform: scale(1.04);
    }

    .tech-badge {
        display: inline-block;
        background-color: var(--brand-primary);
        color: white;
        font-size: 0.85rem;
        padding: 6px 14px;
        border-radius: 25px;
        margin: 4px 6px;
    }

    .card-section {
        padding: 3rem 1rem;
    }
</style>

<section class="card-section" style="background-color: var(--brand-light);">
    <div class="container px-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h1 class="section-title">{{ $contenidos['titulo'] ?? 'Hostella' }}</h1>
            <p class="lead">{{ $contenidos['descripcion'] ?? 'Una plataforma moderna para la gestión de hospedajes.' }}</p>
        </div>

        <div class="row align-items-center g-5">
            <div class="col-md-6" data-aos="zoom-in-right">
                <img src="{{ asset($contenidos['img_demo'] ?? 'images/hostella-demo.png') }}"
                     alt="Demo Hostella"
                     class="img-fluid img-hover-zoom shadow-lg">
            </div>

            <div class="col-md-6" data-aos="fade-left" data-aos-delay="100">
                <h4 class="fw-bold mb-3" style="color: var(--brand-dark);">¿Qué es Hostella?</h4>
                <p class="text-muted">
                    {{ $contenidos['detalle'] ?? 'Sistema web desarrollado con Laravel y Vue.js para ayudar a anfitriones a gestionar propiedades, reservas, pagos y clientes en tiempo real.' }}
                </p>

                <h6 class="fw-bold mt-4">Tecnologías</h6>
                <div class="mb-3">
                    @forelse ($techs as $tech)
                        <span class="tech-badge">{{ $tech }}</span>
                    @empty
                        <span class="tech-badge">Laravel</span>
                        <span class="tech-badge">Vue.js</span>
                        <span class="tech-badge">MySQL</span>
                        <span class="tech-badge">Stripe</span>
                        <span class="tech-badge">Google Calendar</span>
                    @endforelse
                </div>

                <h6 class="fw-bold">Características</h6>
                <ul class="list-unstyled">
                    @forelse ($features as $i => $feature)
                        <li class="mb-2" data-aos="fade-up" data-aos-delay="{{ 100 + $loop->index * 50 }}">
                            <i class="fas fa-check feature-icon me-2"></i> {{ $feature }}
                        </li>
                    @empty
                        <li class="mb-2"><i class="fas fa-check feature-icon me-2"></i> Gestión de reservas</li>
                        <li class="mb-2"><i class="fas fa-check feature-icon me-2"></i> Sincronización con calendario</li>
                        <li class="mb-2"><i class="fas fa-check feature-icon me-2"></i> Procesamiento de pagos con Stripe</li>
                        <li class="mb-2"><i class="fas fa-check feature-icon me-2"></i> Soporte para múltiples propiedades</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
