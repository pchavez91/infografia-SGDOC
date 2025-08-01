<!DOCTYPE html>
<html lang="en">
<head>
<link href="../../css/style.css" rel="stylesheet">
</head>
  
<body class="sticky-header left-side-collapsed">

  <div class="form_empresa">
      <div class="panel panel-default">
        <div class="panel-body">

    <ul class="nav nav-tabs">
      
      <li class="active col-lg-6"> <a class="btn btn-success" data-toggle="tab" href="#tab_principal1" id="id2_tab11" onclick="carga_tabla_archivos()">PUBLICAR DOCUMENTO</a></li>
      <li class="col-lg-6"> <a class="btn btn-success" data-toggle="tab" href="#tab_principal2" id="id2_tab22" onclick="tabla_archivos_publicados()">DOCUMENTOS PUBLICADOS</a></li>
       
    </ul>            
        <div class="tab-content">
                <div id="tab_principal1" class="tab-pane active">
                  <div class="panel-body">
                       <CENTER><label>PUBLICAR DOCUMENTO</label></CENTER>

                            <div class="col-xs-12 col-lg-12">
                                  <table id="tabla_lista_archivos" class="display nowrap" width="100%">
                                      <thead>
                                          <tr>
                                          <th>Nombre Archivo</th>
                                          <th>Código</th>
                                          <th>Subido</th>
                                          <th>Ubicación</th>
                                          <th>Aprobado por</th>
                                          <th>F Aprob</th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                             
                                          </tr>
                                      </thead>
                                  </table>
                              </div>

                  </div>
                </div>  
                
                <div id="tab_principal2" class="tab-pane fade">
                  <div class="panel-body">
                    <div class="row">
                       <CENTER><label>DOCUMENTO PUBLICADOS</label></CENTER>
                              <div class="col-xs-12 col-lg-12">
                                  <table id="tabla_archivos_publicados" class="display nowrap" width="100%">
                                      <thead>
                                          <tr>
                                          <th>Nombre Archivo</th>
                                          <th>Código</th>
                                          <th>Subido</th>
                                          <th>Ubicación</th>
                                          <th>Aprobado por</th>
                                          <th>F Aprob</th>
                                          <th></th>
                                             
                                          </tr>
                                      </thead>
                                  </table>
                              </div>

                    </div>
                    
                  </div> 
                </div>      
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
            <h4 class="modal-title"><center>RECHAZA PUBLICACIÓN DE DOCUMENTO</center></h4>
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


<script src="script/publicar_documento.js"></script>

</html>