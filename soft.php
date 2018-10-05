<?php
include("conexion.php");
$soft = $_POST['soft'];
if($soft == "")
{
  //echo "vacio";
}else{
  //echo "Buscar: ".$soft."<br>";
  $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM herramienta where correo like '%$soft%' and estadoherramienta != 'Asignada'");
  if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
  echo "Numero de coicidencias: ".$numrows."<br>";
  if($numrows == 0){echo "No se encontro Considencia";}else{
    $query = "SELECT *
              FROM herramienta
              WHERE correo like '%$soft%' and estadoherramienta != 'Asignada'";
  $consulta = sqlsrv_query($conexion,$query);
  echo "<table class='table table-striped'>
  <thead>
  <tr>
   <th>Nombre</th>
   <th>Contraseña</th>
  </tr>
  </thead>
  <tbody>
  ";
  while( $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC) ){
    echo "<tr>";
    echo "<td>".$line['correo']." </td>";
    echo "<td>".$line['passcorreo']."</td>";
    echo "<td><input class = 'software' type='checkbox' value='".$line['Clave']."' data-nombrequipo='".$line['correo']."'>Asignar</label></td>";
    echo "</tr>";
  }
  echo "<tbody>
  </table>";
 }
}
