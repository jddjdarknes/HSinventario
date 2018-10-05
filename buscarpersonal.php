<?php
include ('conexion.php');
$buscar = $_POST['personal'];
$opcion = $_POST['opcion'];
//echo "Option Resivida: ".$opcion."<br>";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <html lang="en">
          <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Servicios con Sentido Humano - Human Services 21</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="assets/css/mystyle.css">
    </head>
    <style media="screen">
      #ver{background-color:MediumSeaGreen; }
      .cortar{
          width:200px;
          height:20px;
          padding:20px;
          border:1px solid blue;
          text-overflow:ellipsis;
          white-space:nowrap;
          overflow:hidden;
        }
      .cortar:hover {
        width: auto;
        white-space: initial;
        overflow:visible;
        cursor: pointer;
      }
    </style>
    <title></title>
  </head>
  <body>

    <?php
    $query = "SELECT * FROM personal
    WHERE Nombres LIKE '%$buscar%'
    OR apellidos LIKE '%$buscar%' and estatus != '0';";

    $consulta = sqlsrv_query($conexion,$query);
    echo "<table>";
    while( $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC) ){
      echo "<tr>
      <td>
      <button type='button' name='button' class='btnpersonal btn btn-primary'
      data-id='".$line['idpersonal']."'
      data-nombre='".$line['Nombres']."'
      data-apellido='".$line['apellidos']."'
      data-departamento = '".$line['departamentopersonal']."'
      data-puesto = '".$line['puesto']."'
      data-localidad = '".$line['localidad']."'
      data-coordinador = '".$line['coordinador']."'
      data-perfil = '".$line['perfil']."'
      data-opcion = '".$opcion."'>
      <img high='50' width='50' src='imagenes/avatar.png' alt=''>
      Nombre: ".$line['Nombres']
      ." ".$line['apellidos']."</button>
      </td></tr>";
    }
    echo "</table>";
    ?>

  </body>
</html>
