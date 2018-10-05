<?php
include("conexion.php");
$hard = $_POST['hard'];
if($hard == "")
{
  //echo "vacio";
}else{
  //echo "Buscar: ".$hard."<br>";
  $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM herramienta where nombreequipo like '%$hard%' and estadoherramienta != 'Asignada'");
  if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
  echo "Numero de coincidencias: ".$numrows."<br>";
  if($numrows == 0){echo "No se encontro Considencia";}else{
    $query = "SELECT *
              FROM herramienta
              WHERE nombreequipo like '%$hard%' and estadoherramienta != 'Asignada'";
  $consulta = sqlsrv_query($conexion,$query);
  echo "<table class='table table-striped'>
  <thead>
  <tr>
    <th>Nombre</th>
    <th>Marca</th>
    <th>Modelo</th>
  </tr>
  </thead>
  <tbody>";
  while($line = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC))
  {
    echo "<tr>
    <td>".$line['nombreequipo']."</td>
    <td>".$line['marca']."</td>
    <td>".$line['modelo']."</td>";
    if($line['tipo'] == "HESCRITORIO" || $line['tipo'] == "HLAPTOP" ){
      echo "<td><label><input class = 'asignar' type='radio' name='estado' value='".$line['Clave']."' data-nombrequipo='".$line['nombreequipo']."' data-estado='Asignada'>Asignar</label></td>
            </tr>";
            //<td><label><input class = 'asignar' type='radio' name='estado' value='".$line['Clave']."' data-nombrequipo='".$line['nombreequipo']."' data-estado='Prestada'>Prestar</label></td>
    }else{
      echo "<td><label class='checkbox-inline'><input class = 'accesorio' type='checkbox' value='".$line['Clave']."' data-nombrequipo='".$line['nombreequipo']."'>Asignar</label></td>";
    }
  }
  echo "</tbody>
  </table>";
 }
}
?>
