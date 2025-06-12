@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Páginas configurables</h1>
    <ul class="list-group">
        @foreach ($paginas as $pagina)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $pagina->nombre }}
                <a href="{{ route('paginas.secciones', $pagina) }}" class="btn btn-sm btn-outline-primary">Ver secciones</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
