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
      HOLA";
    }
    ?>
    </ul>
    </table>
  </body>
</html>
