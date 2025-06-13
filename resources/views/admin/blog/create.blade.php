@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Crear nuevo artículo</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug (opcional)</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen principal (opcional)</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Contenido</label>
            <input id="contenido" type="hidden" name="contenido">
            <trix-editor input="contenido"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary">Crear artículo</button>
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
