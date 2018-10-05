<?php
session_start();
include 'conexion.php';
	# conectare la base de datos
	$usuario = (isset($_POST['usuario'])&& $_POST['usuario'] !=NULL)?$_POST['usuario']:'';
	switch ($usuario) {
		case 'perfil':
			# code...
			//echo "Usuario: ".$usuario."<br>";
			$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
			if($action == 'ajax'){
				include 'paginacion.php'; //incluir el archivo de paginación
				//las variables de paginación
				$page = (isset($_POST['page']) && !empty($_POST['page']))?$_POST['page']:1;
				//$user = (isset($_REQUEST['user']) && !empty($_REQUEST['user']))?$_REQUEST['user']:"";
				$per_page = 4 ; //la cantidad de registros que desea mostrar
				$adjacents  = 5; //brecha entre páginas después de varios adyacentes
				$offset = ($page - 1 ) * $per_page;
				$contador1 = 4;
				$contador2 = 1;
				if($offset != 0){$contador1=$offset+4;}
				if($offset != 0){$contador2 = $offset+1; }
				//Cuenta el número total de filas de la tabla*/
				$count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM perfil");
				if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
				$total_pages = ceil($numrows/$per_page);
				$reload = 'index.php';

				//consulta principal para recuperar los datos EXEC [GetPaginasRowNumber] $page,$per_page,$depa
					$consulta="SELECT *
					 from
						(Select *,
						 ROW_NUMBER() OVER (ORDER BY idperfil ASC)ROWNUMBER from perfil) AS TABLEWHITROWNUMBER
						where ROWNUMBER BETWEEN $contador2 and $contador1;";
					$query = sqlsrv_query($conexion,$consulta);
				//WHERE  ROWNUM BETWEEN (@NUMero_PAGINA*@TAMaño_PAGINA)-@TAM_PAGINA+1 AND (@NUM_PAGINA*@TAM_PAGINA)
				if ($numrows>0)
				{
				echo"
				<h3>Perfil Registrado:</h3>
				<table width=100%>
				<ul>";
					while($line = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
					{
						echo"
						<tr>
				      <td><li align='left' style='list-style:none;'>".$line['departamentoperfil']."</li></td>
				      <td align='right'><button id='botonperfil' class='btn btn-xs' type='button' name='button'
				      data-id='".$line['idperfil']."',
				      data-departamento='".$line['departamentoperfil']."',
				      data-contrasena='".$line['contraseña']."'>Editar</button>
				      <button data-id ='".$line['idperfil']."' data-usuario = 'perfil' id='borrar' class='btn btn-xs' type='button' name='button'>Borrar</button>
				      </td>
				    </tr>";
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
									<h4>Aviso!!!</h4> No hay datos para mostrar
								</div>
					<?php
				}
			}
			break;

		case 'personal':
			# code...
			//echo "Usuario: ".$usuario."<br>";
			$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
			if($action == 'ajax'){
				include 'paginacion.php'; //incluir el archivo de paginación
				//las variables de paginación
				$page = (isset($_POST['page']) && !empty($_POST['page']))?$_POST['page']:1;
				//$user = (isset($_REQUEST['user']) && !empty($_REQUEST['user']))?$_REQUEST['user']:"";
				$per_page = 4 ; //la cantidad de registros que desea mostrar
				$adjacents  = 5; //brecha entre páginas después de varios adyacentes
				$offset = ($page - 1 ) * $per_page;
				$contador1 = 4;
				$contador2 = 1;
				if($offset != 0){$contador1=$offset+4;}
				if($offset != 0){$contador2 = $offset+1; }
				//Cuenta el número total de filas de la tabla*/
				$count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM personal where estatus !=0");
				if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
				$total_pages = ceil($numrows/$per_page);
				$reload = 'index.php';

				//consulta principal para recuperar los datos EXEC [GetPaginasRowNumber] $page,$per_page,$depa
					$consulta="SELECT *
					 from
						(Select *,
						 ROW_NUMBER() OVER (ORDER BY idpersonal ASC)ROWNUMBER from personal where estatus != 0) AS TABLEWHITROWNUMBER
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
							<li align='left' align='left' style='list-style:none;'>".$line['Nombres']." ".$line['apellidos']."</li>
						 </td>
						 <td align='right'><button id='botonpersonal' class='btn btn-xs' type='button' name='button'
						 data-id='".$line['idpersonal']."',
						 data-nombre='".$line['Nombres']."',
						 data-apellidos='".$line['apellidos']."',
						 data-departamento='".$line['departamentopersonal']."',
						 data-localidad='".$line['localidad']."',
						 data-coordinador='".$line['coordinador']."'
						 >Editar</button>
							<button id='borrar' data-id ='".$line['idpersonal']."' data-usuario = 'personal' class='btn btn-xs' type='button' name='button'>Borrar</button>
						 </td>
						</tr>";
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
									<h4>Aviso!!!</h4> No hay datos para mostrar
								</div>
					<?php
				}
			}
			break;
	}
?>
