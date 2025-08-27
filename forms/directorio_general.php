<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    .dataTables_length,
    .dataTables_filter {
      display: none !important;
    }
  </style>
<link href="../../css/style.css" rel="stylesheet">
</head>
	
<body class="sticky-header left-side-collapsed">
  <input type="hidden" id="id_directorio" value="0">
  <label id="ruta_directorio"></label>
  <div class="form_empresa">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="form-group col-xs-6 col-lg-6">
          <button type="button" class="btn btn-light" data-dismiss="modal" onclick="salir_directorio()">Atrás</button>
        </div>
        <div class="form-group col-xs-6 col-lg-6">
          <button id="btnBusquedaRapida" class="btn btn-primary">Buscar archivo</button>         
        </div>
      </div>
    </div>
  </div>  

	<div class="panel panel-default">
        <div class="panel-body">
          <div class="form_empresa" id="directorio_principal"></div>
      </div>
  </div>
		
</body>
<script src="script/directorio_general.js"></script>

  <!-- busqueda rapida -->
  <div id="ventana_busqueda_archivo" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
                  
        <div class="modal-header" style="display: flex; align-items: center; justify-content: space-between;">
          
          <img src="../../images/photos/logo_comasa_avatar.png" alt="Logo Comasa" style="height: 40px; margin-right: 10px;">
          
          <div style="flex-grow: 1; text-align: center;">
            <h2 class="modal-title" style="margin: 0;">BUSCADOR</h2>
          </div>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 10px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="form_editar_descripcion" role="form">
          <br>
          <div class="modal-body">
            <div class="form-group mb-3">
              <h4 class="font-weight-bold mb-2" style="color:#333;">🔎 Buscador de archivos</h4>
              <input type="text" id="buscador" class="form-control" placeholder="Escribe para encontrar tus archivos..." onkeyup="tablaFiltroGlobal(this.value)">
            </div>
            <h4 class="font-weight-bold mb-2" style="color:#333;">🧮 Filtros</h4>

            <div class="form-row mb-3">
              <div class="col-md-4">
                <select id="selectRepositorio" class="form-control">
                  <option value="">Todos los repositorios</option>
                </select>
              </div>
              <div class="col-md-4">
                <select id="selectArea" class="form-control">
                  <option value="">Seleccione repositorio primero</option>
                </select>
              </div>
              <div class="col-md-4">
                <select id="selectDepartamento" class="form-control">
                  <option value="">Seleccione área primero</option>
                </select>
              </div>
            </div>

          <div class="row" style="padding: 0 15px;">
            <div class="col-xs-12 col-lg-12">
              <table
                id="tabla_lista_archivos_encontrados"
                class="display nowrap"
                width="100%">
                <thead>
                  <tr>
                    <th>NOMBRE</th>
                    <th>CODIGO</th>
                    <th>VER</th>
                    <th>RUTA</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <br><br>
        </form>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-default"
            data-dismiss="modal">Salir</button>
        </div>
      </div>
    </div>
  </div>









</html>