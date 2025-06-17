@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Editar SEO de la página: <strong>{{ $pagina->slug }}</strong></h1>

    <form method="POST" action="{{ route('admin.seo.update', $pagina) }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $seo->meta_title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $seo->meta_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $seo->meta_keywords) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">OG Title</label>
            <input type="text" name="og_title" class="form-control" value="{{ old('og_title', $seo->og_title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">OG Description</label>
            <textarea name="og_description" class="form-control" rows="2">{{ old('og_description', $seo->og_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">OG Image</label><br>
            @if ($seo->og_image)
                <img src="{{ asset('storage/' . $seo->og_image) }}" class="img-thumbnail mb-2" style="max-height: 150px;">
            @endif
            <input type="file" name="og_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Canonical URL</label>
            <input type="text" name="canonical" class="form-control" value="{{ old('canonical', $seo->canonical) }}">
        </div>


        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
