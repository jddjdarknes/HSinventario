<?php
include ('conexion.php');
$id = $_POST['id'];
$usuario = $_POST['usuario'];
if($usuario != 'personal'){
  //$sql = "UPDATE perfil SET estatus = 0 where idperfil = $id";
}else {
  $sql = "UPDATE $usuario set estatus = 0 Where idpersonal = $id";
}
$query = sqlsrv_query($conexion,$sql);
if($query){
  echo "Datos Borrados";
}else{
  echo "No se pudieron borrar los datos";
}
 ?>
