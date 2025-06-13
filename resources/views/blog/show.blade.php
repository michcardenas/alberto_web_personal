@extends('layouts.app')

@section('title', $articulo->titulo)

@section('content')
<style>
    :root {
        --brand-primary: #2d3c43;
        --brand-dark: #0c3b3b;
        --brand-beige: #d5c6b1;
        --brand-gray: #2a2a2a;
        --brand-light: #f5f4ef;
    }
    

    .article-header {
        background-color: var(--brand-light);
        padding: 3rem 0;
        text-align: center;
    }

    .article-title {
        font-size: 2.75rem;
        font-weight: 700;
        color: var(--brand-dark);
    }

    .article-meta {
        color: #888;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        margin: 2rem 0;
        border-radius: 8px;
    }

    .article-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--brand-gray);
        padding: 2rem 0;
    }

    .article-body img {
        display: block;
        margin: 1.5rem auto;
        max-width: 100%;
        border-radius: 0.75rem;
        box-shadow: 0 8px 16px rgba(0,0,0,0.08);
    }
</style>

<div class="article-header">
    <div class="container">
        <h1 class="article-title">{{ $articulo->titulo }}</h1>
        <p class="article-meta">Publicado el {{ $articulo->created_at->format('d M, Y') }}</p>
    </div>
</div>

<div class="container article-content">
    @if ($articulo->imagen)
        <img src="{{ asset($articulo->imagen) }}" alt="{{ $articulo->titulo }}">
    @endif

    <div class="article-body">
        {!! $articulo->contenido !!}
    </div>

    <div class="text-start mt-4">
        <a href="{{ route('blog') }}" class="btn btn-outline-secondary">&larr; Volver al Blog</a>
    </div>
</div>
@endsection
