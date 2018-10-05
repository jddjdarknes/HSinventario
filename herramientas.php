<?php
include('conexion.php');
$herramienta = $_POST['herramienta'];
$tipo = $_POST['tipo'];
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

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Favicon and touch icons -->
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

          $( "#proyecto" ).change(function() {
              $proyecto = $("#proyecto option:selected").text();
              //alert("Proyecto: "+$proyecto);
              if($proyecto == "Si"){
                $('#nombrep').removeAttr('hidden');
              }else if($proyecto == "No"){
                $('#nombrep').attr('hidden','hidden');
              }
          });

        });
        </script>
    </head>
  <body>
  <form id='form' class="form-horizontal" action="Insertherramienta.php" method="POST" enctype='multipart/form-data'>
    <?php
    switch ($herramienta) {
      case 'Computadora':?>
      <div class="container col-sm-12">
        <h2>Computadora( <?php echo $tipo; ?> ):</h2>
        <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
        <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

          <div class="form-group">
            <label class="control-label col-sm-4" for="nombrequipo">Nombre del equipo: </label>
            <div class="col-sm-8">
              <input type="textarea" class="form-control" id="nombrequipo" placeholder="Nombre del equipo." name="nombrequipo" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4" for="usuariow">Usuario de Windows: </label>
           <div class="col-sm-8">
            <input type="textarea" class="form-control" id="usuariow" placeholder="Usuario del sitema de windows" name="usuariow" required>
           </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4" for="contraseña">Contraseña: </label>
           <div class="col-sm-8">
            <input type="textarea" class="form-control" id="contraseña" placeholder="Contraseña de usuario de windows" name="contraseña" required>
           </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4" for="contraseña">ID Team Viewer: </label>
           <div class="col-sm-8">
            <input type="number" class="form-control" id="idteamviewer" placeholder="Contraseña de usuario de windows" name="idteamviewer" required>
           </div>
          </div>

           <div class="form-group">
             <label class="control-label col-sm-4" for="marca">Marca:</label>
            <div class="col-sm-8">
             <input type="textarea" class="form-control" id="marca" placeholder="Marca del equip" name="marca">
            </div>
           </div>

           <div class="form-group">
             <label class="control-label col-sm-4" for="modelo">Modelo: </label>
            <div class="col-sm-8">
             <input type="textarea" class="form-control" id="modelo" placeholder="Modelo de la laptop o pc escritorio" name="modelo">
            </div>
           </div>

           <div class="form-group">
             <label class="control-label col-sm-4" for="noserie">No. serie:</label>
            <div class="col-sm-8">
             <input type="textarea" class="form-control" id="noserie" placeholder="Numero de serie de laptop o pc escritorio" name="noserie">
            </div>
           </div>

           <div class="form-group">
             <label class="control-label col-sm-4" for="sistemaoperativo">Sistema operativo:</label>
            <div class="col-sm-8">
             <input type="textarea" class="form-control" id="sistemaoperativo" placeholder="sistema perativo" name="sistemaoperativo">
            </div>
          </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="procesador">Procesador:</label>
              <div class="col-sm-8">
                <input type="textarea" class="form-control" id="procesador" placeholder="Procesador" name="procesador">
              </div>
            </div>

            <div class="form-group">
             <label class="control-label col-sm-4" for="ram">Ram: </label>
              <div class="col-sm-4">
               <select class="form-control" id="ram" name="ram">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="4">4</option>
                 <option value="8">8</option>
                 <option value="16">16</option>
                 <option value="32">32</option>
                 <option value="64">64</option>
                 <option value="128">128</option>
                 <option value="256">256</option>
                 <option value="512">512</option>
               </select>
               </div>
               <div class="col-sm-4">
                 <select class="form-control" id="medidaRam" name="medidaRam">
                  <option value="MBYTE">MB</option>
                  <option value="GBYTE">GB</option>
                  <option label="TBYTE">TB</option>
                 </select>
               </div>
            </div>

            <div class="form-group">
             <label class="control-label col-sm-4 " for="discoduro">Disco duro:</label>
              <div class="col-sm-4">
               <input type="number" class="form-control" id="discoduro" placeholder="Ingres el tamañoo del dico duro" name="discoduro">
               </div>
               <div class="col-sm-4">
                 <select class="form-control" id="medidaHDD" name="medidaHDD">
                   <option value="MBYTE">MB</option>
                   <option value="GBYTE">GB</option>
                   <option value="TBYTE">TB</option>
                 </select>
               </div>
            </div>

            <div class="form-group">
             <label class="control-label col-sm-4" for="direccionip">Direccion ip:</label>
              <div class="col-sm-8">
               <input type="textarea" class="form-control" id="direccionip" placeholder="Direccion ip de la pc o laptop" name="direccionip">
              </div>
            </div>

            <div class="form-group">
             <label class="control-label col-sm-4" for="macadress">Mac Adress:</label>
              <div class="col-sm-8">
              <input type="textarea" class="form-control" id="macadress" placeholder="mac adress de la pc o laptop" name="macadress">
              </div>
            </div>

            <?php if($tipo != "Escritorio"){ ?>
              <div class="form-group">
               <label class="control-label col-sm-4" for="macadressw">Mac Adress WIFI:</label>
                <div class="col-sm-8">
                <input type="textarea" class="form-control" id="macadressw" placeholder="mac adress de la pc o laptop" name="macadressw">
                </div>
              </div>
            <?php } ?>

            <div class="form-group">
             <label class="control-label col-sm-4" for="proyecto">¿Asignar a proyecto?</label>
              <div class="col-sm-8">
              <select class="form-control" id="proyecto" name="proyecto">
               <option></option>
               <option>Si</option>
               <option>No</option>
              </select>
              </div>
            </div>

            <div id="nombrep" class="form-group" hidden>
                <label class="control-label col-sm-4" for="nomproyecto">Nombre del Proyecto</label>
                <div class="col-sm-8">
                 <input type="textarea" class="form-control" id="nomproyecto" placeholder="Nombre del proyecto par asignar" name="nomproyecto" >
                </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-1">
                <button type="submit" class="btn btn-primary">Guardar</button>
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
        <h2>Telefonia (<?php
        if($tipo == "FijoTD"){echo "Telefono con Diadema";}
        if($tipo == "FijoTA"){echo "Telefono Analogo";}
        if($tipo == "FijoTIP"){echo "Telefono IP";}
        if($tipo == "FijoTI"){echo "Telefono Inalambrico";}
        if($tipo == "MovilCelular"){echo "Movil Celular";}
         ?>):</h2>
        <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
        <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

          <div class="form-group">
            <label class="control-label col-sm-4" for="marca">Marca :</label>
            <div class="col-sm-8">
              <input type="textarea" class="form-control" id="marca" placeholder="Ingrese marca" name="marca" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4" for="modelo">Modelo: </label>
            <div class="col-sm-8">
              <input type="textarea" class="form-control" id="modelo" placeholder="Ingrese modelo" name="modelo" required>
            </div>
          </div>

          <?php if($tipo != "MovilCelular" ){ ?>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ns">N.S.: </label>
              <div class="col-sm-8">
                <input type="textarea" class="form-control" id="ns" placeholder="Ingrese numero de serie" name="ns">
              </div>
            </div>
          <?php }else{?>
            <div class="form-group">
              <label class="control-label col-sm-4" for="email">E-MAIL: </label>
              <div class="col-sm-8">
                <input type="textarea" class="form-control" id="email" placeholder="Ingrese E-MAIL" name="email">
              </div>
            </div>
          <?php } ?>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-1">
                <button type="submit" class="btn btn-primary">Guardar</button>
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
      case 'Impresora':?>
      <div class="container col-sm-12">
        <?php
        if($tipo != "ConsumibleToner" and $tipo != "ConsumibleTambor" and $tipo != "TargetaPVC"){?>
          <h2 id="h2">Impresora (
            <?php
            if($tipo == "impresoraMulti"){echo "Impresora Monocromatica";}
            if($tipo == "impresoraMultiB/N"){echo "Multifuncional(B/N)";}
            if($tipo == "impresoraMultiColor"){echo "Multifuncional(Color)";}
            if($tipo == "impresoraMono"){echo "Monocromatica";}
            if($tipo == "impresoraCredencial"){echo "Credencial ";}
            ?>):</h2>
            <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
            <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">
            <div class="form-group">
              <label class="control-label col-sm-4" for="marca">Marca:</label>
              <div class="col-sm-8">
                <input type="textarea" class="form-control" name="marca" id="marca" placeholder="Ingrese marca." required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="modelo">Modelo: </label>
              <div class="col-sm-8">
              <input type="text" class="form-control" name="modelo" id="modelo" placeholder = "Ingrese modelo">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="noserie">No. Serie: </label>
              <div class="col-sm-8">
                <input class = "form-control" type="text" name="noserie" id="noserie" placeholder="Ingrese numero de serie">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-1">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
              <div class="col-sm-offset-2 col-sm-1">
                <button onclick="limpiar()" type="button" class="btn btn-primary">Limpiar</button>
              </div>
              <div class="col-sm-offset-2 col-sm-1">
                <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
              </div>
            </div>

          <?php }else{ ?>
            <h2 id="h2">Consumibles(
              <?php
              if($tipo == "ConsumibleToner"){echo "Toner";}
              if($tipo == "ConsumibleTambor"){echo "Tambor";}
              if($tipo == "TargetaPVC"){echo "Targeta PVC";}
              ?>
              ):
             </h2>
             <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
             <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">
              <div class="form-group">
                <label class="control-label col-sm-4" for="marca">Marca:</label>
                <div class="col-sm-8">
                  <input type="textarea" class="form-control" name="marca" id="marca" placeholder="Ingrese marca." required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="modelo">Modelo: </label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="modelo" id="modelo" placeholder = "Ingrese modelo">
                </div>
              </div>

              <div class="form-group">
                <label class ="control-label col-sm-4" for="impresora">Impresora: </label>
                <div class="col-sm-8">
                  <input class = "form-control" type="text" name="impresora" placeholder="Impresora a la que pertenece">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" for="cantidad">Cantidad: </label>
                <div class="col-sm-8">
                  <select class="form-control" id="cantidad" name="cantidad">
                    <?php $i = 1; while ($i <= 20):echo "<option>".$i."</option>"; $i++;endwhile;?>
                  </select>
                </div>
              </div>


              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-1">
                  <button type="submit" class="btn btn-primary">Guardar</button>
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
      if($tipo != "Otro"){
        $sql = "SELECT * FROM herramienta where clave = '$tipo'";
        $consulta = sqlsrv_query( $conexion, $sql );
        $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC);
        echo "<h2>Complemento(".$line['nombreequipo'].")</h2>
          <div class='form-group'>
            <label class='control-label col-sm-4' for='ncomplemento'>Complemento: </label>
            <div class='col-sm-8'>
              <input type='textarea' class='form-control' name='ncomplemento' id='ncomplemento' placeholder='Ingrese nombre del complemento.' value ='".$line['nombreequipo']."' required>
            </div>
          </div>";
        ?>

        <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden = "">
        <input type="text" name="tipo" value="<?php echo $line['Clave']; ?>" hidden = "">

        <div class="form-group">
          <label class="control-label col-sm-4" for="cantidad">Cantidad: </label>
          <div class="col-sm-8">
          <select class="form-control" id="cantidad" name="cantidad">
            <?php echo "<option>".$line['cantidad']."</option>";?>
            <?php $i = 1; while ($i <= 50):echo "<option>".$i."</option>"; $i++;endwhile;?>
          </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-1">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <div class="col-sm-offset-2 col-sm-1">
            <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
          </div>
        </div>

      <?php }else{

      echo "<h2>Complemento(Otro)</h2>
        <div class='form-group'>
          <label class='control-label col-sm-4' for='ncomplemento'>Nuevo complemento:</label>
          <div class='col-sm-8'>
            <input type='textarea' class='form-control' name='ncomplemento' id='ncomplemento' placeholder='Ingresa nombre del complemento.' required>
          </div>
        </div>";
      ?>

      <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
      <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

      <div class="form-group">
        <label class="control-label col-sm-4" for="cantidad">Cantidad: </label>
        <div class="col-sm-8">
        <select class="form-control" id="cantidad" name="cantidad">
          <?php $i = 1; while ($i <= 50):echo "<option>".$i."</option>"; $i++;endwhile;?>
        </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-1">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="limpiar()" type="button" class="btn btn-primary">Limpiar</button>
        </div>
        <div class="col-sm-offset-2 col-sm-1">
          <button onclick="cancelar()" type="button" class="btn btn-primary">Cancelar</button>
        </div>
      </div>
      <?php
      }
      break;
      case "Almacenamiento":
      if($tipo == "ALHDDLap"){echo "<h2>Almacenamiento(Laptop 2.5)";}
      if($tipo == "ALHDDPC"){echo "<h2>Almacenamiento(PC 3.5)";}
      if($tipo == "ALMEMORIUsb"){echo "<h2>Almacenamiento(USB)";}
      if($tipo == "ALMEMORIMICROSD"){echo "<h2>Almacenamiento(Miscro SD)";}
      ?></h2>
      <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
      <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

      <div class="form-group">
        <label class="control-label col-sm-4" for="marca">Marca: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="marca" id="marca" placeholder="Ingrese marca." required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-4" for="modelo">Modelo: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="modelo" id="modelo" placeholder="Ingrese modelo." required>
        </div>
      </div>

      <div class="form-group">
       <label class="control-label col-sm-4 " for="tamaño">Tamaño: </label>
        <div class="col-sm-4">
         <input type="number" class="form-control" id="tamaño" name="tamaño" placeholder="Ingrese el tamaño del dico duro">
         </div>
         <div class="col-sm-4">
           <select class="form-control" id="medida" name="medida">
             <option value="MBYTE">MB</option>
             <option value="GBYTE">GB</option>
             <option value="TBYTE">TB</option>
           </select>
         </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-1">
          <button type="submit" class="btn btn-primary">Guardar</button>
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
      if($tipo == "RedRouter"){echo "<h2>Redes(Router)";}
      if($tipo == "RedSwicht"){echo "<h2>Redes(Swicht)";}
      if($tipo == "RedAccessP"){echo "<h2>Redes(Access Point)";}
      ?></h2>
      <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
      <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

      <div class="form-group">
        <label class="control-label col-sm-4" for="marca">Marca:</label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="marca" id="marca" placeholder="Ingrese marca." required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-4" for="modelo">Modelo:</label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="modelo" id="modelo" placeholder="Ingrese modelo." required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-1">
          <button type="submit" class="btn btn-primary">Guardar</button>
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
      if($tipo == "ServidorVirtual"){echo "<h2>Acceso a programa (Servidor Virtual)";}
      if($tipo == "UnidadRed"){echo "<h2>Acceso a programa (UnidadRed)";}
      if($tipo == "Contabilidad"){echo "<h2>Acceso a programa (Contabilidad)";}
      if($tipo == "Facturacion"){echo "<h2>Acceso a programa (Facturacion)";}
      if($tipo == "Giro"){echo "<h2>Acceso a programa (Servidor Giro)";}
      if($tipo == "SistemaTicket"){echo "<h2>Acceso a programa (Sistema de Tickets)";}
      if($tipo == "GiroWeb"){echo "<h2>Acceso a programa (Giro Web)";}
      ?></h2>
      <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
      <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

      <?php if($tipo == "ServidorVirtual" or $tipo == "Contabilidad" or $tipo == "Facturacion" or $tipo == "Giro" or $tipo == "SistemaTicket" or $tipo == "GiroWeb"){?>
      <div class="form-group">
        <label class="control-label col-sm-4" for="usuario">Usuario:</label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="usuario" id="usuario" placeholder="Ingrese usuario." required>
        </div>
      </div>
    <?php } ?>

    <?php if($tipo == "ServidorVirtual" or $tipo == "Contabilidad" or $tipo == "Facturacion" or $tipo == "Giro" or $tipo == "SistemaTicket" or $tipo == "GiroWeb"){ ?>
      <div class="form-group">
        <label class="control-label col-sm-4" for="pass">Contraseña:</label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="pass" id="pass" placeholder="Ingrese contraseña." required>
        </div>
      </div>
      <?php } ?>

      <?php if($tipo == "UnidadRed"){ ?>
      <div class="form-group">
        <label class="control-label col-sm-4" for="nombreuni">Nombre(s) de la unidad: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="nombreuni" id="nombreuni" placeholder="Ingresa nombre del accesorio." required>
        </div>
      </div>
    <?php } ?>

    <?php if($tipo == "Contabilidad" or $tipo == "Facturacion" or $tipo == "Giro"){ ?>
      <div class="form-group">
        <label class="control-label col-sm-4" for="perfil">Perfil: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="perfil" id="perfil" placeholder="Ingrese perfil." required>
        </div>
      </div>
    <?php } ?>

    <?php if($tipo == "Giro" or $tipo == "GiroWeb"){ ?>
      <div class="form-group">
        <label class="control-label col-sm-4" for="bd">Base de Datos: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="bd" id="bd" placeholder="Ingrese base de datos." required>
        </div>
      </div>
    <?php } ?>

    <?php if($tipo == "GiroWeb") { ?>
      <div class="form-group">
        <label class="control-label col-sm-4" for="surcusal">Sucursal: </label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="sucursal" id="sucursal" placeholder="Ingrese Sucursal." required>
        </div>
      </div>
    <?php } ?>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-1">
          <button type="submit" class="btn btn-primary">Guardar</button>
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
      <h2>Correo</h2>
      <input type="text" name="herramienta" value="<?php echo $herramienta; ?>" hidden="">
      <input type="text" name="tipo" value="<?php echo $tipo; ?>" hidden="">

      <div class="form-group">
        <label class="control-label col-sm-4" for="usuario">Usuario:</label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="usuario" id="usuario" placeholder="Ingrese usuario." required>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-4" for="contraseña">Contraseña:</label>
        <div class="col-sm-8">
          <input type="textarea" class="form-control" name="contraseña" id="contraseña" placeholder="Ingrese contraseña." required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-1">
          <button type="submit" class="btn btn-primary">Guardar</button>
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
