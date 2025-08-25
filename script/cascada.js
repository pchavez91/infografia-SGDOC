

// Carga inicial de carpetas raíz (id_padre=3844)
function cargarVistaCarpetas() {
  const $cont = $('#vista_carpetas').empty();

  $.ajax({
    url: 'json/json.php',
    method: 'POST',
    dataType: 'json',
    data: {
      accion:   'consulta_directorio_por_padre',
      id_padre: 3844
    },
    success(resp) {
      const items = resp.data || [];
      if (!items.length) {
        return $cont.append('<p>No hay carpetas en la raíz.</p>');
      }
      items.forEach(item => {
        const $card = $(`
          <div class="col-lg-3 col-xs-6 carpeta-root"
               data-id="${item.id}"
               data-nombre="${item.nombre_elemento}">
            <div class="panel panel-default">
              <div class="panel-body" style="
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  padding: 10px;
                ">
                <img src="img/ca.png"
                     title="${item.nombre_elemento}"
                     style="
                       max-width: 80px;
                       margin-right: 8px;
                       display: inline-block;
                       vertical-align: middle;
                     ">
                <h5 style="
                     margin: 0;
                     display: inline-block;
                     vertical-align: middle;
                   ">
                  ${item.nombre_elemento}
                </h5>
              </div>
            </div>
          </div>
        `);
        $cont.append($card);
      });
    },
    error() {
      $cont.append('<p>Error cargando carpetas raíz.</p>');
    }
  });
}

// Carga botones dinámicos según id_padre
function cargarBases(idPadre) {
  console.log('> cargarBases invocado con idPadre =', idPadre);
  const $cont = $('#botonesExplorador').empty();

  $.ajax({
    url: 'json/json.php',
    method: 'POST',
    dataType: 'json',
    data: {
      accion:   'consulta_bases',
      id_padre: idPadre
    },
    success(resp) {
      console.log('  ← respuesta consulta_bases:', resp);
      const bases = resp.bases || [];
      if (!bases.length) {
        $cont.append(`<p>No se encontraron bases para el padre ${idPadre}.</p>`);
        return;
      }

      // Agrupamiento y render de botones (tu lógica de niveles/color)
      const grupos = { 1: [], 2: [], 3: [], 4: [] };
      bases.forEach(base => {
        const nombre = base.nombre.trim().toLowerCase();
        let nivel, colorClass;

        if (nombre === 'alta direccion') {
          nivel = 1; colorClass = 'clr-alta';
        } else if (nombre.startsWith('subgerencia')) {
          nivel = 2; colorClass = 'clr-subgerencia';
        } else if (nombre === 'formatos oficiales') {
          nivel = 4; colorClass = 'clr-formatos';
        } else {
          nivel = 3; colorClass = 'clr-depto';
        }

        const $btn = $('<button>')
          .addClass(`base-btn boton-caja ${colorClass}`)
          .text(base.nombre)
          .attr('data-id', base.id)
          .attr('data-nombre', base.nombre);

        grupos[nivel].push($btn);
      });

      Object.keys(grupos).sort((a,b)=>a-b).forEach(n => {
        const $nivelDiv = $('<div>').addClass(`nivel nivel-${n}`);
        grupos[n].forEach($btn => $nivelDiv.append($btn));
        $cont.append($nivelDiv);
      });
    },
    error(xhr, status, err) {
      console.error('  ¡Error AJAX!', status, err);
      $cont.append('<p>Error cargando botones.</p>');
    }
  });
}

// Abrir modal y actualizar título
function abrir_modal(idBase, nombreBase) {
  const titulo = document.getElementById('modalLabel');
  if (!titulo) {
    console.error('No se encontró #modalLabel en el DOM');
    return;
  }
  titulo.textContent = nombreBase;
  const contenedor = document.getElementById('explorador');
  contenedor.innerHTML = '';
  cargarHijos(idBase, contenedor);
  $('#abrir_modal_explorador').modal('show');
}

//Función para obtener icono de cada elemento
function getIconHtml(item) {
  if (item.tipo_elemento == 1) {
    return '<img src="img/ca.png" alt="Carpeta" class="icono" />';
  }
  const ext = (item.extencion_elemento || '').toLowerCase();
  let iconFile = 'otro.png';
  switch (ext) {
    case 'pdf':   iconFile = 'pdf.png';     break;
    case 'xls':   iconFile = 'xls.png';     break;
    case 'xlsx':  iconFile = 'xlsx.png';    break;
    case 'excel': iconFile = 'excel.png';   break;
    case 'doc':   iconFile = 'docx.png';    break;
    case 'docx':  iconFile = 'docx.png';    break;
    case 'ppt':   iconFile = 'pptx.png';    break;
    case 'pptx':  iconFile = 'pptx.png';    break;
    case 'dwg':   iconFile = 'dwg.png';     break;
    case 'server':iconFile = 'server2.png'; break;
    case 'img':   iconFile = 'img.png';     break;
  }
  return `<img src="img/${iconFile}" alt="${ext}" class="icono" />`;
}


function cargarHijos(idPadre, contenedor) {
  fetch(`json/json.php?accion=consulta_directorio_completo&id_padre=${idPadre}`)
    .then(resp => resp.json())
    .then(data => {
      data.data.forEach(item => {
        if (contenedor.querySelector(`[data-id="${item.id}"]`)) return;

        const nodo = document.createElement('div');
        nodo.classList.add(item.tipo_elemento==1 ? 'item-carpeta' : 'item-archivo');
        nodo.dataset.id = item.id;

        nodo.innerHTML = `
          ${getIconHtml(item)}
          <span class="nombre-elemento">${item.nombre_elemento}</span>
        `;

        const hijosCont = document.createElement('div');
        hijosCont.classList.add('hijos-carpeta');
        nodo.appendChild(hijosCont);

        if (item.tipo_elemento == 1) {
          nodo.addEventListener('click', e => {
            e.stopPropagation();
            const abierto = hijosCont.style.display === 'block';
            hijosCont.style.display = abierto ? 'none' : 'block';
            if (!abierto && hijosCont.children.length === 0) {
              cargarHijos(item.id, hijosCont);
            }
          });
        }

        if (item.tipo_elemento == 0 && item.codigo_archivo) {
          nodo.addEventListener('click', e => {
            e.stopPropagation();
            const ruta = `archivos_subidos/${item.codigo_archivo}.${item.extencion_elemento}`;
            window.open(ruta, '_blank');
          });
        }

        contenedor.appendChild(nodo);
      });
    })
    .catch(err => console.error('Error cargando hijos:', err));
}


$(function(){
  // Al inicio, mostrar solo la vista de carpetas
  $('#botonesExplorador').hide();
  cargarVistaCarpetas();

  // Click sobre carpeta raíz → ocultar vista y cargar botones
  $('#vista_carpetas').on('click', '.carpeta-root', function(){
    const id     = $(this).data('id');
    const nombre = $(this).data('nombre');

    $('#vista_carpetas').hide();
    $('#botonesExplorador').show();
    $('#ruta_directorio').text(`DIRECTORIO PRINCIPAL > ${nombre}`);

    cargarBases(id);
  });

  // Delegación para abrir modal desde los botones
  $('#botonesExplorador').on('click', 'button.base-btn', function(){
    abrir_modal($(this).data('id'), $(this).data('nombre'));
  });
});
