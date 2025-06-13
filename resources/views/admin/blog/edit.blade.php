@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Editar artículo</h1>

    <form method="POST" action="{{ route('admin.blog.update', $articulo) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $articulo->titulo) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $articulo->slug) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen principal</label><br>
            @if ($articulo->imagen)
                <img src="{{ asset($articulo->imagen) }}" alt="Imagen actual" class="img-thumbnail mb-2" style="max-height: 150px;">
            @endif
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Contenido</label>
            <input id="contenido" type="hidden" name="contenido" value="{{ old('contenido', $articulo->contenido) }}">
            <trix-editor input="contenido"></trix-editor>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection

@section('scripts')
    {{-- Trix Editor --}}
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <script>
        document.addEventListener("trix-attachment-add", function(event) {
            if (event.attachment.file) {
                uploadFileAttachment(event.attachment);
            }
        });

        function uploadFileAttachment(attachment) {
            const file = attachment.file;
            const form = new FormData();
            form.append("file", file);

            fetch("{{ route('blog.upload') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: form
            })
            .then(response => response.json())
            .then(data => {
                attachment.setAttributes({
                    url: data.url,
                    href: data.url
                });
            })
            .catch(error => {
                console.error("Upload failed:", error);
            });
        }
    </script>
@endsection
