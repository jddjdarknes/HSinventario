<?php
include('conexion.php');
$herramienta = $_POST['herramienta'];
$tipo = (isset($_POST['tipo']) && $_POST['tipo'] != NULL)?$_POST['tipo']:'0';
$fecha = localtime();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <META HTTP-EQUIV="REFRESH" CONTENT="5;URL=http://38.101.223.14/HSinventario/altaherramienta.php">
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
      <link rel="shortcut icon" href="assets/ico/favicon.ico">
      <!--<meta http-equiv="refresh" content="3;URL=http://hscorporativo.dyndns-server.com:8080/HSiNVENTARIO/altaherramienta.php" />-->
    <title>Datos A guardar </title>
  </head>
  <body>
    <div align="left">
      <a href="index.php">
        <img src="assets/img/logo-human.png" height="80px">
      </a>
    </div>
     <div class="navbar">
       <div class="col-sm-3"></div>
        <div class="collapse navbar-collapse col-sm-4" align="center">
         <ul class="nav navbar-nav">
          <li><a href="#">Alta usuario</a></li>
          <li class="active"><a href="#">Alta equipo</a></li>
          <li><a href="#">Asignar herramientas.</a></li>
          <li><a href="#">Consultar usuario</a></li>
           <li><a href="#">Salir</a></li>
         </ul>
       </div>
       <div class="col-sm-4"></div>
     </div>
<?php
 echo "<h3>Datos de Herramienta:</h3>";
 switch ($herramienta) {
   case 'Computadora':
     # code...
     $sql = "SELECT * FROM herramienta where tipo like '%$tipo%'";
     $params = array();
     $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
     $consulta = sqlsrv_query( $conexion, $sql , $params, $options );
     $filas = sqlsrv_num_rows( $consulta )+1;
     //echo "Filas: ".$filas."<br>";
     $clave = "$tipo".$filas;

     $nombrequipo = $_POST['nombrequipo'];
     $usuariow = $_POST['usuariow'];
     $contraseña = $_POST['contraseña'];
     $idteamviewer = $_POST['idteamviewer'];
     $tipo = $_POST['tipo'];
     $marca = $_POST['marca'];
     $modelo = $_POST['modelo'];
     $noserie = $_POST['noserie'];
     $sistemaoperativo = $_POST['sistemaoperativo'];
     $procesador = $_POST['procesador'];
     $ram = $_POST['ram'];
     $medidaR = $_POST['medidaRam'];
     $ram = $ram." ".$medidaR;
     $discoduro = $_POST['discoduro'];
     $medidaH = $_POST ['medidaHDD'];
     $discoduro = $discoduro." ".$medidaH;
     $direccionip = $_POST['direccionip'];
     $macadress = $_POST['macadress'];
     $macadressw = (isset($_POST['macadressw']) && $_POST['macadressw'] != NULL)?$_POST['macadressw']:'0';
     $proyecto = $_POST['proyecto'];
     $nomproyecto = $_POST['nomproyecto'];
     $fecha = date('d/m/Y h:i:s a');

     echo "<table align='center'>";
     echo "<tr><th>Herramienta:</th><td>".$herramienta."</td></tr>";
     echo "<tr><th>Nombre del equipo:</th><td>".$nombrequipo."</td></tr>";
     echo "<tr><th>Usuario Windows:</th><td>".$usuariow."</td></tr>";
     echo "<tr><th>Contraseña:</th><td>".$contraseña."</td></tr>";
     echo "<tr><th>ID Team Viewer:</th><td>".$idteamviewer."</td></tr>";
     echo "<tr><th>Tipo(Laptop,Escritorio):</th><td>".$tipo."</td></tr>";
     echo "<tr><th>Marca:</th><td>".$marca."</td></tr>";
     echo "<tr><th>Modelo:</th><td>".$modelo."</td></tr>";
     echo "<tr><th>No. serie:</th><td>".$noserie."</td></tr>";
     echo "<tr><th>Sistema operativo:</th><td>".$sistemaoperativo."</td></tr>";
     echo "<tr><th>Procesador:</th><td>".$procesador."</td></tr>";
     echo "<tr><th>Ram:</th><td>".$ram."</td></tr>";
     echo "<tr><th>medidaRam:</th><td>".$medidaR."</td></tr>";
     echo "<tr><th>Disco Duro:</th><td>".$discoduro."</td></tr>";
     echo "<tr><th>direccion ip:</th><td>".$direccionip."</td></tr>";
     echo "<tr><th>Mac Adres:</th><td>".$macadress."</td></tr>";
     echo "<tr><th>Mac Adres wifi:</th><td>".$macadressw."</td></tr>";
     echo "<tr><th>¿Asignada a Proyecto? ".$proyecto."</td></tr>";
     echo "<tr><th>Nombre Proyecto:</th><td>".$nomproyecto."</td></tr>";
     echo "<tr><th>clave:</th><td>".$clave."</td></tr>";
     echo "<tr><th>Fecha:</th><td>".$fecha."</td></tr>";
     echo "</table>";

     $query = "INSERT INTO herramienta (Clave,passwindows,nombreequipo,tipo,usuariowindows,marca,modelo,no_serie,procesador,discoduro,ram,so,direccionip,macadress,idteamviewer,fecha_ingreso,Proyecto,Asignar,estadoherramienta)
               VALUES('$clave','$contraseña','$nombrequipo','H'+'$tipo','$usuariow','$marca','$modelo','$noserie','$procesador','$discoduro','$ram','$sistemaoperativo','$direccionip','$macadress',$idteamviewer,'$fecha','$nomproyecto','$proyecto','No Asignada');";

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
        echo "<div class='alert alert-success'>
               <strong>Se guradaron los datos !</strong>
              </div>";
      }
     break;
   case 'Telefonia':
     if($tipo == "FijoTD"){$nombre="Telefono con Diadema";}
     if($tipo == "FijoTA"){$nombre="Telefono Analogo";}
     if($tipo == "FijoTIP"){$nombre="Telefono IP";}
     if($tipo == "FijoTI"){$nombre="Telefono Inalambrico";}
     if($tipo == "MovilCelular"){$nombre="Celular";}

     $sql = "SELECT * FROM herramienta where tipo like '%$tipo';";
     $params = array();
     $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
     $consulta = sqlsrv_query( $conexion, $sql , $params, $options );
     $filas = sqlsrv_num_rows( $consulta )+1;
     $clave = "$tipo".$filas;

     $marca = $_POST['marca'];
     $modelo = $_POST['modelo'];
     $ns = (isset($_POST['ns']) && $_POST['ns'] != NULL)?$_POST['ns']:'0';
     $email = (isset($_POST['email']) && $_POST['email'] != NULL)?$_POST['email']:'0';

     echo "<table align='center'>
        <tr>
          <th>Herramienta:</th>
          <td>".$herramienta."</th>
        </tr>
        <tr>
          <th>Tipo:</th>
          <td>".$tipo."</td>
        </tr>
        <tr>
          <th>Marca:</td>
          <td>".$marca."</td>
        </tr>
        <tr>
          <th>Modelo:</td>
          <td>".$modelo."</td>
        </tr>
        <tr>
          <th>N.S:</td>
          <td>".$ns."</td>
        </tr>
        <tr>
          <th>E-mail:</td>
          <td>".$email."</td>
        </tr>
        <tr>
          <th>Clave:</td>
          <td>".$clave."</td>
        </tr>
      </table>";

     $query = "INSERT INTO herramienta (Clave,nombreequipo,correo,tipo,marca,modelo,no_serie,estadoherramienta)
     VALUES('$clave','$nombre','$email','H'+'$tipo','$marca','$modelo','$ns','No Asignada') ";

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
        echo "<div class='alert alert-success'>
               <strong>Se guardaron los datos!</strong>
              </div>";
      }
     break;
   case 'Impresora':

      $sql = "SELECT * FROM herramienta where clave like '%$tipo%'";
      $params = array();
      $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $consulta = sqlsrv_query( $conexion, $sql , $params, $options );
      $filas = sqlsrv_num_rows( $consulta )+1;
      $clave = "$tipo".$filas;

      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $impresora = (isset($_REQUEST['impresora'])&& $_REQUEST['impresora'] !=NULL)?$_REQUEST['impresora']:'0';
      $cantidad = (isset($_REQUEST['cantidad'])&& $_REQUEST['cantidad'] !=NULL)?$_REQUEST['cantidad']:'0';
      $noserie = (isset($_REQUEST['noserie'])&& $_REQUEST['noserie'] !=NULL)?$_REQUEST['noserie']:'0';

      echo "<table align='center'>";
      echo "<tr><th>Tipo:</th><td>".$tipo."</td></tr>";
      echo "<tr><th>Marca: </th><td>".$marca."</td></tr>";
      echo "<tr><th>Modelo: </th><td>".$modelo."</td></tr>";
      echo "<tr><th>No. Serie: </th><td>".$noserie."</td></tr>";
      echo "<tr><th>Impresora: </th><td>".$impresora."</td></tr>";
      echo "<tr><th>Cantidad: </th><td>".$cantidad."</td></tr>";
      echo "<tr><th>Clave: </th><td>".$clave."</td></tr>";
      echo "</table>";

      if($tipo == "impresoraColor"){$nombre="Impresora a Color";}
      if($tipo == "impresoraCredencial"){$nombre="Impresora Credencial";}
      if($tipo == "impresoraMono"){$nombre="Impresora Monocromatica";}
      if($tipo == "impresoraMultiB/N"){$nombre="Impresora Multi B/N";}
      if($tipo == "impresoraMultiColor"){$nombre="Impresora Multi Color";}
      if($tipo == "ConsumibleTambor"){$nombre="Tambor";}
      if($tipo == "ConsumibleToner"){$nombre="Toner";}
      if($tipo == "TargetaPVC"){$nombre="Targeta PVC";}

      if($tipo != "Consumible"){
        $query = "INSERT INTO herramienta (Clave,nombreequipo,tipo,marca,modelo,no_serie,estadoherramienta)
        VALUES('$clave','$nombre','H'+'$tipo','$marca','$modelo','$noserie','No Asignada') ";
      }else{
        $query = "INSERT INTO herramienta (Clave,nombreequipo,tipo,marca,modelo,cantidad,estadoherramienta)
        VALUES('$clave','$nombre','H'+'$tipo','$marca','$modelo','$cantidad','No Asignada') ";
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
         echo "<div class='alert alert-success'>
                <strong>Se guardaron los datos. !</strong> Indicates a successful or positive action.
               </div>";
       }
        break;

      case 'Complemento':

      $ncomplento = (isset($_POST['ncomplemento']) && $_POST['ncomplemento'] != NULL)?$_POST['ncomplemento']:'0';
      $cantidad = $_POST['cantidad'];

      echo "<table align='center'>";
      echo "<tr><th>Complemento:</th><td>".$ncomplento."</td></tr>";
      echo "<tr><th>Cantidad:</th><td>".$cantidad."</td></tr>";
      echo "<tr><th>Tipo:</th><td>".$tipo."</td></tr>";
      echo "</table>";

      if($tipo != "Otro"){
        $query= "UPDATE herramienta SET cantidad += $cantidad WHERE Clave = '$tipo'";
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
           echo "<div class='alert alert-success'>
                  <strong>Se guardaron los datos. !</strong>
                 </div>";
         }
      }else{
        $sql = "SELECT * FROM herramienta where clave like '%$tipo%'";
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $consulta = sqlsrv_query( $conexion, $sql , $params, $options );
        $filas = sqlsrv_num_rows( $consulta )+1;
        $clave = "$tipo".$filas;

        $query= "INSERT INTO Herramienta (Clave,nombreequipo,tipo,marca,modelo,cantidad,estadoherramienta)
                 values('$clave','$ncomplento','H'+'$tipo','null','null',$cantidad,'No Asignada')";
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
           echo "<div class='alert alert-success'>
                  <strong>Se guardaron los datos. !</strong>
                 </div>";
         }
      }
      break;
    case "Almacenamiento":

    if($tipo == "ALHDDLap"){$nombre="Disco Duro Laptop";}
    if($tipo == "ALHDDPC"){$nombre="Disco Duro Desktop";}
    if($tipo == "ALMEMORIMICROSD"){$nombre="Micro SD";}
    if($tipo == "ALMEMORIUsb"){$nombre="Memoria Usb";}

    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $tamaño = $_POST['tamaño'];
    $medida = $_POST['medida'];

    echo "<table align='center'>";
    echo "<tr><th>Marca:</th><td>".$marca."</td></tr>";
    echo "<tr><th>Modelo:</th><td>".$modelo."</td></tr>";
    echo "<tr><th>Tamaño:</th><td>".$tamaño."</td></tr>";
    echo "<tr><th>Medida:</th><td>".$medida."</td></tr>";
    echo "</table>";

    $sql = "SELECT * FROM herramienta where Clave like '%$tipo%'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $consulta = sqlsrv_query( $conexion, $sql , $params, $options );
    $filas = sqlsrv_num_rows( $consulta )+1;
    $clave = "$tipo".$filas;

    $query = "INSERT INTO herramienta (Clave,nombreequipo,tipo,marca,modelo,discoduro,estadoherramienta)
    VALUES('$clave','$nombre','H'+'$tipo','$marca','$modelo','$tamaño.$medida','No Asignada') ";

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
       echo "<div class='alert alert-success'>
              <strong>Se guardaron los datos. !</strong>
             </div>";
     }
    break;
   case "Red":

   if($tipo == "RedRouter"){$nombre="Router";}
   if($tipo == "RedSwicht"){$nombre="Switch";}
   if($tipo == "RedAccessP"){$nombre="Access Point";}

   $marca = $_POST['marca'];
   $modelo = $_POST['modelo'];

   echo "<table align='center'>";
   echo "<tr><th>Marca: </th><td>".$marca."</td></tr>";
   echo "<tr><th>Modelo: </th><td>".$modelo."</td></tr>";
   echo "</table>";

   $sql = "SELECT * FROM herramienta where Clave like '%$tipo%'";
   $params = array();
   $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   $consulta = sqlsrv_query( $conexion, $sql , $params, $options );
   $filas = sqlsrv_num_rows( $consulta )+1;
   $clave = "$tipo".$filas;

   $query = "INSERT INTO herramienta (Clave,nombreequipo,tipo,marca,modelo,estadoherramienta)
   VALUES('$clave','$nombre','H'+'$tipo','$marca','$modelo','No Asignada') ";

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
      echo "<div class='alert alert-success'>
             <strong>Se guardaron los datos. !</strong>
            </div>";
    }
   break;
   case "Acceso_Programa":

   $usuario = (isset($_POST['usuario']) && $_POST['usuario'] != NULL)?$_POST['usuario']:'0';
   $contraseña = (isset($_POST['pass']) && $_POST['pass'] != NULL)?$_POST['pass']:'0';
   $nombreuni = (isset($_POST['nombreuni']) && $_POST['nombreuni'] != NULL)?$_POST['nombreuni']:'0';
   $perfil = (isset($_POST['perfil']) && $_POST['perfil'] != NULL)?$_POST['perfil']:'0';
   $bd = (isset($_POST['bd']) && $_POST['bd'] != NULL)?$_POST['bd']:'0';
   $sucursales = (isset($_POST['sucursal']) && $_POST['sucursal'] != NULL)?$_POST['sucursal']:'0';

   $sql = "SELECT * FROM herramienta where clave like '%$tipo%'";
   $params = array();
   $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   $consulta = sqlsrv_query( $conexion, $sql , $params, $options );
   $filas = sqlsrv_num_rows( $consulta )+1;
   $clave = "$tipo".$filas;

   echo "<table align='center'>";
   echo "<tr><th>Usuario:</th><td>".$usuario."</td></tr>";
   echo "<tr><th>Contraseña:</th><td>".$contraseña."</td></tr>";
   echo "<tr><th>Nombres de unidad:</th><td>".$nombreuni."</td></tr>";
   echo "<tr><th>Perfil:</th><td>".$perfil."</td></tr>";
   echo "<tr><th>Base de Datos:</th><td>".$bd."</td></tr>";
   echo "<tr><th>Sucursales:</th><td>".$sucursales."</td></tr>";
   echo "</table>";

   if($tipo == "ServidorVirtual"){
     $query = "INSERT INTO herramienta (Clave,correo,passcorreo,tipo,estadoherramienta)
     VALUES('$clave','$usuario','$contraseña','S'+'$tipo','No Asignada') ";
   }
   if($tipo == "UnidadRed"){
     $query = "INSERT INTO herramienta (Clave,correo,tipo,estadoherramienta)
     VALUES('$clave','$nombreuni','S'+'$tipo','No Asignada') ";
   }
   if($tipo == "Contabilidad"){
     $query = "INSERT INTO herramienta (Clave,correo,passcorreo,passpst,tipo,estadoherramienta)
     VALUES('$clave','$usuario','$contraseña','$perfil','S'+'$tipo','No Asignada') ";
   }
   if($tipo == "Facturacion"){
     $query = "INSERT INTO herramienta (Clave,correo,passcorreo,passpst,tipo,estadoherramienta)
     VALUES('$clave','$usuario','$contraseña','$perfil','S'+'$tipo','No Asignada')";
   }
   if($tipo == "Giro"){
     $query = "INSERT INTO herramienta (Clave,correo,passcorreo,passpst,passwindows,tipo,estadoherramienta)
     VALUES('$clave','$usuario','$contraseña','$bd','$perfil','S'+'$tipo','No Asignada') ";
   }
   if($tipo == "SistemaTicket"){
     $query = "INSERT INTO herramienta (Clave,correo,passcorreo,tipo,estadoherramienta)
     VALUES('$clave','$usuario','$contraseña','S'+'$tipo','No Asignada') ";
   }
   if($tipo == "GiroWeb"){
     $query = "INSERT INTO herramienta (Clave,correo,passcorreo,passpst,passwindows,tipo,estadoherramienta)
     VALUES('$clave','$usuario','$contraseña','$bd','$sucursales','S'+'$tipo','No Asignada') ";
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
      echo "<div class='alert alert-success'>
             <strong>Se guardaron los datos. !</strong>
            </div>";
    }
   break;
   case "Correo":
   $usuario = $_POST['usuario'];
   $contraseña = $_POST['contraseña'];

   echo "<table align='center'>";
   echo "<tr><th>Usuario:</th><td>".$usuario."</td></tr>";
   echo "<tr><th>Contraseña:</th><td>".$contraseña."</td></tr>";
   echo "<tr><th>Tipo:</th><td>".$tipo."</td></tr>";
   echo "<tr><th>Herramienta: </th><td>".$herramienta."</td></tr>";
   echo "</table>";

   $sql = "SELECT * FROM herramienta where clave like '%$tipo%'";
   $params = array();
   $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   $consulta = sqlsrv_query( $conexion, $sql , $params, $options );
   $filas = sqlsrv_num_rows( $consulta )+1;
   $clave = "$tipo".$filas;

   $query = "INSERT INTO herramienta (Clave,correo,passcorreo,tipo,estadoherramienta)
   VALUES('$clave','$usuario','$contraseña','S'+'$tipo','No Asignada') ";


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
      echo "<div class='alert alert-success'>
             <strong>Se guardaron los datos. !</strong>
            </div>";
    }

   break;
   default:
     # code...
     echo "Opcion de fault: ";
     echo "Herramienta: ".$herramienta."<br>";
     echo "Tipo: ".$tipo."<br>";
     break;
 }
  echo "<div>
  <a href='http://38.101.223.14/HSinventario/altaherramienta.php'>Agregar otra herramienta.</a>
  </div>
  ";
 ?>
 <footer>
     <div class="container">
         <div class="row">
             <div class="col-sm-7 footer-copyright wow fadeIn">
                 <p>&copy; 2017 Human Services 21</p>
             </div>
         </div>
     </div>
 </footer>
 </body>
</html>
