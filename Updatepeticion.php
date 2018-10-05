<?php
session_start();
include("conexion.php");
$hardware = json_decode($_POST['hardware']);
$software = json_decode($_POST['software']);
$usuario = $_POST['usuario'];
$datosoftware="";
$datohardware="";

$sql = sqlsrv_query($conexion,"Select * from personal where idpersonal = $usuario");

$line = sqlsrv_fetch_array( $sql, SQLSRV_FETCH_ASSOC);
echo "Nombre: ".$line['Nombres']."<br>";
echo "Apellidos: ".$line['apellidos']."<br>";

$datospersona = ",Nombre(s):".$line['Nombres'].",Apellidos:". $line['apellidos'].",Departamento:".$line['departamentopersonal'].",Puesto:".$line['puesto'].",Localidad:".$line['localidad'].",Coordinador:".$line['coordinador'].",Perfil:".$line['perfil'];

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
$personalAlta = $_SESSION['id'];
date_default_timezone_set('America/Mexico_City');
$fechainicio = date('Y/m/d');
echo "Fecha inicio: ".$fechainicio."<br>";
echo "Personal Alta: ".$personalAlta."<br>";
$sql = "INSERT INTO peticion (datos          ,hardware       ,software       ,atendido,fecha_ingreso,idpersonalAlta)
                      VALUES ('$datospersona','$datohardware','$datosoftware',0       ,$fechainicio ,$personalAlta)";

$resultado = sqlsrv_query($conexion,$sql);

if( $resultado === false ) {
     die( print_r( sqlsrv_errors(), true));
}else{
  echo "<div class='alert alert-success'>
            <strong>OK !!! </strong>Se creó correctamente la petición.
            </div>";}
