<?php
session_start();
include ("conexion.php");
function encriptar($cadena){
  $key='darks';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
  $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
  return $encrypted; //Devuelve el string encriptado
}

function desencriptar($cadena){
   $key='darks';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
   $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
   return $decrypted;  //Devuelve el string desencriptado
}

$cadena1 = $_SESSION['puesto'];
$rh = strpos($cadena1,"RECURSOS HUMANOS");
$sistemas = strpos($cadena1,"SISTEMAS");

echo "ID: ".$_SESSION['id']."<br>";
echo "Personal: ".$_SESSION['personal']."<br>";
echo "Contraseña: ".$_SESSION['contraseña']."<br>";
echo "Departamento: ".$_SESSION['departamento']."<br>";
echo "Puesto: ".$_SESSION['puesto']."<br><br>";

$query="select * from personals where idpersonal > 1";
$consulta=sqlsrv_query($conexion,$query);
while ($rows = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) {
  echo "Usuario: ".$rows['usuario']."Contraseña: ".$rows['contrasena']."<br>";
  /*$usuarios="SET IDENTITY_INSERT personal ON
  insert into personal(idpersonal,usuario,contrasena,Nombres,apellidos ,departamentopersonal,puesto,estatus) values
  (".$rows['idpersonal'].",'".encriptar($rows['usuario'])."','".encriptar($rows['contrasena'])."','".$rows['Nombres']."','".$rows['apellidos']."','".$rows['departamentopersonal']."','".$rows['puesto']."',".$rows['estatus'].");
  SET IDENTITY_INSERT usuario OFF;";
  $datos = sqlsrv_query($conexion,$usuarios);
  if( $datos === false ) {
   die( print_r( sqlsrv_errors(), true));
 }else {
   echo "Se guardo el dato.....<br>";
 }*/
}
 ?>
