@extends('layouts.app')

@section('title', 'Artículos del Blog')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Artículos del Blog</h1>

    <div class="text-center mb-4">
        <a href="{{ route('blog.create') }}" class="btn btn-success">➕ Crear nuevo artículo</a>
    </div>

    <div class="row g-4">
        @foreach($articulos as $articulo)
        <div class="col-md-4 fade-in">
            <div class="card h-100 shadow-sm card-blog border-0">
                <img src="{{ asset($articulo->imagen ?? 'images/placeholder.jpg') }}" alt="Imagen blog" class="card-img-top" style="object-fit: cover; height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $articulo->titulo }}</h5>
                    <p class="card-text">{{ Str::limit(strip_tags($articulo->contenido), 120) }}</p>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                    <a href="{{ route('blog.show', $articulo->slug) }}" class="btn btn-sm btn-outline-dark">Leer más</a>
                    <a href="{{ route('admin.blog.edit', $articulo->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection