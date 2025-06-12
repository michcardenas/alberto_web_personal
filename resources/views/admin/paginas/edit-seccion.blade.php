@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Editar sección: {{ $seccion->slug }}</h1>

    <form method="POST" action="{{ route('paginas.secciones.update', [$pagina, $seccion]) }}">
        @csrf

        @foreach ($contenidos as $clave => $valor)
            <div class="mb-3">
                <label class="form-label">{{ ucwords(str_replace('_', ' ', $clave)) }}</label>
                <textarea name="{{ $clave }}" class="form-control" rows="2">{{ $valor }}</textarea>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
@endsection
