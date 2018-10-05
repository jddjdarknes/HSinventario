<?php
include("conexion.php");
$hardware = json_decode($_POST['hardware']);
$software = json_decode($_POST['software']);
$accesorio = json_decode($_POST['accesorio']);
$unidadredbaja = json_decode($_POST['unidadredbaja']);
$persona = $_POST['persona'];
$estadoH = $_POST['estadoH'];
$nuevousuario  = (isset($_POST['nuevousuario']) && $_POST['nuevousuario'] != NULL)?$_POST['nuevousuario']:'0';
$borrartodounidadred = (isset($_POST['borrartodounidadred']) && $_POST['borrartodounidadred'] != NULL)?$_POST['borrartodounidadred']:'0';
$inicio = (isset($_POST['inicio']) && $_POST['inicio'] != NULL)?$_POST['inicio']:'0';
$termino = (isset($_POST['termino']) && $_POST['termino'] != NULL)?$_POST['termino']:'0';

if($borrartodounidadred != "0"){
  $sql = sqlsrv_query($conexion,"Delete from herramientas_personal where idpersonal = '$persona'");
  if( $sql === false ) {
     die( print_r( sqlsrv_errors(), true));
 }else{echo "Over Here";}
}

foreach ($unidadredbaja as $contenido) {
  $query = "delete from herramientas_personal where Clave = '$contenido'";
  $sql = sqlsrv_query($conexion,$query);
  if( $sql === false ) {
       if( ($errors = sqlsrv_errors() ) != null) {
           foreach( $errors as $error ) {
               echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
               echo "code: ".$error[ 'code']."<br />";
               echo "message: ".$error[ 'message']."<br />";
           }
       }
   }else{
     echo "Baja unidad Red.<br>";
   }
}//end foreach


if($nuevousuario != 0){
    $sl = sqlsrv_query($conexion,"update peticion set atendido = 2 where idpeticion = $nuevousuario");
    if( $sl === false ) {
       die( print_r( sqlsrv_errors(), true));
  }else{echo "Aqui esta el otro QWERTY";}
}

echo "Estado: ".$estadoH."<br>";
$valor = 0;

echo "Persona: asinada: ".$persona."<br>";
foreach ($hardware as $contenido) {

  if($inicio !='0' && $termino !='0'){
    $query = "INSERT INTO herramientas_personal (idpersonal,clave,descripcion,estado_herramienta,inicio_prestamo,fin_prestamo)
              VALUES ($persona,'$contenido','','Prestada','$inicio','$termino')";
  }else{
    $query = "INSERT INTO herramientas_personal (idpersonal,clave,descripcion,estado_herramienta)
            VALUES ($persona,'$contenido','','$estadoH')";
        }

  $sql = sqlsrv_query($conexion,$query);
  if( $sql === false ) {
       if( ($errors = sqlsrv_errors() ) != null) {
           foreach( $errors as $error ) {
               echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
               echo "code: ".$error[ 'code']."<br />";
               echo "message: ".$error[ 'message']."<br />";
           }
       }
   }else{
     echo "Se guardaron los Datos.<br>";
   }
}//end foreach

foreach ($software as $contenido) {
  $query = "INSERT INTO herramientas_personal (idpersonal,clave,descripcion,estado_herramienta)
            VALUES ($persona,'$contenido','','Asignada')";
  $sql = sqlsrv_query($conexion,$query);
  if( $sql === false ) {
       if( ($errors = sqlsrv_errors() ) != null) {
           foreach( $errors as $error ) {
               echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
               echo "code: ".$error[ 'code']."<br />";
               echo "message: ".$error[ 'message']."<br />";
           }
       }
   }else{
     echo "Se guardaron los Datos.<br>";
   }
}//end foreach

foreach ($accesorio as $contenido) {
  echo "Cleve de herramienta: ".$contenido."<br>";
  if($inicio != '0' && $termino !='0'){
    $query = "INSERT INTO herramientas_personal (idpersonal,clave,descripcion,estado_herramienta,inicio_prestamo,fin_prestamo)
              VALUES ($persona,'$contenido','','Prestada','$inicio','$termino')";
  }else{
    $query = "INSERT INTO herramientas_personal (idpersonal,clave,descripcion,estado_herramienta)
              VALUES ($persona,'$contenido','','Asignada')";
  }
  $sql = sqlsrv_query($conexion,$query);
  if( $sql === false ) {
       if( ($errors = sqlsrv_errors() ) != null) {
           foreach( $errors as $error ) {
               echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
               echo "code: ".$error[ 'code']."<br />";
               echo "message: ".$error[ 'message']."<br />";
           }
       }
   }else{
     echo "Se guardaron los Datos.<br>";
     $acce = substr($contenido, 0, -1);
     echo "ACCESORIO: ".$acce."<br>";
     if($acce == "Otro"){
       $reducir = sqlsrv_query($conexion,"UPDATE herramienta SET cantidad -=1,estadoherramienta = 'No Asignada' where Clave = '$contenido' ");
     }
   }
}//end foreach
?>
