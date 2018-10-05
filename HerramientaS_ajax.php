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
        if($herramienta == 1){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows
          FROM Herramienta
          where tipo like '%ServidorVirtual'
          and estadoherramienta = 'No Asignada';");
        }

        if($herramienta == 2){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows
          FROM Herramienta
          where tipo like '%UnidadRed'
          and estadoherramienta != 'Asignada'");
        }

        if($herramienta == 3){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows
          FROM Herramienta
          where tipo like '%Contabilidad'
          and estadoherramienta != 'Asignada'");
        }

        if($herramienta == 4){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows
          FROM Herramienta
          where tipo like '%Facturacion'
          and estadoherramienta != 'Asignada'");
        }

        if($herramienta == 5){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where tipo like '%Giro'
          and estadoherramienta != 'Asignada'");
        }

        if($herramienta == 6){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where tipo like '%SistemaTicket'
          and estadoherramienta != 'Asignada'");
        }

        if($herramienta == 7){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where tipo like '%GiroWeb'
          and estadoherramienta != 'Asignada'");
        }

        if($herramienta == 8){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where tipo like '%correo'
          and estadoherramienta != 'Asignada'");
        }

        if ($row = sqlsrv_fetch_array($count_query)){
          $numrows = $row['numrows'];
        }

				$total_pages = ceil($numrows/$per_page);
				$reload = 'index.php';

				//consulta principal para recuperar los datos EXEC [GetPaginasRowNumber] $page,$per_page,$depa
				if($herramienta == 1){
          $consulta="SELECT *
          from
          (Select *,
            ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
            where tipo like '%ServidorVirtual'
            and estadoherramienta = 'No Asignada') AS TABLEWHITROWNUMBER
            where ROWNUMBER BETWEEN $contador2 and $contador1;";
          }

          if($herramienta == 2){
            $consulta="SELECT *
            from
            (Select *,
              ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
              where tipo like '%UnidadRed'
              and estadoherramienta != 'Asignada') AS TABLEWHITROWNUMBER
              where ROWNUMBER BETWEEN $contador2 and $contador1;";
            }

            if($herramienta == 3){
              $consulta="SELECT *
              from
              (Select *,
                ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                where tipo like '%Contabilidad'
                and estadoherramienta != 'Asignada') AS TABLEWHITROWNUMBER
                where ROWNUMBER BETWEEN $contador2 and $contador1;";

              }

              if($herramienta == 4){
                  $consulta="SELECT *
                  from
                  (Select *,
                    ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                    where tipo like '%Facturacion'
                    and estadoherramienta != 'Asignada') AS TABLEWHITROWNUMBER
                    where ROWNUMBER BETWEEN $contador2 and $contador1;";
                }

                if($herramienta == 5){
                  $consulta="SELECT *
                  from
                  (Select *,
                    ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                    where tipo like '%Giro'
                    and estadoherramienta != 'Asignada') AS TABLEWHITROWNUMBER
                    where ROWNUMBER BETWEEN $contador2 and $contador1;";
                }

                if($herramienta == 6){
                  $consulta="SELECT *
                  from
                  (Select *,
                    ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                    where tipo like '%SistemaTicket'
                    and estadoherramienta != 'Asignada') AS TABLEWHITROWNUMBER
                    where ROWNUMBER BETWEEN $contador2 and $contador1;";
                }

                if($herramienta == 7){
                  $consulta="SELECT *
                  from
                  (Select *,
                    ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                    where tipo like '%GiroWeb'
                    and estadoherramienta != 'Asignada') AS TABLEWHITROWNUMBER
                    where ROWNUMBER BETWEEN $contador2 and $contador1;";
                }

                if($herramienta == 8){
                  $consulta="SELECT *
                  from
                  (Select *,
                    ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                    where tipo like '%correo'
                    and estadoherramienta != 'Asignada') AS TABLEWHITROWNUMBER
                    where ROWNUMBER BETWEEN $contador2 and $contador1;";
                }

					$query = sqlsrv_query($conexion,$consulta);
					//WHERE  ROWNUM BETWEEN (@NUMero_PAGINA*@TAMaño_PAGINA)-@TAM_PAGINA+1 AND (@NUM_PAGINA*@TAM_PAGINA)
					if ($numrows>0)
					{
						echo"
            <table class='table table-striped'>
						<thead>
						<tr>";
            if($herramienta == "1"){echo"<th>Usuario</th><th>Contraseña</th>";}
 					  if($herramienta == "2"){echo"<th>Nombre(s) de la unidad</th>";}
 					  if($herramienta == "3"){echo"<th>Usuario</th><th>Contraseña</th><th>Perfil</th>";}
 					  if($herramienta == "4"){echo"<th>Usuario</th><th>Contraseña</th><th>Perfil</th>";}
 					  if($herramienta == "5"){echo"<th>Usuario</th><th>Contraseña</th><th>Perfil</th><th>Base de Datos</th>";}
 					  if($herramienta == "6"){echo"<th>Usuario</th><th>Contraseña</th>";}
 					  if($herramienta == "7"){echo"<th>Usuaro</th><th>Contraseña</th><th>Base de Datos</th><th>Sucursales</th>";}
 					  if($herramienta == "8"){echo"<th>Usuario</th><th>Contraseña</th>";}
						echo "</tr>
						</thead>
						<tbody>";
						while($line = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							echo "<tr>";
              if($herramienta == "1"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td>"; echo "<td><label class='checkbox-inline'><input class = 'software' type='checkbox' value='".$line['Clave']."' data-nombrequipo='".$line['correo']."' data-estado='Asignada'>Asignar</label></td>";}
 	 					  if($herramienta == "2"){echo"<td>".$line['correo']."</td>"; echo "<td><label class='checkbox-inline'><input class = 'software' type='checkbox' value='".$line['Clave']."' data-nombrequipo='".$line['correo']."' data-estado='Asignada'>Asignar</label></td>";}
 	 					  if($herramienta == "3"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td><td>".$line['passpst']."</td>"; echo "<td><label class='checkbox-inline'><input class = 'software' type='checkbox' value='".$line['Clave']."' data-nombrequipo='".$line['correo']."' data-estado='Asignada'>Asignar</label></td>";}
 	 					  if($herramienta == "4"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td><td>".$line['passpst']."</td>"; echo "<td><label class='checkbox-inline'><input class = 'software' type='checkbox' value='".$line['Clave']."' data-nombrequipo='".$line['correo']."' data-estado='Asignada' >Asignar</label></td>";}
 	 					  if($herramienta == "5"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td><td>".$line['passpst']."</td><td>".$line['passwindows']."</td>"; echo "<td><label class='checkbox-inline'><input class = 'software' type='checkbox' value='".$line['correo']."' data-nombrequipo='".$line['correo']."' data-estado='Asignada'>Asignar</label></td>";}
 	 					  if($herramienta == "6"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td>"; echo "<td><label class='checkbox-inline'><input class = 'software' type='checkbox' value='".$line['Clave']."' data-nombrequipo='".$line['correo']."' data-estado='Asignada' >Asignar</label></td>";}
 	 					  if($herramienta == "7"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td><td>".$line['passpst']."</td><td>".$line['passwindows']."</td>"; echo "<td><label class='checkbox-inline'><input class = 'software' type='checkbox' value='".$line['correo']."' data-nombrequipo='".$line['correo']."' data-estado='Asignada'>Asignar</label></td>";}
 						  if($herramienta == "8"){echo"<td>".$line['correo']."</td><td>".$line['passcorreo']."</td>"; echo "<td><label class='checkbox-inline'><input class = 'software' type='checkbox' value='".$line['Clave']."' data-nombrequipo='".$line['correo']."' data-estado='Asignada'>Asignar</label></td>";}
              echo "<tr>";
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
