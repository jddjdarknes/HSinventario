<?php
session_start();
include "conexion.php";
$idpersona = $_GET['idper'];

$sql = "SELECT *
        FROM personal
        WHERE idpersonal = $idpersona";
$resultado = sqlsrv_query($conexion,$sql);
$rows = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC);

$query = "SELECT *
          FROM herramientas_personal HP
          inner join herramienta H on HP.Clave = H.Clave
          WHERE HP.idpersonal = $idpersona and tipo like 'H%';";
$res = sqlsrv_query($conexion,$query);

$res2 = sqlsrv_query($conexion,$query);
$line = sqlsrv_fetch_array( $res2, SQLSRV_FETCH_ASSOC);
$estado = $line['estadoherramienta'];


$sqls = " SELECT *
          FROM herramientas_personal HP
          inner join herramienta H on HP.Clave = H.Clave
          WHERE HP.idpersonal = $idpersona and tipo like 'S%';";
$respuesta = sqlsrv_query($conexion,$sqls);

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
  <head>
    <title>Convertir a PDF</title>
  </head>
  <body>
    <center><h1>Human Services</h1></center>
    <table width="100%">
      <tr border=1>
        <td colspan = "6"><h2>Datos Personales</h2></td>
      </tr>
      <tr>
        <td colspan="2"><STRONG>Nombre: </td>
        <td colspan="2"><STRONG>Departamento: </td>
        <td><STRONG>Localidad: </td>
        <td><STRONG>Coordinador: </td>
      </tr>
      <tr>
        <td colspan="2"><?php echo $rows['Nombres']." ".$rows['apellidos']; ?></td>
        <td colspan="2"><?php echo $rows['departamentopersonal']; ?></td>
        <td><?php echo $rows['localidad']; ?></td>
        <td><?php echo $rows['coordinador']; ?></td>
      </tr>
      <tr>
        <td colspan="6"><h3>Hardware asignado: </h3></td>
        <tr>
          <td colspan="6">Estado de la Herramienta: <?php echo $estado; ?></td>;
        </tr>
      </tr>
      <tr>
        <td><STRONG>Tipo</td>
        <td><STRONG>Nombre</td>
        <td><STRONG>Usuario</td>
        <td><STRONG>Marca</td>
        <td><STRONG>Modelo</td>
        <td><STRONG>No. Serie</td>
      </tr>
        <?php while( $rows = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC)){
          $equipo = substr($rows['tipo'], 1, 18);
          echo "<tr>";
           if($equipo != "ESCRITORIO" and $equipo != 'LAPTOP'){
             echo "<td>Accesorio</td>";
           }else{
             echo "<td>".$equipo."</td>";
           }
           echo "<td>".$rows['nombreequipo']."</td>";
           echo "<td>".$rows['usuariowindows']."</td>";
           echo "<td>".$rows['marca']."</td>";
           echo "<td>".$rows['modelo']."</td>";
           echo "<td>".$rows['no_serie']."</td>";
          echo "</tr>";
        } ?>
      <tr>
        <td colspan="6"><h3>Software asignado: </h3></td>
      </tr>
      <tr>
        <td colspan="2"><STRONG>Tipo</td>
        <td colspan="2"><STRONG>Nombre</td>
        <td><STRONG>Password</td>
        <!-- <td><STRONG>PST</td> -->
      </tr>
      <?php while( $rows = sqlsrv_fetch_array( $respuesta,SQLSRV_FETCH_ASSOC) ) {
        $equipo = substr($rows['tipo'], 1, 18);
        echo "<tr>";
         echo "<td colspan='2'>".$equipo."</td>";
         echo "<td colspan='2'>".$rows['correo']."</td>";
         echo "<td>".$rows['passcorreo']."</td>";
         //echo "<td>".$rows['passpst']."</td>";
        echo "</tr>";
      } ?>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
    </table>
    <table border="1" width="100%">
      <tr>
        <td width="25%" rowspan="2">Aprobado por: </td>
        <td width="25%">Persona</td>
        <td width="25%" rowspan="2">Resivido por:</td>
        <td width="25%" rowspan="2"></td>
      </tr>
      <tr>
        <td>Departamento</td>
      </tr>
    </table>
  </body>
</html>

<?php
require_once '/dompdf_config.inc.php';
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf =  $dompdf -> output();
$filename = 'aqui_va_el_nombre_del_pdf.pdf';
$dompdf -> stream($filename,array("Attachment" => 0));
?>
