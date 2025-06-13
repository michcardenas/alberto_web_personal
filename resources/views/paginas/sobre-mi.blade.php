@extends('layouts.app')

@section('title', 'Sobre mí')

@section('content')
@php
$pagina = \App\Models\Pagina::where('slug', 'sobre-mi')->with('secciones.contenidos')->first();
$secciones = $pagina->secciones->keyBy('slug');

$perfil = optional(optional($secciones['perfil'] ?? null)->contenidos)->pluck('valor', 'clave') ?? collect();
$timeline = optional(optional($secciones['timeline'] ?? null)->contenidos)
->sortBy('clave')
->pluck('valor', 'clave') ?? collect();
@endphp

<style>
    :root {
        --brand-primary: #2d3c43;
        --brand-dark: #0c3b3b;
        --brand-beige: #d5c6b1;
        --brand-gray: #2a2a2a;
        --brand-light: #f5f4ef;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--brand-dark);
    }

    .timeline-wrapper {
        position: relative;
        padding: 2rem 0;
        margin-top: 2rem;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2.5rem;
        width: 50%;
        padding: 1rem 2rem;
    }

    .timeline-item.left {
        left: 0;
        text-align: right;
    }

    .timeline-item.right {
        left: 50%;
        text-align: left;
    }

    .timeline-content {
        background-color: var(--brand-light);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .timeline-dot {
        width: 18px;
        height: 18px;
        background-color: var(--brand-primary);
        border-radius: 50%;
        position: absolute;
        top: 20px;
        left: -9px;
    }

    .timeline-year {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--brand-dark);
    }

    .timeline-content p {
        color: var(--brand-gray);
    }

    .typing-title {
        overflow: hidden;
        border-right: 2px solid var(--brand-primary);
        white-space: nowrap;
        width: fit-content;
        animation: typing 2.5s steps(25, end), blink 0.75s step-end infinite;
    }

    @keyframes typing {
        from {
            width: 0
        }

        to {
            width: 100%
        }
    }

    @keyframes blink {

        from,
        to {
            border-color: transparent
        }

        50% {
            border-color: var(--brand-primary);
        }
    }


    @media (max-width: 768px) {

        .timeline-item,
        .timeline-item.left,
        .timeline-item.right {
            left: 0 !important;
            width: 100%;
            text-align: left;
        }
    }
</style>

{{-- Sección PERFIL --}}
<section class="py-5" style="
    background: url('{{ asset('images/bg-textura.jpg') }}') center center / cover no-repeat fixed;
    color: var(--brand-dark);">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-md-5 text-center" data-aos="fade-right">
                <img src="{{ asset($perfil['img_perfil'] ?? 'images/foto-perfil.jpg') }}" alt="Foto de perfil"
                    class="img-fluid rounded-circle shadow" style="max-width: 300px;">
            </div>

            <div class="col-md-7" data-aos="fade-left">
                <h1 class="section-title typing-title">{{ $perfil['h1_titulo'] ?? 'Sobre mí' }}</h1>

                @foreach ($perfil as $clave => $valor)
                @if(Str::startsWith($clave, 'descripcion_'))
                <p class="text-muted">{{ $valor }}</p>
                @endif
                @endforeach

                <ul class="list-unstyled mt-4">
                    @foreach ($perfil as $clave => $valor)
                    @if(Str::startsWith($clave, 'li_') && !empty($valor))
                    <li class="mb-2">
                        <i class="fas fa-check-circle me-2" style="color: var(--brand-primary);"></i> {{ $valor }}
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</section>


{{-- Sección TIMELINE --}}
@if($timeline->isNotEmpty())
<section class="py-5" style="background-color: var(--brand-light);">
    <div class="container">
        <h2 class="section-title text-center mb-5" data-aos="fade-up">Nuestra historia</h2>
        <div class="timeline-wrapper">
            @foreach ($timeline as $clave => $evento)
            @php
            $anio = Str::after($clave, 'evento_');
            $left = $loop->index % 2 === 0;
            @endphp
            <div class="timeline-item {{ $left ? 'left' : 'right' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <div class="timeline-content">
                    <div class="timeline-dot"></div>
                    <h4 class="timeline-year">{{ $anio }}</h4>
                    <p>{{ $evento }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection