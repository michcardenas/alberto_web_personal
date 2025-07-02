<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    {{-- Meta dinámico desde $seo --}}
    <title>@yield('meta_title', $seo->meta_title ?? 'Alberto Ascencion')</title>
    <meta name="description" content="{{ $seo->meta_description ?? 'Descripción por defecto del sitio.' }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?? '' }}">

    {{-- Canonical --}}
    @if (!empty($seo->canonical))
    <link rel="canonical" href="{{ $seo->canonical }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $seo->og_title ?? $seo->meta_title ?? 'Alberto Ascencion' }}">
    <meta property="og:description" content="{{ $seo->og_description ?? $seo->meta_description ?? '' }}">
    @if (!empty($seo->og_image))
    <meta property="og:image" content="{{ asset($seo->og_image) }}">
    @endif
    <meta property="og:type" content="{{ $seo->og_type ?? 'website' }}">
    @if (!empty($seo->og_url))
    <meta property="og:url" content="{{ $seo->og_url }}">
    @endif

    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
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

        .timeline-wrapper {
            position: relative;
            max-width: 1000px;
            margin: auto;
            padding: 2rem 0;
        }

        .timeline-wrapper::after {
            content: '';
            position: absolute;
            width: 4px;
            background-color: var(--primary-color);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
        }

        .timeline-item {
            padding: 1rem 2rem;
            position: relative;
            width: 50%;
        }

        .timeline-item.left {
            left: 0;
        }

        .timeline-item.right {
            left: 50%;
        }

        .timeline-content {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            position: relative;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .timeline-dot {
            position: absolute;
            top: 1.5rem;
            width: 20px;
            height: 20px;
            background: var(--primary-color);
            border: 4px solid white;
            border-radius: 50%;
            z-index: 1;
        }

        .timeline-item.left .timeline-dot {
            right: -10px;
        }

        .timeline-item.right .timeline-dot {
            left: -10px;
        }

        .timeline-year {
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        /* Responsivo */
        @media screen and (max-width: 768px) {
            .timeline-wrapper::after {
                left: 8px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 2.5rem;
                margin-bottom: 2rem;
            }

            .timeline-item.right {
                left: 0;
            }

            .timeline-dot {
                left: 0;
            }
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
</head>

<body class="d-flex flex-column min-vh-100">
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
                </ul>

                <a href="{{ route('contacto') }}" class="btn btn-primary ms-3">Contactanos</a>
            </div>
        </div>
    </nav>


    <!-- Page Content -->
    <main class="flex-fill" style="padding-top: 100px;">
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

        .footer-logo {
            text-align: center;
        }

        .footer-logo img {
            height: 140px;
        }

        .footer-description {
            max-width: 600px;
            margin: 1.5rem auto 0 auto;
            text-align: center;
            font-size: 1rem;
        }
    </style>

    <div class="container">
        <div class="footer-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Alberto Ascencion">
            <p class="footer-description">
                Profesional con más de 10 años de experiencia liderando proyectos estratégicos en compras y transformación digital para el sector público y privado.
            </p>
        </div>

        <div class="footer-bottom text-center">
            <p class="mb-1">© 2025 Alberto Ascencion. Todos los derechos reservados.</p>
            <div>
                <a href="#">Política de privacidad</a> |
                <a href="#">Términos y condiciones</a>
            </div>
        </div>
    </div>
</footer>


    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S26GJYS9ZR"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-S26GJYS9ZR');
</script>

    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

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

@stack('scripts')
</body>

</html>