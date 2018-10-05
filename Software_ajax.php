<?php
session_start();
include 'conexion.php';
	# conectare la base de datos
	$herramienta = (isset($_POST['herramienta'])&& $_POST['herramienta'] !=NULL)?$_POST['herramienta']:'';
			# code...
			//echo "Usuario: ".$usuario."<br>";
			$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
			if($action == 'ajax'){
				include 'pagina.php'; //incluir el archivo de paginación
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
				$count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta where tipo like '%$herramienta' and estadoherramienta = 'No Asignada'");
				if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
				$total_pages = ceil($numrows/$per_page);
				$reload = 'index.php';
				//consulta principal para recuperar los datos EXEC [GetPaginasRowNumber] $page,$per_page,$depa
					$consulta="SELECT *
					 from
						(Select *,
						 ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta where tipo like '%$herramienta' and estadoherramienta = 'No Asignada') AS TABLEWHITROWNUMBER
						where ROWNUMBER BETWEEN $contador2 and $contador1;";
					$query = sqlsrv_query($conexion,$consulta);
				//WHERE  ROWNUM BETWEEN (@NUMero_PAGINA*@TAMaño_PAGINA)-@TAM_PAGINA+1 AND (@NUM_PAGINA*@TAM_PAGINA)
				if ($numrows>0)
				{
					echo "<table class='table table-striped'>
					<thead>
					 <tr>";
					 if($herramienta == "ServidorVirtual"){echo"<td>Usuario</td><td>Contraseña</td>";}
					 if($herramienta == "UnidadRed"){echo"<td>Nombre(s) de la unidad</td>";}
					 if($herramienta == "Contabilidad"){echo"<td>Usuario</td><td>Contraseña</td><td>Perfil</td>";}
					 if($herramienta == "Facturacion"){echo"<td>Usuario</td><td>Contraseña</td><td>Perfil</td>";}
					 if($herramienta == "Giro"){echo"<td>Usuario</td><td>Contraseña</td><td>Perfil</td><td>Base de Datos</td>";}
					 if($herramienta == "SistemaTicket"){echo"<td>Usuario</td><td>Contraseña</td>";}
					 if($herramienta == "GiroWeb"){echo"<td>Usuario</td><td>Contraseña</td><td>Base de Datos</td><td>Sucursal</td>";}
					 if($herramienta == "Correo"){echo"<td>Usuario</td><td>Contraseña</td>";}
					echo"</tr>
						</thead>
						<tbody>";
					while($line = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
					{
						echo "<tr>";
						 if($herramienta == "ServidorVirtual"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td>
							 <td><a href='#' id='seditar'
							 data-id = '".$line['Clave']."'
							 data-herramienta = '".$herramienta."'
							 data-tipo = '".$line['tipo']."'
							 data-correo = '".$line['correo']."'
							 data-passcorreo = '".$line['passcorreo']."'
							 data-passpst = '".$line['passpst']."'
							 data-passwindows = '".$line['passwindows']."'
							 >Editar</a></td>
							 <td><a href='#' id='heliminar'
               data-clave='".$line['Clave']."'>Eliminar</a></td>";}
	 					 if($herramienta == "UnidadRed"){echo"<td>".$line['correo']."</td><td><a href='#' id='seditar'
						 data-id = '".$line['Clave']."'
						 data-herramienta = '".$herramienta."'
						 data-tipo = '".$line['tipo']."'
						 data-correo = '".$line['correo']."'
						 data-passcorreo = '".$line['passcorreo']."'
						 data-passpst = '".$line['passpst']."'
						 data-passwindows = '".$line['passwindows']."'
						 >Editar</a></td>
						 <td><a href='#' id='heliminar'
						 data-clave='".$line['Clave']."'>Eliminar</a></td>";}
	 					 if($herramienta == "Contabilidad"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td><td>".$line['passpst']."</td>
							 <td><a href='#' id='seditar'
							 data-id = '".$line['Clave']."'
							 data-herramienta = '".$herramienta."'
							 data-tipo = '".$line['tipo']."'
							 data-correo = '".$line['correo']."'
							 data-passcorreo = '".$line['passcorreo']."'
							 data-passpst = '".$line['passpst']."'
							 data-passwindows = '".$line['passwindows']."'
							 >Editar</a></td>
							 <td><a href='#' id='heliminar'
               data-clave='".$line['Clave']."'>Eliminar</a></td>";}
	 					 if($herramienta == "Facturacion"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td><td>".$line['passpst']."</td>
							 <td><a href='#' id='seditar'
							 data-id = '".$line['Clave']."'
							 data-herramienta = '".$herramienta."'
							 data-tipo = '".$line['tipo']."'
							 data-correo = '".$line['correo']."'
							 data-passcorreo = '".$line['passcorreo']."'
							 data-passpst = '".$line['passpst']."'
							 data-passwindows = '".$line['passwindows']."'
							 >Editar</a></td>
							 <td><a href='#' id='heliminar'
               data-clave='".$line['Clave']."'>Eliminar</a></td>";}
	 					 if($herramienta == "Giro"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td><td>".$line['passpst']."</td><td>".$line['passwindows']."</td>
							 <td><a href='#' id='seditar'
							 data-id = '".$line['Clave']."'
							 data-herramienta = '".$herramienta."'
							 data-tipo = '".$line['tipo']."'
							 data-correo = '".$line['correo']."'
							 data-passcorreo = '".$line['passcorreo']."'
							 data-passpst = '".$line['passpst']."'
							 data-passwindows = '".$line['passwindows']."'
							 >Editar</a></td>
							 <td><a href='#' id='heliminar'
               data-clave='".$line['Clave']."'>Eliminar</a></td>";}
	 					 if($herramienta == "SistemaTicket"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td>
							 <td><a href='#' id='seditar'
							 data-id = '".$line['Clave']."'
							 data-herramienta = '".$herramienta."'
							 data-tipo = '".$line['tipo']."'
							 data-correo = '".$line['correo']."'
							 data-passcorreo = '".$line['passcorreo']."'
							 data-passpst = '".$line['passpst']."'
							 data-passwindows = '".$line['passwindows']."'
							 >Editar</a></td>
							 <td><a href='#' id='heliminar'
               data-clave='".$line['Clave']."'>Eliminar</a></td>";}
	 					 if($herramienta == "GiroWeb"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td><td>".$line['passpst']."</td><td>".$line['passwindows']."</td>
							 <td><a href='#' id='seditar'
							 data-id = '".$line['Clave']."'
							 data-herramienta = '".$herramienta."'
							 data-tipo = '".$line['tipo']."'
							 data-correo = '".$line['correo']."'
							 data-passcorreo = '".$line['passcorreo']."'
							 data-passpst = '".$line['passpst']."'
							 data-passwindows = '".$line['passwindows']."'
							 >Editar</a></td>
							 <td><a href='#' id='heliminar'
               data-clave='".$line['Clave']."'>Eliminar</a></td>";}
						 if($herramienta == "Correo"){
							 echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td>
							 <td><a href='#' id='seditar'
							 data-id = '".$line['Clave']."'
							 data-herramienta = '".$herramienta."'
							 data-tipo = '".$line['tipo']."'
							 data-correo = '".$line['correo']."'
							 data-passcorreo = '".$line['passcorreo']."'
							 data-passpst = '".$line['passpst']."'
							 data-passwindows = '".$line['passwindows']."'
							 >Editar</a></td>
							 <td><a href='#' id='heliminar'
               data-clave='".$line['Clave']."'>Eliminar</a></td>";
						 }
						echo "</tr>";
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