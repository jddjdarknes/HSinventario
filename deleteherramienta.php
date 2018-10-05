<?php
include ("conexion.php");
$clave = $_POST['clave'];
$cantidad = (isset($_POST['cantidad']) && $_POST['cantidad'] != NULL)?$_POST['cantidad']:'0';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Eliminar Herramienta</title>
</head>
<body>
  <?php
  echo "Clave: ".$clave."<br>";
  $sql = "UPDATE herramienta SET estadoherramienta = '0' WHERE Clave = '$clave'";
  $query = sqlsrv_query($conexion,$sql);
  if($query){echo "True";}else{echo "False";}
  ?>
</body>
</html>
