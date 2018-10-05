<?php
include( "conexion.php" );
$idpersonal = $_POST['id'];
$claveherramienta = $_POST['clave'];

echo "Id personal: ".$idpersonal."<br>";
echo "Clave Herramienta: ".$claveherramienta."<br>";

$query = "DELETE FROM herramientas_personal where Clave like '%$claveherramienta%'";
$consulta = sqlsrv_query($conexion,$query);
if( $consulta === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
    }
}else{
  echo "Se libero la herramienta.<br>";
}

$query = " UPDATE herramienta Set estadoherramienta = 'No asignada', cantidad +=1 where Clave like '%$claveherramienta%'";
$consulta = sqlsrv_query($conexion,$query);
if( $consulta === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
    }
}else{
  echo "Se actualisaron los Datos.<br>";
}

$query = " UPDATE personal Set estadoherramienta = 'No asignada' where idpersonal = '$idpersonal'";
$consulta = sqlsrv_query($conexion,$query);
if( $consulta === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
    }
}else{
  echo "Se actualisaron los Datos del personal.<br>";
}
?>
