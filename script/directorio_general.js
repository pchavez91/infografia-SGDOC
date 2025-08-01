$(document).on('shown.bs.modal', function (e) {
      $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    });
    
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
           .columns.adjust()
           .responsive.recalc();
    });
        


function abre_ventana_buscar_archivo(){

var id_directorio = $("#id_directorio").val();

  if(id_directorio == '0'){

            alert('Error: Al menos debe ingresar a algunos de los directorios');

  }else{

    carga_lista_archivos();

    $("#ventana_busqueda_archivo").modal('show');

  }
}


function visualizar_archivo(id_directorio){

         $.ajax({
                  url:'json/json.php?accion=abrir_nombre_archivo',
                  data:{id_directorio:id_directorio},
                  type:'post',
                  dataType: "json", 
                  success: function (json_jax)
                    {

                       // Abrir nuevo tab
                        var win = window.open('archivos_subidos/'+json_jax.descripcion, '_blank');
                        // Cambiar el foco al nuevo tab (punto opcional)
                        win.focus();

              

                    }
            });

}


function carga_lista_archivos(){

var consulta='json/json.php?accion=listar_archivos_busqueda';


$("#tabla_lista_archivos_encontrados").dataTable().fnDestroy();
$('#tabla_lista_archivos_encontrados').DataTable({
         responsive: true,
         dom: 'Bfrtip',
         scrollX:true,
         buttons: [ 
        ],
             aLengthMenu: [
                          [10,25, 50, 100, 200, -1],
                          [10,25, 50, 100, 200, "Todos"]
                      ],
        iDisplayLength: 10,     
    
            "ajax":''+consulta+'',
            "columns": [
            { "data": "nombre_elemento" },
            { "data": "codigo_archivo" },
            { "data": "ruta" },
            {data: 'id', "render": function (data, type, row, meta) {
                return '<div class="form-group col-xs-2 col-md-2 col-lg-2" onClick="visualizar_archivo(\''+row.id+'\')"><img src="img/'+row.extencion_elemento+'.png" class="img-responsive" style="max-width: 30px;" alt="Logo" title="'+row.nombre_elemento+'" ></div>';
            }} 
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




function carga_lista_codigos(){


var id_directorio = $("#id_directorio").val();
var consulta='json/json.php?accion=lista_de_codigos&id_directorio='+id_directorio;


$("#tabla_lista_archivos").dataTable().fnDestroy();
$('#tabla_lista_archivos').DataTable({
         responsive: true,
         dom: 'Bfrtip',
         scrollX:true,
         buttons: [ 
        ],
             aLengthMenu: [
                          [10,25, 50, 100, 200, -1],
                          [10,25, 50, 100, 200, "Todos"]
                      ],
        iDisplayLength: 10,     
    
            "ajax":''+consulta+'',
            "columns": [
            { "data": "codigo_directotio" },
            { "data": "fecha_creacion" },
            { "data": "utilizado" },
            {data: 'id', "render": function (data, type, row, meta) {

                if(row.utilizado=='NO'){
                    return '<center><button type="button"  class="btn btn-danger fa fa-minus-square btn-md pull-left" title="Eliminar código" onclick="eliminar_codigo(\''+row.id+'\')" ></button>';
                }else{
                    return '';
                }

            }}  
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





function eliminar_codigo(id_codigo){


    $.ajax({
          url:'json/json.php?accion=eliminar_codigo',
          data:{id_codigo:id_codigo},
          type:'post',
          dataType: "json", 
          success: function (json_jax)
            {
               if(json_jax[0].success=='true'){

                listar_codigos();

               }
            }
    });

}




function listar_codigos(){

  var rutta_directorio = $("#ruta_directorio").html();
  $("#directorio_codigos").html(rutta_directorio);

  carga_lista_codigos();

    $("#ventana_lista_codigos").modal('show');


}


function reservar_codigo(){
    var id_directorio = $("#id_directorio").val();
    var codigo_directotio = $("#codigo_directotio").val();
    var correlativo_directorio = $("#correlativo_directorio").val();
    var codigo_generado = $("#codigo_generado").val();
    var ruta_directorio = $("#ruta_directorio").html();



    $.ajax({
          url:'json/json.php?accion=reservar_codigo',
          data:{id_directorio:id_directorio,
                codigo_directotio:codigo_directotio,
                correlativo_directorio:correlativo_directorio,
                codigo_generado:codigo_generado,
                ruta_directorio:ruta_directorio},
          type:'post',
          dataType: "json", 
          success: function (json_jax)
            {
               if(json_jax[0].success=='true'){

                $("#ventana_nuevo_codigo").modal('hide');
                alert(json_jax[0].codigo);

               }
            }
    });

}

function generar_codigo(){
    var id_directorio = $("#id_directorio").val();
    if(id_directorio!='0'){

        $.ajax({
              url:'json/json.php?accion=generar_codigo',
              data:{id_directorio:id_directorio},
              type:'post',
              dataType: "json", 
              success: function (data)
                {

                      if(data[0].success=='false'){

                        alert(data[0].codigo);

                      }else{

                        var directorio_codigo = $("#ruta_directorio").html();
                         $("#directorio_codigo").html(directorio_codigo);
                         $("#codigo_generado").val(data[0].codigo);
                         $("#correlativo_directorio").val(data[0].correlativo);
                        $("#ventana_nuevo_codigo").modal('show');

                      } 
                        

                }
        });


    }else{
        alert('ERROR: Debe almenos ingresar a un directorio');
    }


}


function crea_carpeta(){

  var rutta_directorio = $("#ruta_directorio").html();
  $("#titulo_editar_nuevo").html(rutta_directorio);

  
    $("#nombre_nueva_carpeta").val('');
    $("#ventana_nueva_carpeta").modal('show');

    $('#ventana_nueva_carpeta').on('shown.bs.modal', function () {
            $('#nombre_nueva_carpeta').focus();
        }) 

}

function crea_carpeta_directorio(){

    var nombre_nueva_carpeta = $("#nombre_nueva_carpeta").val();
    var nomesclatura_carpeta = $("#nomesclatura_carpeta").val();
    var id_directorio = $("#id_directorio").val();
    var ruta_directorio = $("#ruta_directorio").html();

    $.ajax({
          url:'json/json.php?accion=crea_carpeta_directorio',
          data:{nombre_nueva_carpeta:nombre_nueva_carpeta,
                nomesclatura_carpeta:nomesclatura_carpeta,
                id_directorio:id_directorio,
                ruta_directorio:ruta_directorio},
          type:'post',
          dataType: "json", 
          success: function (json_jax)
            {
                $("#ventana_nueva_carpeta").modal('hide');
                ingresar_directorio(id_directorio,'1');
            }
    });


}



function carga_directorio_inicio(){

    $("#ruta_directorio").html("DIRECTORIO PRINCIPAL"); 

	$.ajax({
          url:'json/json.php?accion=consulta_directorio_principal',
          //data:{id_subsistema:id_subsistema},
          type:'post',
          dataType: "json", 
          success: function (json_jax)
            {
      
            	for (var i = 0; i < json_jax.data.length; i++) {

                  $("#directorio_principal").append('<div class="col-lg-6 col-xs-12" onclick="ingresar_directorio('+json_jax.data[i].id+','+json_jax.data[i].tipo_elemento+')"><div class="panel panel-default"><div class="panel-body"><img src="img/server2.png" class="img-responsive" style="max-width: 150px;" alt="Logo" title="'+json_jax.data[i].nombre_elemento+'" ><h4 class="centered"><br><strong>'+json_jax.data[i].nombre_elemento+'</strong></h4></div></div></div>');

                }
            }
    });

};



function ingresar_directorio(id_directorio,extencion_elemento,nombre_carpeta){

     //extencion_elemento =(si es '1' es una carpeta y si es '2' es un archivo)
     if(extencion_elemento=='1'){
        $("#id_directorio").val(id_directorio); 
      }

      var contenido_tabla=''; 

     if(extencion_elemento=='1'){

     	$("#directorio_principal").html(""); 
     

	     	$.ajax({
	          url:'json/json.php?accion=consulta_directorio_adelante_general',
	          data:{id_directorio:id_directorio},
	          type:'post',
	          dataType: "json", 
	          success: function (json_jax)
	            {

                    if(json_jax.data.length=='0' && id_directorio!='0'){

                        var ruta_absoluta=$("#ruta_directorio").html();

                        $("#ruta_directorio").html(ruta_absoluta+' '+nombre_carpeta+' >'); 

                    }
	      
	            	for (var i = 0; i < json_jax.data.length; i++) {

                        if(json_jax.data[i].tipo_elemento=='1'){

                            var nombre_elemento=json_jax.data[i].nombre_nomesclatura;

                        }else{
                            var nombre_elemento=json_jax.data[i].nombre_elemento;
                        }
                        

	                  //$("#directorio_principal").append("<div class='col-lg-3' onclick='ingresar_directorio(\""+json_jax.data[i].id+"\",\""+json_jax.data[i].tipo_elemento+"\",\""+json_jax.data[i].nombre_elemento+"\")'><div class='panel panel-default'><div class='panel-body'><img src='img/"+json_jax.data[i].extencion_elemento+".png' class='img-responsive' style='max-width: 150px;' alt='Logo' title='"+nombre_elemento+" - NIVEL "+json_jax.data[i].nivel_acceso+"' ><h6 class='centered'><br><strong>"+nombre_elemento+"</strong></h6></div></div></div>");

                       contenido_tabla=contenido_tabla+"<tr><td><img src='img/"+json_jax.data[i].extencion_elemento+".png' class='img-responsive' style='max-width: 50px;' alt='Logo' title='"+nombre_elemento+" - NIVEL "+json_jax.data[i].nivel_acceso+"' ></td><td align='left'><a onclick='ingresar_directorio(\""+json_jax.data[i].id+"\",\""+json_jax.data[i].tipo_elemento+"\",\""+json_jax.data[i].nombre_elemento+"\")'><strong style='color:#333FFF';>"+nombre_elemento+"</strong></a></td><td align='left'><a onclick='ingresar_directorio(\""+json_jax.data[i].id+"\",\""+json_jax.data[i].tipo_elemento+"\",\""+json_jax.data[i].nombre_elemento+"\")'><strong style='color:#333FFF';>"+json_jax.data[i].codigo_archivo+"</strong></a></td><td><strong style='color:#333FFF';>"+json_jax.data[i].extencion_elemento+"</strong></td></tr>";

                      


                      $("#ruta_directorio").html(json_jax.data[i].ruta); 
	                }

                      $("#directorio_principal").html("<table class='display nowrap' width='100%'><tr><th>Tipo</th><th>Nombre</th><th>Código</th><th>Extención</th></tr>"+contenido_tabla+"</table>"); 
              
	            }
	    });

     }else{

         $.ajax({
                  url:'json/json.php?accion=abrir_nombre_archivo',
                  data:{id_directorio:id_directorio},
                  type:'post',
                  dataType: "json", 
                  success: function (json_jax)
                    {

                       // Abrir nuevo tab
                        var win = window.open('archivos_subidos/'+json_jax.descripcion, '_blank');
                        // Cambiar el foco al nuevo tab (punto opcional)
                        win.focus();

              

                    }
            });

     }

}; 



function salir_directorio(){

     $("#directorio_principal").html(""); 

     var id_directorio = $("#id_directorio").val(); 

     var contenido_tabla=''; 
     

     if(id_directorio=='1' || id_directorio=='2' || id_directorio=='0' || id_directorio==''){
     	carga_directorio_inicio();
     }else{

     	$.ajax({
          url:'json/json.php?accion=consulta_directorio_atras_general',
          data:{id_directorio:id_directorio},
          type:'post',
          dataType: "json", 
          success: function (json_jax)
            {
      
            	for (var i = 0; i < json_jax.data.length; i++) {

            	$("#id_directorio").val(json_jax.data[i].id_padre);

                $("#ruta_directorio").html(json_jax.data[i].ruta); 

                        if(json_jax.data[i].tipo_elemento=='1'){

                            var nombre_elemento=json_jax.data[i].nombre_nomesclatura;

                        }else{
                            var nombre_elemento=json_jax.data[i].nombre_elemento;
                        }


                        if(id_directorio==json_jax.data[i].id){
                            var color='#FF5733';
                        }else{
                            var color='#333FFF';
                        }

                  //$("#directorio_principal").append("<div class='col-lg-3' onclick='ingresar_directorio(\""+json_jax.data[i].id+"\",\""+json_jax.data[i].tipo_elemento+"\",\""+json_jax.data[i].nombre_elemento+"\")'><div class='panel panel-default'><div class='panel-body'><img src='img/"+json_jax.data[i].extencion_elemento+".png' class='img-responsive' style='max-width: 150px;' alt='Logo' title='"+nombre_elemento+" - NIVEL "+json_jax.data[i].nivel_acceso+"' ><h6 class='centered'><br><strong>"+nombre_elemento+"</strong></h6></div></div></div>");

                     contenido_tabla=contenido_tabla+"<tr><td><img src='img/"+json_jax.data[i].extencion_elemento+".png' class='img-responsive' style='max-width: 50px;' alt='Logo' title='"+nombre_elemento+" - NIVEL "+json_jax.data[i].nivel_acceso+"' ></td><td align='left'><a onclick='ingresar_directorio(\""+json_jax.data[i].id+"\",\""+json_jax.data[i].tipo_elemento+"\",\""+json_jax.data[i].nombre_elemento+"\")'><strong style='color:"+color+"';>"+nombre_elemento+"</strong></a></td><td><strong style='color:"+color+"';>"+json_jax.data[i].codigo_archivo+"</strong></td><td><strong style='color:"+color+"';>"+json_jax.data[i].extencion_elemento+"</strong></td></tr>";


                }

                  $("#directorio_principal").html("<table class='display nowrap' width='100%'><tr><th>Tipo</th><th>Nombre</th><th>Código</th><th>Extención</th></tr>"+contenido_tabla+"</table>"); 


            }
    	});

     }

}; 

carga_directorio_inicio();

	
