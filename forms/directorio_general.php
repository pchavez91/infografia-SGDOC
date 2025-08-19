<!DOCTYPE html>
<html lang="en">
<head>
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
            <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="abre_ventana_buscar_archivo()">Busqueda rápida</button>
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
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
          <center>
            <h2 class="modal-title"><label>BUSCAR ARCHIVOS</label></h2>
          </center>
          <img src="../../images/photos/logo_comasa_avatar.png" alt="Logo Comasa" style="height: 50px; margin-right: 10px;
          <h6 class="modal-title">
            <label id="directorio_codigos"></label>
          </h6>
        </div>

        <form id="form_editar_descripcion" role="form">
          <br>
          <!-- Aquí inyectaremos el buscador y los dos filtros -->
          <!-- Tabla -->
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