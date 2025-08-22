//Abrir modal y actualizar título
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

//funcion iconos
function getIconHtml(item) {
  // Carpeta
  if (item.tipo_elemento == 1) {
    return '<img src="img/ca.png" alt="Carpeta" class="icono" />';
  }

  // Mapea extensiones a nombres de archivo en img/
  const ext = (item.extencion_elemento || '').toLowerCase();
  let iconFile = 'otro.png'; // icono por defecto

  switch (ext) {
    case 'pdf':   iconFile = 'pdf.png';     break;
    case 'xls':   iconFile = 'xls.png';     break;
    case 'xlsx':  iconFile = 'xlsx.png';    break;
    case 'excel': iconFile = 'excel.png';   break; // por si viene “excel”
    case 'doc':   iconFile = 'docx.png';    break;
    case 'docx':  iconFile = 'docx.png';    break;
    case 'ppt':   iconFile = 'pptx.png';    break;
    case 'pptx':  iconFile = 'pptx.png';    break;
    case 'dwg':   iconFile = 'dwg.png';     break;
    case 'server':iconFile = 'server2.png'; break;
    case 'img':   iconFile = 'img.png';     break;
    default:      iconFile = 'otro.png';    break;
  }

  return `<img src="img/${iconFile}" alt="${ext}" class="icono" />`;
}


// Carga recursiva de hijos
function cargarHijos(idPadre, contenedor) {
  fetch(`json/json.php?accion=consulta_directorio_completo&id_padre=${idPadre}`)
    .then(resp => resp.json())
    .then(data => {
      data.data.forEach(item => {
        // Evita duplicar nodos
        if (contenedor.querySelector(`[data-id="${item.id}"]`)) return;

        // Crea el nodo
        const nodo = document.createElement('div');
        nodo.classList.add(
          item.tipo_elemento == 1
            ? 'item-carpeta'
            : 'item-archivo'
        );
        nodo.dataset.id = item.id;

        // Inserta icono + nombre
        const iconHtml = getIconHtml(item);
        nodo.innerHTML = `
          ${iconHtml}
          <span class="nombre-elemento">${item.nombre_elemento}</span>
        `;

        // Contenedor para hijos anidados
        const hijosCont = document.createElement('div');
        hijosCont.classList.add('hijos-carpeta');
        nodo.appendChild(hijosCont);

        // Si es carpeta, clic expande/colapsa
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

        // Si es archivo y tiene código, clic abre en nueva pestaña
        if (item.tipo_elemento == 0 && item.codigo_archivo) {
          nodo.addEventListener('click', e => {
            e.stopPropagation();
            const ruta = `archivos_subidos/${item.codigo_archivo}.${item.extencion_elemento}`;
            window.open(ruta, '_blank');
          });
        }

        // Añade el nodo al contenedor
        contenedor.appendChild(nodo);
      });
    })
    .catch(err => console.error('Error cargando hijos:', err));
}

//botones dinamicos
$(function () {
  cargarBases();

  $('#botonesExplorador').on('click', 'button.base-btn', function () {
    const idBase     = $(this).data('id');
    const nombreBase = $(this).data('nombre');
    abrir_modal(idBase, nombreBase);
  });
});


function cargarBases() {
  const $cont = $('#botonesExplorador').empty();

  $.ajax({
    url: 'json/json.php',
    method: 'POST',
    dataType: 'json',
    data: { accion: 'consulta_bases' },
    success: function (resp) {
      const bases = resp.bases || [];
      if (!bases.length) {
        return $cont.text('No hay bases disponibles.');
      }

      // Estructura para agrupar botones por nivel
      const grupos = {
        1: [], // Alta dirección
        2: [], // Subgerencias
        3: [], // Áreas internas
        4: []  // Formatos Oficiales
      };

      bases.forEach(base => {
        const nombre = base.nombre.trim().toLowerCase();
        let nivel, colorClass;

        if (nombre === 'alta direccion') {
          nivel = 1; colorClass = 'clr-alta';
        }
        else if (nombre.startsWith('subgerencia')) {
          nivel = 2; colorClass = 'clr-subgerencia';
        }
        else if (nombre === 'formatos oficiales') {
          nivel = 4; colorClass = 'clr-formatos';
        }
        else {
          nivel = 3; colorClass = 'clr-depto';
        }

        // Crear botón y asignar datos
        const $btn = $('<button>')
          .addClass(`base-btn boton-caja ${colorClass}`)
          .text(base.nombre)
          .attr('data-id', base.id)
          .attr('data-nombre', base.nombre);

        grupos[nivel].push($btn);
      });

      // Renderizar por niveles en orden
      Object.keys(grupos)
        .sort((a, b) => a - b)
        .forEach(n => {
          const $nivelDiv = $('<div>').addClass(`nivel nivel-${n}`);
          grupos[n].forEach($btn => $nivelDiv.append($btn));
          $cont.append($nivelDiv);
        });
    },
    error: function () {
      $cont.text('Error al cargar las bases.');
    }
  });
}

