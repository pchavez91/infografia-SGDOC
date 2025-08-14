function abrir_modal(idBase = 1) {
  const contenedor = document.getElementById('explorador');
  contenedor.innerHTML = '';
  cargarHijos(idBase, contenedor);
  $('#abrir_modal_explorador').modal('show');
}

function cargarHijos(idPadre, contenedor) {
  fetch(`json/json.php?accion=consulta_directorio_completo&id_padre=${idPadre}`)
    .then(resp => resp.json())
    .then(data => {
      data.data.forEach(item => {
        if (contenedor.querySelector(`[data-id="${item.id}"]`)) return;

        const nodo = document.createElement('div');
        nodo.classList.add(item.tipo_elemento == 1 ? 'item-carpeta' : 'item-archivo');
        nodo.dataset.id = item.id;
        nodo.innerHTML = item.tipo_elemento == 1
          ? `<span class="icono-carpeta">📁</span> ${item.nombre_elemento}`
          : `<span class="icono-archivo">📄</span> ${item.nombre_elemento}`;

        const hijosCont = document.createElement('div');
        hijosCont.classList.add('hijos-carpeta');
        nodo.appendChild(hijosCont);

        if (item.tipo_elemento == 1) {
          nodo.addEventListener('click', e => {
            e.stopPropagation();
            const show = hijosCont.style.display !== 'block';
            hijosCont.style.display = show ? 'block' : 'none';
            if (show && hijosCont.children.length === 0) {
              cargarHijos(item.id, hijosCont);
            }
          });
        }

        if (item.tipo_elemento == 0 && item.codigo_archivo) {
          nodo.addEventListener('click', e => {
            e.stopPropagation();
            window.open(
              `archivos_subidos/${item.codigo_archivo}.${item.extencion_elemento}`,
              '_blank'
            );
          });
        }

        contenedor.appendChild(nodo);
      });
    })
    .catch(err => console.error('Error cargando hijos:', err));
}