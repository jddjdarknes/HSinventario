<?php
include('conexion.php');

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

$nombre = (isset($_POST['nombre']) && $_POST['nombre'] != NULL)?$_POST['nombre']:'0';

if($nombre != '0'){
  $option = "Personal";
}else{
  $option = "Perfil";
}

switch ($option) {
  case 'Perfil':
    # code...
    $id = (isset($_POST['id']) && $_POST['id'] != NULL)?$_POST['id']:'0';
    $user = (isset($_POST['user']) && $_POST['user'] != NULL)?$_POST['user']:'0';
    $password= (isset($_POST['password']) && $_POST['password'] != NULL)?$_POST['password']:'0';
    echo "Datos:<br>user: ".$user."<br>
    password: ".$password."<br><br>";
    $query = "UPDATE perfil SET departamentoperfil = '$user', contraseña = '$password' WHERE idperfil = $id ";
    $consulta = sqlsrv_query( $conexion, $query);
    if($consulta){
      echo "Se Actualizaron los datos.";
    }else{
      echo "No se pudieron Actualizar los datos.";
    }
  break;
  case 'Personal':
      # code...
      $id = (isset($_POST['id']) && $_POST['id'] != NULL)?$_POST['id']:'0';
      $apellidos = (isset($_POST['apellidos']) && $_POST['apellidos'] != NULL)?$_POST['apellidos']:'0';
      $departamento = (isset($_POST['departamento']) && $_POST['departamento'] != NULL)?$_POST['departamento']:'0';
      $puesto = (isset($_POST['puesto']) && $_POST['puesto'] != NULL)?$_POST['puesto']:'0';
      $localidad = (isset($_POST['localidad']) && $_POST['localidad'] != NULL)?$_POST['localidad']:'0';
      $coordinador = (isset($_POST['coordinador']) && $_POST['coordinador'] != NULL)?$_POST['coordinador']:'0';
      $user = (isset($_POST['user']) && $_POST['user'] != NULL)?$_POST['user']:'0';
      $password = (isset($_POST['password']) && $_POST['password'] != NULL)?$_POST['password']:'0';
      $perfil= (isset($_POST['perfil']) && $_POST['perfil'] != NULL)?$_POST['perfil']:'0';
      $estatus = (isset($_POST['estatus']) && $_POST['estatus'] != NULL)?$_POST['estatus']:'0';

      $user = encriptar($user);
      $password = encriptar($password);

      echo "Datos<br> Nombre: ".$nombre."<br>
      Apellidos: ".$apellidos."<br>
      User: ".$user."<br>
      Password: ".$password."<br>
      Departamento: ".$departamento."<br>
      Puesto:  ".$puesto."<br>
      Localidad: ".$localidad."<br>
      Coordinador: ".$coordinador."<br>
      Perfil: ".$perfil."<br>
      Estatus: ".$estatus."<br>";

      $query = "UPDATE personal
      SET  usuario = '$user',
           contrasena = '$password',
           nombres = '$nombre',
           apellidos = '$apellidos',
           departamentopersonal = '$departamento',
           puesto='$puesto',
           localidad='$localidad',
           coordinador='$coordinador',
           perfil='$perfil',
           estatus='$estatus'
      WHERE idpersonal = $id ";

      $consulta = sqlsrv_query( $conexion, $query);
      if($consulta){
        echo "Se Actualizaron los datos.";
      }else{
        echo "No se pudieron Actualizar los datos.";
      }
  break;
  default: Echo "No existe opcion.";

  break;
}
?>
