<?php

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

include('conexion.php');
    $nombre = (isset($_POST['nombre']) && $_POST['nombre'] != NULL)?$_POST['nombre']:'0';
    $apellidos = (isset($_POST['apellidos']) && $_POST['apellidos'] != NULL)?$_POST['apellidos']:'0';
    $usuario = (isset($_POST['usuario']) && $_POST['usuario'] != NULL)?$_POST['usuario']:'0';
    $contrasena = (isset($_POST['contraseña']) && $_POST['contraseña'] != NULL)?$_POST['contraseña']:'0';
    $departamento = (isset($_POST['departamento']) && $_POST['departamento'] != NULL)?$_POST['departamento']:'0';
    $localidad = (isset($_POST['localidad']) && $_POST['localidad'] != NULL)?$_POST['localidad']:'0';
    $coordinador = (isset($_POST['coordinador']) && $_POST['coordinador'] != NULL)?$_POST['coordinador']:'0';
    $perfil = (isset($_POST['perfil']) && $_POST['perfil'] != NULL)?$_POST['perfil']:'0';
    $puesto = (isset($_POST['puesto']) && $_POST['puesto'] != NULL)?$_POST['puesto']:'0';
    $peticion = (isset($_POST['peticion']) && $_POST['peticion'] != NULL)?$_POST['peticion']:'0';

    if($peticion !='0' ){
      $q = sqlsrv_query($conexion,"Update peticion set atendido = 0 where idpeticion ='$peticion'");
      if( $q === false ) {
        die( print_r( sqlsrv_errors(), true));
      }
    }

    $sql = "SELECT * FROM personal where nombres = '$nombre' and apellidos = '$apellidos'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $consulta = sqlsrv_query( $conexion, $sql , $params, $options );
    $idperfil = $consulta['idperfil'];
    $filas = sqlsrv_num_rows( $consulta );
    if($filas != 0){
      echo "<br>El perfil ya existe.";
    }else{

      $usuario = encriptar($usuario);
      $contrasena = encriptar($contrasena);

      echo "Datos<br>
      Nombre: ".$nombre."<br>
      Apellidos: ".$apellidos."<br>
      Usuario: ".$usuario."<br>
      Contraseña: ".$contrasena."<br>
      Departamento: ".$departamento."<br>
      Puesto: ".$puesto."<br>
      Localidad: ".$localidad."<br>
      Coordinador: ".$coordinador."<br>
      Perfil: ".$perfil."<br>";

      $sql = "INSERT INTO personal (usuario,contrasena,Nombres,apellidos,departamentopersonal,puesto,localidad,coordinador,perfil,estadoherramienta,estatus)
      values('$usuario','$contrasena','$nombre','$apellidos','$departamento','$puesto','$localidad','$coordinador','$perfil','No Asignada',1)";
      $resultado = sqlsrv_query( $conexion,$sql );
    }
    if( $resultado === false ) {
      die( print_r( sqlsrv_errors(), true));
    }else{
      echo "Se guardaron los datos.";
    }
/* Coddigo Pendiemnte........
$sql = "SELECT * FROM usuario";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$consulta = sqlsrv_query( $conexion, $sql , $params, $options );

$filas = sqlsrv_num_rows( $consulta );
*/
 ?>
