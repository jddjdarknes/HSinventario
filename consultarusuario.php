<?php
session_start();
include("conexion.php");
//echo "Perfil: ".$_SESSION['perfil']."<br>";
//echo "personal: ".$_SESSION['personal'];
$cadena1 = $_SESSION['puesto'];
$rh = strpos($cadena1,"RECURSOS HUMANOS");
$sistemas = strpos($cadena1,"SISTEMAS");
if(!isset($_SESSION['personal'])){header("Location: logout.php");}
else{
 ?>
 <!DOCTYPE html>
 <html lang="en">
     <head>
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Servicios con Sentido Humano - Human Services 21</title>
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400">
       <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:700,400">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
       <link rel="stylesheet" href="assets/elegant-font/code/style.css">
       <link rel="stylesheet" href="assets/css/animate.css">
       <link rel="stylesheet" href="assets/css/magnific-popup.css">
       <link rel="stylesheet" href="assets/flexslider/flexslider.css">
       <!--<link rel="stylesheet" href="assets/css/form-elements.css">-->
       <link rel="stylesheet" href="assets/css/mystyle.css">
       <link rel="stylesheet" href="assets/css/font-awesome.min.css">
       <link rel="stylesheet" href="assets/css/media-queries.css">
         <style type="text/css">
         td{text-align:left;}
         #h2{background-color: #FFFEFE}
         #btnguardar{margin: 0 10px 0 10px;}
         </style>
         <script type="text/javascript">
         function limpiar(){
           $('input[type="text"]').val('');
         }

         function cancelar(){
           location.reload();
         }

         function redireccionar(id,accion){
           //alert("Datos: "+datos);
           /*alert("ID: "+id);
           alert("Accion: "+accion);*/
           if(accion == "Asignada"){alert(accion); var url = "http://38.101.223.14/HSInventario/exportar_pdf2.php?idper="+id+"&op='"+accion+"'";}
           if(accion == "Prestada"){alert(accion); var url = "http://38.101.223.14/HSInventario/exportar_pdf3.php?idper="+id+"&op='"+accion+"'";}
           //var url = "http://38.101.223.14/HSInventario/exportar_pdf2.php?idper="+id+"&op='"+accion+"'";
           window.open(url);
         }

         $(document).ready(function(){
           $usuario="";
           $option="";
           var hardware = new Array();
           var software = new Array();
           var mostrar1 = new Array();
           var mostrar2 = new Array();
           $hcontador = 0;
           $scontador = 0;

          $( "#herramientaseleccionada" ).on("click","#bguardar",function(){
            if(hardware == "" && accesorio == "" && software == "" && unidadredbaja == "" && $borrartodounidadred == ""){
              alert("No a seleccionado ninguna herramienta");
            }else{
              alert("Guardando. . . . . !!!!!");
              //alert("Personal: "+$personal);
              //alert("Estado: "+$estadoH);
              $.post( "Updatepeticion.php",{
                "hardware":JSON.stringify(hardware),
                "software":JSON.stringify(software),
                "usuario":$usuario}
                ,function( data ) {
                $( "#herramientaseleccionada" ).html( data );
              });
              //location.reload();
            }
          });

          $( "input[type=radio]" ).on( "click", function(){
             $opcion = $(this).data("opcion");
             //alert("Opcion: "+$opcion);
             if($opcion == "asignacion"){
               //alert("Opcion: "+$opcion);
               $("#asignacion").show();
               $("#busqueda").hide();
                 $( "label#opcion" ).html("Asinacion");
             }
             if($opcion == "prestamo"){
               //alert("Opcion: "+$opcion);
               $("#prestamo").show();
               $("#busqueda").hide();
               $( "label#opcion" ).html("Prestamo");
             }
           });

          $("#datospersona").on("click","input",function(){
              if($(this).is( ":checked" )){
              $valor = $(this).val();
              $tipo = $(this).data("tipo");
              //alert("Valor: "+$valor);
              //alert("Tipo: "+$tipo);

              if($tipo == "hardware"){
                hardware[$hcontador] = $valor;
                mostrar1[$hcontador] = $valor+"<br>";
                $hcontador ++;
                $( "#shardware" ).html("HARDWARE:<br>"+mostrar1);
              }

              if($tipo == "software"){
                software[$scontador] = $valor;
                mostrar2[$scontador] = $valor+"<br>";
                $scontador ++;
                $( "#ssoftware" ).html("SOFTWARE:<br>"+mostrar2);
              }
            }
          });

           $( "#datospersona" ).on("click","#pasignacion",function(){
             $( "#mostrarherramientas" ).show();
           });

           $("#datospersona").on( "change", "#unidadred", function(){
             $confirmar = $(this).val();
             //alert("Confirmar: "+$confirmar);
             if($confirmar == 'si'){$( "#sociolaborales" ).show(); $( "#finanzas" ).show(); $borrartodounidadred=0; $estadoH='Asignar';}
             if($confirmar == 'no'){$( "#sociolaborales" ).hide(); $( "#finanzas" ).hide(); $borrartodounidadred=1; $estadoH='Asignar';}
           });

           $( "#datospersona" ).on("click","#btnbuscar",function(){
             $( "#datospersona" ).removeClass( "panel panel-default" );
             $( "#persona" ).focus();
             $( "#datospersona" ).empty();
           });

           $( "input#busqueda" ).on("keydown",function(){
             $opt = $(this).data("op");
             //alert("OPT: "+$opt);
             $nomusuario = $("input#busqueda").val();
             //alert("Nombre: "+$nomusuario);
             $.post( "buscarpersonal.php",{
               personal:$nomusuario,
               opcion:$opt
             },function( data ) {
               $( "#datospersona" ).html( data );
             });
           });

           $( "#datospersona" ).on("click",".btnpersonal",function(){
             $id=$(this).data( "id" );
             $usuario = $id;
             //alert($personal);
             $nombre=$(this).data( "nombre" );
             $apellido=$(this).data( "apellido" );
             $nombres = $nombre;
             $completo = $apellido;
             $departamento=$(this).data( "departamento" );
             $puesto = $(this).data( "puesto" );
             $localidad=$(this).data( "localidad" );
             $coordinador=$(this).data( "coordinador" );
             $perfil = $(this).data( "perfil" );
             $opcion = $(this).data( "opcion" );
             //alert("ID: "+$id+$nombre+$apellido+$departamento+$coordinador);
             /*$( "label#nombre" ).html( $nombre+" "+$apellido );
             $( "label#departamento" ).html( $departamento );
             $( "label#localidad" ).html( $localidad );
             $( "label#coordinador" ).html( $coordinador );*/
             $.post( "consultarHerramienta.php" ,{
               idp:$id,
               nombrep:$nombre,
               apellidop:$apellido,
               departamentop:$departamento,
               puestop:$puesto,
               localidadp:$localidad,
               coordinadorp:$coordinador,
               perfilp:$perfil,
               opcionp:$opcion
             },function( data ) {
               $( "#datospersona" ).empty();
               $( "#datospersona" ).html( data );
               $( "#datospersona" ).addClass( "panel panel-default" );
               //$( "#datosasignacion" ).empty( data );
             });
             /*Localidad:<label id="localidad"></label><br>
             coordinador: <label id="coordinador"></label><br>*/
           });

         });
         </script>
     </head>
     <body>
       <?php if($_SESSION['departamento'] == "192 [SISTEMAS]" and $sistemas !== false){ ?>
         <!-- Top menu -->
    <div align="left">
      <a href="index.php">
        <img src="assets/img/logo-human.png" height="80px">
      </a>

      <div class="navbar">
        <div class="col-sm-2"></div>
         <div class="collapse navbar-collapse col-sm-4" align="center">
          <ul class="nav navbar-nav">
           <li><a href="altausuario.php"><i style="font-size:24px" class="fa fa-user-plus"></i><br>Alta usuario</a></li>
           <li><a href="altaherramienta.php"><i style="font-size:24px" class="fa fa-desktop"></i><br>Alta equipo</a></li>
           <li><a href="asignarherramientas.php"><i class="fa fa-edit" style="font-size:24px"></i><br>Asignar herramientas</a></li>
           <li><a href="prestarherramientas.php"><i class="fa fa-pencil-square" style="font-size:24px"></i><br>prestar herramientas</a></li>
           <li class="active"><a href="consultarusuario.php"><i class="fa fa-address-book" style="font-size:24px"></i><br>Consultar usuario</a></li>
           <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle">
            <i class="fa fa-user-circle-o" style="font-size:24px"></i><br><?php echo $_SESSION['personal']; ?></a>
            <ul class="dropdown-menu two" role="menu">
            <li><a href="logout.php">Salir</a></li>
          </ul>
         </li>
        </ul>
        </div>
      </div>

         <!-- Slider -->
         <div class="slider-container">
           <div class="col-sm-2 panel panel-default">
             <!-- <div class="form-group">
               <label for="personal">Buscar personal:</label>
               <input type="text" class="form-control" id="persona">
             </div> -->
             <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#busqueda"><strong>Buscar por: </strong></button><label id="opcion"></label>
             <div id="busqueda" class="collapse">
               <div class="radio">
                 <label><input type="radio" name="opcion" data-opcion = "asignacion">Asignación.</label>
               </div>
               <div class="radio">
                 <label><input type="radio" name="opcion" data-opcion = "prestamo">Préstamo.</label>
               </div>
             </div>
             <div id='asignacion' hidden>
              <input type="text" class="form-control" id="busqueda" data-op="Asignada"><br>
               <button type="button" class="btn btn-primary btn-sm" onclick="limpiar()" >Limpiar</button>
               <button type="button" class="btn btn-secondary btn-sm" onclick="cancelar()" >Cancelar</button>
             </div>
             <div id='prestamo' hidden>
              <input type="text" class="form-control" id="busqueda" data-op="Prestada"><br>
                <button type="button" class="btn btn-primary btn-sm" onclick="limpiar()">Limpiar</button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="cancelar()">Cancelar</button>
             </div>
           </div>
           <div class="col-sm-6" id="datospersona"></div>

           <!--<div class="col-sm-3" id="datos"></div>
           <div class="col-sm-3">

           </div>-->
         </div>
         <!-- Footer -->
         <div class="col-sm-12">
           <footer>
               <div class="container">
                   <div class="row">
                       <div class="col-sm-7 footer-copyright wow fadeIn">
                           <p>&copy; <?php $año = date("Y"); echo $año; ?> Human Services 21</p>
                       </div>
                   </div>
               </div><br>
           </footer>
          </div>

         <!-- Javascript -->
         <script src="assets/js/jquery-1.11.1.min.js"></script>
         <script src="assets/bootstrap/js/bootstrap.min.js"></script>
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

       <?php }elseif($_SESSION['departamento'] == "161 [RECLUTAMIENTO]"){
         echo "Id: ".$_SESSION['id']."<br>" ?>
         <div align="left">
           <a href="index.php">
             <img src="assets/img/logo-human.png" height="80px">
           </a>
            <div class="navbar">
              <div class="col-sm-3"></div>
               <div class="collapse navbar-collapse col-sm-4" align="center">
                <ul class="nav navbar-nav">
                  <li><a href="altausuario.php">manejo de personal</a></li>
                  <li class="active"><a href="consultarusuario.php">consulta de asignación</a></li>
                  <li><a href="logout.php">Salir</a></li>
                </ul>
              </div>
            </div>
              <!-- Slider -->
              <div class="slider-container">
         <div class="col-sm-3">
           <div class="form-group">
             <label for="personal">Buscar personal:</label>
             <input type="text" class="form-control" id="persona">
           </div>
           <div id="herramientaseleccionada" class="panel panel-default">
             <h4>Herramientas Seleccionadas: </h4>
             <div id="shardware" class="panel panel-default">< Empty ></div>
             <div id="ssoftware" class="panel panel-default">< Empty ></div>
             <button type='button' class='btn btn-default btn-block' id='bguardar' data-personal=''>Guardar</button>
           </div>
         </div>


         <div class="col-sm-6" id="datospersona"></div>
         <!--<div class="col-sm-3" id="datos"></div>
         <div class="col-sm-3">

         </div>-->
       </div>
              <!-- Footer -->
              <div class="col-sm-12">
                <footer>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-7 footer-copyright wow fadeIn">
                                <p>&copy; <?php $año = date("Y"); echo $año; ?> Human Services 21</p>
                            </div>
                        </div>
                    </div><br>
                </footer>
               </div>

              <!-- Javascript -->
              <script src="assets/js/jquery-1.11.1.min.js"></script>
              <script src="assets/bootstrap/js/bootstrap.min.js"></script>
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
         <?php } ?>
     </body>
 </html>
 <?php } ?>
