<style>

toastr.options = {
  "debug": false,
  "positionClass": "toast-bottom-right",
  "onclick": null,
  "fadeIn": 300,
  "fadeOut": 100,
  "timeOut": 5000,
  "extendedTimeOut": 1000
}

.fadeout{
  opacity: 0;
}

 .table { width: 100%; max-width: none; // >= this is very important } 
 
    body:not(.modal-open) {
        padding-right: 0px !important;
    }
    
    .nav > li > a:hover,
    .nav > li > a:focus {
        background-color: #ABEBC6;
        text-decoration: none;
    }
    
    .btn-success2 {
        color: #fff;
        background-color: #65CEA7;
        border-color: #65CEA7;
    }
    
    .panel-default > .panel-heading {
        background-color: #007bff;
        border-color: #424F63;
        color: #fff;
    }
    
    .modal {
        overflow: scroll !important;
    }
    
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid blue;
        border-bottom: 16px solid blue;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        margin-right: auto;
        margin-left: auto;
    }
    
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }
    
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>

<head>

<link href="../../css/style.css" rel="stylesheet">
  
<body class="sticky-header left-side-collapsed">

  <div class="form_empresa">
      <div class="panel panel-default">
        <div class="panel-body">

          <CENTER><label>MIS ARCHIVOS</label></CENTER>

          <div class="col-xs-12 col-lg-12">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="abre_ventana_subir_archivo()">Subir un Archivo</button>
          </div>
          <br>
          <br>

             <div class="col-xs-12 col-lg-12">
                  <table id="tabla_lista_archivos" class="display nowrap" width="100%">
                      <thead>
                          <tr>
                          <th>Nombre Archivo</th>
                          <th>Código</th>
                          <th>Subido</th>
                          <th>Ubicación</th>
                          <th>Aprobado</th>
                          <th>F. Aprueb.</th>
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

 <!-- VENTANA CODIGO ARCHIVO -->
<div id="ventana_subir_archivo" class="modal fade">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <input type="hidden" id="correlativo_directorio" value="0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><label>SUBIR ARCHIVO</label></h4>
      </div>
      <!-- <div class="modal-body"> -->
    <form action="#" method="post" role="form" id="formulario_subir_archivos">

  </br> 
              <div class="row">
        <div class="col-lg-12">
         
          <div class="form-group col-xs-12 col-lg-12 val_error">
            <input class="form-control" type="text" id="nombre_archivo" placeholder="Ej: Nombre de Archivo" />
          </div>
          
          <div class="form-group col-xs-12 col-lg-12 val_error">
            <input class="form-control" type="text" id="codigo_en_directorio" placeholder="Ej: COM-OP-0001-V1" />
          </div>
          
          <div class="form-group col-xs-12 col-lg-12 val_error">
                <select class="form-control" type="text" id="ubicacion" >
                  <option value="" disabled selected hidden>SELECCIONE UBICACIÓN...</option> 
                  <option value="Lautaro_I" >LAUTARO I</option>
                  <option value="Lautaro_II" >LAUTARO II</option>
                  <option value="Planta_General" >PLANTA GENERAL</option>
                            </select>
          </div>
          
          <div class="form-group col-xs-12 col-md-12 col-lg-12" style="display:none;">
          <label>doc_adjunto:</label>
          <input required type="text" class="form-control" id="doc_adjunto" > 
          </div>

          <div id="respuesta" class="form-group col-xs-12 col-md-12 col-lg-12 alert" style="display:none;"></div>
          
            <div class="form-group col-lg-12">
              <input type="file" name="archivo" id="archivo"/>
            </div> 
            
            <!--  <div class="col-lg-1">
            
                <button style="display:display" type="button" id="boton_subir" class="btn btn-warning">Subir Documentos
                    <span class="glyphicon glyphicon-cloud-upload"></span>
                </button>
       
            </div> -->
                
                 
          </br>
          <div id="archivos_subidos"></div> 
          
              
                </div>
          </div>        
        
   
    </form>
    </br>
      <!-- </div> -->
    <div class="rows">
      <div class="modal-footer">
        <button type="button" class="btn btn-info" id="boton_subir">CONFIRMAR <span class="glyphicon glyphicon-cloud-upload"></span> </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
      </div>
    </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- FIN CODIGO ARCHIVO-->

</head>




 <!-- VENTANA NUEVA CARPETA -->
<div id="ventana_motivo_rechazo" class="modal fade">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><center>MOTIVO DE RECHAZO</center></h4>
      </div>
      <!-- <div class="modal-body"> -->
    <form action="#" method="post" role="form" id="form_nueva_carpeta">
      <br>
      <div class="rows">
            <div class="form-group col-xs-12 col-lg-12"><strong id="docto_rechazado"></strong><br><strong id="fecha_rechaza"></strong><br><strong id="usuario_rechaza"></strong><br><strong id="visualiza_motivo_rechazo"></strong></div>

      </div>
    </form>
 <br><br><br><br><br>
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



<script src="../repositorio/js/jquery.inputmask.bundle.js"></script>
<script src="../repositorio/bootbox.min.js"></script>
<script src="script/subir_archivo.js"></script>

<script src="../repositorio/upload/js/upload.js"></script>
<script src="../repositorio/upload/js/upload_multiple.js"></script>

<link href="../repositorio/css/toastr.css" rel="stylesheet"/>
<!-- <link href="http://codeseven.github.com/toastr/toastr-responsive.css" rel="stylesheet"/> -->
<script src="../repositorio/js/toastr.js"></script>

<script type="text/javascript">

            function subirArchivos() {
        
                if($("#nombre_archivo").val() == '' || $("#nombre_archivo").val()  == null) { 
         parent_error("#nombre_archivo");   
        }

        if($("#codigo_en_directorio").val() == '' || $("#codigo_en_directorio").val()  == null) { 
         parent_error("#codigo_en_directorio");   
        }

        if($("#ubicacion").val() == '' || $("#ubicacion").val()  == null) { 
         parent_error("#ubicacion");    
        }
        
        var fileInput = document.getElementById("archivo");
        var files = fileInput.files;
        var file;
        var cont =0;
        
        if(files.length == 0) { 
           
         document.getElementById("respuesta").style.display = "block";
         $("#respuesta").addClass('alert-danger').html('Debe Seleccionar Archivo Adjunto');
          
        }
        
          for (var i = 0; i < files.length; i++) {
          
              file = files[i];
              //alert(i);
              //alert(file.name);
          
                $('#archivo').upload_multiple('upload/subir_archivo.php?accion=adjuntos',
              {
                //nombre_archivo: $("#nombre_archivo").val()
              },
              function(respuesta,documento) {
                //Subida finalizada.
                $("#barra_de_progreso").val(0);
                if (respuesta != 0) {
                
                  //mostrarRespuesta('El archivo ha sido subido correctamente.', true);
                  //$("#nombre_archivo, #archivo").val('');
                   //mostrarArchivos(respuesta,'ingresar');
                  
                  cont = cont+1;

                   document.getElementById("doc_adjunto").value=respuesta;  
                   confirmar_archivo(respuesta,cont,files.length);
                   
                } else {
                  //mostrarRespuesta('El archivo NO se ha podido subir.', false);
                }
                 
              }, function(progreso, valor) {
                //Barra de progreso.
                $("#barra_de_progreso").val(valor);
              },i);

          }             
               
            }
          
            $(document).ready(function() {
                /*mostrarArchivos();*/
         $("#archivo").on('click', function() {
         document.getElementById("respuesta").style.display = "none";
                 //$("#respuesta").removeClass('alert-success').removeClass('alert-danger').html('');
                });
          $("#boton_subir").on('click', function() {
                    subirArchivos();
                });
        

            });
      
</script>