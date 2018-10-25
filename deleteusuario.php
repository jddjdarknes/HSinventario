<?php
include ('conexion.php');
$id = $_POST['id'];
$usuario = $_POST['usuario'];

$query = "Select * from herramientas_personal where idpersonal = '$id'";
$consulta = sqlsrv_query($conexion,$query);
while( $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC)){
    echo "idpersonal: ".$line['idpersonal']."<br>";
    $clave = $line['Clave'];
    $actualizarestado = sqlsrv_query($conexion,"Update herramienta set estadoherramienta = 'No Asignada' where Clave = '$clave'");
}

$borrarpersonal = sqlsrv_query($conexion,"Update personal set estatus = 0, estadoherramienta = '' where idpersonal = '$id'");
$quitarherramientas = sqlsrv_query($conexion,"Delete from herramientas_personal where idpersonal = '$id' ");

$stmt = sqlsrv_query($quitarherramientas);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}else{
  echo "Herrramientas Reacignadas.";
}

$stmt = sqlsrv_query($borrarpersonal);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}else{
  echo "Datos Borrados";
}
 ?>
