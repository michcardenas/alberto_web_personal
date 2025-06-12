@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
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

    .lead {
        color: var(--brand-gray);
    }

    .contact-form .form-control {
        border: 1px solid #ccc;
        border-radius: 0.5rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .contact-form .form-control:focus {
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 0.2rem rgba(45, 60, 67, 0.2);
    }

    .contact-form button {
        background-color: var(--brand-primary);
        border: none;
        padding: 0.75rem;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .contact-form button:hover {
        background-color: var(--brand-dark);
    }

    .map-container {
        border-radius: 1rem;
        overflow: hidden;
        height: 100%;
        min-height: 360px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .map-container:hover {
        transform: scale(1.01);
    }
</style>

<section class="py-5" style="background-color: var(--brand-light);">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title">Contáctanos</h1>
            <p class="lead">¿Tienes un proyecto en mente o deseas una asesoría? Estoy lista para ayudarte.</p>
        </div>

        <div class="row g-5">
            <div class="col-md-6">
                <form action="#" method="POST" class="contact-form">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" id="correo" name="correo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" rows="5" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar mensaje</button>
                </form>
            </div>

            <div class="col-md-6">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3..."
                        width="100%" height="100%" frameborder="0"
                        style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
