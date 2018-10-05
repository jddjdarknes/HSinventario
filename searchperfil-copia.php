<?php
include ('conexion.php');
$buscar = $_POST['perfil'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h3>Perfiles Registrados:</h3>
    <table width=100%>
    <ul>
    <?php
    $query = "SELECT * FROM perfil WHERE departamentoperfil LIKE '%$buscar%';";
    $consulta = sqlsrv_query($conexion,$query);
    while( $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC) ){
      echo "
        <tr>
          <td><li align='left' style='list-style:none;'>".$line['departamentoperfil']."</li></td>
          <td align='right'><button id='botonperfil' class='btn btn-xs' type='button' name='button'
          data-id='".$line['idperfil']."',
          data-departamento='".$line['departamentoperfil']."',
          data-contrasena='".$line['contraseña']."'>Editar</button>
          <button data-id ='".$line['idperfil']."' data-usuario = 'perfil' id='borrar' class='btn btn-xs' type='button' name='button'>Borrar</button>
          </td>
        </tr>";
    }
    ?>
    </ul>
    </table>
  </body>
</html>
