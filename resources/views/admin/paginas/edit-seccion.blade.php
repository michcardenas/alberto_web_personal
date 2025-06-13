@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Editar sección: {{ $seccion->slug }}</h1>

    <form method="POST" action="{{ route('paginas.secciones.update', [$pagina, $seccion]) }}" enctype="multipart/form-data">
        @csrf

        @foreach ($contenidos as $clave => $valor)
            <div class="mb-4">
                <label class="form-label">{{ ucwords(str_replace('_', ' ', $clave)) }}</label>

                @if (Str::startsWith($clave, 'img_'))
                    {{-- Vista previa --}}
                    @if ($valor)
                        <div class="mb-2">
                            <img src="{{ asset($valor) }}" alt="{{ $clave }}" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif

                    {{-- Input para subir nueva imagen --}}
                    <input type="file" name="{{ $clave }}" class="form-control" accept="image/*">

                    {{-- Campo oculto para mantener la imagen actual si no se reemplaza --}}
                    <input type="hidden" name="{{ $clave }}_actual" value="{{ $valor }}">
                @else
                    {{-- Input para texto normal --}}
                    <textarea name="{{ $clave }}" class="form-control" rows="2">{{ $valor }}</textarea>
                @endif
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
@endsection
