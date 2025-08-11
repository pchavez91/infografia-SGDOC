
function abre_modal_ayuda(){
    $("#ventana_de_ayuda").modal('show');
}

//siguiente y atras en el modal
  let pasoActual = 1;
  const totalPasos = 3;

  function cambiarPaso(direccion) {
    // Oculta el paso actual
    document.getElementById(`paso${pasoActual}`).style.display = "none";

    // Cambia el paso
    pasoActual += direccion;

    // Muestra el nuevo paso
    document.getElementById(`paso${pasoActual}`).style.display = "block";

    // Actualiza botones
    const btnAnterior = document.getElementById("btnAnterior");
    const btnSiguiente = document.getElementById("btnSiguiente");

    btnAnterior.disabled = pasoActual === 1;

    if (pasoActual === totalPasos) {
      btnSiguiente.style.display = "none";

      // ⏱️ Cerrar el modal automáticamente después de 10 segundos
      setTimeout(() => {
        $('#ventana_de_ayuda').modal('hide');
        pasoActual = 1; // Reinicia si vuelven a abrir el modal

        // mostrar solo el primer paso al reabrir
        document.getElementById("paso2").style.display = "none";
        document.getElementById("paso3").style.display = "none";
        document.getElementById("paso1").style.display = "block";
        btnSiguiente.style.display = "inline-block";
        btnAnterior.disabled = true;

      }, 10000); // 10000 milisegundos = 5 segundos
    } else {
      btnSiguiente.style.display = "inline-block";
      btnSiguiente.textContent = "Siguiente";
    }
  }


//tipo de documento (filtro departamento por terminar)

function abre_ventana_buscar_archivo() {
    var id_directorio = $("#id_directorio").val();

    if (id_directorio == '0') {
        alert('Error: Al menos debe ingresar a algunos de los directorios');
    } else {
        // Cargar el select de tipos de documento
        cargar_select_tipo_documento();

        // Cargar la tabla
        carga_lista_archivos();

        // Mostrar el modal
        $("#ventana_busqueda_archivo").modal('show');
    }
}

function carga_lista_archivos(){
var tipoDoc = $('#filtro_tipo_documento').val();
var departamento = $('#filtro_departamento').val(); // otro filtro
var consulta='json/json.php?accion=listar_archivos_busqueda';

// Agregar filtros como parámetros GET si tienen valor
    var params = [];
    if (tipoDoc !== '') params.push('tipo_documento=' + encodeURIComponent(tipoDoc));
    if (departamento !== '') params.push('departamento=' + encodeURIComponent(departamento));

    if (params.length > 0) {
        consulta += '&' + params.join('&');
    }
    
$("#tabla_lista_archivos_encontrados").dataTable().fnDestroy();
$('#tabla_lista_archivos_encontrados').DataTable({
         responsive: true,
         dom: "<'row'<'col-sm-12'<'custom-filters d-flex align-items-center'>>>" +
                "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
         scrollX:true,
         buttons: [],
             aLengthMenu: [
                          [10,25, 50, 100, 200, -1],
                          [10,25, 50, 100, 200, "Todos"]
                      ],
        iDisplayLength: 10,     
    
            "ajax":''+consulta+'',
                      { "data": "nombre_elemento" },
            { "data": "codigo_archivo" },
            { 
                data: 'id',
                render: function (data, type, row) {
                return '<div style="cursor:pointer;" onClick="visualizar_archivo(\''+row.id+'\')">' +
                        '<img src="img/'+row.extencion_elemento+'.png" style="max-width: 30px;" title="Ver archivo">' +
                        '</div>';
                }
            },
            { "data": "ruta" }
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros por pagina",
                "zeroRecords": "No se ha encontrado resultados",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sin resultados",
                "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                "search": "Buscar",
                 "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                        },
            },
            
           "order": [], // sin orden de columna

            "columnDefs": [
            {
                //"targets": [ 2],
                //"visible": false,
                //"searchable": false
            }
        ],
           });
}

$('#tabla_lista_archivos_encontrados').on('init.dt', function () {
    const filtrosHTML = `

        <div class="col-lg-12 col-xs-12 d-flex align-items-center mb-3">
            <label for="custom_search_input" class="col-auto col-form-label mr-2"><strong>Buscar:</strong></label>
            <div class="col-auto">
                <input type="search" id="custom_search_input" class="form-control" placeholder="Buscar...">
            </div>
        </div>

        <div class="col-lg-6 col-xs-6 d-flex align-items-center">
                <label for="filtro_departamento" class="col-auto col-form-label mr-2">
                <strong>Departamento:</strong></label>
            <div class="col-auto">
                <select id="filtro_departamento" class="form-control">
                    <option value="">Todos</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6 d-flex align-items-center">
            <label for="filtro_tipo_documento" class="col-auto col-form-label ml-4 mr-2"><strong>Tipo de documento:</strong></label>
            <div class="col-auto">
                <select id="filtro_tipo_documento" class="form-control">
                    <option value="">Todos</option>
                </select>
            </div>
        </div>
    </div>
`;

    $('.custom-filters').html(filtrosHTML);

    // Ahora cargamos los departamentos
    cargar_select_departamento();
    // Ahora cargamos los tipos de documento
    cargar_select_tipo_documento();

    // Vinculamos eventos
    $('#custom_search_input').on('keyup', function () {
        $('#tabla_lista_archivos_encontrados').DataTable().search(this.value).draw();
    });

    $('#filtro_departamento').on('change', function () {
        $('#tabla_lista_archivos_encontrados').DataTable().column(1).search(this.value).draw();
    });

    $('#filtro_tipo_documento').on('change', function () {
        carga_lista_archivos(); // Recarga la tabla con filtro
    });
});


function cargar_select_tipo_documento() {
    $.ajax({
        url: 'json/json.php?accion=obtener_tipos_documento',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            var select = $('#filtro_tipo_documento');
            select.empty();
            select.append('<option value="">Todos</option>');

            data.forEach(function (item) {
                // Usar item.id o item.nombre según tu JSON, en este caso ambos son iguales
                select.append('<option value="' + item.id + '">' + item.nombre + '</option>');
            });
        },
        error: function () {
            alert('Error al cargar los tipos de documento');
        }
    });
}

function cargar_select_departamento() {
    $.ajax({
        url: 'json/json.php?accion=obtener_departamentos',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            var select = $('#filtro_departamento');
            select.empty();
            select.append('<option value="">Todos</option>');
            data.forEach(function (item) {
                select.append('<option value="' + item.id + '">' + item.nombre + '</option>');
            });
        },
        error: function () {
            alert('Error al cargar los departamentos');
        }
    });
}
