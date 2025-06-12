<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if($global && $global->favicon)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $global->favicon) }}">
    @endif

    <!-- Meta Tags SEO -->
    <title>{{ $global && $global->meta_title ? $global->meta_title : 'Kitchen Design Company' }}</title>
    <meta name="description" content="{{ $global && $global->meta_description ? $global->meta_description : 'Professional kitchen design services' }}">
    <meta name="keywords" content="{{ $global && $global->meta_keywords ? $global->meta_keywords : 'kitchen, design, cabinets' }}">
    <meta name="author" content="{{ $global && $global->meta_author ? $global->meta_author : 'Your Company' }}">
    <meta name="robots" content="{{ $global && $global->meta_robots ? $global->meta_robots : 'index,follow' }}">

    @if($global && $global->canonical_url)
    <link rel="canonical" href="{{ $global->canonical_url }}">
    @endif


    <!-- <title>Alberto Ascencion</title> -->
    <!-- <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}"> -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
</head>
<style>
    :root {
        --brand-primary: #2d3c43;
        --brand-dark: #0c3b3b;
        --brand-beige: #d5c6b1;
        --brand-gray: #2a2a2a;
        --brand-light: #f5f4ef;

        /* Usos anteriores mapeados a nuevos */
        --primary-color: var(--brand-primary);
        --secondary-color: var(--brand-gray);
        --text-color: #2a2a2a;
        --light-color: var(--brand-light);
    }

    .bg-beige {
        background-color: var(--brand-beige) !important;
    }

    .text-brand {
        color: var(--primary-color);
    }


    body {
        font-family: 'Poppins', sans-serif;
        color: var(--text-color);
    }

    .navbar {
        background-color: var(--brand-light);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: fixed;
        /* Cambiar de sticky-top a fixed */
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        /* Valor alto de z-index */
    }

    .navbar-brand img {
        height: 80px;
    }

    .nav-link {
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 10%;
        width: 80%;
        height: 2px;
        background-color: var(--primary-color);
        transform: scaleX(0);
        transform-origin: bottom right;
        transition: transform 0.3s ease-out;
    }

    .nav-link:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    .nav-link:hover {
        color: var(--primary-color);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        padding: 10px 20px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #e09a2d;
        border-color: #e09a2d;
    }

    .hero {
        background-size: cover;
        background-position: center;
        min-height: 80vh;
        display: flex;
        align-items: center;
        position: relative;
    }

    .hero-overlay {
        background: rgba(12, 59, 59, 0.5);
        /* Verde oscuro con transparencia */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .hero-content {
        position: relative;
        z-index: 10;
        color: white;
    }

    h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: var(--secondary-color);
        position: relative;
        display: inline-block;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background-color: var(--primary-color);
    }

    .service-card {
        text-align: center;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        transition: transform 0.3s ease;
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-10px);
    }

    .service-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
    }

    .portfolio-item {
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 30px;
        position: relative;
    }

    .portfolio-item img {
        transition: transform 0.4s ease;
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .portfolio-item:hover img {
        transform: scale(1.05);
    }

    .testimonial-card {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin: 1rem;
    }

    .testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
    }

    .cta-section {
        background-color: var(--primary-color);
        padding: 5rem 0;
        color: white;
    }

    .contact-form {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .whatsapp-btn {
        background-color: #25D366;
        color: white;
        border-radius: 50px;
        padding: 10px 20px;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
    }

    .whatsapp-btn i {
        margin-right: 8px;
    }

    footer {
        background-color: var(--secondary-color);
        color: white;
        padding: 3rem 0 1rem;
    }

    .footer-menu a {
        color: #ccc;
        margin: 0 10px;
        text-decoration: none;
    }

    .social-links a {
        color: white;
        margin: 0 10px;
        font-size: 1.5rem;
    }

    .footer-bottom {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Estilos mejorados para el carrusel hero */
    .hero-carousel {
        position: relative;
    }

    #heroCarousel {
        position: relative;
    }

    .hero-slide {
        height: 80vh;
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .hero-content {
        position: relative;
        z-index: 10;
        color: white;
        padding: 2rem 0;
    }

    .hero-content h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }

    .hero-content .lead {
        font-size: 1.25rem;
        font-weight: 400;
        margin-bottom: 1.5rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
    }

    .hero-content .btn-primary {
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Mejorar los controles del carrusel */
    .carousel-control-prev,
    .carousel-control-next {
        width: 10%;
        /* Aumenta el ancho del área clickeable */
        opacity: 1;
        /* Mayor visibilidad */
    }

    /* Hacer que el icono sea más grande y visible */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 40px;
        height: 40px;
        background-color: rgba(0, 0, 0, 0.5);
        /* Fondo oscuro para mejor visibilidad */
        border-radius: 50%;
        /* Forma circular */
        background-size: 50%;
        /* Ajusta el tamaño del icono dentro del círculo */
        padding: 15px;
        /* Aumenta el área de clic */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Efecto hover para mejor experiencia de usuario */
    .carousel-control-prev:hover .carousel-control-prev-icon,
    .carousel-control-next:hover .carousel-control-next-icon {
        background-color: var(--primary-color);
        /* Usar el color principal al pasar el cursor */
        transform: scale(1.1);
        /* Efecto de agrandamiento */
        transition: all 0.3s ease;
    }

    /* Asegurar que el botón completo sea clickeable */
    .carousel-control-prev button,
    .carousel-control-next button {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        cursor: pointer;
    }

    /* Estilos para el selector de idioma */
    /* Estilo para botones de idioma directos */
    /* Estilos para los botones de idioma */
    .language-buttons {
        display: flex;
        align-items: center;
    }

    .lang-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #f0f0f0;
        color: var(--text-color);
        font-weight: 600;
        font-size: 0.8rem;
        margin: 0 4px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .lang-btn.active {
        background-color: var(--primary-color);
        color: white;
    }

    .lang-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: var(--text-color);
    }

    .lang-btn.active:hover {
        color: white;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--brand-dark);
        border-color: var(--brand-dark);
    }


    /* Ajustes responsivos */
    @media (max-width: 992px) {
        .language-buttons {
            margin: 15px 0;
            justify-content: center;
        }
    }

    /* Ajustes para dispositivos móviles */
    @media (max-width: 768px) {
        .hero-slide {
            height: 60vh;
        }

        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-content .lead {
            font-size: 1rem;
        }

        .hero-content .btn-primary {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>


<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Alberto Ascencion" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('sobre-mi') ? 'active' : '' }}" href="{{ route('sobre-mi') }}">Sobre mí</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lo-que-hago') ? 'active' : '' }}" href="{{ route('lo-que-hago') }}">Lo que hago</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('hostella') ? 'active' : '' }}" href="{{ route('hostella') }}">Hostella</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prensa-eventos') ? 'active' : '' }}" href="{{ route('prensa-eventos') }}">Prensa y eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}" href="{{ route('contacto') }}">Contáctanos</a>
                    </li>

                </ul>

                <!-- Botones de idioma -->
                <div class="language-buttons ms-3 d-flex">
                    <a href="{{ route('welcome') }}" class="lang-btn {{ request()->routeIs('welcome') ? 'active' : '' }}" title="Español">ES</a>
                    <a href="{{ route('Alberto Ascencion') }}" class="lang-btn {{ request()->routeIs('Alberto Ascencion') ? 'active' : '' }}" title="English">EN</a>
                </div>

                <a href="{{ route('contacto') }}" class="btn btn-primary ms-3">Solicita tu diseño gratuito</a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main style="padding-top: 100px;">
        @yield('content')
    </main>
    <footer style="background-color: var(--brand-dark); color: var(--brand-light); padding: 3rem 0;">
    <style>
        :root {
            --brand-primary: #2d3c43;
            --brand-dark: #0c3b3b;
            --brand-beige: #d5c6b1;
            --brand-gray: #2a2a2a;
            --brand-light: #f5f4ef;
        }

        .footer-menu a,
        .social-links a {
            display: inline-block;
            color: var(--brand-light);
            margin: 0 0.5rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-menu a:hover,
        .social-links a:hover {
            color: var(--brand-beige);
        }

        .footer-bottom {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 0.9rem;
        }

        .footer-bottom a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-bottom a:hover {
            color: var(--brand-beige);
        }

        .social-links a i {
            font-size: 1.5rem;
            margin: 0 0.4rem;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="{{ asset('images/logo.png') }}" alt="Alberto Ascencion" height="160">
                <p class="mt-3">Transformando espacios de cocina en hogares con personalidad.</p>
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0 text-lg-center">
                <h5 class="text-uppercase text-white">Enlaces rápidos</h5>
                <div class="footer-menu mt-3">
                    <a href="#inicio">Inicio</a>
                    <a href="#servicios">Servicios</a>
                    <a href="#portafolio">Portafolio</a>
                    <a href="#testimonios">Testimonios</a>
                    <a href="#contacto">Contacto</a>
                </div>
            </div>

            <div class="col-lg-4 text-lg-end">
                <h5 class="text-uppercase text-white">Síguenos</h5>
                <div class="social-links mt-3">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                    <a href="#"><i class="fab fa-houzz"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <p class="mb-1">© 2025 Alberto Ascencion LLC. Todos los derechos reservados.</p>
            <div>
                <a href="#">Política de privacidad</a> |
                <a href="#">Términos y condiciones</a>
            </div>
        </div>
    </div>
</footer>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>