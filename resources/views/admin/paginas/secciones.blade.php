@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Secciones de: {{ $pagina->nombre }}</h1>
    <ul class="list-group">
        @foreach ($secciones as $seccion)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $seccion->slug }}
                <a href="{{ route('paginas.secciones.edit', [$pagina, $seccion]) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
