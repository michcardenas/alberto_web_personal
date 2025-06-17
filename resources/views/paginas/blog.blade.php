@extends('layouts.app')

@section('title', 'Blog')

@section('content')
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
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }
</style>


<section class="py-5" style="background-color: var(--brand-light);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h1 class="section-title">{{ $contenidos['titulo_blog'] ?? 'Blog' }}</h1>
            <p class="lead">{{ $contenidos['descripcion_blog'] ?? 'Explora nuestras últimas ideas.' }}</p>
        </div>

        <div class="row g-4">
            @foreach ($articulos as $index => $articulo)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index % 3) }}">
                <div class="card h-100 border-0 shadow-sm card-blog">
                    <img src="{{ asset($articulo->imagen) }}" alt="{{ $articulo->titulo }}" class="card-img-top rounded-top" style="object-fit: cover; height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $articulo->titulo }}</h5>
                        <p class="card-text">{{ $articulo->descripcion }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('blog.show', $articulo->slug) }}" class="btn btn-sm btn-outline-dark">Leer más</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection