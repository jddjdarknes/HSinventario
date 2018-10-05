<?php
include("conexion.php");
$cherramienta = $_POST['clave'];
$nombre;
$contador=1;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
</head>
<body>
<?php
if($cherramienta == "")
{
  echo "Vacio.......";
}else{
  echo "<table class='table table-striped'>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Modelo</th>
      </tr>
    </thead>
    <tbody>";
    $query = sqlsrv_query($conexion,"SELECT *
                                     FROM herramienta
                                     where nombreequipo
                                     like '%$cherramienta%' or correo like '%$cherramienta%'");
    while ($line = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){
      if($line['estadoherramienta'] == "Asignada"){
        if($line['nombreequipo'] == ""){
          echo "
          <tr>
          <td><a class = 'linkher' href='#' data-idher = '".$line['Clave']."'>".$line['correo']."</a></td>
          <td>".$line['marca']."</td>
          <td>".$line['modelo']."</td><a/>
          </tr>";
        }else{
          echo "<tr>
          <td><a class = 'linkher' href='#' data-idher = '".$line['Clave']."'>".$line['nombreequipo']."<a/></td>
          <td>".$line['marca']."</td>
          <td>".$line['modelo']."</td><a/>
          </tr>";
        }
      }else{
        if($line['nombreequipo'] == ""){
          echo "<tr>
          <td>".$line['correo']."</td>
          <td>".$line['marca']."</td>
          <td>".$line['modelo']."</td>
          </tr>";
        }else{
          echo "<tr>
          <td>".$line['nombreequipo']."</td>
          <td>".$line['marca']."</td>
          <td>".$line['modelo']."</td>
          </tr>";
        }
      }
      $contador ++;
    }
  echo"</tbody>
</table>";
  }
?>
</body>
</html>
