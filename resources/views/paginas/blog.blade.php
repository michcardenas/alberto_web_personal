@extends('layouts.app')

@section('title', 'Blog')

@section('content')
@php
    $pagina = \App\Models\Pagina::where('slug', 'blog')->with('secciones.contenidos')->first();
    $seccion = $pagina?->secciones?->firstWhere('slug', 'entradas');
    $contenidos = $seccion?->contenidos?->groupBy(function ($item) {
        return preg_replace('/[^0-9]/', '', $item->clave); // Agrupa por número
    }) ?? collect();
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

    .card-blog {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-blog:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.1);
    }

    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s forwards;
    }

    .fade-delay-1 { animation-delay: 0.2s; }
    .fade-delay-2 { animation-delay: 0.4s; }
    .fade-delay-3 { animation-delay: 0.6s; }

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
            <h1 class="section-title">{{ $pagina->nombre ?? 'Blog' }}</h1>
            <p class="lead">Ideas, consejos y tendencias para transformar tus espacios desde la inspiración hasta la acción.</p>
        </div>

        <div class="row g-4">
            @foreach ($contenidos as $index => $grupo)
                @php
                    $titulo = $grupo->firstWhere('clave', 'titulo_'.$index)?->valor ?? 'Artículo';
                    $descripcion = $grupo->firstWhere('clave', 'descripcion_'.$index)?->valor ?? '';
                    $img = $grupo->firstWhere('clave', 'img_'.$index)?->valor ?? "images/blog-$index.jpg";
                @endphp

                <div class="col-md-4 fade-in {{ 'fade-delay-' . (($loop->index % 3) + 1) }}">
                    <div class="card h-100 border-0 shadow-sm card-blog">
                        <img src="{{ asset($img) }}" alt="Blog {{ $index }}" class="card-img-top rounded-top" style="object-fit: cover; height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $titulo }}</h5>
                            <p class="card-text">{{ $descripcion }}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="#" class="btn btn-sm btn-outline-dark">Leer más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
