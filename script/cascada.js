

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
    $('#btnVolver').show();
    $('#ruta_directorio').text(`DIRECTORIO PRINCIPAL > ${nombre}`);

    cargarBases(id);
  });

  $('#btnVolver').on('click', function(){
  // oculto botones y Volver
  $('#botonesExplorador').hide();
  $('#btnVolver').hide();

  // muestro de nuevo la vista inicial
  $('#vista_carpetas').show();
  $('#ruta_directorio').text('DIRECTORIO PRINCIPAL');
});


  // Delegación para abrir modal desde los botones
  $('#botonesExplorador').on('click', 'button.base-btn', function(){
    abrir_modal($(this).data('id'), $(this).data('nombre'));
  });
});


// === Config ===
var ROOT_PARENT_ID = 1; // ID raíz para listar repositorios (ajústalo si tu raíz es otra)

// === Cache simple para hijos de directorios ===
var __dirCache = {};

// === util: cargar hijos (repos, áreas, deptos) ===
function loadDirOptions(parentId) {
  if (__dirCache[parentId]) {
    return $.Deferred().resolve(__dirCache[parentId]).promise();
  }
  return $.getJSON('json/json.php', {
    accion: 'listar_elementos_filtro',
    id_padre: parentId
  }).then(function (resp) {
    var list = (resp && resp.data) ? resp.data : [];
    __dirCache[parentId] = list;
    return list;
  }, function () {
    return [];
  });
}

// === util: rellenar <select> ===
function fillSelect($sel, items, placeholder) {
  var html = '<option value="">' + placeholder + '</option>';
  for (var i = 0; i < items.length; i++) {
    html += '<option value="' + items[i].id + '">' + items[i].nombre_elemento + '</option>';
  }
  $sel.html(html);
}

// === refs DOM (no cambiamos HTML) ===
var $modal, $selRepo, $selArea, $selDepto, $buscador;
var tablaArchivos = null;

// === inicialización DataTable (una sola vez) ===
function ensureDataTable() {
  if ( $.fn.dataTable.isDataTable('#tabla_lista_archivos_encontrados') ) {
    tablaArchivos = $('#tabla_lista_archivos_encontrados').DataTable();
    return;
  }

  tablaArchivos = $('#tabla_lista_archivos_encontrados').DataTable({
    dom: 'lrtip',              // oculto searchbox nativo, usamos #buscador
    responsive: true,
    scrollX: true,
    ajax: {
      url: 'json/json.php?accion=listar_archivos_busqueda',
      data: function (d) {
        // Enviamos SIEMPRE los 3 filtros (vacíos si no hay)
        d.repositorio  = $selRepo.val()  || '';
        d.area         = $selArea.val()  || '';
        d.departamento = $selDepto.val() || '';
      },
      dataSrc: 'data'
    },
    columns: [
      { data: 'nombre_elemento' },
      { data: 'codigo_archivo' },
      {
        data: 'id',
        render: function (id, type, row) {
          return '' +
            '<div style="cursor:pointer;" onClick="visualizar_archivo(\'' + id + '\')">' +
              '<img src="img/' + row.extencion_elemento + '.png" style="max-width:30px" title="Ver archivo">' +
            '</div>';
        }
      },
      { data: 'ruta' }
    ],
    language: {
      lengthMenu:   'Mostrar _MENU_ registros',
      zeroRecords:  'No se ha encontrado resultados',
      info:         'Mostrando página _PAGE_ de _PAGES_',
      infoEmpty:    'Sin resultados',
      infoFiltered: '(filtrado de _MAX_ totales)',
      paginate: {
        first: 'Primero', last: 'Último', next: 'Siguiente', previous: 'Anterior'
      }
    },
    order: [] // sin orden por defecto
  });
}

// === buscador global (separado de los filtros) ===
function hookSearch() {
  // soporta tanto el onkeyup inline del HTML como el evento jQuery
  window.tablaFiltroGlobal = function(q) {
    if (tablaArchivos) { tablaArchivos.search(q).draw(); }
  };
  $buscador.on('input', function() {
    if (tablaArchivos) { tablaArchivos.search(this.value).draw(); }
  });
}

// === encadenado de filtros jerárquicos ===
function hookFilters() {
  // Repositorio → carga áreas, aplica filtro
  $selRepo.on('change', function() {
    var repoId = $(this).val();

    // reset hijos
    fillSelect($selArea, [], 'Seleccione repositorio primero');
    $selArea.prop('disabled', true);
    fillSelect($selDepto, [], 'Seleccione área primero');
    $selDepto.prop('disabled', true);

    // recarga tabla (si repo vacío, trae todos; si tiene valor, filtra por repo)
    if (tablaArchivos) tablaArchivos.ajax.reload();

    if (repoId) {
      loadDirOptions(parseInt(repoId, 10)).then(function(list) {
        fillSelect($selArea, list, 'Seleccione área');
        $selArea.prop('disabled', false);
      });
    }
  });

  // Área → carga deptos, aplica filtro
  $selArea.on('change', function() {
    var areaId = $(this).val();

    fillSelect($selDepto, [], 'Seleccione área primero');
    $selDepto.prop('disabled', true);

    if (tablaArchivos) tablaArchivos.ajax.reload();

    if (areaId) {
      loadDirOptions(parseInt(areaId, 10)).then(function(list) {
        fillSelect($selDepto, list, 'Seleccione departamento');
        $selDepto.prop('disabled', false);
      });
    }
  });

  // Depto → aplica filtro más específico
  $selDepto.on('change', function() {
    if (tablaArchivos) tablaArchivos.ajax.reload();
  });

  // Botón aplicar (si existe en tu HTML): evitamos submit/refresh
  $('#btnAplicarFiltros').on('click', function(e) {
    e.preventDefault();
    if (tablaArchivos) tablaArchivos.ajax.reload();
  });
}

// === abrir modal (siguiendo tu lógica antigua) ===
function abre_ventana_buscar_archivo() {
  // respeta tu validación previa si existe el campo
  var $idDir = $('#id_directorio');
  if ($idDir.length && $idDir.val() === '0') {
    alert('Error: Al menos debe ingresar a algunos de los directorios');
    return;
  }

  // refs (por si el DOM no estaba listo antes)
  $modal    = $('#ventana_busqueda_archivo');
  $selRepo  = $('#selectRepositorio');
  $selArea  = $('#selectArea');
  $selDepto = $('#selectDepartamento');
  $buscador = $('#buscador');

  ensureDataTable();
  hookSearch();
  hookFilters();

  // limpiar buscador y resetear filtros
  $buscador.val('');
  tablaFiltroGlobal('');

  $selRepo.prop('disabled', false).val('');
  fillSelect($selArea, [], 'Seleccione repositorio primero'); $selArea.prop('disabled', true);
  fillSelect($selDepto, [], 'Seleccione área primero');       $selDepto.prop('disabled', true);

  // cargar repos al abrir
  loadDirOptions(ROOT_PARENT_ID).then(function(list) {
    fillSelect($selRepo, list, 'Seleccione repositorio');
  });

  // mostrar modal y cargar TODOS los archivos (sin filtros)
  $modal.modal('show');
  tablaArchivos.ajax.reload();
}

// === compatibilidad: si además tienes un botón con id #btnBusquedaRapida, que llame a la misma función
$(document).on('click', '#btnBusquedaRapida', function(e) {
  e.preventDefault();
  abre_ventana_buscar_archivo();
});

// === ajustar columnas al mostrarse el modal (evita desalineación)
$(document).on('shown.bs.modal', '#ventana_busqueda_archivo', function () {
  if (tablaArchivos) {
    tablaArchivos.columns.adjust().responsive.recalc();
  }
});

// === función global visualizar_archivo (igual a tu versión) ===
function visualizar_archivo(id_directorio) {
  $.ajax({
    url: 'json/json.php?accion=abrir_nombre_archivo',
    type: 'post',
    dataType: 'json',
    data: { id_directorio: id_directorio },
    success: function (json_jax) {
      var win = window.open('archivos_subidos/' + json_jax.descripcion, '_blank');
      if (win) { win.focus(); }
    }
  });
}
