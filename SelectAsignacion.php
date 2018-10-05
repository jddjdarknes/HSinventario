<?php
include("conexion.php");
$id = $_POST['idpersonal'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Servicios con Sentido Humano - Human Services 21</title>
      <!-- CSS -->
      <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400">
      <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:700,400">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/elegant-font/code/style.css">
      <link rel="stylesheet" href="assets/css/animate.css">
      <link rel="stylesheet" href="assets/css/magnific-popup.css">
      <link rel="stylesheet" href="assets/flexslider/flexslider.css">
      <link rel="stylesheet" href="assets/css/form-elements.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/media-queries.css">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/ico/favicon.ico">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        <style type="text/css">
        </style>
        <script>
        $(document).ready(function(){
          $( "#btnagregar" ).click(function(){
            alert("Agregar");
            if ( $( "input.asignar" ).is( ":checked" ) || $( "input.prestar" ).is( ":checked" ) ||  $( "input.software" ).is( ":checked" ) || $( "input.accesorio" ).is( ":checked" ))
            {
              $asignar = $( ".asignar:checked" ).val();
              $prestar = $( ".prestar:checked" ).val();
              var contadorsoft = 0;
              var contsoft = 0;
              var contadoracce = 0;
              var contacce = 0;
              var software;
              var accesorio;
              $software = $(  ".software:checked" ).val();
              $accesorio = $( ".accesorio:checked" ).val();
              $personal = $( this ).data( 'personal' );
              //alert("Asignar: "+$asignar+" Prestar: "+$prestar+" Personal: "+$personal);
              //alert("Asignar Software: "+$software);
              //alert("Asignar Accesorio: "+$accesorio);

              $('.software:checked').each(function() {contadorsoft ++;});
              software = new Array(contadorsoft);

              $('.software:checked').each(
                function() {
                  software[contsoft] = $( this ).val();
                  contsoft ++;
                }
              );

              $('.accesorio:checked').each(function() {contadoracce ++;});
              accesorio = new Array(contadoracce);

              $('.accesorio:checked').each(
                function() {
                  accesorio[contacce] = $( this ).val();
                  contacce ++;
                }
              );

              $.post( "Insertasignacion.php",{
                "asignar":$asignar,
                "prestar":$prestar,
                "personal":$personal,
                "software":JSON.stringify(software),
                "accesorio":JSON.stringify(accesorio)}
                , function( data ) {
                $( "#datosasignacion" ).html( data );
              });
            }else{alert("No se ha seleccionado ningun elemento.");}
          });

        });
        </script>
  </head>
  <body>
  <h2 id='h2'>Datos de Asignacion: </h2>
    <table class='table table-striped'>
      <thead>
        <tr>
          <?php
          $sql1 = "SELECT *
            FROM personal
            where idpersonal = '$id';";
            $consulta1 = sqlsrv_query($conexion,$sql1);
            while( $line = sqlsrv_fetch_array( $consulta1, SQLSRV_FETCH_ASSOC) ){
            echo "<th colspan=3>Nombre: ".$line['Nombres']." ".$line['apellidos']."</th>";
          }
          ?>
      </tr>
      </thead>
      <tbody>
        <tr>
          <td><label>Equipo</label><br>
          <?php
            $sql0 = "SELECT *
              FROM herramientas_personal HP
              INNER JOIN Herramienta H ON HP.clave = H.clave
              INNER JOIN personal P ON HP.idpersonal = P.idpersonal
              where HP.idpersonal = '$id' and HP.Clave like '%Hard%';";
              $consulta0 = sqlsrv_query($conexion,$sql0);
              while( $line = sqlsrv_fetch_array( $consulta0, SQLSRV_FETCH_ASSOC) ){
              echo $line['nombreequipo'];
            }
          ?>
          </td>
          <td><label><input id='Soft' data-tipo = 'Soft' type='checkbox' value=''>Software</label><br>
            <?php
            $sql2 = "SELECT correo
              FROM herramientas_personal HP
              INNER JOIN Herramienta H ON HP.clave = H.clave
              INNER JOIN personal P ON HP.idpersonal = P.idpersonal
              where HP.clave like '%Soft%' and HP.idpersonal = '$id'";
            $consulta2 = sqlsrv_query($conexion,$sql2);
            while( $line = sqlsrv_fetch_array( $consulta2, SQLSRV_FETCH_ASSOC) ){
                echo $line['correo']."<br>";
            }
            ?>
          </td>
          <td><label><input id='Acce' data-tipo = 'Acce' type='checkbox' value=''>Accesorio(s)</label><br>
          <?php
          $sql3 = "SELECT *
            FROM herramientas_personal HP
            INNER JOIN Herramienta H ON HP.clave = H.clave
            INNER JOIN personal P ON HP.idpersonal = P.idpersonal
            where P.idpersonal = '$id' AND H.clave like '%Acce%';";
          $consulta3 = sqlsrv_query($conexion,$sql3);
          while( $line = sqlsrv_fetch_array( $consulta3, SQLSRV_FETCH_ASSOC) ){
                echo $line['nombreequipo']."<br>";
          }
          ?>
          </td>
        </tr>
     </tbody>
    </table>
    <div align='left'>
    <button id='btnagregar' data-personal = "<?php echo $id; ?>" type='button' class = 'btn' name='button'>Agregar</button>
    <button id='btncancelar' type='button' class = 'btn' name='button'>Cancelar</button>
    </div>
  </body>
</html>
