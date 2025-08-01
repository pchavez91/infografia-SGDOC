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
          <div class="form-group col-xs-3 col-lg-6">
            <button type="button" class="btn btn-light" data-dismiss="modal" onclick="salir_directorio()">Atrás</button>
          </div>
          <div class="form-group col-xs-3 col-lg-2">
            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="generar_codigo()">Generar Código</button>
          </div>
          <div class="form-group col-xs-3 col-lg-2">
            <button type="button" class="btn btn-info" data-dismiss="modal" onclick="crea_carpeta()">Crear Carpeta</button>
          </div>
          <div class="form-group col-xs-3 col-lg-2">
            <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="listar_codigos()">Lista de códigos</button>
          </div>
          
        
      </div>
  </div>
  </div>

  <div class="form_empresa" id="directorio_principal">
    
  </div>
    
</body>
<script src="script/directorio.js"></script>




<!-- VENTANA NUEVA CARPETA -->
<div id="ventana_lista_codigos" class="modal fade">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <center><h4 class="modal-title"><label id="">LISTA DE CODIGOS</label></h4></center>
            <h6 class="modal-title"><label id="directorio_codigos"></label></h6>
      </div>
      <!-- <div class="modal-body"> -->
    <form action="#" method="post" role="form" id="form_editar_descripcion">
      </br>
      <div class="rows">
            <div class="col-xs-12 col-lg-12">
                  <table id="tabla_lista_archivos" class="display nowrap" width="100%">
                      <thead>
                          <tr>
                          <th>CODIGOS</th>
                          <th>CREADO</th>
                          <th>OCUPADO</th>
                          <th></th>
                             
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




 <!-- VENTANA NUEVA CARPETA -->
<div id="ventana_nueva_carpeta" class="modal fade">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6 class="modal-title"><label id="titulo_editar_nuevo"></label></h6>
      </div>
      <!-- <div class="modal-body"> -->
    <form action="#" method="post" role="form" id="form_nueva_carpeta">
      </br>
      <div class="rows">
            <div class="form-group col-xs-7 col-lg-7">
              <label>Nombre Carpeta</label>
                   <input type="text" class="form-control" placeholder="Ej: Mi Carpeta..." name="nombre_nueva_carpeta"  id="nombre_nueva_carpeta" required="required" >
            </div>
            <div class="form-group col-xs-2 col-lg-2">
                   <label>Nomesclatura</label>
                   <input type="text" class="form-control" placeholder="EJ: MICARP..." name="nomesclatura_carpeta"  id="nomesclatura_carpeta" required="required" >
            </div>
             <div class="form-group col-xs-3 col-lg-3">
                  <label>Nivel de Acceso</label>
                  <select class="form-control"  name="nivel_acceso" id="nivel_acceso" >
                            <option value="" disabled selected hidden>Seleccione</option>
                            <option value="4">TODOS</option>
                            <option value="3">GRTES-SUBGRTES-JEFES</option>
                            <option value="2">GRTES-SUBGRTES</option>
                            <option value="1">GERENTES</option>
                          </select>
            </div>
   
      </div>
    </form>
 </br></br></br>
      <!-- </div> -->
    <div class="rows">
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="crea_carpeta_directorio()">CREAR CARPETA</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
  </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- FIN VENTANA NUEVA CARPETA -->




 <!-- VENTANA EDITAR CARPETA -->
<div id="ventana_editar_carpeta" class="modal fade">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6 class="modal-title"><label id="titulo_editar_carpeta"></label></h6>
      </div>
      <!-- <div class="modal-body"> -->
    <form action="#" method="post" role="form">
      <input type="hidden" id="id_directorio_editar">
      </br>
      <div class="rows">
            <div class="form-group col-xs-7 col-lg-7">
              <label>Nombre Carpeta</label>
                   <input type="text" class="form-control" name="nombre_editar_carpeta"  id="nombre_editar_carpeta" required="required" readonly>
            </div>
            <div class="form-group col-xs-2 col-lg-2">
                   <label>Nomesclatura</label>
                   <input type="text" class="form-control" name="editar_nomesclatura_carpeta"  id="editar_nomesclatura_carpeta" required="required" >
            </div>
             <div class="form-group col-xs-3 col-lg-3">
                  <label>Nivel de Acceso</label>
                  <select class="form-control"  name="editar_nivel_acceso" id="editar_nivel_acceso" >
                            
                          </select>
            </div>
   
      </div>
    </form>
 </br></br></br>
      <!-- </div> -->
    <div class="rows">
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="editar_carpeta_directorio()">GUARDAR CAMBIOS</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
  </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- FIN VENTANA NUEVA CARPETA -->



 <!-- VENTANA CODIGO ARCHIVO -->
<div id="ventana_nuevo_codigo" class="modal fade">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <input type="hidden" id="correlativo_directorio" value="0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><label>CODIGO GENERADO</label></h4>
      </div>
      <!-- <div class="modal-body"> -->
    <form action="#" method="post" role="form">
      </br>
      <div class="rows">
            <div class="form-group col-xs-12 col-lg-12">
                   <label id="directorio_codigo"></label> 
                   <input type="text" class="form-control" name="codigo_generado"  id="codigo_generado" >
            </div>      
      </div>
    </form>
 </br></br></br>
      <!-- </div> -->
    <div class="rows">
      <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="reservar_codigo()">RESERVAR CODIGO</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
  </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- FIN CODIGO ARCHIVO-->


</html>