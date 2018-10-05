<?php
include ('conexion.php');
$buscar = $_POST['personal'];

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
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h3>Personal Registrado:</h3>
    <table width="100%">
    <ul>
    <?php
    $query = "SELECT * FROM personal
    WHERE Nombres LIKE '%$buscar%'
    OR apellidos LIKE '%$buscar%';";

    $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows
    FROM personal
    WHERE Nombres LIKE '%$buscar%'
    OR apellidos LIKE '%$buscar%';");
    if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
    //echo "Coincidencia(s): ".$numrows."<br>";
    if($numrows != 0){

    }else{
      echo "No se encontraron coincidencias ....";
    }

    $consulta = sqlsrv_query($conexion,$query);
    while( $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC)){
      echo "<tr>
       <td>
        <li align='left' align='left' style='list-style:none;'>".$line['Nombres']." ".$line['apellidos']."</li>
       </td>
       <td align='right'><button id='botonpersonal' class='btn btn-xs' type='button' name='button'
       data-id='".$line['idpersonal']."',
       data-nombre='".$line['Nombres']."',
       data-apellidos='".$line['apellidos']."',
       data-usuario='".desencriptar($line['usuario'])."',
       data-contraseña='".desencriptar($line['contrasena'])."',
       data-departamento='".$line['departamentopersonal']."',
       data-puesto='".$line['puesto']."',
       data-localidad='".$line['localidad']."',
       data-coordinador='".$line['coordinador']."',
       data-perfil='".$line['perfil']."',
       data-estatus='".$line['estatus']."'
       >Editar</button>
        <button id='borrar' data-id ='".$line['idpersonal']."' data-usuario = 'personal' class='btn btn-xs' type='button' name='button'>Borrar</button>
       </td>
      </tr>";
    }
    ?>
    </ul>
    </table>
  </body>
</html>
