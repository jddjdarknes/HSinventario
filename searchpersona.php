<?php
session_start();
include 'conexion.php';

function encriptar($cadena){
	$key='darks';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
	return $encrypted; //Devuelve el string encriptado
}

function desencriptar($cadena){
	 $key='darks';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	 $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	 return $decrypted;  //Devuelve el string desencriptado
}
	# conectare la base de datos
	$usuario = (isset($_POST['personal'])&& $_POST['personal'] !=NULL)?$_POST['personal']:'';
			# code...
			//echo "Usuario: ".$usuario."<br>";
			$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
			if($action == 'ajax'){
        /*echo "Buscar: ".$usuario."<br>";
        echo "Action: ".$action."<br>";*/
				include 'pagination_p.php'; //incluir el archivo de paginación
				//las variables de paginación
				$page = (isset($_POST['page']) && !empty($_POST['page']))?$_POST['page']:1;
				//$user = (isset($_REQUEST['user']) && !empty($_REQUEST['user']))?$_REQUEST['user']:"";
				$per_page = 5; //la cantidad de registros que desea mostrar
				$adjacents  = 1; //brecha entre páginas después de varios adyacentes
				$offset = ($page - 1 ) * $per_page;
				$contador1 = 5;
				$contador2 = 1;
				if($offset != 0){$contador1=$offset+5;}
				if($offset != 0){$contador2 = $offset+1; }
				//Cuenta el número total de filas de la tabla*/
				$count_query = sqlsrv_query($conexion,
        "SELECT count(*) AS numrows FROM personal
        WHERE Nombres LIKE '%$usuario%'
        OR apellidos LIKE '%$usuario%';");

				if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
				$total_pages = ceil($numrows/$per_page);
				$reload = 'index.php';

				//consulta principal para recuperar los datos EXEC [GetPaginasRowNumber] $page,$per_page,$depa
					$consulta="SELECT *
					 from
						(Select *,
						 ROW_NUMBER() OVER (ORDER BY idpersonal ASC)ROWNUMBER
						 from personal
						 where Nombres LIKE '%$usuario%'
		         OR apellidos LIKE '%$usuario%' and estatus != 0) AS TABLEWHITROWNUMBER
						 where ROWNUMBER BETWEEN $contador2 and $contador1;";
					$query = sqlsrv_query($conexion,$consulta);
				//WHERE  ROWNUM BETWEEN (@NUMero_PAGINA*@TAMaño_PAGINA)-@TAM_PAGINA+1 AND (@NUM_PAGINA*@TAM_PAGINA)
				if ($numrows>0)
				{
				echo"
				<h3>Personal Registrado:</h3>
				<table width=100%>
				<ul>";
					while($line = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
					{
						echo"
						<tr>
						 <td>
							<li align='left' align='left' style='list-style:none;'></li>
						 </td>
						 <td align='right'><a href='#' id='pdatos'
						 data-id='".$line['idpersonal']."',
						 data-nombre='".$line['Nombres']."',
						 data-apellidos='".$line['apellidos']."',
						 data-departamento='".$line['departamentopersonal']."',
						 data-puesto='".$line['puesto']."',
						 data-localidad='".$line['localidad']."',
						 data-coordinador='".$line['coordinador']."',
						 data-perfil='".$line['perfil']."''
						 >".$line['Nombres']." ".$line['apellidos']."</a>
						 </td></tr>";
					}
					echo "</ul></table>";?>
				<div class="table-pagination pull-right">
					<?php
					echo paginate($reload, $page, $total_pages, $adjacents, $usuario);?>
				</div>
					<?php
				} else {
					?>
					<div class="alert alert-warning alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4>Aviso !!!</h4> No hay datos para mostrar
								</div>
					<?php
				}
			}
?>
