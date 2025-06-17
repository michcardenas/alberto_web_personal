<!-- Modal para agregar contenido personalizado a Hostella -->
<div class="modal fade" id="modalAgregarContenido" tabindex="-1" aria-labelledby="modalContenidoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Agregar contenido a Hostella</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="tipoContenido" class="form-label">Tipo de contenido</label>
                    <select id="tipoContenido" class="form-select" onchange="mostrarCamposTipo()">
                        <option value="general">Contenido general (título, descripción, detalle)</option>
                        <option value="feature">Feature / Funcionalidad</option>
                        <option value="tecnologia">Tecnología usada</option>
                    </select>
                </div>

                {{-- Contenido general --}}
                <div id="camposGeneral">
                    <div class="mb-3">
                        <label for="nuevoTitulo" class="form-label">Título</label>
                        <input type="text" id="nuevoTitulo" class="form-control" placeholder="Ej. Hostella">
                    </div>
                    <div class="mb-3">
                        <label for="nuevaDescripcion" class="form-label">Descripción</label>
                        <textarea id="nuevaDescripcion" class="form-control" rows="2" placeholder="Resumen principal"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nuevoDetalle" class="form-label">Detalle extendido</label>
                        <textarea id="nuevoDetalle" class="form-control" rows="4" placeholder="Más información sobre el proyecto"></textarea>
                    </div>
                </div>

                {{-- Features --}}
                <div id="camposFeature" class="d-none">
                    <label for="nuevaFeature" class="form-label">Nueva funcionalidad</label>
                    <input type="text" id="nuevaFeature" class="form-control" placeholder="Ej. Gestión de reservas">
                    <button class="btn btn-outline-secondary mt-2" onclick="agregarFeature()">Agregar</button>
                    <ul class="list-group mt-3" id="featuresPreview"></ul>
                </div>

                {{-- Tecnologías --}}
                <div id="camposTecnologia" class="d-none">
                    <label for="nuevaTecnologia" class="form-label">Nueva tecnología</label>
                    <input type="text" id="nuevaTecnologia" class="form-control" placeholder="Ej. Laravel, Vue.js">
                    <button class="btn btn-outline-secondary mt-2" onclick="agregarTecnologia()">Agregar</button>
                    <ul class="list-group mt-3" id="tecnologiasPreview"></ul>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" onclick="agregarContenidoHostella()">Aplicar cambios</button>
            </div>

        </div>
    </div>
</div>

<!-- Scripts para manejar contenido -->
<script>
    let featuresTemp = [];
    let tecnologiasTemp = [];

    function mostrarCamposTipo() {
        const tipo = document.getElementById('tipoContenido').value;

        document.getElementById('camposGeneral').classList.add('d-none');
        document.getElementById('camposFeature').classList.add('d-none');
        document.getElementById('camposTecnologia').classList.add('d-none');

        if (tipo === 'general') {
            document.getElementById('camposGeneral').classList.remove('d-none');
        } else if (tipo === 'feature') {
            document.getElementById('camposFeature').classList.remove('d-none');
        } else if (tipo === 'tecnologia') {
            document.getElementById('camposTecnologia').classList.remove('d-none');
        }
    }

function agregarFeature() {
    const valor = document.getElementById('nuevaFeature').value.trim();
    if (!valor) return;

    // Buscar los que ya existen en el form
    const existentes = document.querySelectorAll('input[name^="feature_"]');
    const contador = existentes.length + featuresTemp.length + 1;
    const clave = 'feature_' + contador;

    featuresTemp.push({ clave, valor });

    const li = document.createElement('li');
    li.className = 'list-group-item';
    li.textContent = valor;
    document.getElementById('featuresPreview').appendChild(li);

    document.getElementById('nuevaFeature').value = '';
}


function agregarTecnologia() {
    const valor = document.getElementById('nuevaTecnologia').value.trim();
    if (!valor) return;

    const existentes = document.querySelectorAll('input[name^="tech_"]');
    const contador = existentes.length + tecnologiasTemp.length + 1;
    const clave = 'tech_' + contador;

    tecnologiasTemp.push({ clave, valor });

    const li = document.createElement('li');
    li.className = 'list-group-item';
    li.textContent = valor;
    document.getElementById('tecnologiasPreview').appendChild(li);

    document.getElementById('nuevaTecnologia').value = '';
}


    function agregarContenidoHostella() {
        const form = document.querySelector('form');
        const tipo = document.getElementById('tipoContenido').value;

        if (tipo === 'general') {
            const campos = {
                'titulo': document.getElementById('nuevoTitulo').value,
                'descripcion': document.getElementById('nuevaDescripcion').value,
                'detalle': document.getElementById('nuevoDetalle').value,
            };

            Object.entries(campos).forEach(([clave, valor]) => {
                if (valor.trim()) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = clave;
                    input.value = valor;
                    form.appendChild(input);
                }
            });

        } else if (tipo === 'feature') {
            featuresTemp.forEach(({ clave, valor }) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = clave;
                input.value = valor;
                form.appendChild(input);
            });

        } else if (tipo === 'tecnologia') {
            tecnologiasTemp.forEach(({ clave, valor }) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = clave;
                input.value = valor;
                form.appendChild(input);
            });
        }

        const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarContenido'));
        modal.hide();

        // Limpiar arrays y vistas previas
        featuresTemp = [];
        tecnologiasTemp = [];
        document.getElementById('featuresPreview').innerHTML = '';
        document.getElementById('tecnologiasPreview').innerHTML = '';
    }
</script>
