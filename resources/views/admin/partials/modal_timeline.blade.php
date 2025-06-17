<!-- Modal Timeline -->
<div class="modal fade" id="modalAgregarTimeline" tabindex="-1" aria-labelledby="modalTimelineLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar evento al Timeline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Año</label>
                    <select id="timelineAnio" class="form-select">
                        @for ($i = date('Y'); $i >= 2015; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label>Descripción del evento</label>
                    <textarea id="timelineDescripcion" class="form-control" rows="3" placeholder="Detalle o historia del evento"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="agregarNuevoTimeline()">Agregar</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function agregarNuevoTimeline() {
    const anio = document.getElementById('timelineAnio').value;
    const descripcion = document.getElementById('timelineDescripcion').value;

    if (!descripcion) {
        alert('Por favor escribe una descripción');
        return;
    }

    const claveTexto = `evento_${anio}`;
    const claveImagen = `img_${anio}`;
    const form = document.querySelector('form');

    // Campo oculto con la descripción
    const inputTexto = document.createElement('input');
    inputTexto.type = 'hidden';
    inputTexto.name = claveTexto;
    inputTexto.value = descripcion;
    form.appendChild(inputTexto);

    // Contenedor visual para mostrar como el resto
    const wrapper = document.createElement('div');
    wrapper.classList.add('mb-4');

    const labelTexto = document.createElement('label');
    labelTexto.classList.add('form-label');
    labelTexto.textContent = claveTexto.replace('_', ' ').toUpperCase();

    const textarea = document.createElement('textarea');
    textarea.name = claveTexto;
    textarea.classList.add('form-control');
    textarea.rows = 2;
    textarea.textContent = descripcion;

    const labelImagen = document.createElement('label');
    labelImagen.classList.add('form-label', 'mt-3');
    labelImagen.textContent = `Imagen ${anio}`;

    const inputImagen = document.createElement('input');
    inputImagen.type = 'file';
    inputImagen.name = claveImagen;
    inputImagen.accept = 'image/*';
    inputImagen.classList.add('form-control');

    wrapper.appendChild(labelTexto);
    wrapper.appendChild(textarea);
    wrapper.appendChild(labelImagen);
    wrapper.appendChild(inputImagen);
    form.insertBefore(wrapper, form.querySelector('button[type="submit"]'));

    // Cerrar modal y limpiar
    document.getElementById('timelineDescripcion').value = '';
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarTimeline'));
    modal.hide();
}

</script>
@endpush
