<!DOCTYPE html>
<html lang="en">
<head>
<link href="../../css/style.css" rel="stylesheet">
</head>
  
<body class="sticky-header left-side-collapsed">

  <div class="form_empresa">
      <div class="panel panel-default">
        <div class="panel-body">

            <CENTER><label>APROBAR DOCUMENTO</label></CENTER>

            <div class="col-xs-12 col-lg-12">
                  <table id="tabla_lista_archivos" class="display nowrap" width="100%">
                      <thead>
                          <tr>
                          <th>Nombre Archivo</th>
                          <th>Código</th>
                          <th>Subido</th>
                          <th>Ubicación</th>
                          <th></th>
                          <th></th>
                          <th></th>
                             
                          </tr>
                      </thead>
                  </table>
              </div>

        </div>
      </div>
  </div>

    
</body>



 <!-- VENTANA NUEVA CARPETA -->
<div id="ventana_rechazar_documento" class="modal fade">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><center>RECHAZAR DOCUMENTO</center></h4>
      </div>
      <!-- <div class="modal-body"> -->
    <form action="#" method="post" role="form" id="form_nueva_carpeta">
      <input type="hidden"  id="id_archivo_rechazo">
      <input type="hidden"  id="nombre_archivo_rechazo">
      <br>
      <div class="rows">
            <div class="form-group col-xs-12 col-lg-12">
              <label>Indique motivo de rechazo:</label>
                   <input type="text" class="form-control" name="motivo_de_rechazo_archivo"  id="motivo_de_rechazo_archivo" required="required" >
            </div>

      </div>
    </form>
 </br></br></br>
      <!-- </div> -->
    <div class="rows">
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="rechazar_documento()">CONFIRMAR</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
  </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- FIN VENTANA NUEVA CARPETA -->




<script src="script/aprobar_docto.js"></script>

</html>