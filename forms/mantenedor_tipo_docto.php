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


.select2-container .select2-selection--single { 
	height: 34px !important;
}

.select2-selection__rendered {
    line-height: 3.3rem !important;
}

.buttons-excel{
    color:#fff;
    background-color:#30a5ff;
    border-color:#30a5ff;
}

</style>

<HEAD>
<meta http-equiv="Expires" content="0">
 
<meta http-equiv="Last-Modified" content="0">
 
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
 
<meta http-equiv="Pragma" content="no-cache">

<div id="abre_modal" class="modal fade" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #39b3d7; border: 1px solid; border-color:#269abc; padding: 10px 3px 10px 5px; line-height: 15px; top:-15px;" >
               <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <b><font size=3 color="white"><center><label id="titulo"></label></center></font></b>
            </div>
            <div class="modal-body">
			
			    <div class="col-md-12"><input  type="text" class="form-control" id="tipo"             placeholder="" style="display:none;"></div>
				<div class="col-md-12"><input  type="text" class="form-control" id="codigo"           placeholder="" style="display:none;"></div>
				
			  	<form class="col-lg-6">
					<div class="form-group input-group col-lg-12 val_error"><span class="input-group-addon">Tipo Documento:</span>
						<input type="text" class="form-control" id="tipo_documento" ></text>
					</div>
	            </form>
				
				<form class="col-lg-3">
					<div class="form-group input-group col-lg-12 val_error"><span class="input-group-addon">Sigla:</span>
						<input type="text" class="form-control" id="sigla" ></text>
					</div>
				</form>
				
				<form class="col-lg-3">
					<div class="form-group input-group col-xs-12 col-lg-12 val_error"><span class="input-group-addon">Vigente:</span>
						<select class="form-control" id="vigente">
						        <option value='S'>S</option>
								<option value='N'>N</option>
						</select>
					</div>
				</form>
				
				</br>
	

            </div>
			
			    <div class="modal-footer">
				    <button type="button" class="btn btn-success" onclick="guardar()">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>
				
        </div>
              		
    </div>
</div>

			
<div class="panel panel-info">
 
    <div class="panel box-shadow-none content-header margin-topbar">
        <div class="form-group col-xs-12 col-lg-12" style="background-color: #39b3d7; border: 1px solid; border-color:#269abc; padding: 10px 3px 10px 5px; line-height: 15px; top:-15px;">
            <!--colocar al estilo-->
            <b><font size=3 color="white"><center>MANTENEDOR TIPO DOCUMENTO</center></font></b>
        </div>
    </div>

	<div class="form-group col-lg-1">
                <button class="btn btn-success" onclick="abre_modal('Nuevo',0,'','','S')"> <span class="glyphicon glyphicon-plus"></span> Nuevo </button>
    </div>
	
			
    <div class="panel-body">
	
				<div class="col-xs-12 col-lg-12">
							<table id="tabla_tarea_principal" class="display nowrap" width="100%">
								<thead>
									<tr>
										<th>Tipo Documento</th>
										<th>Sigla</th>
										<th>Vigente</th>
										<th></th>								   
									</tr>
								</thead>
							</table>
				</div>
								
	
	</div>
</div>	

<script src="../fracttal_comasa/js/jquery.inputmask.bundle.js"></script>
<script src="../fracttal_comasa/bootbox.min.js"></script>
<link href="../fracttal_comasa/css/toastr.css" rel="stylesheet"/>
<!-- <link href="http://codeseven.github.com/toastr/toastr-responsive.css" rel="stylesheet"/> -->
<script src="../fracttal_comasa/js/toastr.js"></script>

<script type="text/javascript">

$(".val_error").click(function(){  $(this).removeClass("has-error");//$(this).css("color", "#333");
});

function parent_error(id){
  //$(id).parent().css({"color": "red"}); TEXTO
  $(id).parent().addClass("has-error");
}

function limpiar(){	

		document.getElementById("tipo").value='';
		document.getElementById("codigo").value='';
		document.getElementById("tipo_documento").value='';
		document.getElementById("sigla").value='';
		document.getElementById("vigente").value='S';
							
}

function guardar(){	

var cont=0;
		
		if($("#tipo_documento").val() == '' || $("#tipo_documento").val()  == null) { 
						 cont = 1;
						 parent_error("#tipo_documento");	  
						}
		if($("#sigla").val() == '' || $("#sigla").val()  == null) { 
						 cont = 1;
						 parent_error("#sigla");	  
						}
		if($("#vigente").val() == '' || $("#vigente").val()  == null) { 
						 cont = 1;
						 parent_error("#vigente");	  
						}				

if(cont == 0){	

			var dialog = bootbox.dialog({
			message: '<p class="loader"></p>',
			closeButton: false
			});	
			
	 $.ajax({
			url:'json/solicitud_codigo.php?accion=guardar_documento',
			data:{
				tipo:          document.getElementById("tipo").value,
				codigo:        document.getElementById("codigo").value,
				tipo_documento:document.getElementById("tipo_documento").value,
				sigla:         document.getElementById("sigla").value,
				vigente:       document.getElementById("vigente").value
				},
			type: "POST",
			contentType: "application/x-www-form-urlencoded",
			dataType: "json",
			success: function(data){
				if(data != null && $.isArray(data)){
					$.each(data, function(index, value){
							
							dialog.modal('hide');
							
							toastr.success('Datos Ingresados Correctamente', 'AVISO');
					        $(".val_error").removeClass("has-error");							
							
							$('#abre_modal').modal('hide'); 
							
							limpiar();
							tabla_tarea_principal();
				
						});
		
	
					}
				}
			})		
					
}					
					
}	
	
function abre_modal(tipo,cod_tipo_documento,tipo_documento,sigla,vigente){

$("#titulo").html(tipo);
 
document.getElementById("tipo").value=tipo;
document.getElementById("codigo").value=cod_tipo_documento;

document.getElementById("tipo_documento").value=tipo_documento;
document.getElementById("sigla").value=sigla;
document.getElementById("vigente").value=vigente;

	    $('#abre_modal').modal('show');
		//$('.modal-dialog').css('width', '95%');	
}
	
function tabla_tarea_principal(){

var consulta='json/solicitud_codigo.php?accion=tabla_tipo_documento';

$("#tabla_tarea_principal").dataTable().fnDestroy();
$('#tabla_tarea_principal').DataTable({
		 responsive: true,
		 dom: 'Bfrtip',
		 scrollX:true,
         buttons:[/* //{extend: 'excelHtml5',exportOptions: {columns: [ 0,1,2]},title: 'Tipos_documentos'}// */], 
		 aLengthMenu: [
                          [10,25, 50, 100, 200, -1],
                          [10,25, 50, 100, 200, "Todos"]
                      ],
		 iDisplayLength: 10,	
		 
		 "ajax":''+consulta+'',
		 "columns": [
		    { "data": "tipo_documento" },
		    { "data": "sigla" },					   
			{data: 'vigente', "render": function (data, type, row, meta) {
	       		
					if(row.vigente == 'N' ){
					
					return "<div style='color:red'>"+data+"<div>";                
					
					}else{
					
					 return data;
					
					}
                        
			}},
			  {data: 'cod_tipo_documento', "render": function (data, type, row, meta) {
				  return '<button type="button" class="btn btn-warning btn-md glyphicon glyphicon-edit" onclick="abre_modal(\'Modificar\',\''+row.cod_tipo_documento+'\',\''+row.tipo_documento+'\',\''+row.sigla+'\',\''+row.vigente+'\')" ></button>';
				
			 }},	
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

tabla_tarea_principal();

</script>

