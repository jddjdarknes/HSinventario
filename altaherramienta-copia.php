<?php
  session_start();
  include ('conexion.php');
  if(!isset($_SESSION['personal'])){header("Location: logout.php");}
  else{?>
    <!DOCTYPE html>
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
          <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="assets/css/mystyle.css">
          <link rel="shortcut icon" href="assets/ico/favicon.ico">
          <!-- CSS -->
          <style>
          .dropdown-submenu {
            position: relative;
          }

          .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px;
            border-radius: 0 6px 6px 6px;
          }

          .dropdown-submenu:hover>.dropdown-menu {
            display: block;
          }

          .dropdown-submenu>a:after {
              display: block;
              content: " ";
              float: right;
              width: 0;
              height: 0;
              border-color: transparent;
              border-style: solid;
              border-width: 5px 0 5px 5px;
              border-left-color: #ccc;
              margin-top: 5px;
              margin-right: -10px;
          }

          .dropdown-submenu:hover>a:after {
              border-left-color: #fff;
          }

          .dropdown-submenu.pull-left {
              float: none;
          }

          .dropdown-submenu.pull-left>.dropdown-menu {
              left: -100%;
              margin-left: 10px;
              -webkit-border-radius: 6px 0 6px 6px;
              -moz-border-radius: 6px 0 6px 6px;
              border-radius: 6px 0 6px 6px;
          }

          </style>
          <script type="text/javascript">
          $buscando="";
          function load(page,herramienta,buscando){
            alert("Aqui esta");
            $.post( "HerramientaH_ajax.php",
            {page:page,herramienta:herramienta,action:"ajax",buscando:$buscando}
            ,function( data ) {
              $("#herramienta").html(data);
             });
          }
          function redireccionar(){
              window.location="altaherramienta.php";
          }
          $(document).ready(function(){

           $( "#buscarH" ).on("keydown",function(){
             //alert("Aqui");
             $buscarherramienta = $( "#buscarH" ).val();
             $buscando = $buscarherramienta;
             if($buscarherramienta == ""){
               $("#herramienta").empty();
             }else{
               $.post("HerramientaH_ajax.php",
               {page:1,herramienta:7,action:"ajax",buscando:$buscarherramienta}
               ,function(data){
                 $("#herramienta").html(data)
               });
             }
           });

            $( "#Hdisponibles" ).click(function(){
              $.post( "Selectherramienta.php",function( data ) {
                $( "#herramienta" ).html( data );
              });
            });

            $( "#herramienta" ).on("click","a#aeliminar",function(){
              //alert("Eliminar");
              $clave = $( this ).data( 'clave' );
              $cantidad = $( this ).data( 'cantidad' );
              //alert("Clave: "+$clave+", Cantidad: "+$cantidad);
              $.post( "deleteherramienta.php",{
                clave:$clave,
                cantidad:$cantidad
                }, function( data ) {
                //alert("Dos");
                alert("Eliminado");
             });
             //setTimeout ("redireccionar()", 3000);
            });

            $( "#herramienta" ).on("click","a#heliminar",function(){
              //alert("Eliminar");
              $clave = $( this ).data( 'clave' );
              $cantidad = $( this ).data( 'cantidad' );
              //alert("Clave: "+$clave+", Cantidad: "+$cantidad);
              $.post( "deleteherramienta.php",{
                clave:$clave,
                cantidad:$cantidad
                }, function( data ) {
                $( "#herramientas" ).html( data );
                //alert("Dos");
                alert("Eliminado");
             });
             setTimeout ("redireccionar()", 3000);
            });

            $( "#herramienta" ).on("click","a#seditar",function(){
              //alert("Editar");
              $id = $( this  ).data( "id" );
              $herramienta = $( this ).data("herramienta");
              $tipo = $( this ).data( "tipo" );
              $correo = $( this ).data( "correo" );
              $passcorreo = $( this ).data( "passcorreo" );
              $passpst = $( this ).data( "passpst" );
              $passwindows = $( this ).data( "passwindows" );
              //alert("ID::--) "+$id);
              $.post( "editarherramientas.php",{
                id:$id,
                herramienta:$herramienta,
                tipo:$tipo,
                correo:$correo,
                passcorreo:$passcorreo,
                passpst:$passpst,
                passwindows:$passwindows
                }, function( data ) {
                $( "#herramientas" ).html( data );
                //alert("Dos");
             });
           });

            //Aqui se mandan los datos para editar.
            $( "#herramienta" ).on("click","a#heditar",function(){
              //alert("Editar");
              $id = $(this).data('id');
              $herramienta = $(this).data('herramienta');
              $passwindows = $(this).data('passwindows');
              $nombreequipo = $(this).data('nombreequipo');
              $tipo = $(this).data('tipo');
              $usuariowindows = $(this).data('usuariowindows');
              $marca = $(this).data('marca');
              $modelo = $(this).data('modelo');
              $no_serie = $(this).data('no_serie');
              $procesador = $(this).data('procesador');
              $discoduro = $(this).data('discoduro');
              $ram = $(this).data('ram');
              $so = $(this).data('so');
              //alert("Ram: "+$ram+" Disco Duro: "+$discoduro);
              $direccionip = $(this).data('direccionip');
              $macadress = $(this).data('macadress');
              $idteamviewer = $(this).data('idteamviewer');
              $proyecto = $(this).data('proyecto');
              $asignar = $(this).data('asignar');
              $cantidad = $(this).data('cantidad');
              $macadresswi = $(this).data('macadresswi');
              //alert("Cantidad: "+$cantidad);
              //alert("Mac Adress Wi: "+$macadresswi);
              //alert("Datos: Herramienta: "+$herramienta+",ID: "+$id+", password: "+$passwindows+", nombre quipo: "+$nombreequipo+", Tipo: "+$tipo+", usuario windows: "+$usuariowindows+", Marca: "+$marca+", Modelo: "+$modelo+", No. serie: "+$no_serie+", procesador: "+$procesador+", Disco Duro: "+$discoduro+", Ram: "+$ram+", Sistema operativo: "+$so+", Direccion Ip: "+$direccionip+", Mac Address"+$macadress+", ID Team: "+$idteamviewer+", Proyecto: "+$proyecto
              //+", Asignar: "+$asignar);
              $.post( "editarherramientas.php", {
                 herramienta: $herramienta,
                 id: $id,
                 passwindows: $passwindows,
                 nombreequipo: $nombreequipo,
                 tipo: $tipo,
                 usuariowindows: $usuariowindows,
                 marca: $marca,
                 modelo: $modelo,
                 no_serie: $no_serie,
                 procesador: $procesador,
                 discoduro : $discoduro,
                 ram : $ram,
                 so : $so,
                 direccionip : $direccionip,
                 macadress : $macadress,
                 idteamviewer : $idteamviewer,
                 proyecto : $proyecto,
                 asignar : $asignar,
                 cantidad : $cantidad,
                 macadresswi : $macadresswi}, function( data ) {
                $( "#herramientas" ).html( data );
                //alert("Dos");
             });
            });

            $( "#herramienta" ).change(function() {
                $herramienta = $("#herramienta option:selected").text();
                //alert("Herramienta: "+$herramienta);
                $.post( "herramientas.php", { herramienta: $herramienta } , function( data ) {
                  $( "#herramienta" ).html( data );
                  //alert("Dos");
               });
            });

            //Aqui estan los botones con iconos de las herramientas disponibles.
            $('.herramienta').on("click",function(){
                $herramienta = $(this).data("herramienta");
                $tipo = $(this).data("tipo");
                $noserie = $(this).data("noserie");
                //alert("Tipo: "+$tipo);
                $.post( "herramientas.php", { herramienta: $herramienta, tipo:$tipo, noserie:$noserie } , function( data ) {
                $( "#herramientas" ).html( data );
              });
            });

          });
          </script>
        </head>
        <body>
          <?php switch ($_SESSION['perfil']){
            case 'Sistemas':?>
            <!-- Top menu -->
             <div align="left">
               <a href="index.php">
                 <img src="assets/img/logo-human.png" height="80px">
               </a>
             </div>

             <div class="navbar">
               <div class="col-sm-2"></div>
                <div class="collapse navbar-collapse col-sm-4" align="center">
                 <ul class="nav navbar-nav">
                  <li><a href="altausuario.php"><i style="font-size:24px" class="fa fa-user-plus"></i><br>Alta usuario</a></li>
                  <li class="active"><a href="altaherramienta.php"><i style="font-size:24px" class="fa fa-desktop"></i><br>Alta equipo</a></li>
                  <li><a href="asignarherramientas.php"><i class="fa fa-edit" style="font-size:24px"></i><br>Asignar herramientas</a></li>
                  <li><a href="prestarherramientas.php"><i class="fa fa-pencil-square" style="font-size:24px"></i><br>prestar herramientas</a></li>
                  <li><a href="consultarusuario.php"><i class="fa fa-address-book" style="font-size:24px"></i><br>Consultar usuario</a></li>
                  <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                   <i class="fa fa-user-circle-o" style="font-size:24px"></i><br><?php echo $_SESSION['personal']; ?></a>
                   <ul class="dropdown-menu two" role="menu">
                   <li><a href="logout.php">Salir</a></li>
                 </ul>
                </li>
               </ul>
               </div>
             </div>

             <div class="container col-sm-12 col-xl-12 ">
               <div class="dropdown">
                <button id="H" class="btn btn-primary dropdown-toggle col-sm-6" type="button" data-toggle="dropdown">Nueva herramienta</button>
                <ul class="dropdown-menu">
                  <li class="dropdown-submenu">
                    <a class="test" tabindex="-1" href="#">
                     <div class="btn-group">
                       <button class="btn btn-link" type="button"><i class="material-icons">desktop_windows</i></button>
                       <button class="btn btn-link" type="button">Hardware</button>
                     </div>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="dropdown-submenu">
                        <a class="test" href="#"><div class="btn-group">
                          <button class="btn btn-link" type="button">Computadora</button>
                        </div></a>
                        <ul class="dropdown-menu">
                          <li class="herramienta" data-tipo="ESCRITORIO" data-herramienta="Computadora"><a href="#">Escritorio</a></li>
                          <li class="herramienta" data-tipo="LAPTOP" data-herramienta="Computadora"><a href="#">Laptop</a></li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="test" href="#">
                          <div class="btn-group">
                            <button class="btn btn-link" type="button">Telefonia</button>
                          </div>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-submenu">
                            <a class="test" href="#">Fijo</a>
                            <ul class="dropdown-menu">
                              <li class="herramienta" data-tipo = "FijoTD" data-herramienta="Telefonia"><a href="#">Telefono con Diadema</a></li>
                              <li class="herramienta" data-tipo = "FijoTA" data-herramienta="Telefonia"><a href="#">Telefono Analogo</a></li>
                              <li class="herramienta" data-tipo = "FijoTIP" data-herramienta="Telefonia"><a href="#">Telefono IP</a></li>
                              <li class="herramienta" data-tipo = "FijoTI" data-herramienta="Telefonia"><a href="#">Telefono Inalambrico</a></li>
                            </ul>
                          </li>
                          <li class="dropdown-submenu">
                            <a class="test" href="#">MOVIL</a>
                            <ul class="dropdown-menu">
                              <li class="herramienta" data-tipo = "MovilCelular" data-herramienta="Telefonia"><a href="#">CELULAR</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="test" href="#">
                          <div class="btn-group">
                            <button class="btn btn-link" type="button">Impresora</button>
                          </div>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-submenu">
                            <a class="test" href="#">Impresoras</a>
                            <ul class="dropdown-menu">
                              <li class="herramienta" data-tipo = "impresoraMono" data-herramienta="Impresora"><a href="#">Monocromatica</a></li>
                              <li class="dropdown-submenu">
                                <a href="#">Multifuncional</a>
                                <ul class="dropdown-menu">
                                  <li class = "herramienta" data-tipo="impresoraMultiB/N" data-herramienta="Impresora"><a href="#">Blaco/Negro</a></li>
                                  <li class = "herramienta" data-tipo="impresoraMultiColor" data-herramienta="Impresora"><a href="#">Color</a></li>
                                </ul>
                              </li>
                              <li class="herramienta" data-tipo = "impresoraColor" data-herramienta="Impresora"><a href="#">Color</a></li>
                              <li class="herramienta" data-tipo = "impresoraCredencial" data-herramienta="Impresora"><a href="#">Credenciales</a></li>
                            </ul>
                          </li>
                          <li class="dropdown-submenu">
                            <a href="#">Consumibles</a>
                            <ul class="dropdown-menu">
                              <li class = "herramienta" data-tipo="ConsumibleToner" data-herramienta="Impresora"><a href="#">Toner</a></li>
                              <li class = "herramienta" data-tipo="ConsumibleTambor" data-herramienta="Impresora"><a href="#">Tambor</a></li>
                              <li class = "herramienta" data-tipo="TargetaPVC" data-herramienta="Impresora"><a href="#">Targeta PVC</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="test" href="#">
                          <div class="btn-group">
                            <button class="btn btn-link" type="button">Accesorio</button>
                          </div>
                        </a>
                        <ul class="dropdown-menu">
                          <?php
                           $sql = "SELECT Clave,nombreequipo,tipo FROM herramienta WHERE tipo like '%Otro%'";
                           $consulta = sqlsrv_query($conexion,$sql);
                           while( $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC) ){
                             echo "<li class='herramienta' data-herramienta='Complemento' data-tipo='".$line['Clave']."'><a class='test' href='#'>".$line['nombreequipo']."</a></li>";
                           }
                          ?>
                          <li class="herramienta" data-herramienta="Complemento" data-tipo="Otro"><a class="test" href="#">Otro</a></li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="test" href="#">
                          <div class="btn-group">
                            <button class="btn btn-link" type="button">Almacenamiento</button>
                          </div>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-submenu">
                            <a class="test" href="#">Disco Duro</a>
                            <ul class="dropdown-menu">
                              <li class = "herramienta" data-herramienta="Almacenamiento" data-tipo="ALHDDLap"><a class="test" href="#">Disco Duro para Laptop 2.5</a> </li>
                              <li class = "herramienta" data-herramienta="Almacenamiento" data-tipo="ALHDDPC"><a class="test" href="#">Disco Duro para PC 3.5</a> </li>
                            </ul>
                          </li>
                          <li class="dropdown-submenu">
                            <a class = "test" href="#">Memorias Externas</a>
                            <ul class = dropdown-menu>
                              <li class = "herramienta" data-herramienta = "Almacenamiento" data-tipo="ALMEMORIUsb"> <a class = "test" href="#">Flash Usb</a></li>
                              <li class = "herramienta" data-herramienta = "Almacenamiento" data-tipo="ALMEMORIMICROSD"> <a class = "test" href="#">Micro SD</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="test" href="#">
                          <div class="btn-group">
                            <button class="btn btn-link" type="button">Redes</button>
                          </div>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="herramienta" data-herramienta = "Red" data-tipo="RedRouter">
                            <a class="test" href="#">Router</a>
                          </li>
                          <li class="herramienta" data-herramienta = "Red" data-tipo="RedSwicht">
                            <a class="test" href="#">Swicht</a>
                          </li>
                          <li class="herramienta" data-herramienta = "Red" data-tipo="RedAccessP">
                            <a class="test" href="#">Access Point</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a class="test" tabindex="-1" href="#">
                      <div class="btn-group">
                        <button class="btn btn-link" type="button"><i class="material-icons">disc_full</i></button>
                        <button class="btn btn-link" type="button">Software</button>
                      </div>
                    </a>
                    <ul class="dropdown-menu">
                       <li class="dropdown-submenu">
                         <a class="test" href="#">
                           <div class="btn-group">
                             <button class="btn btn-link" type="button">ACCESO A PROGRAMA</button>
                           </div>
                         </a>
                         <ul class="dropdown-menu">
                           <li class="herramienta" data-herramienta = "Acceso_Programa" data-tipo="ServidorVirtual"><a href="#">SERVIDOR VIRTUAL</a></li>
                           <!--<li class="herramienta" data-herramienta = "Acceso_Programa" data-tipo="UnidadRed"><a href="#">UNIDADES DE RED</a></li>-->
                           <li class="herramienta" data-herramienta = "Acceso_Programa" data-tipo="Contabilidad"><a href="#">CONTABILIDAD</a></li>
                           <li class="herramienta" data-herramienta = "Acceso_Programa" data-tipo="Facturacion"><a href="#">FACTURACIÓN</a></li>
                           <li class="herramienta" data-herramienta = "Acceso_Programa" data-tipo="Giro"><a href="#">GIRO</a></li>
                           <li class="herramienta" data-herramienta = "Acceso_Programa" data-tipo="SistemaTicket"><a href="#">SISTEMA TICKET</a></li>
                           <li class="herramienta" data-herramienta = "Acceso_Programa" data-tipo="GiroWeb"><a href="#">GIRO WEB</a></li>
                         </ul>
                       </li>
                       <li class = "herramienta" data-herramienta="Correo" data-tipo="correo">
                       <a class="test" href="#">
                         <div class="btn-group">
                           <button class="btn btn-link" type="button">CORREO ELECTRONICO</button>
                         </div>
                       </a>
                       </li>
                    </ul>
                  </li>
                </ul>
                <button id="Hdisponibles" class="btn btn-primary col-sm-6" type="button">Herramientas Disponibles</button>
                <br><br>
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                  <div class="col-sm-3"><label>Buscar Herramienta</label></div>
                  <div class="col-sm-6"><input id='buscarH' class="form-control" type="text" name="" value=""></div>
                  <div class="col-sm-3"><button class="btn btn-primary btn-sm" onclick="load(1,'0')">Todas las Herramientas</button></div>
                </div>
              </div>
             </div>
             <!-- Slider -->
             <div class="slider-container">
               <div class="col-sm-6">
                  <div id="herramientas" class="col-sm-12 panel panel-default">
                  </div>
               </div>

              <div class="col-sm-6">
                <div id="herramienta" class="col-sm-12 panel panel-default"></div>
            </div>

            <div class="col-sm-12">
              <footer>
                  <div class="container">
                      <div class="row">
                          <div class="col-sm-7 footer-copyright wow fadeIn">
                              <p>&copy; <?php $año = date("Y"); echo $año; ?> Human Services 21</p>
                          </div>
                      </div>
                  </div>
              </footer>
            </div>

            <!-- Javascript -->
            <script src="assets/js/jquery-1.11.1.min.js"></script>
            <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
            <script src="assets/js/wow.min.js"></script>
            <script src="assets/js/retina-1.1.0.min.js"></script>
            <script src="assets/js/jquery.magnific-popup.min.js"></script>
            <script src="assets/flexslider/jquery.flexslider-min.js"></script>
            <script src="assets/js/jflickrfeed.min.js"></script>
            <script src="assets/js/masonry.pkgd.min.js"></script>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
            <script src="assets/js/jquery.ui.map.min.js"></script>
            <script src="assets/js/scripts.js"></script>
              <?php break;
            case 'Coordinador':?>

              <?php break;
            default:?>
              <?php
          }?>
          <!-- Modal -->
          <div class="modal fade" id="DatosModal" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
        </body>
    </html>
  <?php } ?>
