<?php
session_start();
include("conexion.php");
$hardware = json_decode($_POST['hardware']);
$software = json_decode($_POST['software']);
$persona = json_decode($_POST['persona']);
$datospersona="";
$datosoftware="";
$datohardware="";
$idpersona = $_SESSION['id'];

echo "<h1>Datos de la persona: <br></h1>";
foreach ($persona as $value) {
  echo "<p align='left'>".$value."</p>";
  $datospersona = $datospersona.",".$value;
}

echo "<h1>Datos Hardware: <br></h1>";
foreach ($hardware as $hard) {
  // code...
  echo "<p align='left'>".$hard."</p>";
  $datohardware = $datohardware.",".$hard;
}
echo "<h1>Dato Software: <br></h1>";
foreach ($software as $soft) {
  // code...
  echo "<p align='left'>".$soft."</p>";
  $datosoftware = $datosoftware.",".$soft;
}

/*echo "<br>Datos perosnal: ".$datospersona."<br>";
echo "Datos Hardware: ".$datohardware."<br>";
echo "Datos Software: ".$datosoftware."<br>";*/

$fecha_ingreso = DATE('Y-m-d');
//$fecha_ingreso = date('Y-m-d');

$sql = "INSERT INTO peticion (datos, hardware, software, atendido, fecha_ingreso, idpersonalAlta)
VALUES ('$datospersona','$datohardware', '$datosoftware', 0, '$fecha_ingreso', $idpersona)";

$resultado = sqlsrv_query($conexion,$sql);

if( $resultado === false ) {
     die( print_r( sqlsrv_errors(), true));
}else{
  echo "<div class='alert alert-success'>
        <strong>OK !!! </strong>Se creó correctamente la petición.
        </div>";
      }
 ?>
