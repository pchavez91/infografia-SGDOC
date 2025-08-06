
<!-- codigo por arreglar pero trae los datos de tipo documento-->

if($accion=='listar_archivos_busqueda'){

	/*$tipo_documento = isset($_GET['tipo_documento']) ? trim($_GET['tipo_documento']) : '';
    $departamento = isset($_GET['departamento']) ? trim($_GET['departamento']) : '';*/

	$arreglo='';
	$codigo_cargo=$_SESSION['cod_cargo'];
	//$codigo_cargo='92';


    $sql ="SELECT [id], [nombre_elemento], [id_padre], [extencion_elemento], [tipo_elemento],
                   [ruta], [fecha_publicacion], [nivel_acceso], [descripcion], [codigo_archivo]
            FROM [BDflexline].[TI].[base_repositorio]
            WHERE [tipo_elemento] = '0'
              AND [vigencia] = 'SI'
              AND [estado_gestion] = 'OK'";

			/*if ($tipo_documento != '') {
        	// Escapa o valida $tipo_documento para evitar inyección
        		$tipo_documento_esc = addslashes($tipo_documento);
        		$sql .= " AND r.tipo_documento = '$tipo_documento_esc'";
    		}

    		/*if ($departamento != '') {
        		$departamento_esc = addslashes($departamento);
        		$sql .= " AND d.departamento = '$departamento_esc'";
    		}*/

			$RESP = mssql_query($sql, $link);
    		if(!$RESP){
       			echo json_encode(["data"=>[]]);
       			exit;
    		}	



		 
			while($ROW =  mssql_fetch_array($RESP)){
				$nombre_elemento= utf8_decode($ROW['nombre_elemento']);
				$extencion_elemento=$ROW['extencion_elemento'];
				$id_padre=$ROW['id_padre'];
				$tipo_elemento=$ROW['tipo_elemento'];
				$id=$ROW['id'];
				$nivel_acceso=$ROW['nivel_acceso'];
				$ruta=utf8_encode($ROW['ruta']);
				$fecha_publicacion=$ROW['fecha_publicacion'];
				$descripcion=$ROW['descripcion'];
				$codigo_archivo=$ROW['codigo_archivo'];
				// $tipo_documento = $ROW['tipo_documento']; // si quieres usar
        		// $departamento = $ROW['departamento']; // si quieres usar

				if($nivel_acceso=='4'){

            	 	$arreglo=$arreglo.'{"nombre_elemento":"'.$nombre_elemento.'","extencion_elemento":"'.$extencion_elemento.'","id_padre":"'.$id_padre.'","tipo_elemento":"'.$tipo_elemento.'","id":"'.$id.'","nivel_acceso":"'.$nivel_acceso.'","ruta":"'.$ruta.'","fecha_publicacion":"'.$fecha_publicacion.'","descripcion":"'.$descripcion.'","codigo_archivo":"'.$codigo_archivo.'"},';

            	}else if($nivel_acceso=='3'){

            		$sql_usuario="SELECT top 1 A.nivel4, A.nivel3, A.nivel2, A.nivel1
								FROM Seguridad.dbo.cargo AS A
								WHERE A.cargo_codigo='$codigo_cargo'";
				            	$r = mssql_query($sql_usuario, $link);
						     	if($ROW2 =  mssql_fetch_array($r)) {
						            if($ROW2['nivel4']=='0'){
						            	$arreglo=$arreglo.'{"nombre_elemento":"'.$nombre_elemento.'","extencion_elemento":"'.$extencion_elemento.'","id_padre":"'.$id_padre.'","tipo_elemento":"'.$tipo_elemento.'","id":"'.$id.'","nivel_acceso":"'.$nivel_acceso.'","ruta":"'.$ruta.'","fecha_publicacion":"'.$fecha_publicacion.'","descripcion":"'.$descripcion.'","codigo_archivo":"'.$codigo_archivo.'"},';
						            }
						        }

            	}else if($nivel_acceso=='2'){
            	 	$sql_usuario2="SELECT top 1 A.nivel4, A.nivel3, A.nivel2, A.nivel1
									FROM Seguridad.dbo.cargo AS A
									WHERE A.cargo_codigo='$codigo_cargo'";
				            	 	$r2 = mssql_query($sql_usuario2, $link);
						     	 	if($ROW3 =  mssql_fetch_array($r2)) {
						            	if($ROW3['nivel3']=='0' && $ROW3['nivel4']=='0'){
						            		$arreglo=$arreglo.'{"nombre_elemento":"'.$nombre_elemento.'","extencion_elemento":"'.$extencion_elemento.'","id_padre":"'.$id_padre.'","tipo_elemento":"'.$tipo_elemento.'","id":"'.$id.'","nivel_acceso":"'.$nivel_acceso.'","ruta":"'.$ruta.'","fecha_publicacion":"'.$fecha_publicacion.'","descripcion":"'.$descripcion.'","codigo_archivo":"'.$codigo_archivo.'"},';
						            	}
						            }			
            	}else if($nivel_acceso=='1'){
            	 		$sql_usuario2="SELECT top 1 A.nivel4, A.nivel3, A.nivel2, A.nivel1
									   FROM Seguridad.dbo.cargo AS A
								       WHERE A.cargo_codigo='$codigo_cargo' AND cargo_nombre like 'GERENTE%'";
				            	       $r2 = mssql_query($sql_usuario2, $link);
						     		if($ROW3 =  mssql_fetch_array($r2)) {
						            	$arreglo=$arreglo.'{"nombre_elemento":"'.$nombre_elemento.'","extencion_elemento":"'.$extencion_elemento.'","id_padre":"'.$id_padre.'","tipo_elemento":"'.$tipo_elemento.'","id":"'.$id.'","nivel_acceso":"'.$nivel_acceso.'","ruta":"'.$ruta.'","fecha_publicacion":"'.$fecha_publicacion.'","descripcion":"'.$descripcion.'","codigo_archivo":"'.$codigo_archivo.'"},';
						        	}
            	}
			}
			$cont1=strlen($arreglo);
		    $arreglo=substr($arreglo,0,($cont1-1));
            echo '{"data":['.$arreglo.']}';
}

if ($accion == 'obtener_tipos_documento') {
    $tipos = array();

    $sql = "SELECT tipo_documento
            FROM [BDflexline].[TI].[base_repositorio_tipo_documento]
            WHERE vigente = 'S'";

    $resp = mssql_query($sql, $link);

    while ($row = mssql_fetch_array($resp)) {
        $tipo = trim(utf8_encode($row['tipo_documento']));  // <-- importante el trim

        if ($tipo !== '') {  // evita valores vacíos o nulos
            $tipos[] = array(
                "id" => $tipo,
                "nombre" => $tipo
            );
        }
    }

    header('Content-Type: application/json');
    echo json_encode($tipos);
    exit;
}
