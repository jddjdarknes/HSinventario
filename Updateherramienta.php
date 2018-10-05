<?php
include("conexion.php");
$herramienta = (isset($_POST['herramienta']) && $_POST['herramienta'] !=NULL)?$_POST['herramienta']:'No llego';
$id =  (isset($_POST['id']) && $_POST['id'] != NULL)?$_POST['id']:'0';
$passwindows = (isset($_POST['contraseña']) && $_POST['contraseña'] !=NULL)?$_POST['contraseña']:'0';
$nombreequipo =(isset($_POST['nombrequipo']) && $_POST['nombrequipo'] !=NULL)?$_POST['nombrequipo']:'0';
$tipo = (isset($_POST['tipo']) && $_POST['tipo'] !=NULL)?$_POST['tipo']:'0';
$usuariowindows = (isset($_POST['usuariow']) && $_POST['usuariow'] !=NULL)?$_POST['usuariow']:'0';
$marca = (isset($_POST['marca']) && $_POST['marca'] !=NULL)?$_POST['marca']:'0';
$modelo = (isset($_POST['modelo']) && $_POST['modelo'] !=NULL)?$_POST['modelo']:'0';
$no_serie = (isset($_POST['noserie']) && $_POST['noserie'] !=NULL)?$_POST['noserie']:'0';
$procesador = (isset($_POST['procesador']) && $_POST['procesador'] !=NULL)?$_POST['procesador']:'0';
$discoduro = (isset($_POST['discoduro']) && $_POST['discoduro'] !=NULL)?$_POST['discoduro']:'';
$ram = (isset($_POST['ram']) && $_POST['ram'] !=NULL)?$_POST['ram']:'0';
$so = (isset($_POST['sistemaoperativo']) && $_POST['sistemaoperativo'] !=NULL)?$_POST['sistemaoperativo']:'0';
$direccionip = (isset($_POST['direccionip']) && $_POST['direccionip'] !=NULL)?$_POST['direccionip']:'0';
$macadress = (isset($_POST['macadress']) && $_POST['macadress'] !=NULL)?$_POST['macadress']:'0';
$idteamviewer = (isset($_POST['idteamviewer']) && $_POST['idteamviewer'] !=NULL)?$_POST['idteamviewer']:'0';
$proyecto = (isset($_POST['nomproyecto']) && $_POST['nomproyecto'] !=NULL)?$_POST['nomproyecto']:'0';
$asignar = (isset($_POST['asignar']) && $_POST['asignar'] !=NULL)?$_POST['asignar']:'0';
$cantidad = (isset($_POST['cantidad']) && $_POST['cantidad'] !=NULL)?$_POST['cantidad']:'0';
$macadressw = (isset($_POST['macadressw']) && $_POST['macadressw'] !=NULL)?$_POST['macadressw']:'0';
$nombreproyecto = (isset($_POST['nomproyecto']) && $_POST['nomproyecto'] !=NULL)?$_POST['nomproyecto']:'0';
$numeroserie = (isset($_POST['ns']) && $_POST['ns'] !=NULL)?$_POST['ns']:'0';
$macadressw = (isset($_POST['macadressw']) && $_POST['macadressw'] !=NULL)?$_POST['macadressw']:'0';
$medida = (isset($_POST['medida']) && $_POST['medida'] !=NULL)?$_POST['medida']:'0';
$tamaño = (isset($_POST['tamaño']) && $_POST['tamaño'] !=NULL)?$_POST['tamaño']:'0';

$correo = (isset($_POST['correo']) && $_POST['correo'] !=NULL)?$_POST['correo']:'0';
$passcorreo = (isset($_POST['passcorreo']) && $_POST['passcorreo'] !=NULL)?$_POST['passcorreo']:'0';
$passpst = (isset($_POST['passpst']) && $_POST['passpst'] !=NULL)?$_POST['passpst']:'0';
$passwindows = (isset($_POST['passwindows']) && $_POST['passwindows'] !=NULL)?$_POST['passwindows']:'0';

//$correo = (isset($_POST['']) && $_POST[''] != NULL)?$_POST['']:'0';
//$passcorreo = (isset($_POST['']) && $_POST[''] != NULL)?$_POST['']:'0';
//$paspst = (isset($_POST['']) && $_POST[''] != NULL)?$_POST['']:'0';

if($medida != '0' and $tamaño != '0')
{
  $discoduro=$tamaño.".".$medida;
}

echo "Herramienta: ".$herramienta."<br>";
echo "Id: ".$id."<br>";
echo "Pass windows: ".$passwindows."<br>";
echo "Nombre Equipo: ".$nombreequipo."<br>";
echo "Tipo: ".$tipo."<br>";
echo "Usuario Windows: ".$usuariowindows."<br>";
echo "Marca: ".$marca."<br>";
echo "Modelo: ".$modelo."<br>";
echo "No. serie: ".$numeroserie."<br>";
echo "Procesador: ".$procesador."<br>";
echo "Disco Duro: ".$discoduro."<br>";
echo "Ram: ".$ram."<br>";
echo "Sistema Operativo: ".$so."<br>";
echo "Direccion IP: ".$direccionip."<br>";
echo "Mac Adress: ".$macadress."<br>";
echo "Team Viewer: ".$idteamviewer."<br>";
echo "Proyecto: ".$proyecto."<br>";
echo "Asignar: ".$asignar."<br>";
echo "Cantidad: ".$cantidad."<br>";
echo "Mac adress: ".$macadressw."<br>";
echo "Nombre Proyecto: ".$nombreproyecto."<br>";
echo "Numero Serie: ".$numeroserie."<br>";
echo "Mac Adress Wi: ".$macadressw."<br>";
echo "Medida: ".$medida."<br>";
echo "Tamaño: ".$tamaño."<br>";

echo "Correo: ".$correo."<br>";
echo "Passcorreo: ".$passcorreo."<br>";
echo "Passpst: ".$passpst."<br>";
echo "Passwindows: ".$passwindows."<br>";

switch ($herramienta) {
  case 'Computadora':
    # code...
    $query = "UPDATE herramienta SET
               passwindows = '$passwindows',
               nombreequipo = '$nombreequipo',
               tipo = '$tipo',
               usuariowindows = '$usuariowindows',
               marca = '$marca',
               modelo = '$modelo',
               no_serie = '$numeroserie',
               procesador = '$procesador',
               discoduro = '$discoduro',
               ram = '$ram',
               so = '$so',
               direccionip = '$direccionip',
               macadress = '$macadress',
               idteamviewer = '$idteamviewer',
               proyecto = '$proyecto',
               asignar = '$asignar',
               estadoherramienta = 'No Asignada',
               macadresswi = '$macadressw'
               where Clave = '$id'";

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
       echo "Se Actualizaron los Datos.";
     }
    break;
  case 'Telefonia':
     $query = "UPDATE herramienta SET
       marca = '$marca',
       modelo = '$modelo',
       no_serie = '$numeroserie'
     where Clave = '$id'";

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
       echo "Se Actualizaron los Datos.";
     }
    break;
  case 'Impresora':
  $rest = substr($id, 0, -1);  ;
  if($rest != "Consumible"){
    $query = "UPDATE herramienta SET
      marca = '$marca',
      modelo = '$modelo',
      no_serie = '$numeroserie',
      cantidad = '$cantidad'
    where Clave = '$id'";
  }else{
    $query = "UPDATE herramienta SET
      marca = '$marca',
      modelo = '$modelo',
      nombreequipo = '$nombreequipo',
      cantidad = '$cantidad'
    where Clave = '$id'";
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
      echo "Se Actualizaron los Datos.";
    }
    break;
  case 'Almacenamiento':
    $query = "UPDATE herramienta SET
      marca = '$marca',
      modelo = '$modelo',
      discoduro = '$discoduro'
    where Clave = '$id'";

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
      echo "Se Actualizaron los Datos.";
    }
    break;
  case 'Red':
    $query = "UPDATE herramienta SET
      marca = '$marca',
      modelo = '$modelo'
    where Clave = '$id'";

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
      echo "Se Actualizaron los Datos.";
    }
    break;
  case 'Complemento':
    $query = "UPDATE herramienta SET
      nombreequipo = '$nombreequipo',
      cantidad -= '$cantidad'
    where Clave = '$id'";

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
      echo "Se Actualizaron los Datos.";
    }
    break;
  case 'Acceso_Programa':
    $query = "UPDATE herramienta SET
       correo='$correo',
       passcorreo='$passcorreo',
       passpst='$passpst',
       passwindows='$passwindows'
    where Clave = '$id'";

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
      echo "Se Actualizaron los Datos.";
    }
    break;
  case 'correo':
    $query = "UPDATE herramienta SET
       correo='$correo',
       passcorreo='$passcorreo'
    where Clave = '$id'";

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
        echo "Se Actualizaron los Datos.";
      }
    break;
  default:
    # code...
    break;
}


 ?>
