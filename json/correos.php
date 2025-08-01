<?php
//session_start();
include_once("../../../config/conex.php");
//require_once('../../../lib2/PHPMailerAutoload.php');
$link = Conexion();

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$continua = true;



function correo_rechaza_publicacion($fecha_rechazo,$motivo_rechazo,$usuario_aprueba,$usuario_crea,$user_correo,$nombre_elemento,$descripcion,$correo_aprueba){

$link = Conexion();
$continua = true;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->CharSet = "UTF-8";
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure ="tls";
$mail->Username  = "comasa.info@gmail.com";
$mail->Password = "gqjopyktbcbxqwln";

/* $mail->Host = "smtp.office365.com";
$mail->SMTPSecure ="STARTTLS";
$mail->Username  = "compras@comasageneracion.cl";
$mail->Password = "o365.2019"; */

$mail->SetFrom  ('compras@comasageneracion.cl', 'Comasa'); //('tu_correo@gmail.com', 'Administrador');
$asunto='RECHAZO DE PUBLICACI�N DE DOCUMENTO EN SISTEMA DE GESTI�N DOCUMENTAL';
$mail->Subject = (utf8_encode($asunto));

// -----  detalle 
$mail->MsgHTML("
<p> <strong>".utf8_encode('Estimado/a, le informamos que lamentablemente su documento subido al sistema de Gesti�n Documental "NO SE H� PUBLICADO". A continuaci�n se encuentra el detalle del rechazo de este proceso:')." </strong> </p>

<p> <span style='color:#000000';><strong>Con fecha:                          </strong></span> ".utf8_encode($fecha_rechazo)." </p>
<p> <span style='color:#000000';><strong>Motivo del rechazo:                 </strong></span> ".utf8_encode($motivo_rechazo)." </p>
<p> <span style='color:#000000';><strong>Usuario que rechaza:                </strong></span> ".utf8_encode(str_replace('_',' ',$usuario_aprueba))." </p>
<p></p>
<p> <span style='color:#000000';><strong>Nombre del documento:               </strong></span> ".utf8_encode($nombre_elemento)." </p>
<p> <span style='color:#000000';><strong>".utf8_encode('Descripci�n').": </strong></span> ".utf8_encode($descripcion)." </p>
<p></p>");

$mail->Timeout=30;

$mail->AddAddress('mantinao@comasageneracion.cl','');
$mail->AddAddress($_SESSION['user_correo'],'');
//$mail->AddAddress('croa@comasageneracion.cl','');
$mail->AddAddress($user_correo,'');
$mail->AddAddress($correo_aprueba,'');

$intentos=1; 
if(!$mail->Send()) {
	    
			echo '[{"mensaje":"Error en el envio","success":true}]';     
			} else {
				
            echo '[{"mensaje":"RECHAZADO CORRECTAMENTE","success":"true"}]'; 
    
			}
}




function correo_solicitar_automatico($repositorio,$nombre_documento,$tipo_documento,$area,$departamento,$version,$resumen_contenido,$combo_ultimo_nivel,$id_repositorio,$codigo_generado_automaticamente){

$link = Conexion();
$continua = true;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->CharSet = "UTF-8";
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure ="tls";
$mail->Username  = "comasa.info@gmail.com";
$mail->Password = "gqjopyktbcbxqwln";

/* $mail->Host = "smtp.office365.com";
$mail->SMTPSecure ="STARTTLS";
$mail->Username  = "compras@comasageneracion.cl";
$mail->Password = "o365.2019"; */

$mail->SetFrom  ('compras@comasageneracion.cl', 'Comasa'); //('tu_correo@gmail.com', 'Administrador');
$asunto='SOLICITUD DE C�DIGO GESTI�N DOCUMENTAL';
$mail->Subject = (utf8_encode($asunto));
$mail->Timeout=30;
// -----  detalle 

if($id_repositorio=='4'){

		$mail->MsgHTML("
		<p>".utf8_encode('Estimado(a): A continuaci�n, se encuentra su c�digo parea el documento el m�dulo de Gesti�n Documental y el detalle de su solicitud. Ante cualquier duda sobre la informaci�n que contiene este correo favor comunicarse con el departamento TI.')." </p>

		<center><p> <span style='color:#000000';><h2>SU CODIGO ES:</h2></span> <h2 style=color:blue;>".$codigo_generado_automaticamente."</h2> </p></center>

		<p> <span style='color:#000000';><strong>DETALLE</strong></span></p>
		<p> <span style='color:#000000';><strong>Fecha:                      </strong></span> ".date('d-m-Y')." </p>
		<p> <span style='color:#000000';><strong>Nombre del Documento:       </strong></span> ".utf8_encode($nombre_documento)." </p>
		<p> <span style='color:#000000';><strong>".utf8_encode('Versi�n').": </strong></span> ".utf8_encode($version)." </p>
		<p> <span style='color:#000000';><strong>Resumen Contenido:          </strong></span> ".utf8_encode($resumen_contenido)." </p>
		<p> <span style='color:#000000';><strong>Repositorio:                </strong></span> ".utf8_encode($repositorio)." </p>
		<p> <span style='color:#000000';><strong>".utf8_encode('�rea').":    </strong></span> ".utf8_encode($area)." </p>
		<p> <span style='color:#000000';><strong>Sistema:               </strong></span> ".utf8_encode($departamento)." </p>
		<p> <span style='color:#000000';><strong>Subsistema:              </strong></span> ".utf8_encode($tipo_documento)." </p>
		<p> <span style='color:#000000';><strong>Tipo de Documento:              </strong></span> ".utf8_encode($combo_ultimo_nivel)." </p>
		<p> <span style=color:#000000;><strong>Solicitante:     </strong></span> ".utf8_encode($_SESSION['nick'])." </p>
		<p> <span style=color:#000000;><strong>Correo:          </strong></span> ".utf8_encode($_SESSION['correo'])." </p>
		<p></p>");

		$mail->AddAddress($_SESSION['correo'],'');


}else{

		$mail->MsgHTML("
		<p>".utf8_encode('Estimado(a): A continuaci�n, se encuentra su c�digo parea el documento el m�dulo de Gesti�n Documental y el detalle de su solicitud. Ante cualquier duda sobre la informaci�n que contiene este correo favor comunicarse con el departamento TI.')." </p>

		<center><p> <span style='color:#000000';><h2>SU CODIGO ES:</h2></span> <h2 style=color:blue;>".$codigo_generado_automaticamente."</h2> </p></center>

		<p> <span style='color:#000000';><strong>DETALLE</strong></span></p>
		<p> <span style='color:#000000';><strong>Fecha:                      </strong></span> ".date('d-m-Y')." </p>
		<p> <span style='color:#000000';><strong>Nombre del Documento:       </strong></span> ".utf8_encode($nombre_documento)." </p>
		<p> <span style='color:#000000';><strong>".utf8_encode('Versi�n').": </strong></span> ".utf8_encode($version)." </p>
		<p> <span style='color:#000000';><strong>Resumen Contenido:          </strong></span> ".utf8_encode($resumen_contenido)." </p>
		<p> <span style='color:#000000';><strong>Repositorio:                </strong></span> ".utf8_encode($repositorio)." </p>
		<p> <span style='color:#000000';><strong>".utf8_encode('�rea').":    </strong></span> ".utf8_encode($area)." </p>
		<p> <span style='color:#000000';><strong>Departamento:               </strong></span> ".utf8_encode($departamento)." </p>
		<p> <span style='color:#000000';><strong>Tipo de Documento:              </strong></span> ".utf8_encode($tipo_documento)." </p>
		<p> <span style=color:#000000;><strong>Solicitante:     </strong></span> ".utf8_encode($_SESSION['nick'])." </p>
		<p> <span style=color:#000000;><strong>Correo:          </strong></span> ".utf8_encode($_SESSION['correo'])." </p>
		<p></p>");

			$mail->AddAddress($_SESSION['correo'],'');
}


		

//$mail->AddAddress('mantinao@comasageneracion.cl','');
//$mail->AddAddress('croa@comasageneracion.cl','');

$intentos=1; 
if(!$mail->Send()) {
	
	           $sql_no_enviadas ="INSERT INTO [TI].[base_repositorio_solictud_codigo]
											   ([repositorio]
											   ,[nombre_documento]
											   ,[tipo_documento]
											   ,[area]
											   ,[departamento]
											   ,[version]
											   ,[resumen_contenido]
											   ,[enviado]
											   ,[fecha_registro]
											   ,[usuario_registro])
                                   
										VALUES('".$repositorio."',
											   '".$nombre_documento."',
											   '".$tipo_documento."',
											   '".$area."',
											   '".$departamento."',
											   '".$version."',
											   '".$resumen_contenido."', 
											   'NO',		
											   GETDATE(),
											   '".$_SESSION['nick']."')";

				mssql_query($sql_no_enviadas, $link);
	
    
			echo '[{"mensaje":"Error en el envio","success":true}]';     
			} else {
				
				$sql_no_enviadas ="INSERT INTO [TI].[base_repositorio_solictud_codigo]
											   ([repositorio]
											   ,[nombre_documento]
											   ,[tipo_documento]
											   ,[area]
											   ,[departamento]
											   ,[version]
											   ,[resumen_contenido]
											   ,[enviado]
											   ,[fecha_registro]
											   ,[usuario_registro])
                                   
										VALUES('".$repositorio."',
											   '".$nombre_documento."',
											   '".$tipo_documento."',
											   '".$area."',
											   '".$departamento."',
											   '".$version."',
											   '".$resumen_contenido."', 
											   'SI',		
											   GETDATE(),
											   '".$_SESSION['nick']."')";

				mssql_query($sql_no_enviadas, $link);

            echo '[{"mensaje":"Correo enviado con Exito","success":"true"}]'; 
    
			}



}





function correo_solicitar_codigo($repositorio,$nombre_documento,$tipo_documento,$area,$departamento,$version,$resumen_contenido,$combo_ultimo_nivel,$id_repositorio){

$link = Conexion();
$continua = true;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->CharSet = "UTF-8";
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure ="tls";
$mail->Username  = "comasa.info@gmail.com";
$mail->Password = "gqjopyktbcbxqwln";

/* $mail->Host = "smtp.office365.com";
$mail->SMTPSecure ="STARTTLS";
$mail->Username  = "compras@comasageneracion.cl";
$mail->Password = "o365.2019"; */

$mail->SetFrom  ('compras@comasageneracion.cl', 'Comasa'); //('tu_correo@gmail.com', 'Administrador');
$asunto='SOLICITUD DE C�DIGO PARA SISTEMA DE GESTI�N DOCUMENTAL';
$mail->Subject = (utf8_encode($asunto));
$mail->Timeout=30;

// -----  detalle 

if($id_repositorio=='4'){

		$mail->MsgHTML("
		<p> <strong>".utf8_encode('Estimado/a, a continuaci�n se detalla informaci�n de solicitud de c�digo Gesti�n documental')." </strong> </p>

		<p> <span style='color:#000000';><strong>Fecha:                      </strong></span> ".date('d-m-Y')." </p>
		<p> <span style='color:#000000';><strong>Nombre del Documento:       </strong></span> ".utf8_encode($nombre_documento)." </p>
		<p> <span style='color:#000000';><strong>".utf8_encode('Versi�n').": </strong></span> ".utf8_encode($version)." </p>
		<p> <span style='color:#000000';><strong>Resumen Contenido:          </strong></span> ".utf8_encode($resumen_contenido)." </p>
		<p> <span style='color:#000000';><strong>Repositorio:                </strong></span> ".utf8_encode($repositorio)." </p>
		<p> <span style='color:#000000';><strong>".utf8_encode('�rea').":    </strong></span> ".utf8_encode($area)." </p>
		<p> <span style='color:#000000';><strong>Sistema:               </strong></span> ".utf8_encode($departamento)." </p>
		<p> <span style='color:#000000';><strong>Subsistema:              </strong></span> ".utf8_encode($tipo_documento)." </p>
		<p> <span style='color:#000000';><strong>Tipo de Documento:              </strong></span> ".utf8_encode($combo_ultimo_nivel)." </p>
		<p> <span style=color:blue;><strong>Solicitante:     </strong></span> ".utf8_encode($_SESSION['nick'])." </p>
		<p> <span style=color:blue;><strong>Correo:          </strong></span> ".utf8_encode($_SESSION['correo'])." </p>
		<p></p>");

		$mail->AddAddress('llaborit@comasageneracion.cl','');


}else{

		$mail->MsgHTML("
		<p> <strong>".utf8_encode('Estimado/a, a continuaci�n se detalla informaci�n de solicitud de c�digo Gesti�n documental')." </strong> </p>

		<p> <span style='color:#000000';><strong>Fecha:                      </strong></span> ".date('d-m-Y')." </p>
		<p> <span style='color:#000000';><strong>Nombre del Documento:       </strong></span> ".utf8_encode($nombre_documento)." </p>
		<p> <span style='color:#000000';><strong>".utf8_encode('Versi�n').": </strong></span> ".utf8_encode($version)." </p>
		<p> <span style='color:#000000';><strong>Resumen Contenido:          </strong></span> ".utf8_encode($resumen_contenido)." </p>
		<p> <span style='color:#000000';><strong>Repositorio:                </strong></span> ".utf8_encode($repositorio)." </p>
		<p> <span style='color:#000000';><strong>".utf8_encode('�rea').":    </strong></span> ".utf8_encode($area)." </p>
		<p> <span style='color:#000000';><strong>Departamento:               </strong></span> ".utf8_encode($departamento)." </p>
		<p> <span style='color:#000000';><strong>Tipo de Documento:              </strong></span> ".utf8_encode($tipo_documento)." </p>
		<p> <span style=color:blue;><strong>Solicitante:     </strong></span> ".utf8_encode($_SESSION['nick'])." </p>
		<p> <span style=color:blue;><strong>Correo:          </strong></span> ".utf8_encode($_SESSION['correo'])." </p>
		<p></p>");

		$mail->AddAddress('llaborit@comasageneracion.cl','');
}


		

$mail->Timeout=30;

$mail->AddAddress('mantinao@comasageneracion.cl','');
//$mail->AddAddress('croa@comasageneracion.cl','');

$intentos=1; 
if(!$mail->Send()) {
	
	           $sql_no_enviadas ="INSERT INTO [TI].[base_repositorio_solictud_codigo]
											   ([repositorio]
											   ,[nombre_documento]
											   ,[tipo_documento]
											   ,[area]
											   ,[departamento]
											   ,[version]
											   ,[resumen_contenido]
											   ,[enviado]
											   ,[fecha_registro]
											   ,[usuario_registro])
                                   
										VALUES('".$repositorio."',
											   '".$nombre_documento."',
											   '".$tipo_documento."',
											   '".$area."',
											   '".$departamento."',
											   '".$version."',
											   '".$resumen_contenido."', 
											   'NO',		
											   GETDATE(),
											   '".$_SESSION['nick']."')";

				mssql_query($sql_no_enviadas, $link);
	
    
			echo '[{"mensaje":"Error en el envio","success":true}]';     
			} else {
				
				$sql_no_enviadas ="INSERT INTO [TI].[base_repositorio_solictud_codigo]
											   ([repositorio]
											   ,[nombre_documento]
											   ,[tipo_documento]
											   ,[area]
											   ,[departamento]
											   ,[version]
											   ,[resumen_contenido]
											   ,[enviado]
											   ,[fecha_registro]
											   ,[usuario_registro])
                                   
										VALUES('".$repositorio."',
											   '".$nombre_documento."',
											   '".$tipo_documento."',
											   '".$area."',
											   '".$departamento."',
											   '".$version."',
											   '".$resumen_contenido."', 
											   'SI',		
											   GETDATE(),
											   '".$_SESSION['nick']."')";

				mssql_query($sql_no_enviadas, $link);

            echo '[{"mensaje":"Correo enviado con Exito","success":"true"}]'; 
    
			}



}






function correo_rechazo($fecha_rechazo,$motivo_rechazo,$usuario_aprueba,$usuario_crea,$user_correo,$nombre_elemento,$descripcion){

$link = Conexion();
$continua = true;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->CharSet = "UTF-8";
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure ="tls";
$mail->Username  = "comasa.info@gmail.com";
$mail->Password = "gqjopyktbcbxqwln";

/* $mail->Host = "smtp.office365.com";
$mail->SMTPSecure ="STARTTLS";
$mail->Username  = "compras@comasageneracion.cl";
$mail->Password = "o365.2019"; */

$mail->SetFrom  ('compras@comasageneracion.cl', 'Comasa'); //('tu_correo@gmail.com', 'Administrador');
$asunto='RECHAZO DE APROBACI�N DE DOCUMENTO EN SISTEMA DE GESTI�N DOCUMENTAL';
$mail->Subject = (utf8_encode($asunto));

// -----  detalle 
$mail->MsgHTML("
<p> <strong>".utf8_encode('Estimado/a, le informamos que lamentablemente su documento subido al sistema de Gesti�n Documental "NO H� SIDO APROBADO", a continuaci�n se encuentra el detalle de este proceso:')." </strong> </p>

<p> <span style='color:#000000';><strong>Rechado con fecha:                          </strong></span> ".utf8_encode($fecha_rechazo)." </p>
<p> <span style='color:#000000';><strong>Usuario que rechaza:                </strong></span> ".utf8_encode(str_replace('_',' ',$usuario_aprueba))." </p>
<p> <span style='color:#000000';><strong>Motivo del rechazo:                 </strong></span> ".utf8_encode($motivo_rechazo)." </p>
<p></p>
<p> <span style='color:#000000';><strong>Usuario:                        </strong></span> ".utf8_encode(str_replace('_',' ',$usuario_crea))." </p>
<p> <span style='color:#000000';><strong>Nombre del documento:               </strong></span> ".utf8_encode($nombre_elemento)." </p>
<p> <span style='color:#000000';><strong>".utf8_encode('Descripci�n').": </strong></span> ".utf8_encode($descripcion)." </p>
<p></p>");

$mail->Timeout=30;

$mail->AddAddress('jpinto@comasageneracion.cl','');
$mail->AddAddress($user_correo,'');
//$mail->AddAddress('croa@comasageneracion.cl','');

$intentos=1; 
if(!$mail->Send()) {
	    
			echo '[{"mensaje":"Error en el envio","success":true}]';     
			} else {
				
            echo '[{"mensaje":"RECHAZADO CORRECTAMENTE","success":"true"}]'; 
    
			}
}

function correo_aprueba($fecha_aprobacion,$motivo_rechazo,$usuario_aprueba,$usuario_crea,$user_correo,$nombre_elemento,$descripcion){

$link = Conexion();
$continua = true;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->CharSet = "UTF-8";
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure ="tls";
$mail->Username  = "comasa.info@gmail.com";
$mail->Password = "gqjopyktbcbxqwln";

/* $mail->Host = "smtp.office365.com";
$mail->SMTPSecure ="STARTTLS";
$mail->Username  = "compras@comasageneracion.cl";
$mail->Password = "o365.2019"; */

$mail->SetFrom  ('compras@comasageneracion.cl', 'Comasa'); //('tu_correo@gmail.com', 'Administrador');
$asunto='APROBACI�N DE DOCUMENTO EN SISTEMA DE GESTI�N DOCUMENTAL';
$mail->Subject = (utf8_encode($asunto));

// -----  detalle 
$mail->MsgHTML("
<p> <strong>".utf8_encode('Estimado/a, le informamos que su documento ya a sido APROBADO, y paso al proceso de revisi�n para ser publicado. A continuaci�n detallamos datos de la aprobaci�n')." </strong> </p>

<p> <span style='color:#000000';><strong>Aprobado con fecha:                          </strong></span> ".utf8_encode($fecha_aprobacion)." </p>
<p> <span style='color:#000000';><strong>Usuario que Aprueba:                </strong></span> ".utf8_encode(str_replace('_',' ',$usuario_aprueba))." </p>
<p></p>
<p> <span style='color:#000000';><strong>Nombre del documento:               </strong></span> ".utf8_encode($nombre_elemento)." </p>
<p> <span style='color:#000000';><strong>".utf8_encode('Descripci�n').": </strong></span> ".utf8_encode($descripcion)." </p>
<p></p>");

$mail->Timeout=30;

$mail->AddAddress('jpinto@comasageneracion.cl','');
$mail->AddAddress($user_correo,'');
$mail->AddAddress('croa@comasageneracion.cl','');

$intentos=1; 
if(!$mail->Send()) {
	    
			echo '[{"mensaje":"Error en el envio","success":true}]';     
			} else {
				
            echo '[{"mensaje":"APROBADO CORRECTAMENTE","success":"true"}]'; 
    
			}
}


function correo_publica_docto($fecha_aprobacion,$motivo_rechazo,$usuario_aprueba,$usuario_crea,$user_correo,$nombre_elemento,$usuario_publica){

$link = Conexion();
$continua = true;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->CharSet = "UTF-8";
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure ="tls";
$mail->Username  = "comasa.info@gmail.com";
$mail->Password = "gqjopyktbcbxqwln";

/* $mail->Host = "smtp.office365.com";
$mail->SMTPSecure ="STARTTLS";
$mail->Username  = "compras@comasageneracion.cl";
$mail->Password = "o365.2019"; */

$mail->SetFrom  ('compras@comasageneracion.cl', 'Comasa'); //('tu_correo@gmail.com', 'Administrador');
$asunto='SU DOCUMENTO HA SIDO PUBLICADO EN EL SISTEMA DE GESTI�N DOCUMENTAL';
$mail->Subject = (utf8_encode($asunto));

// -----  detalle 
$mail->MsgHTML("
<p> <strong>".utf8_encode('Estimado, le informamos que su documento a sido publicado en el sistema de Gesti�n Documental, a continuaci�n le enviamos el detalle:')." </strong> </p>
<p> <span style='color:#000000';><strong>Nombre Documento:               </strong></span> ".utf8_encode($nombre_elemento)." </p>
<p> <span style='color:#000000';><strong>Publicado con fecha:            </strong></span> ".utf8_encode($fecha_aprobacion)." </p>
<p></p>
<p> <span style='color:#000000';><strong>Usuario que Publica:            </strong></span> ".utf8_encode(str_replace('_',' ',$usuario_publica))." </p>
<p></p>");

$mail->Timeout=30;

//$mail->AddAddress('jpinto@comasageneracion.cl','');
$mail->AddAddress($user_correo,'');
//$mail->AddAddress('croa@comasageneracion.cl','');

$intentos=1; 
if(!$mail->Send()) {
	    
			echo '[{"mensaje":"Error en el envio","success":true}]';     
			} else {
				
            echo '[{"mensaje":"APROBADO CORRECTAMENTE","success":"true"}]'; 
    
			}
}


?>