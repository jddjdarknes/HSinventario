<?php
session_start();
include 'conexion.php';
# conectare la base de datos
 $herramienta = (isset($_POST['herramienta'])&& $_POST['herramienta'] !=NULL)?$_POST['herramienta']:'';
			# code...
			//echo "Usuario: ".$usuario."<br>";
			$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
			if($action == 'ajax'){
				include 'paginar.php'; //incluir el archivo de paginación
				//las variables de paginación
				$page = (isset($_POST['page']) && !empty($_POST['page']))?$_POST['page']:1;
				//$user = (isset($_REQUEST['user']) && !empty($_REQUEST['user']))?$_REQUEST['user']:"";
				$per_page = 4 ; //la cantidad de registros que desea mostrar
				$adjacents  = 5; //brecha entre páginas después de varios adyacentes
				$offset = ($page - 1 ) * $per_page;
				$contador1 = 4;
				$contador2 = 1;
				if($offset != 0){$contador1=$offset+4;}
				if($offset != 0){$contador2 = $offset+1;}
				//Cuenta el número total de filas de la tabla*/
				$count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta where estadoherramienta = 'No Asignada' and tipo = 'H".$herramienta."'");
				if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
				$total_pages = ceil($numrows/$per_page);
				$reload = 'index.php';

				//
				$consulta="SELECT *
				from
				(Select *,
					ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta where estadoherramienta = 'No Asignada' and tipo = 'H".$herramienta."') AS TABLEWHITROWNUMBER
					where ROWNUMBER BETWEEN $contador2 and $contador1;";
					$query = sqlsrv_query($conexion,$consulta);
					//WHERE  ROWNUM BETWEEN (@NUMero_PAGINA*@TAMaño_PAGINA)-@TAM_PAGINA+1 AND (@NUM_PAGINA*@TAM_PAGINA)
					if ($numrows>0)
					{
            //echo "Herramienta: ".$herramienta."<br>";
						echo "<table class='table table-striped'>
						<thead>
						<tr>";
            if($herramienta == 'Escritorio' || $herramienta == 'Laptop'){
              echo "<th>Nombre </th>";
            }
            echo "<th>Marca</th>
						<th>Modelo</th>
						<th>No. serie</th>
						</tr>
						</thead>
						<tbody>";
						while($line = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							echo "<tr>";

              if($herramienta == 'Escritorio' || $herramienta == 'Laptop'){
                echo "<td>".$line['nombreequipo']."</td>";
              }
							echo "<td>".$line['marca']."</td>
							<td>".$line['modelo']."</td>
							<td>".$line['no_serie']."</td>
              <td><a href='#' id='heditar'
              data-herramienta='".$herramienta."'
              data-id='".$line['Clave']."'
              data-passwindows='".$line['passwindows']."'
              data-nombreequipo='".$line['nombreequipo']."'
              data-tipo='".$line['tipo']."'
              data-usuariowindows='".$line['usuariowindows']."'
              data-marca='".$line['marca']."'
              data-modelo='".$line['modelo']."'
              data-no_serie='".$line['no_serie']."'
              data-procesador='".$line['procesador']."'
              data-discoduro='".$line['discoduro']."'
              data-ram='".$line['ram']."'
              data-so='".$line['so']."'
              data-direccionip='".$line['direccionip']."'
              data-macadress='".$line['macadress']."'
              data-idteamviewer='".$line['idteamviewer']."'
              data-proyecto='".$line['proyecto']."'
              data-asignar='".$line['asignar']."'
              data-cantidad='".$line['cantidad']."'
              data-macadresswi='".$line['macadresswi']."'
              >Editar</a></td>";

              if($line['tipo'] != "HESCRITORIO" and $line['tipo'] != "HLAPTOP"){
              echo "<td><a href='#' id='heliminar'
              data-clave='".$line['Clave']."'>Eliminar</a></td>";
              }

							echo"</tr>";
						}
						echo "</tbody>
						</table>";
						?>
						<div class="table-pagination pull-right">
							<?php
							echo paginate($reload, $page, $total_pages, $adjacents, $herramienta);?>
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
?>
