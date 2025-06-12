@extends('layouts.admin')
<div class="container-fluid" style="margin-top: 120px; padding-top: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="color: black;">Gestión de Contenido en Inglés</h3>
                </div>
                <div class="card-body">
                    
                    <!-- Mensajes de éxito/error -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-triangle"></i> Errores encontrados:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contenido-ingles.update') }}" method="POST" enctype="multipart/form-data" id="contenidoForm">
                        @csrf
                        
                        <!-- Hero Carousel Section -->
                        <div class="mb-5">
                            <h4 style="color: black; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                                <i class="fas fa-images"></i> Carrusel Hero
                            </h4>
                            <div class="row">
                                @for ($i = 1; $i <= 4; $i++)
                                <div class="col-md-6 mb-4">
                                    <div class="card border-secondary">
                                        <div class="card-header bg-beige">
                                            <h6 style="color: black; margin: 0;">Slide {{ $i }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="h1_hero_carrusel_{{ $i }}" style="color: black;">Título H1:</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="h1_hero_carrusel_{{ $i }}" 
                                                       id="h1_hero_carrusel_{{ $i }}"
                                                       style="color: black;"
                                                       value="{{ $contenido->{'h1_hero_carrusel_' . $i} ?? '' }}"
                                                       placeholder="Ingrese el título principal">
                                            </div>
                                            <div class="mb-3">
                                                <label for="p_hero_carrusel_{{ $i }}" style="color: black;">Párrafo:</label>
                                                <textarea class="form-control" 
                                                          name="p_hero_carrusel_{{ $i }}" 
                                                          id="p_hero_carrusel_{{ $i }}"
                                                          rows="3"
                                                          style="color: black;"
                                                          placeholder="Ingrese la descripción">{{ $contenido->{'p_hero_carrusel_' . $i} ?? '' }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="a_hero_carrusel_{{ $i }}" style="color: black;">Enlace:</label>
                                                <input type="url" 
                                                       class="form-control" 
                                                       name="a_hero_carrusel_{{ $i }}" 
                                                       id="a_hero_carrusel_{{ $i }}"
                                                       style="color: black;"
                                                       value="{{ $contenido->{'a_hero_carrusel_' . $i} ?? '' }}"
                                                       placeholder="https://example.com">
                                            </div>
                                            <div class="mb-3">
                                                <label for="img_hero_carrusel_{{ $i }}" style="color: black;">Imagen:</label>
                                                @if(isset($contenido->{'img_hero_carrusel_' . $i}) && $contenido->{'img_hero_carrusel_' . $i})
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $contenido->{'img_hero_carrusel_' . $i}) }}" 
                                                             alt="Imagen actual" 
                                                             style="max-width: 100px; height: auto;" 
                                                             class="img-thumbnail">
                                                        <small class="d-block text-muted">Imagen actual</small>
                                                    </div>
                                                @endif
                                                <input type="file" 
                                                       class="form-control" 
                                                       name="img_hero_carrusel_{{ $i }}" 
                                                       id="img_hero_carrusel_{{ $i }}"
                                                       accept="image/*">
                                                <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>

                        <!-- About Us Section -->
                        <div class="mb-5">
                            <h4 style="color: black; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                                <i class="fas fa-info-circle"></i> About Us
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="h2_about_us" style="color: black;">Título de la sección:</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="h2_about_us" 
                                               id="h2_about_us"
                                               style="color: black;"
                                               value="{{ $contenido->h2_about_us ?? '' }}"
                                               placeholder="About Us">
                                    </div>
                                    <div class="mb-3">
                                        <label for="p_about_us" style="color: black;">Descripción:</label>
                                        <textarea class="form-control" 
                                                  name="p_about_us" 
                                                  id="p_about_us"
                                                  rows="4"
                                                  style="color: black;"
                                                  placeholder="Descripción de la empresa">{{ $contenido->p_about_us ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="img_about_us" style="color: black;">Imagen:</label>
                                        @if(isset($contenido->img_about_us) && $contenido->img_about_us)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $contenido->img_about_us) }}" 
                                                     alt="Imagen About Us" 
                                                     style="max-width: 150px; height: auto;" 
                                                     class="img-thumbnail">
                                                <small class="d-block text-muted">Imagen actual</small>
                                            </div>
                                        @endif
                                        <input type="file" 
                                               class="form-control" 
                                               name="img_about_us" 
                                               id="img_about_us"
                                               accept="image/*">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- About Us Features -->
                            <div class="row">
                                @for ($i = 1; $i <= 4; $i++)
                                <div class="col-md-3 mb-3">
                                    <div class="card border-light">
                                        <div class="card-header bg-beige">
                                            <h6 style="color: black; margin: 0;">Feature {{ $i }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="i__about_us_{{ $i }}" style="color: black;">Icono:</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="i__about_us_{{ $i }}" 
                                                       id="i__about_us_{{ $i }}"
                                                       style="color: black;"
                                                       value="{{ $contenido->{'i__about_us_' . $i} ?? '' }}"
                                                       placeholder="fas fa-icon">
                                            </div>
                                            <div class="mb-3">
                                                <label for="h5__about_us_{{ $i }}" style="color: black;">Título:</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="h5__about_us_{{ $i }}" 
                                                       id="h5__about_us_{{ $i }}"
                                                       style="color: black;"
                                                       value="{{ $contenido->{'h5__about_us_' . $i} ?? '' }}"
                                                       placeholder="Título del feature">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Services Section -->
                        <div class="mb-5">
                            <h4 style="color: black; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                                <i class="fas fa-tools"></i> Services
                            </h4>
                            <div class="mb-3">
                                <label for="h2_services" style="color: black;">Título de la sección:</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="h2_services" 
                                       id="h2_services"
                                       style="color: black;"
                                       value="{{ $contenido->h2_services ?? '' }}"
                                       placeholder="Our Services">
                            </div>
                            <div class="row">
                                @for ($i = 1; $i <= 4; $i++)
                                <div class="col-md-6 mb-3">
                                    <div class="card border-light">
                                        <div class="card-header bg-beige">
                                            <h6 style="color: black; margin: 0;">Service {{ $i }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="i_services_{{ $i }}" style="color: black;">Icono:</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="i_services_{{ $i }}" 
                                                       id="i_services_{{ $i }}"
                                                       style="color: black;"
                                                       value="{{ $contenido->{'i_services_' . $i} ?? '' }}"
                                                       placeholder="fas fa-icon">
                                            </div>
                                            <div class="mb-3">
                                                <label for="h4__services_{{ $i }}" style="color: black;">Título:</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="h4__services_{{ $i }}" 
                                                       id="h4__services_{{ $i }}"
                                                       style="color: black;"
                                                       value="{{ $contenido->{'h4__services_' . $i} ?? '' }}"
                                                       placeholder="Título del servicio">
                                            </div>
                                            <div class="mb-3">
                                                <label for="p__services_{{ $i }}" style="color: black;">Descripción:</label>
                                                <textarea class="form-control" 
                                                          name="p__services_{{ $i }}" 
                                                          id="p__services_{{ $i }}"
                                                          rows="3"
                                                          style="color: black;"
                                                          placeholder="Descripción del servicio">{{ $contenido->{'p__services_' . $i} ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Portfolio Section -->
                        <div class="mb-5">
                            <h4 style="color: black; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                                <i class="fas fa-image"></i> Portfolio
                            </h4>
                            <div class="mb-3">
                                <label for="h2_portfolio" style="color: black;">Título de la sección:</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="h2_portfolio" 
                                       id="h2_portfolio"
                                       style="color: black;"
                                       value="{{ $contenido->h2_portfolio ?? '' }}"
                                       placeholder="Our Portfolio">
                            </div>
                            <div class="row">
                                @for ($i = 1; $i <= 6; $i++)
                                <div class="col-md-4 mb-3">
                                    <div class="card border-light">
                                        <div class="card-header bg-beige">
                                            <h6 style="color: black; margin: 0;">Portfolio Item {{ $i }}</h6>
                                        </div>
                                        <div class="card-body">
                                            @if(isset($contenido->{'img_portfolio_' . $i}) && $contenido->{'img_portfolio_' . $i})
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $contenido->{'img_portfolio_' . $i}) }}" 
                                                         alt="Portfolio {{ $i }}" 
                                                         style="max-width: 100%; height: auto;" 
                                                         class="img-thumbnail">
                                                    <small class="d-block text-muted">Imagen actual</small>
                                                </div>
                                            @endif
                                            <input type="file" 
                                                   class="form-control" 
                                                   name="img_portfolio_{{ $i }}" 
                                                   id="img_portfolio_{{ $i }}"
                                                   accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Testimonials Section -->
                        <div class="mb-5">
                            <h4 style="color: black; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                                <i class="fas fa-comments"></i> Testimonials
                            </h4>
                            <div class="mb-3">
                                <label for="h2_testimonials" style="color: black;">Título de la sección:</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="h2_testimonials" 
                                       id="h2_testimonials"
                                       style="color: black;"
                                       value="{{ $contenido->h2_testimonials ?? '' }}"
                                       placeholder="What Our Clients Say">
                            </div>
                            <div class="row">
                                @for ($i = 1; $i <= 3; $i++)
                                <div class="col-md-4 mb-3">
                                    <div class="card border-light">
                                        <div class="card-header bg-beige">
                                            <h6 style="color: black; margin: 0;">Testimonial {{ $i }}</h6>
                                        </div>
                                        <div class="card-body">
                                            @if(isset($contenido->{'img_testimonials_' . $i}) && $contenido->{'img_testimonials_' . $i})
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $contenido->{'img_testimonials_' . $i}) }}" 
                                                         alt="Client {{ $i }}" 
                                                         style="max-width: 80px; height: 80px; object-fit: cover;" 
                                                         class="img-thumbnail rounded-circle">
                                                    <small class="d-block text-muted">Foto actual</small>
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label for="img_testimonials_{{ $i }}" style="color: black;">Foto del cliente:</label>
                                                <input type="file" 
                                                       class="form-control" 
                                                       name="img_testimonials_{{ $i }}" 
                                                       id="img_testimonials_{{ $i }}"
                                                       accept="image/*">
                                            </div>
                                            <div class="mb-3">
                                                <label for="h5_testimonials_{{ $i }}" style="color: black;">Nombre del cliente:</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="h5_testimonials_{{ $i }}" 
                                                       id="h5_testimonials_{{ $i }}"
                                                       style="color: black;"
                                                       value="{{ $contenido->{'h5_testimonials_' . $i} ?? '' }}"
                                                       placeholder="Nombre del cliente">
                                            </div>
                                            <div class="mb-3">
                                                <label for="p_testimonials_city_{{ $i }}" style="color: black;">Ciudad:</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="p_testimonials_city_{{ $i }}" 
                                                       id="p_testimonials_city_{{ $i }}"
                                                       style="color: black;"
                                                       value="{{ $contenido->{'p_testimonials_city_' . $i} ?? '' }}"
                                                       placeholder="Ciudad del cliente">
                                            </div>
                                            <div class="mb-3">
                                                <label for="p_testimonials_{{ $i }}" style="color: black;">Testimonio:</label>
                                                <textarea class="form-control" 
                                                          name="p_testimonials_{{ $i }}" 
                                                          id="p_testimonials_{{ $i }}"
                                                          rows="4"
                                                          style="color: black;"
                                                          placeholder="Testimonio del cliente">{{ $contenido->{'p_testimonials_' . $i} ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Call to Action Section -->
                        <div class="mb-5">
                            <h4 style="color: black; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                                <i class="fas fa-bullhorn"></i> Call to Action
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="h2_call" style="color: black;">Título:</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="h2_call" 
                                               id="h2_call"
                                               style="color: black;"
                                               value="{{ $contenido->h2_call ?? '' }}"
                                               placeholder="Ready to Start Your Project?">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="btn_call" style="color: black;">Texto del botón:</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="btn_call" 
                                               id="btn_call"
                                               style="color: black;"
                                               value="{{ $contenido->btn_call ?? '' }}"
                                               placeholder="Contact Us Today">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Section -->
                        <div class="mb-5">
                            <h4 style="color: black; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                                <i class="fas fa-envelope"></i> Contact
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="h2_contact_title" style="color: black;">Título de contacto:</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="h2_contact_title" 
                                               id="h2_contact_title"
                                               style="color: black;"
                                               value="{{ $contenido->h2_contact_title ?? '' }}"
                                               placeholder="Contact Us">
                                    </div>
                                    <div class="mb-3">
                                        <label for="p_contact_title" style="color: black;">Descripción:</label>
                                        <textarea class="form-control" 
                                                  name="p_contact_title" 
                                                  id="p_contact_title"
                                                  rows="3"
                                                  style="color: black;"
                                                  placeholder="Get in touch with us">{{ $contenido->p_contact_title ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="h4_contact_1" style="color: black;">Título de dirección:</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="h4_contact_1" 
                                               id="h4_contact_1"
                                               style="color: black;"
                                               value="{{ $contenido->h4_contact_1 ?? '' }}"
                                               placeholder="Our Location">
                                    </div>
                                    <div class="mb-3">
                                        <label for="p_contact_1" style="color: black;">Dirección:</label>
                                        <textarea class="form-control" 
                                                  name="p_contact_1" 
                                                  id="p_contact_1"
                                                  rows="2"
                                                  style="color: black;"
                                                  placeholder="123 Main Street, City, State">{{ $contenido->p_contact_1 ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="h4_contact_email_1" style="color: black;">Título de email:</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="h4_contact_email_1" 
                                               id="h4_contact_email_1"
                                               style="color: black;"
                                               value="{{ $contenido->h4_contact_email_1 ?? '' }}"
                                               placeholder="Email Us">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="p_contact_email_1" style="color: black;">Email:</label>
                                        <input type="email" 
                                               class="form-control" 
                                               name="p_contact_email_1" 
                                               id="p_contact_email_1"
                                               style="color: black;"
                                               value="{{ $contenido->p_contact_email_1 ?? '' }}"
                                               placeholder="info@company.com">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <button type="submit" class="btn btn-primary btn-lg me-3">
                                    <i class="fas fa-save"></i> Guardar Cambios
                                </button>
                                <button type="button" class="btn btn-secondary btn-lg" onclick="resetForm()">
                                    <i class="fas fa-undo"></i> Restablecer
                                </button>
                                <button type="button" class="btn btn-info btn-lg" onclick="previewChanges()">
                                    <i class="fas fa-eye"></i> Vista Previa
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript para manejar el formulario -->
<script>
function resetForm() {
    if (confirm('¿Estás seguro de que quieres restablecer el formulario? Se perderán todos los cambios no guardados.')) {
        document.getElementById('contenidoForm').reset();
    }
}

// Debug del formulario antes del envío
document.getElementById('contenidoForm').addEventListener('submit', function(e) {
    // Opcional: Agregar validación aquí
    console.log('Enviando formulario...');
    
    // Verificar que los campos principales no estén vacíos
    const h1_1 = document.getElementById('h1_hero_carrusel_1').value.trim();
    if (h1_1 === '') {
        alert('Por favor, ingresa al menos el título del primer slide.');
        e.preventDefault();
        return false;
    }
});

// Mostrar preview de imágenes al seleccionar
document.querySelectorAll('input[type="file"]').forEach(function(input) {
    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            console.log('Archivo seleccionado:', file.name, 'Tamaño:', file.size);
        }
    });
});
</script>
