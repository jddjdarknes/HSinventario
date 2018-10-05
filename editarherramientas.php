<?php
include("conexion.php");

$herramienta = (isset($_POST['herramienta']) && $_POST['herramienta'] !=NULL)?$_POST['herramienta']:'No llego';
$id =  (isset($_POST['id']) && $_POST['id'] != NULL)?$_POST['id']:'0';
$passwindows = (isset($_POST['passwindows']) && $_POST['passwindows'] !=NULL)?$_POST['passwindows']:'';
$nombreequipo =(isset($_POST['nombreequipo']) && $_POST['nombreequipo'] !=NULL)?$_POST['nombreequipo']:'';
$tipo = (isset($_POST['tipo']) && $_POST['tipo'] !=NULL)?$_POST['tipo']:'';
$usuariowindows = (isset($_POST['usuariowindows']) && $_POST['usuariowindows'] !=NULL)?$_POST['usuariowindows']:'';
$marca = (isset($_POST['marca']) && $_POST['marca'] !=NULL)?$_POST['marca']:'';
$modelo = (isset($_POST['modelo']) && $_POST['modelo'] !=NULL)?$_POST['modelo']:'';
$no_serie = (isset($_POST['no_serie']) && $_POST['no_serie'] !=NULL)?$_POST['no_serie']:'';
$procesador = (isset($_POST['procesador']) && $_POST['procesador'] !=NULL)?$_POST['procesador']:'';
$discoduro = (isset($_POST['discoduro']) && $_POST['discoduro'] !=NULL)?$_POST['discoduro']:'';
$ram = (isset($_POST['ram']) && $_POST['ram'] !=NULL)?$_POST['ram']:'';
$so = (isset($_POST['so']) && $_POST['so'] !=NULL)?$_POST['so']:'';
$direccionip = (isset($_POST['direccionip']) && $_POST['direccionip'] !=NULL)?$_POST['direccionip']:'';
$macadress = (isset($_POST['macadress']) && $_POST['macadress'] !=NULL)?$_POST['macadress']:'';
$idteamviewer = (isset($_POST['idteamviewer']) && $_POST['idteamviewer'] !=NULL)?$_POST['idteamviewer']:'';
$proyecto = (isset($_POST['proyecto']) && $_POST['proyecto'] !=NULL)?$_POST['proyecto']:'';
$asignar = (isset($_POST['asignar']) && $_POST['asignar'] !=NULL)?$_POST['asignar']:'';
$cantidad = (isset($_POST['cantidad']) && $_POST['cantidad'] !=NULL)?$_POST['cantidad']:'';
$macadresswi = (isset($_POST['macadresswi']) && $_POST['macadresswi'] !=NULL)?$_POST['macadresswi']:'';

$correo = (isset($_POST['correo']) && $_POST['correo'] !=NULL)?$_POST['correo']:'';
$passcorreo = (isset($_POST['passcorreo']) && $_POST['passcorreo'] !=NULL)?$_POST['passcorreo']:'';
$passpst = (isset($_POST['passpst']) && $_POST['passpst'] !=NULL)?$_POST['passpst']:'';
$passwindows = (isset($_POST['passwindows']) && $_POST['passwindows'] !=NULL)?$_POST['passwindows']:'';


/*echo "<h1> Datos de Herramientas (Hardware): </h1>";
echo "Herramienta: ".$herramienta."<br>";
echo "Tipo: ".$tipo."<br>";
echo "<h1>Datos Entrantes: </h1><br>";
echo "-->Herramienta: ".$herramienta."<br>";
echo "-->ID: ".$id."<br>";
echo "-->Passwindos: ".$passwindows."<br>";
echo "-->Nombre Equipo: ".$nombreequipo."<br>";
echo "-->Tipo: ".$tipo."<br>";
echo "-->Usuario Windows: ".$usuariowindows."<br>";
echo "-->Marca: ".$marca."<br>";
echo "-->Modelo: ".$modelo."<br>";
echo "-->No. Serie: ".$no_serie."<br>";
echo "-->Procesador: ".$procesador."<br>";
echo "-->Disco Duro: ".$discoduro."<br>";
echo "-->Ram: ".$ram."<br>";
echo "-->Sistema Operativo: ".$so."<br>";
echo "-->Direccion Ip: ".$direccionip."<br>";
echo "-->Mac Adress: ".$macadress."<br>";
echo "-->Id Team Viewer: ".$idteamviewer."<br>";
echo "-->Proyecto: ".$proyecto."<br>";
echo "-->Asignar: ".$asignar."<br>";
echo "-->Cantidad: ".$cantidad."<br>";
echo "-->Mac Adress Wi: ".$macadresswi."<br>";
echo "<------------------------------------------------------------>";
echo "<h1>Datos Herramienta (Software)</h1>";
echo "Herramienta: ".$herramienta."<br>";
echo "ID: ".$id."<br>";
echo "Corro: ".$correo."<br>";
echo "Password Correo: ".$passcorreo."<br>";
echo "Password PST: ".$passpst."<br>";
echo "Password windows: ".$passwindows."<br>";*/


if($herramienta == "Escritorio" or $herramienta == "Laptop"){$herramienta= "Computadora"; /*echo $herramienta;*/}
if($herramienta == "FijoTD" or $herramienta == "FijoTA" or $herramienta == "FijoTIP" or $herramienta == "FijoTI" or $herramienta == "MovilCelular"){$herramienta= "Telefonia"; /*echo $herramienta;*/}
if($herramienta == "impresoraMono" or $herramienta == "impresoraMulti" or $herramienta == "Consumible"){$herramienta="Impresora"; /*echo $herramienta;*/}
if($herramienta == "ALHDDLap" or $herramienta == "ALHDDPC" or $herramienta == "ALMEMORIUsb" or $herramienta == "ALMEMORIMICROSD"){ $herramienta = "Almacenamiento"; /*echo $herramienta;*/}
if($herramienta == "RedRouter" or $herramienta == "RedSwicht" or $herramienta == "RedAccessP"){$herramienta="Red"; /*echo $herramienta;*/}
if($herramienta == "Otro"){$herramienta="Complemento"; /*echo $herramienta;*/}

if($herramienta == "ServidorVirtual" or $herramienta == "UnidadRed" or $herramienta == "Contabilidad" or $herramienta == "Facturacion" or $herramienta == "Giro" or $herramienta == "SistemaTicket" or $herramienta == "GiroWeb"){$herramienta="Acceso_Programa"; /*echo "<br>LOL: ".$herramienta."<br>";*/}
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
      <link rel="stylesheet" href="assets/css/mystyle.css">
        <style type="text/css">
         h2{background-color: #FFFEFE}
        </style>
        <script type="text/javascript">

        function limpiar(){
          $( "input" ).val("");
        }

        function cancelar(){
          //$( "#herramienta" ).empty();
          $( "#herramientas" ).empty();
          //alert("Cancelar");
        }

        $(document).ready(function(){

          $( "#asignar" ).change(function() {
              $asignar = $("#asignar option:selected").text();
              //alert("Proyecto: "+$proyecto);
              if($asignar == "Si"){
                $('#nombrep').removeAttr('hidden');
              }else if($asignar == "No"){
                $('#nombrep').attr('hidden','hidden');
              }
          });

        });
        </script>
    </head>
  <body>
  <form id='form' class="form-horizontal" action="Updateherramienta.php" method="POST" enctype='multipart/form-data'>
    <?php
    $res = substr($tipo, 1);
    switch ($herramienta) {
      case 'Computadora':?>
      <div class="container col-sm-12">
        <h2>Formulario Computadora( <?php echo $res; ?> ):</h2>
        <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
        <input type="text" name="id" value="<?php echo $id; ?>" hidden="">
        <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

          <div class="form-group">
            <label class="control-label col-sm-4" for="nombrequipo">Nombre del equipo: </label>
            <div class="col-sm-8">
              <input type="textarea" class="form-control" id="nombrequipo" placeholder="Nombre del equipo(Laptop o Escritorio)" name="nombrequipo" value="<?php echo $nombreequipo; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4" for="usuariow">Usuario de Windows: </label>
           <div class="col-sm-8">
            <input type="textarea" class="form-control" id="usuariow" placeholder="Usuario del sitema de windows" name="usuariow" value=" <?php echo $usuariowindows; ?> " required>
           </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4" for="contraseña">Contraseña: </label>
           <div class="col-sm-8">
            <input type="textarea" class="form-control" id="contraseña" placeholder="Contraseña de usuario de windows" name="contraseña" value = "<?php echo $passwindows; ?>" required>
           </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4" for="contraseña">ID Team Viewer: </label>
           <div class="col-sm-8">
            <input type="number" class="form-control" id="idteamviewer" placeholder="Contraseña de usuario de windows" name="idteamviewer" value="<?php echo $idteamviewer; ?>" required>
           </div>
          </div>

           <div class="form-group">
             <label class="control-label col-sm-4" for="marca">Marca:</label>
            <div class="col-sm-8">
             <input type="textarea" class="form-control" id="marca" placeholder="Marca del equip" name="marca" value="<?php echo $marca; ?>">
            </div>
           </div>

           <div class="form-group">
             <label class="control-label col-sm-4" for="modelo">Modelo: </label>
            <div class="col-sm-8">
             <input type="textarea" class="form-control" id="modelo" placeholder="Modelo de la laptop o pc escritorio" name="modelo" value="<?php echo $modelo; ?>">
            </div>
           </div>

           <div class="form-group">
             <label class="control-label col-sm-4" for="noserie">No. serie:</label>
            <div class="col-sm-8">
             <input type="textarea" class="form-control" id="noserie" placeholder="Numero de serie de laptop o pc escritorio" name="noserie" value="<?php echo $no_serie; ?>">
            </div>
           </div>

           <div class="form-group">
             <label class="control-label col-sm-4" for="sistemaoperativo">Sistema operativo:</label>
            <div class="col-sm-8">
             <input type="textarea" class="form-control" id="sistemaoperativo" placeholder="sistema perativo" name="sistemaoperativo" value="<?php echo $so; ?>">
            </div>
          </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="procesador">Procesador:</label>
               <div class="col-sm-8">
               <input type="textarea" class="form-control" id="procesador" placeholder="Procesador" name="procesador" value="<?php echo $procesador; ?>">
               </div>
            </div>

            <div class="form-group">
             <label class="control-label col-sm-4" for="ram">Ram: </label>
             <div class="col-sm-8">
              <input type="textarea" class="form-control" id="ram" name="ram" value="<?php echo $ram; ?>">
             </div>
            </div>

            <div class="form-group">
             <label class="control-label col-sm-4 " for="discoduro">Disco duro:</label>
             <div class="col-sm-8">
              <input type="textarea" class="form-control" id="discoduro" name="discoduro" value="<?php echo $discoduro; ?>">
             </div>
            </div>

            <div class="form-group">
             <label class="control-label col-sm-4" for="direccionip">Direccion ip:</label>
              <div class="col-sm-8">
               <input type="textarea" class="form-control" id="direccionip" placeholder="Direccion ip de la pc o laptop" name="direccionip" value="<?php echo $direccionip; ?>">
              </div>
            </div>

            <div class="form-group">
             <label class="control-label col-sm-4" for="macadress">Mac Adress:</label>
              <div class="col-sm-8">
              <input type="textarea" class="form-control" id="macadress" placeholder="mac adress de la pc o laptop" name="macadress" value="<?php echo $macadress; ?>">
              </div>
            </div>

            <?php if($tipo != "HESCRITORIO"){ ?>
              <div class="form-group">
               <label class="control-label col-sm-4" for="macadressw">Mac Adress WIFI:</label>
                <div class="col-sm-8">
                <input type="textarea" class="form-control" id="macadressw" placeholder="mac adress de la Laptop" name="macadressw" value="<?php echo $macadresswi; ?>">
                </div>
              </div>
            <?php } ?>

            <div class="form-group">
             <label class="control-label col-sm-4" for="asignar">¿Asignar a proyecto?</label>
              <div class="col-sm-8">
              <select class="form-control" id="asignar" name="asignar">
               <?php if($asignar == "Si"){
                 echo "<option value='Si'>Si</option>";
                 echo "<option value='No'>No</option>";
               }else{
                 echo "<option value='No'>No</option>";
                 echo "<option value='Si'>Si</option>";
               }  ?>
              </select>
              </div>
            </div>

              <?php if($asignar == "Si"){
                echo "<div id='nombrep' class='form-group'>
                <label class='control-label col-sm-4' for='nomproyecto'>Nombre del Proyecto</label>
                <div class='col-sm-8'>
                 <input type='textarea' class='form-control' id='nomproyecto' name='nomproyecto' placeholder='Nombre del proyecto para asignar' value = '".$proyecto."'>
                </div>
            </div>";
              }else{
                echo "<div id='nombrep' class='form-group' hidden>
                <label class='control-label col-sm-4' for='nomproyecto'>Nombre del Proyecto</label>
                <div class='col-sm-8'>
                 <input type='textarea' class='form-control' id='nomproyecto' name='nomproyecto' placeholder='Nombre del proyecto para asignar' value = ''>
                </div>
            </div>";
              } ?>


            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-1">
                <button type="submit" class="btn btn-primary">Editar</button>
              </div>
              <div class="col-sm-offset-2 col-sm-1">
                <button onclick='limpiar()' type="button" class="btn btn-primary">Limpiar</button>
              </div>
              <div class="col-sm-offset-2 col-sm-1">
                <button onclick='cancelar()' type="button" class="btn btn-primary">Cancelar</button>
              </div>
            </div>
      </div>
      <?php  break;
      case 'Telefonia':?>
      <div class="container col-sm-12">
        <h2>Formulario Telefonia(<?php
        if($tipo == "HFijoTD"){echo "Telefono con Diadema";}
        if($tipo == "HFijoTA"){echo "Telefono Analogo";}
        if($tipo == "HFijoTIP"){echo "Telefono IP";}
        if($tipo == "HFijoTI"){echo "Telefono Inalambrico";}
        if($tipo == "HMovilCelular"){echo "Movil Celular";}
         ?>):</h2>
        <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
        <input type="text" name="id" value="<?php echo $id; ?>" hidden="">
        <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

          <div class="form-group">
            <label class="control-label col-sm-4" for="marca">Marca :</label>
            <div class="col-sm-8">
              <input type="textarea" class="form-control" id="marca" placeholder="Ingresar marca" name="marca" value = "<?php echo $marca; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4" for="modelo">Modelo: </label>
            <div class="col-sm-8">
              <input type="textarea" class="form-control" id="modelo" placeholder="Ingrese modelo" name="modelo" value="<?php echo $modelo; ?>" required>
            </div>
          </div>

          <?php if($tipo != "HMovilCelular" ){?>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ns">No.Serie: </label>
              <div class="col-sm-8">
                <input type="textarea" class="form-control" id="ns" placeholder="Ingrese numero de serie" name="ns" value="<?php echo $no_serie ?>">
              </div>
            </div>
          <?php }else{?>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ns">E-MAIL: </label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="ns" placeholder="Ingrese E-mail" name="ns" value="<?php echo $no_serie; ?>">
              </div>
            </div>
          <?php } ?>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-1">
                <button type="submit" class="btn btn-primary">Editar</button>
              </div>

              <div class="col-sm-offset-2 col-sm-1">
                <button onclick='limpiar()' type="button" class="btn btn-primary">Limpiar</button>
              </div>

              <div class="col-sm-offset-2 col-sm-1">
                <button onclick='cancelar()' type="button" class="btn btn-primary">Cancelar</button>
              </div>
            </div>

          </div>
      <?php  break;
      case 'Impresora':
      if($tipo == "HimpresoraMono" or $tipo == "HimpresoraMulti"){?>
        <div class="container col-sm-12">
          <h2 id="h2">Formulario Impresora (
            <?php
            if($tipo != "HimpresoraMulti"){echo "Impresora Monocromatica";}
            else {echo "Impresora Multifuncional";} ?>
            ):</h2>
            <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
            <input type="text" name="id" value="<?php echo $id; ?>" hidden="">
            <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">
            <div class="form-group">
              <label class="control-label col-sm-4" for="marca">Marca:</label>
              <div class="col-sm-8">
                <input type="textarea" class="form-control" name="marca" id="marca" placeholder="Ingresa marca." value = "<?php echo $marca; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="modelo">Modelo: </label>
              <div class="col-sm-8">
              <input type="text" class="form-control" name="modelo" id="modelo" pleaceholder = "Ingrese modelo" value="<?php echo $modelo; ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="ns">No. Serie: </label>
              <div class="col-sm-8">
                <input class = "form-control" type="text" name="ns" id="ns" pleaceholder="Ingrese numero de serie" value="<?php echo $no_serie; ?>">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-1">
                <button type="submit" class="btn btn-primary">Editar</button>
              </div>
              <div class="col-sm-offset-2 col-sm-1">
                <button onclick="limpiar()" type="button" class="btn btn-primary">Limpiar</button>
              </div>
              <div class="col-sm-offset-2 col-sm-1">
                <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
              </div>
            </div>
      <?php }else{?>
        <h2 id="h2">Formulario Consumibles(Toner):
             </h2>
             <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
             <input type="text" name="id" value="<?php echo $id; ?>" hidden="">
             <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">
              <div class="form-group">
                <label class="control-label col-sm-4" for="marca">Marca:</label>
                <div class="col-sm-8">
                  <input type="textarea" class="form-control" name="marca" id="marca" placeholder="Ingresa nombre del accesorio." value="<?php echo $marca; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="modelo">Modelo: </label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="modelo" id="modelo" pleaceholder = "" value="<?php echo $modelo; ?>" >
                </div>
              </div>

              <div class="form-group">
                <label class ="control-label col-sm-4" for="nombrequipo">Impresora: </label>
                <div class="col-sm-8">
                  <input class = "form-control" type="text" name="nombrequipo" placeholder="Impresora a la que pertenece" value="<?php echo $nombreequipo; ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" for="cantidad">Cantidad: </label>
                <div class="col-sm-8">
                  <input class = "form-control" type="text" name="cantidad" placeholder="Impresora a la que pertenece" value="<?php echo $cantidad; ?>">
                </div>
              </div>


              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-1">
                  <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                <div class="col-sm-offset-2 col-sm-1">
                  <button onclick="limpiar()" type="button" class="btn btn-primary">Limpiar</button>
                </div>
                <div class="col-sm-offset-2 col-sm-1">
                  <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
                </div>
              </div>
      <?php } ?>
      <?php  break;
      case "Complemento":
        //echo "Tipo: ".$tipo."<br>";
        ?>
        <h2>FORMULARIO Complemento(<?php echo $nombreequipo; ?>)</h2>
          <div class='form-group'>
            <label class='control-label col-sm-4' for='ncomplemento'>Complemento:</label>
            <div class='col-sm-8'>
              <input type='textarea' class='form-control' name='nombrequipo' id='nombrequipo' placeholder='Ingresa nombre del complemento.' value ='<?php echo $nombreequipo; ?>' required>
            </div>
          </div>
        <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden = "">
        <input type="text" name="id" value="<?php echo $id; ?>" hidden="">
        <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden = "">

        <div class="form-group">
          <label class="control-label col-sm-4" for="">Cantidad: </label>
          <div class="col-sm-4">
            <input type='number' class='form-control' value ='<?php echo $cantidad; ?>' disabled>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-4" for="cantidad">Cantidad a quitar: </label>
          <div class="col-sm-4">
          <select class="form-control" id="cantidad" name="cantidad">
            <?php $i = 1; while ($i <= 50):echo "<option>".$i."</option>"; $i++;endwhile;?>
          </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-1">
            <button type="submit" class="btn btn-primary">Editar</button>
          </div>
          <div class="col-sm-offset-2 col-sm-1">
            <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
          </div>
        </div>

      <?php
      break;
      case "Almacenamiento":
      if($tipo == "HALHDDLap"){echo "<h2>FORMULARIO Almacenamiento(Laptop 2.5)";}
      if($tipo == "HALHDDPC"){echo "<h2>FORMULARIO Almacenamiento(PC 3.5)";}
      if($tipo == "HALMEMORIUsb"){echo "<h2>FORMULARIO Almacenamiento(USB)";}
      if($tipo == "HALMEMORIMICROSD"){echo "<h2>FORMULARIO Almacenamiento(Miscro SD)";}
      ?></h2>
      <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
      <input type="text" name="id" value="<?php echo $id; ?>" hidden="">
      <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

      <div class="form-group">
        <label class="control-label col-sm-4" for="marca">Marca: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="marca" id="marca" placeholder="Ingrese marca." value="<?php echo $marca; ?>" required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-4" for="modelo">Modelo: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="modelo" id="modelo" placeholder="Ingresa modelo." value="<?php echo $modelo; ?>" required>
        </div>
      </div>

      <?php $rest = strstr($discoduro, '.'); $res = substr($discoduro, 0, -6);?>
      <div class="form-group">
       <label class="control-label col-sm-4 " for="tamaño">Tamaño: </label>
        <div class="col-sm-4">
         <input type="number" class="form-control" id="tamaño" name="tamaño" placeholder="Ingres el tamaño del dico duro" value="<?php echo $res; ?>">
         </div>
         <div class="col-sm-4">
           <select class="form-control" id="medida" name="medida">
             <?php
             if($rest == '.KBYTE'){
               echo "<option value='KBYTE'>KBYTE</option>
               <option value='MBYTE'>MBYTE</option>
               <option value='GBYTE'>GBYTE</option>
               <option value='TBYTE'>TBYTE</option>";
             }
             if($rest == '.MBYTE'){
               echo "<option value='MBYTE'>MBYTE</option>
               <option value='KBYTE'>KBYTE</option>
               <option value='GBYTE'>GBYTE</option>
               <option value='TBYTE'>TBYTE</option>";
             }
             if($rest == '.GBYTE'){
               echo "<option value='GBYTE'>GBYTE</option>
               <option value='KBYTE'>KBYTE</option>
               <option value='MBYTE'>MBYTE</option>
               <option value='TBYTE'>TBYTE</option>";
             }
             if($rest == '.TBYTE'){
               echo "<option value='TBYTE'>TBYTE</option>
               <option value='KBYTE'>KBYTE</option>
               <option value='MBYTE'>MBYTE</option>
               <option value='GBYTE'>GBYTE</option>";
             }?>
           </select>
         </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-1">
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="limpiar()" type="button" class="btn btn-primary">Limpiar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
        </div>
      </div>
      <?php break;
      case "Red":
      if($tipo == "HRedRouter"){echo "<h2>FORMULARIO Redes(Router)";}
      if($tipo == "HRedSwicht"){echo "<h2>FORMULARIO Redes(Swicht)";}
      if($tipo == "HRedAccessP"){echo "<h2>FORMULARIO Redes(Access Point)";}
      ?></h2>
      <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
      <input type="text" name="id" value="<?php echo $id; ?>" hidden="">
      <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

      <div class="form-group">
        <label class="control-label col-sm-4" for="marca">Marca:</label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="marca" id="marca" placeholder="Ingresa nombre del accesorio." value="<?php echo $marca; ?>" required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-4" for="modelo">Modelo:</label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="modelo" id="modelo" placeholder="Ingresa nombre del accesorio." value="<?php echo $modelo; ?>" required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-1">
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="limpiar()" type="button" class="btn btn-primary">Limpiar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
        </div>
      </div>
      <?php
      break;
      case "Acceso_Programa":
      if($tipo == "SServidorVirtual"){echo "<h2>FORMULARIO Acceso a programa (Servidor Virtual)";}
      if($tipo == "SUnidadRed"){echo "<h2>FORMULARIO Acceso a programa (UnidadRed)";}
      if($tipo == "SContabilidad"){echo "<h2>FORMULARIO Acceso a programa (Contabilidad)";}
      if($tipo == "SFacturacion"){echo "<h2>FORMULARIO Acceso a programa (Facturacion)";}
      if($tipo == "SGiro"){echo "<h2>FORMULARIO Acceso a programa (Servidor Giro)";}
      if($tipo == "SSistemaTicket"){echo "<h2>FORMULARIO Acceso a programa (Sistema de Tickets)";}
      if($tipo == "SGiroWeb"){echo "<h2>FORMULARIO Acceso a programa (Giro Web)";}
      ?></h2>
      <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
      <input type="text" name="id" value="<?php echo $id; ?>" hidden="">
      <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

      <?php if($tipo == "SServidorVirtual" or $tipo == "SSistemaTicket"){?>
        <div class="form-group">
          <label class="control-label col-sm-4" for="Usuario">Usuario: </label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" name="correo" id="correo" value = "<?php echo $correo; ?>" placeholder="" required>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-4" for="Contraseña">Contraseña: </label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" name="passcorreo" id="passcorreo" value = "<?php echo $passcorreo; ?>" placeholder="" required>
          </div>
        </div>
      <?php } ?>

      <?php if($tipo == "SUnidadesRed"){?>
        <div class="form-group">
          <label class="control-label col-sm-4" for="">Nombre(s) de la unidad: </label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" name="correo" id="correo" value = "<?php echo $correo; ?>" placeholder="" required>
          </div>
        </div>
      <?php } ?>

      <?php if($tipo == "SContabilidad" or $tipo == "SFacturacion"){?>
        <div class="form-group">
        <label class="control-label col-sm-4" for="Usuario">Usuario: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="correo" id="correo" value = "<?php echo $correo; ?>" placeholder="" required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-4" for="Contraseña">Contraseña: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="passcorreo" id="passcorreo" value = "<?php echo $passcorreo; ?>" placeholder="" required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-4" for="Perfil">Perfil: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="passpst" id="passpst" value = "<?php echo $passpst; ?>" placeholder="" required>
        </div>
      </div>
      <?php } ?>

      <?php if($tipo == "SGiro" or $tipo == "SGiroWeb"){?>
        <div class="form-group">
          <label class="control-label col-sm-4" for="Usuario">Usuario: </label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" name="correo" id="correo" value = "<?php echo $correo; ?>" placeholder="" required>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-4" for="Contraseña">Contraseña: </label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" name="passcorreo" id="passcorreo" value = "<?php echo $passcorreo; ?>" placeholder="" required>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-4" for="Perfil"><?php if($tipo == "SGiro" ){echo "Perfil: ";}else{echo "Base de Datos: ";} ?> </label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" name="passpst" id="passpst" value = "<?php echo $passpst; ?>" placeholder="" required>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-4" for="Contraseña"><?php if($tipo == "SGiro"){echo "Base de Datos: ";}else{echo "Sucursal: ";} ?></label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" name="passwindows" id="passwindows" value = "<?php echo $passwindows; ?>" placeholder="" required>
          </div>
        </div>

      <?php } ?>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-1">
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="limpiar()" type="button" class="btn btn-primary">Limpiar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
        </div>
      </div>
      <?php break;
      case "Correo": ?>
      <h2>Formulario de Correo</h2>
      <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
      <input type="text" name="id" value="<?php echo $id; ?>" hidden="">
      <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

      <div class="form-group">
        <label class="control-label col-sm-4" for="usuario">Correo: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="correo" id="correo" value = "<?php echo $correo; ?>" placeholder="" required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-4" for="contraseña">Contraseña:</label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="passcorreo" id="passcorreo" value = "<?php echo $passcorreo; ?>" placeholder="" required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-1">
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="limpiar()" type="button" class="btn btn-primary">Limpiar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
        </div>
      </div>

      <?php
      break;
      default:
        echo "No existe la opcion.";
      break;
    }?>
  </form>
  </body>
</html>
