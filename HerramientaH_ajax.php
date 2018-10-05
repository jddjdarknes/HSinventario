<?php
session_start();
include 'conexion.php';
# conectare la base de datos
 $herramienta = (isset($_POST['herramienta'])&& $_POST['herramienta'] !=NULL)?$_POST['herramienta']:'';
 $buscando = (isset($_POST['buscando'])&& $_POST['buscando'] !=NULL)?$_POST['buscando']:'';
			# code...
			//echo "Usuario: ".$usuario."<br>";
			$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
			if($action == 'ajax'){
        //echo "Herramienta: ".$herramienta."<br>";
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
				if($offset != 0){$contador2 = $offset+1; }
				//Cuenta el número total de filas de la tabla*/

        if($herramienta == 0){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows
                                                 FROM Herramienta
                                                 where tipo like 'H%'");
        }

        if($herramienta == 1){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where tipo in ('HESCRITORIO','HLAPTOP')
          and estadoherramienta = 'No Asignada'");
        }

        if($herramienta == 2){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows
          FROM Herramienta
          where tipo in ('HFijoTA','HFijoTD','HFijoTI','HFijoTIP','HMovilCelular')
          and estadoherramienta = 'No Asignada'");
        }

        if($herramienta == 3){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where tipo in('HimpresoraMono','HimpresoraMultiB/N','HimpresoraMultiColor','HimpresoraColor','HimpresoraCredencial','HConsumibleToner','HConsumibleTambor','HTargetaPVC')
          and estadoherramienta = 'No Asignada'");
        }

        if($herramienta == 4){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where tipo like '%Otro%'");
        }

        if($herramienta == 5){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where tipo in('HALHDDLap','HALHDDPC','HALMEMORIUsb','HALMEMORIMICROSD')
          and estadoherramienta = 'No Asignada'");
        }

        if($herramienta == 6){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where tipo in ('HRedRouter','HRedSwicht','HRedAccessP')
          and estadoherramienta = 'No Asignada'");
        }

        if($herramienta == 7){
          $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM Herramienta
          where nombreequipo like '%$buscando%'");
        }

        if ($row = sqlsrv_fetch_array($count_query)){
          $numrows = $row['numrows'];
        }

				$total_pages = ceil($numrows/$per_page);
				$reload = 'index.php';

				//consulta principal para recuperar los datos EXEC [GetPaginasRowNumber] $page,$per_page,$depa
        if($herramienta == 0){
          $consulta="SELECT *
          from
          (Select *,
            ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER
            from herramienta
            where tipo like 'H%'
          ) AS TABLEWHITROWNUMBER
            where ROWNUMBER BETWEEN $contador2 and $contador1;";
          }

        if($herramienta == 1){
          $consulta="SELECT *
          from
          (Select *,
            ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
            where tipo in('HESCRITORIO','HLAPTOP')
            and estadoherramienta = 'No Asignada') AS TABLEWHITROWNUMBER
            where ROWNUMBER BETWEEN $contador2 and $contador1;";
          }

          if($herramienta == 2){
            $consulta="SELECT *
            from
            (Select *,
              ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER
              FROM Herramienta
              where tipo in ('HFijoTA','HFijoTD','HFijoTI','HFijoTIP','HMovilCelular')
              and estadoherramienta = 'No Asignada') AS TABLEWHITROWNUMBER
              where ROWNUMBER BETWEEN $contador2 and $contador1;";
            }

            if($herramienta == 3){
              $consulta="SELECT *
              from
              (Select *,
                ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                where tipo in ('HimpresoraMono','HimpresoraMultiB/N','HimpresoraMultiColor','HimpresoraColor','HimpresoraCredencial','HConsumibleToner','HConsumibleTambor','HTargetaPVC')
                and estadoherramienta = 'No Asignada') AS TABLEWHITROWNUMBER
                where ROWNUMBER BETWEEN $contador2 and $contador1;";
              }

              if($herramienta == 4){
                  $consulta="SELECT *
                  from
                  (Select *,
                    ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                    where tipo like '%Otro%') AS TABLEWHITROWNUMBER
                    where ROWNUMBER BETWEEN $contador2 and $contador1;";
                }

                if($herramienta == 5){
                  $consulta="SELECT *
                  from
                  (Select *,
                    ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                    where tipo in ('HALHDDLap','HALHDDPC','HALMEMORIUsb','HALMEMORIMICROSD')
                    and estadoherramienta = 'No Asignada') AS TABLEWHITROWNUMBER
                    where ROWNUMBER BETWEEN $contador2 and $contador1;";
                }

                if($herramienta == 6){
                  $consulta="SELECT *
                  from
                  (Select *,
                    ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                    where tipo in ('HRedRouter','HRedSwicht','HRedAccessP')
                    and estadoherramienta = 'No Asignada') AS TABLEWHITROWNUMBER
                    where ROWNUMBER BETWEEN $contador2 and $contador1;";
                }

                if($herramienta == 7){
                  $consulta="SELECT *
                  from
                  (Select *,
                    ROW_NUMBER() OVER (ORDER BY Clave ASC)ROWNUMBER from herramienta
                    where nombreequipo like '%$buscando%') AS TABLEWHITROWNUMBER
                    where ROWNUMBER BETWEEN $contador2 and $contador1;";
                }


					$query = sqlsrv_query($conexion,$consulta);
					//WHERE  ROWNUM BETWEEN (@NUMero_PAGINA*@TAMaño_PAGINA)-@TAM_PAGINA+1 AND (@NUM_PAGINA*@TAM_PAGINA)
					if ($numrows>0)
					{
            echo "
            <table class='table table-striped'>
						<thead>";
            if($herramienta != 4){
              echo"
              <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
              </tr>";
            }else{
              echo "<tr>
                <th>Nombre</th>
                <th>Cantidad</th>
              </tr>";
            }
						echo "</thead>
						<tbody>";
						while($line = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							echo "<tr>";
              if($herramienta != 4){
                echo "<td>".$line['nombreequipo']."</td>
                <td>".$line['marca']."</td>
                <td>".$line['modelo']."</td>";
              }else{
                echo "<td>".$line['nombreequipo']."</td>
                <td>".$line['cantidad']."</td>";
              }

              //echo "Herramienta: ".$herramienta."<br>";
              if($herramienta == 7 or $herramienta == 0){
                echo "<td><a href='#' data-toggle='modal' data-target='#DatosModal'>Mostrar Datos</a></td>";
              }else{
              if($line['tipo'] == "HESCRITORIO" || $line['tipo'] == "HLAPTOP" ){
                echo "<td><label><input class = 'asignar' type='radio' name='estado' value='".$line['Clave']."' data-nombrequipo='".$line['nombreequipo']."' data-estado='Asignada'>Asignar</label></td>
                     </tr>";
              }else{
                echo "<td><label class='checkbox-inline'><input class = 'accesorio' type='checkbox' value='".$line['Clave']."' data-nombrequipo='".$line['nombreequipo']."' data-estado='Asignada'>Asignar</label></td>";
              }
            }

						}
						echo "</tbody>
						</table>
            ";

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
