@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Editar sección: {{ $seccion->slug }}</h1>

    <form method="POST" action="{{ route('paginas.secciones.update', [$pagina, $seccion]) }}" enctype="multipart/form-data">
        @csrf

        {{-- Campo especial solo si es contacto/formulario --}}
        @if ($pagina->slug === 'contacto' && $seccion->slug === 'formulario')
        <div class="mb-4">
            <label class="form-label">Mapa (iframe src)</label>
            <input type="text" name="mapa_src" class="form-control" value="{{ $contenidos['mapa_src'] ?? '' }}">
        </div>
        @endif

        @foreach ($contenidos as $clave => $valor)
        @continue($clave === 'mapa_src') {{-- Evitar mostrarlo doble --}}

        <div class="mb-4 content-block">
        <label class="form-label d-flex justify-content-between align-items-center">
            {{ ucwords(str_replace('_', ' ', $clave)) }}
            <button type="button" class="btn btn-danger btn-sm" onclick="eliminarCampo(this)" data-clave="{{ $clave }}">🗑️</button>
        </label>


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
                {{-- Input para texto --}}
                <textarea name="{{ $clave }}" class="form-control" rows="2">{{ $valor }}</textarea>
            @endif
        </div>
        @endforeach

        {{-- Botón para abrir el modal --}}
        @if (in_array($seccion->slug, ['timeline', 'servicios', 'contenido']))
        <button type="button" class="btn btn-secondary my-3"
            data-bs-toggle="modal"
            data-bs-target="#modalAgregar{{ ucfirst($seccion->slug) }}">
            ➕ Agregar contenido
        </button>
        @endif

        <button type="submit" class="btn btn-primary mt-3">Guardar cambios</button>
    </form>
</div>

{{-- Incluir modales según la sección --}}
@if ($seccion->slug === 'timeline')
    @include('admin.partials.modal_timeline')
@endif

@if ($seccion->slug === 'servicios')
    @include('admin.partials.modal_servicios')
@endif

@if ($seccion->slug === 'contenido' && $pagina->slug === 'hostella')
    @include('admin.partials.modal_hostella')
@endif
@endsection

@push('scripts')
<script>
function eliminarCampo(btn) {
    const clave = btn.dataset.clave;
    if (!clave) return;

    const confirmacion = confirm(`¿Estás seguro de que quieres eliminar el campo "${clave}"? Esta acción no se puede deshacer.`);
    if (!confirmacion) return;

    const form = document.querySelector('form');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'eliminar_campos[]';
    input.value = clave;

    form.appendChild(input);
    
    const block = btn.closest('.content-block');
    if (block) block.remove();
}
</script>
@endpush
