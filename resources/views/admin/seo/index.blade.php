@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Gestión SEO por página</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Página</th>
                <th>Slug</th>
                <th>Meta Title</th>
                <th>Meta Description</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paginas as $pagina)
                <tr>
                    <td>{{ $pagina->nombre ?? 'Sin nombre' }}</td>
                    <td>{{ $pagina->slug }}</td>
                    <td>{{ $pagina->seo->meta_title ?? '—' }}</td>
                    <td>{{ \Str::limit($pagina->seo->meta_description ?? '', 60) }}</td>
                    <td>
                        <a href="{{ route('admin.seo.edit', $pagina) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
