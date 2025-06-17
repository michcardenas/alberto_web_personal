<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Alberto Ascención</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --brand-primary: #0c3b3b;
            --brand-accent: #d5c6b1;
            --brand-bg: #f5f4ef;
            --brand-dark: #2d3c43;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--brand-bg);
            color: var(--brand-dark);
        }

        header {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            background: linear-gradient(to right, var(--brand-bg), var(--brand-accent));
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            color: var(--brand-primary);
        }

        p {
            font-size: 1.2rem;
            margin-top: 1rem;
            line-height: 1.6;
        }

        .buttons {
            margin-top: 2.5rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .btn-link {
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            background-color: var(--brand-primary);
            color: #fff;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-link:hover {
            background-color: #1b4e4e;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.2rem;
            }
            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
<div class="container" data-aos="fade-up">
    <img src="{{ asset('img/logo.png') }}" alt="Logo de Alberto Ascención" style="width: 120px; margin-bottom: 1rem;">
    
    <h1>Alberto Ascención</h1>
    <p>
        Profesional con más de 10 años de experiencia en compras nacionales e internacionales. Especialista en transformación digital, estrategia de proveedores y eficiencia operativa, con enfoque en innovación y liderazgo.
    </p>

    <div class="buttons" data-aos="fade-up" data-aos-delay="200">
        <a href="{{ route('home') }}" class="btn-link">Inicio</a>
        <a href="{{ route('sobre-mi') }}" class="btn-link">Sobre mí</a>
        <a href="{{ route('lo-que-hago') }}" class="btn-link">Lo que hago</a>
        <a href="{{ route('hostella') }}" class="btn-link">Hostella</a>
        <a href="{{ route('blog') }}" class="btn-link">Blog</a>
        <a href="{{ route('prensa-eventos') }}" class="btn-link">Prensa y eventos</a>
        <a href="{{ route('contacto') }}" class="btn-link">Contáctanos</a>
    </div>
</div>

    </header>

    <script>
        AOS.init();
    </script>
</body>
</html>
