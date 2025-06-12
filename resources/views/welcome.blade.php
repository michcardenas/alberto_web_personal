<!-- Header & Navigation -->
@extends('layouts.app')
@section('content')

    <!-- Hero Section -->
<section id="inicio" class="hero-carousel">
    <!-- Carrusel de Bootstrap más simple y robusto -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicadores -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
        </div>
        
        <!-- Slides del carrusel -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="hero-slide" style="background-image: url('{{ asset('images/kitchen1.jpg') }}');">
                    <div class="hero-overlay"></div>
                    <div class="hero-content container">
                        <div class="row">
                            <div class="col-lg-8 ps-lg-5">
                                <h1>Diseñamos tu cocina soñada antes de instalarla</h1>
                                <p class="lead mb-4">Visualízala en 3D y recórrela en realidad virtual.</p>
                                <a href="#contacto" class="btn btn-primary btn-lg">Agenda tu diseño</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="hero-slide" style="background-image: url('{{ asset('images/kitchen2.jpg') }}');">
                    <div class="hero-overlay"></div>
                    <div class="hero-content container">
                        <div class="row">
                            <div class="col-lg-8 ps-lg-5">
                                <h1>Cocinas modernas adaptadas a tu espacio</h1>
                                <p class="lead mb-4">Soluciones inteligentes y materiales de alta calidad.</p>
                                <a href="#contacto" class="btn btn-primary btn-lg">Descubre más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="hero-slide" style="background-image: url('{{ asset('images/kitchen3.jpg') }}');">
                    <div class="hero-overlay"></div>
                    <div class="hero-content container">
                        <div class="row">
                            <div class="col-lg-8 ps-lg-5">
                                <h1>Calidad y elegancia en cada detalle</h1>
                                <p class="lead mb-4">Diseños que combinan estética con funcionalidad.</p>
                                <a href="#contacto" class="btn btn-primary btn-lg">Ver nuestros diseños</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 4 -->
            <div class="carousel-item">
                <div class="hero-slide" style="background-image: url('{{ asset('images/kitchen4.jpg') }}');">
                    <div class="hero-overlay"></div>
                    <div class="hero-content container">
                        <div class="row">
                            <div class="col-lg-8 ps-lg-5">
                                <h1>Transforma tu hogar con diseños exclusivos</h1>
                                <p class="lead mb-4">Cocinas personalizadas que reflejan tu estilo.</p>
                                <a href="#contacto" class="btn btn-primary btn-lg">Inicia tu proyecto</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Controles de navegación -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>

    <!-- About Us Section -->
    <section id="nosotros" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('images/architect.jpg') }}" alt="Sobre Alberto Ascencion" class="img-fluid rounded">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title">Diseño con propósito. Servicio con corazón.</h2>
                    <p class="mb-4">En Alberto Ascencion combinamos tecnología, creatividad y ejecución profesional para transformar cocinas en espacios funcionales, modernos y personalizados. Creemos que una cocina debe adaptarse a tu estilo de vida, no al revés.</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-vr-cardboard color: var(--primary-color); me-3 mt-1" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Visualización en 3D + Realidad Virtual</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-tools color: var(--primary-color); me-3 mt-1" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Instalación supervisada de principio a fin</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-handshake color: var(--primary-color); me-3 mt-1" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Trato humano, directo y transparente</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-lightbulb color: var(--primary-color); me-3 mt-1" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Soluciones reales, no solo gabinetes</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="servicios" class="py-5 bg-beige">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title text-center">¿Qué hacemos por ti?</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-drafting-compass"></i>
                        </div>
                        <h4>Diseño 3D de Cocinas</h4>
                        <p>Vemos juntos tu espacio y diseñamos tu cocina ideal.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-vr-cardboard"></i>
                        </div>
                        <h4>Recorrido en Realidad Virtual</h4>
                        <p>Vive la experiencia antes de comprar.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4>Asesoría Personalizada</h4>
                        <p>Te guiamos paso a paso en materiales, distribución y estilo.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-hammer"></i>
                        </div>
                        <h4>Instalación Supervisada</h4>
                        <p>Te acompañamos en todo el proceso hasta el final.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portafolio" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title text-center">Inspiración real para tu próxima cocina</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item">
                        <img src="{{ asset('images/kitchen1.jpg') }}" alt="Diseño de Cocina 1" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item">
                        <img src="{{ asset('images/kitchen2.jpg') }}" alt="Diseño de Cocina 2" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item">
                        <img src="{{ asset('images/kitchen3.jpg') }}" alt="Diseño de Cocina 3" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item">
                        <img src="{{ asset('images/kitchen4.jpg') }}" alt="Diseño de Cocina 4" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item">
                        <img src="{{ asset('images/kitchen5.jpg') }}" alt="Diseño de Cocina 5" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item">
                        <img src="{{ asset('images/kitchen6.jpg') }}" alt="Diseño de Cocina 6" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
  <section id="testimonios" class="py-5 bg-beige">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title text-center">Lo que dicen nuestros clientes</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <img src="{{ asset('images/testimonial-1.jpg') }}" alt="Cliente 1" class="testimonial-avatar" onerror="this.src='{{ asset('images/user.png') }}'">
                    <h5>María González</h5>
                    <p class="text-muted">Minneapolis, MN</p>
                    <p>"Ver mi cocina en 3D antes de instalarla fue increíble. El diseño final quedó exactamente como lo visualizamos."</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <img src="{{ asset('images/testimonial-2.jpg') }}" alt="Cliente 2" class="testimonial-avatar" onerror="this.src='{{ asset('images/user.png') }}'">
                    <h5>Carlos Ramírez</h5>
                    <p class="text-muted">St. Paul, MN</p>
                    <p>"El equipo de Alberto Ascencion entendió perfectamente lo que queríamos y nos sorprendieron con soluciones que no habíamos considerado."</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <img src="{{ asset('images/testimonial-3.jpg') }}" alt="Cliente 3" class="testimonial-avatar" onerror="this.src='{{ asset('images/user.png') }}'">
                    <h5>Ana Martínez</h5>
                    <p class="text-muted">Bloomington, MN</p>
                    <p>"Profesionales, detallistas y muy comprometidos. Nuestra cocina quedó espectacular y funcional para toda la familia."</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Call to Action -->
    <section class="cta-section" style="background-image: url('{{ asset('images/cta-bg.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container text-center">
            <h2 class="display-4 mb-4">¿Listo para transformar tu cocina?</h2>
            <a href="#contacto" class="btn btn-light btn-lg">Solicita tu diseño gratuito</a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contacto" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="section-title text-center">Contáctanos</h2>
                    <p class="lead">Estamos listos para hacer realidad la cocina de tus sueños</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <form class="contact-form">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Nombre completo" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control" placeholder="Teléfono" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Mensaje" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar mensaje</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        <div class="mb-4">
                            <h4>Ubicación</h4>
                            <p>Minneapolis, MN</p>
                        </div>
                        <div class="mb-4">
                            <h4>Email</h4>
                            <p>info@Alberto Ascencionkitchens.com</p>
                        </div>
                        <div class="mb-4">
                            <h4>Redes sociales</h4>
                            <p>Instagram: @Alberto Ascencionkitchen</p>
                        </div>
                        <!-- <div>
                            <a href="https://wa.me/1234567890" class="whatsapp-btn">
                                <i class="fab fa-whatsapp"></i> Chatea con nosotros
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->


@endsection