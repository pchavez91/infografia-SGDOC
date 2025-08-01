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



<!-- VENTANA NUEVA CARPETA -->
<div id="ventana_busqueda_archivo" class="modal fade">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <center><h4 class="modal-title"><label id="">BUSCAR ARCHIVOS </label></h4></center>
            <h6 class="modal-title"><label id="directorio_codigos"></label></h6>
      </div>
      <!-- <div class="modal-body"> -->
    <form action="#" method="post" role="form" id="form_editar_descripcion">
      </br>
      <div class="rows">
            <div class="col-xs-12 col-lg-12">
                  <table id="tabla_lista_archivos_encontrados" class="display nowrap" width="100%">
                      <thead>
                          <tr>
                          <th>NOMBRE</th>
                          <th>CODIGO</th>
                          <th>RUTA</th>
                          <th>VER</th>
                             
                          </tr>
                      </thead>
                  </table>
              </div>
   
      </div>
    </form>
 </br></br>
      <!-- </div> -->
    <div class="rows">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
  </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- FIN VENTANA NUEVA CARPETA -->






</html>