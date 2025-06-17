<!-- Modal para agregar servicio -->
<div class="modal fade" id="modalAgregarServicios" tabindex="-1" aria-labelledby="modalServiciosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="nuevoTituloServicio">Título del servicio</label>
                    <input type="text" id="nuevoTituloServicio" class="form-control" placeholder="Ej. Diseño de interiores">
                </div>

                <div class="mb-3">
                    <label for="nuevaDescripcionServicio">Descripción</label>
                    <textarea id="nuevaDescripcionServicio" class="form-control" rows="3" placeholder="Descripción breve del servicio"></textarea>
                </div>

                <div class="mb-3">
                    <label for="nuevoIconoServicio">Ícono (clase Font Awesome)</label>
                    <input type="text" id="nuevoIconoServicio" class="form-control" placeholder="Ej. fas fa-ruler-combined">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="agregarNuevoServicio()">Agregar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function agregarNuevoServicio() {
        const titulo = document.getElementById('nuevoTituloServicio').value.trim();
        const descripcion = document.getElementById('nuevaDescripcionServicio').value.trim();
        const icono = document.getElementById('nuevoIconoServicio').value.trim();

        if (!titulo || !descripcion || !icono) {
            alert('Por favor, completa todos los campos.');
            return;
        }

        // Contador de servicios existentes
        const camposActuales = document.querySelectorAll('textarea[name^="descripcion_servicio_"]');
        const index = camposActuales.length;

        // Crear elementos en el formulario
        const form = document.querySelector('form');

        const grupo = document.createElement('div');
        grupo.classList.add('mb-4');

        grupo.innerHTML = `
            <label class="form-label">Título Servicio ${index + 1}</label>
            <textarea name="titulo_servicio_${index + 1}" class="form-control" rows="2">${titulo}</textarea>

            <label class="form-label mt-2">Descripción</label>
            <textarea name="descripcion_servicio_${index + 1}" class="form-control" rows="3">${descripcion}</textarea>

            <label class="form-label mt-2">Ícono</label>
            <textarea name="icono_servicio_${index + 1}" class="form-control" rows="2">${icono}</textarea>
        `;

        form.insertBefore(grupo, form.querySelector('button[type="submit"]'));

        // Cerrar modal y limpiar
        const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarServicios'));
        modal.hide();

        document.getElementById('nuevoTituloServicio').value = '';
        document.getElementById('nuevaDescripcionServicio').value = '';
        document.getElementById('nuevoIconoServicio').value = '';
    }
</script>
