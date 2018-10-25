<?php
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

$query = "Select * from personal";
$consulta = sqlsrv_query($conexion,$query);
while( $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC)){
  echo "Nombre: ".$line["Nombres"]."<br>";
  echo "usuario: ".desencriptar($line["usuario"])."<br>";
  echo "contraseña: ".desencriptar($line["contrasena"])."<br>";
}

 ?>
