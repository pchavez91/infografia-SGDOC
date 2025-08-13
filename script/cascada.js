

function abrir_modal(idBase = 3844) { 
    const contenedor = document.getElementById('explorador');
    contenedor.innerHTML = '';
    cargarHijos(idBase, contenedor);
    $("#abrir_modal_explorador").modal('show');
}

function cargarHijos(idPadre, contenedor) {
    fetch(`json/json.php?accion=consulta_directorio_completo&id_padre=${idPadre}`)
        .then(resp => resp.json())
        .then(data => {
            data.data.forEach(item => {
                // Evitar duplicados globalmente
                if (contenedor.querySelector(`[data-id="${item.id}"]`)) return;

                const nodo = document.createElement('div');
                nodo.classList.add(item.tipo_elemento == 1 ? 'item-carpeta' : 'item-archivo');
                nodo.dataset.id = item.id;
                nodo.innerHTML = item.tipo_elemento == 1 
                    ? `<span class="icono-carpeta">📁</span> ${item.nombre_elemento}`
                    : `<span class="icono-archivo">📄</span> ${item.nombre_elemento}`;

                // Crear contenedor de hijos para todos los nodos
                const hijosCont = document.createElement('div');
                hijosCont.classList.add('hijos-carpeta');
                hijosCont.style.display = 'none';
                nodo.appendChild(hijosCont);

                // Si es carpeta, permite expandir para ver hijos
                if (item.tipo_elemento == 1) {
                    nodo.addEventListener('click', (e) => {
                        e.stopPropagation();
                        if (hijosCont.style.display === 'none') {
                            hijosCont.style.display = 'block';
                            if (hijosCont.children.length === 0) {
                                cargarHijos(item.id, hijosCont);
                            }
                        } else {
                            hijosCont.style.display = 'none';
                        }
                    });
                }

                // Si es archivo, permite abrirlo
                if (item.tipo_elemento == 0 && item.codigo_archivo) {
                    nodo.addEventListener('click', (e) => {
                        e.stopPropagation();
                        window.open('ruta/a/archivos/' + item.codigo_archivo, '_blank');
                    });
                }

                contenedor.appendChild(nodo);
            });
        })
        .catch(err => console.error('Error cargando hijos:', err));
}
