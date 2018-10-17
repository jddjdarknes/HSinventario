<?php
session_start();
include ('conexion.php');
$cadena1 = $_SESSION['puesto'];
$rh = strpos($cadena1,"RECURSOS HUMANOS");
/*echo "SESSION: ".$_SESSION['departamento']."<br>";
echo "Cadena: ".$cadena1."<br>";
echo "RH: ".$rh."<br>";*/
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
      <!-- CSS -->
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
        td{text-align:left;}
        #h2{background-color: #FFFEFE}
        #btnguardar{margin: 0 10px 0 10px;}
        </style>
        <script >
        var pbus="";
        function load(page,herramienta){
         //alert("page: "+page+" herramienta: "+herramienta);
         $div="";
         if(herramienta == 1){$div = "Computadora";}
         if(herramienta == 2){$div = "Telefonia";}
         if(herramienta == 3){$div = "Impresora";}
         if(herramienta == 4){$div = "Complemento";}
         if(herramienta == 5){$div = "Almacenamiento";}
         if(herramienta == 6){$div = "Red";}
         //alert("DIV: "+herramienta);
         $.post( "HerramientaH_ajax.php",{page:page,herramienta:herramienta,action:"ajax"},function( data ) {
           $( "#"+$div ).html( data );
          });
         }

         function loading(page,herramienta){
           //alert("page: "+page+" herramienta: "+herramienta);
          $div="";
          if(herramienta == 1){$div = "ServidorVirtual";}
          //if(herramienta == 2){$div = "UnidadesRed";}
          if(herramienta == 2){$div = "Contabilidad";}
          if(herramienta == 3){$div = "Facturacion";}
          if(herramienta == 4){$div = "Giro";}
          if(herramienta == 5){$div = "SistemasTicket";}
          if(herramienta == 6){$div = "GiroWeb";}
          if(herramienta == 7){$div = "Correo";}
          //alert("DIV: "+herramienta);
          $.post( "HerramientaS_ajax.php",{page:page,herramienta:herramienta,action:"ajax"},function( data ) {
            $( "#"+$div ).html( data );
            $( "#datosasignacion" ).addClass( "panel panel-default" );
           });
          }
          function redireccionar(datos){

          }

          function load(page){
            $.post( "searchpersona.php",
            {page:page,action:"ajax",personal : pbus}
            ,function( data ) {
              $("#presultado").empty();
              $("#presultado").html(data);
             });
          }

        $(document).ready(function(){
          $personal="";
          $nombres="";
          $completo="";
          $( "#persona" ).html($personal);
          var hardware = new Array();
          var software = new Array();
          var accesorio = new Array();
          var unidadredbaja = new Array();
          var mostrar1 = new Array();
          var mostrar2 = new Array();
          var mostrar3 = new Array();
          $estadoh="";
          $hcontador=0;
          $scontador=0;
          $acontador=0;
          $URcontador=0;
          $borrartodounidadred=0;
          $ban=0;
          var nuevosdatos = Array();
          var asignarharware = Array();
          var asignarsofware = Array();
          $conta=0;

          $( "#btnenviar" ).click(function(){
            //enviar nuevosdatos
            $si = "false";
            $( "input:checked" ).each(function(){
              $si = "true";
            });

            if($si == "false"){
              alert("No a seleccionado ninguna herramienta");
            }else{
              $( ".hardware:checked" ).each(function(){
                asignarharware.push($(this).val());
              });

              $( ".software:checked" ).each(function(){
                asignarsofware.push($(this).val());
              });

              $id_pl = $( "#idper" ).val();
              //nuevosdatos.push($id_pl);
              $nombre = "Nombre(s): "+$( ".personalDa" ).data("nombre");
              $apellidos = "Apellidos: "+$(".personalDa").data("apellido");
              $departamento = "Departamento: "+$( ".personalDa" ).data("departamento");
              $puesto = "Puesto: "+$( ".personalDa" ).data("puesto");
              $localidad = "Localidad: "+$( ".personalDa" ).data("localidad");
              $coordinador = "Coordinador: "+$( ".personalDa" ).data("coordinador");
              $perfil = "Perfil: "+$( ".personalDa" ).data("perfil");

              nuevosdatos.push($nombre);
              nuevosdatos.push($apellidos);
              nuevosdatos.push($departamento);
              nuevosdatos.push($puesto);
              nuevosdatos.push($localidad);
              nuevosdatos.push($coordinador);
              nuevosdatos.push($perfil);

              for (var i = 0; i < asignarharware.length; i++) {
                alert("Hardware: "+asignarharware[i]);
              }

              for (var i = 0; i < asignarsofware.length; i++) {
                alert("Software: "+asignarsofware[i]);
              }

              for (var i = 0; i < nuevosdatos.length; i++) {
                alert("Datos persona: "+nuevosdatos[i]);
              }

              $.post( "peticion.php",{
                "hardware":JSON.stringify(asignarharware),
                "software":JSON.stringify(asignarsofware),
                "persona":JSON.stringify(nuevosdatos)
              }
                , function( data ) {
                //$( "#mostrarherramientas" ).hide();
                $( "#mostrarherramientas" ).html( data );
              });
            }
              //setTimeout("location.href='http://38.101.223.14/HSInventario/altausuario.php'", 5000);
          });

          $("#Pbuscar").keyup(function(e){
              //obtenemos el texto introducido en el campo de búsqueda
              var consulta = $("#Pbuscar").val();
              pbus = consulta;
              //alert("Buscar esto: "+consulta);
              //hace la búsqueda
              if(consulta == ""){
                 //$("#personal").load("#personal"); alert("< Empty >");
                 $( "#presultado" ).empty();
              }else{
                $.post( "searchpersona.php", { personal: consulta, action : "ajax"},function( data ) {
                  $( "#presultado" ).html( data );
                });
              }
          });

          $( "#presultado" ).on( "click", "a#pdatos", function(){
            $idpersonal = $( this ).data( "id" );
            $Nombres = $( this ).data( "nombre" );
            $apellidos = $( this ).data( "apellidos" );
            $departamentopersonal = $( this ).data( "departamento" );
            $puesto = $( this ).data( "puesto" );
            $localidad = $( this ).data( "localidad" );
            $coordinador = $( this ).data( "coordinador" );
            $perfil = $( this ).data( "perfil" );
            //alert("ID: "+$idpersonal+" Nombre(s): "+$Nombres+" Apellido(s): "+$apellidos+" Departa: "+$departamentopersonal+" Puesto: "+$puesto+" Localidad: "+$localidad+" Coordinador: "+$coordinador+" Perfil: "+$perfil);
            $( "#personaldatos" ).html("<input id='idper' type='text' name='idper' value='"+$idpersonal+"' hidden>"+
                                       "<div class='panel panel-success'>"+
                                       "<div class='panel-heading'>Datos del personal</div>"+
                                       "<div class='panel-body'>"+
                                       "<table width='100%'>"+
                                       "<tr><td>Nombre:</td><td><label class='personalDa' data-nombre='"+$Nombres+"' data-apellido='"+$apellidos+"' data-departamento='"+$departamentopersonal+"' data-puesto='"+$puesto+"' data-localidad='"+$localidad+"' data-coordinador='"+$coordinador+"' data-perfil='"+$perfil+"'>"+$Nombres+" "+$apellidos+"</label></td></tr>"+
                                       "<tr><td>Departamento:</td><td><label>"+$departamentopersonal+"</label></td></tr>"+
                                       "<tr><td>Puesto:</td><td><label>"+$puesto+"</label></td></tr>"+
                                       "<tr><td>Localidad:</td><td><label>"+$localidad+"</label></td></tr>"+
                                       "<tr><td>Coordinador:</td><td><label>"+$coordinador+"</label></td></tr>"+
                                       "<tr><td>Perfil:</td><td><label>"+$perfil+"</label></td></tr>"+
                                       "</table></div></div>");
          $( "#linkherramienta" ).show();
          });

          $( "#datosasignacion" ).on( "click", "input.unidades",function() {
            //alert("Valor: "+$(this).val());
            $estadoH = $(this).data( "estado" );
            //alert("Estado1 :"+$estadoH);
            if($(this).is( ":checked" )){
              $software = $(this).val();
              $nombre = $(this).data("texto");
              if(software != ""){
                //alert("Si hay datos");
                for (var i = 0; i < software.length; i++) {
                  if (software[i] == $software) {
                    $ban=1;
                  }
                }

                if($ban != 1){
                  $scontador++;
                  software[$scontador]= $software;
                  mostrar3[$scontador]= $nombre+"<br>";
                  //$( "#ssoftware" ).html(software);
                }
              }else{
                //alert("No hay datos");
                software[$scontador] = $software;
                mostrar3[$scontador] = $nombre+"<br>";
              }
            }else{
              //Distincion
              $software = $(this).val();
              //alert("Valor: "+$software);
              if(unidadredbaja != ""){
                //alert("Si hay datos");
                for (var i = 0; i < unidadredbaja.length; i++) {
                  if (unidadredbaja[i] == $software) {
                    $ban=1;
                  }
                }

                if($ban != 1){
                  $URcontador++;
                  unidadredbaja[$URcontador]= $software;
                  //$( "#ssoftware" ).html(software);
                }
              }else{
                //alert("No hay datos");
                unidadredbaja[$URcontador] = $software;
              }
              //
              $ban=0;
            }
            //$( "#ssoftware" ).html("SOFTWARE:<br>"+unidadredbaja);
            $ban=0;
          });

         $("#datosasignacion").on( "change", "#unidadred", function(){
           $confirmar = $(this).val();
           //alert("Confirmar: "+$confirmar);
           if($confirmar == 'si'){$( "#sociolaborales" ).show(); $( "#finanzas" ).show(); $borrartodounidadred=0; $estadoH='Asignar';}
           if($confirmar == 'no'){$( "#sociolaborales" ).hide(); $( "#finanzas" ).hide(); $borrartodounidadred=1; $estadoH='Asignar';}
         });

          $( "#busquedapor" ).on( "click", "#blimpiar" ,function(){
            $( "#usuario" ).val("");
          });

          $( "#datosasignacion" ).on("click","a.linkher",function(){
            //alert("HOLA");
            $idher=$(this).data( "idher" );
            //alert("Dato Resivido: "+$idher);
            $.post( "consultaHerramienta.php",{
              idh:$idher
            },function( data ) {
              $( "#datosasignacion" ).html( data );
              //$( "#datosasignacion" ).empty( data );
            });
            $( "#datosasignacion" ).addClass( "panel panel-default" );
          });

          $( "#Modalherramienta" ).on("click","#btnasignacion",function(){
            //alert("BTN Asignar");
            $id=$(this).data( "id" );
            $personal = $id;
            //alert($personal);
            $nombre=$(this).data( "nombre" );
            $apellido=$(this).data( "apellido" );
            $nombres = $nombre;
            $completo = $apellido;
            $departamento=$(this).data( "departamento" );
            $puesto=$(this).data( "puesto" );
            $localidad=$(this).data( "localidad" );
            $coordinador=$(this).data( "coordinador" );
            $perfil=$(this).data( "perfil" );
            $nuevousuario = $(this).data( "usuarion" );
            //alert($nuevousuario);
            $.post( "consultaHerramientas.php" ,{
              idp:$id,
              action:$action,
              nombrep:$nombre,
              apellidop:$apellido,
              departamentop:$departamento,
              puestop:$puesto,
              localidadp:$localidad,
              coordinadorp:$coordinador,
              perfilp:$perfil,
              nuevousuario:$nuevousuario
            },function( data ) {
              $( "#datosasignacion" ).html( data );
              //$( "#datosasignacion" ).empty( data );
            });
            /*Localidad:<label id="localidad"></label><br>
            coordinador: <label id="coordinador"></label><br>*/
            $( "#datosasignacion" ).addClass( "panel panel-default" );
          });

          $( "#datosasignacion" ).on("click",".btnpersonal",function(){
            //alert(".BTN");
            $id=$(this).data( "id" );
            $personal = $id;
            $action="asignar";
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
            //alert("ID: "+$id+$nombre+$apellido+$departamento+$coordinador);
            /*$( "label#nombre" ).html( $nombre+" "+$apellido );
            $( "label#departamento" ).html( $departamento );
            $( "label#localidad" ).html( $localidad );
            $( "label#coordinador" ).html( $coordinador );*/
            $.post( "consultaHerramientas.php" ,{
              idp:$id,
              action:$action,
              nombrep:$nombre,
              apellidop:$apellido,
              departamentop:$departamento,
              puestop:$puesto,
              localidadp:$localidad,
              coordinadorp:$coordinador,
              perfilp:$perfil
            },function( data ) {
              $( "#datosasignacion" ).html( data );
              //$( "#datosasignacion" ).empty( data );
            });
            /*Localidad:<label id="localidad"></label><br>
            coordinador: <label id="coordinador"></label><br>*/
            $( "#datosasignacion" ).addClass( "panel panel-default" );
          });

          $( "#datosasignacion" ).on("click","#cancelar",function(){
            //alert("¿Cancelar?");
            //$( "#datosasignacion" ).hide();
            location.reload();
          });

          $( "#datosasignacion" ).on("click","#asignar",function(){
            $( "#mostrarherramientas" ).show();
            $( "#datosasignacion" ).hide();
            $( "#nombrecompletos" ).html($nombres+" "+$completo);
            //alert( "Boton Asignar" );
          });

          $( "#btnsiguiente" ).click(function(){
            //alert("Siguiente");
            $("input:checkbox:checked").each(
              function() {
                //alert("El checkbox con valor " + $(this).val() + " está seleccionado");

                if($(this).val() == 1){
                  $.post( "HerramientaH_ajax.php" ,{herramienta:1,action:"ajax"},function( data ) {
                    $("#Hard").append("<div align='left' id='com' class='Hardware panel panel-info'>"+
                                      "<div class='panel-heading'>Hardware: Computadora</div>"+
                                      "<div id='Computadora' class='panel-body'>"+
                                      "<div class='col-sm-2'></div>"+
                                      "</div></div>");
                    $( "#Computadora" ).html( data );
                  });
                  //$( "#com" ).show();
                }

                if($(this).val() == 2){
                  $.post( "HerramientaH_ajax.php",{herramienta:2,action:"ajax"},function( data ) {
                    $("#Hard").append("<div align='left' id='tele' class='Hardware panel panel-info'>"+
                                      "<div class='panel-heading'>Hardware: Telefonia</div>"+
                                      "<div id='Telefonia' class='panel-body'>"+
                                      "<div class='col-sm-2'></div>"+
                                      "</div></div>");
                    $( "#Telefonia" ).html( data );
                  });
                  //$("#tele").show();
                }

                 if($(this).val() == 3){
                   $.post( "HerramientaH_ajax.php",{herramienta:3,action:"ajax"},function( data ) {
                     $("#Hard").append("<div align='left' id='imp' class='Hardware panel panel-info'>"+
                                       "<div class='panel-heading'>Hardware: Impresora/Consumible</div>"+
                                       "<div id='Impresora' class='panel-body'>"+
                                       "<div class='col-sm-2'></div>"+
                                       "</div></div>");
                     $( "#Impresora" ).html( data );
                   });
                   //$("#imp").show();
                 }

                 if($(this).val() == 4){
                   $.post( "HerramientaH_ajax.php",{herramienta:4,action:"ajax"},function( data ) {
                     $("#Hard").append("<div align='left' id='comp' class='Hardware panel panel-info'>"+
                                      "<div class='panel-heading'>Hardware: Accesorio</div>"+
                                      "<div id='Complemento' class='panel-body'>"+
                                      "<div class='col-sm-2'></div>"+
                                      "</div></div>");
                     $( "#Complemento" ).html( data );
                   });
                   //$("#comp").show();
                 }

                  if($(this).val() == 5){
                    $.post( "HerramientaH_ajax.php",{herramienta:5,action:"ajax"},function( data ) {
                      $("#Hard").append("<div align='left' id='alm' class='Hardware panel panel-info'>"+
                                        "<div class='panel-heading'>Hardware: Almacenamiento</div>"+
                                        "<div id='Almacenamiento' class='panel-body'>"+
                                        "<div class='col-sm-2'></div>"+
                                        "</div></div>");
                      $( "#Almacenamiento" ).html( data );
                    });
                    //$("#alm").show();
                  }

                if($(this).val() == 6){
                  $.post( "HerramientaH_ajax.php",{herramienta:6,action:"ajax"},function( data ) {
                    $("#Hard").append("<div align='left' id='re' class='Hardware panel panel-info'>"+
                                      "<div class='panel-heading'>Hardware: Red</div>"+
                                      "<div id='Red' class='panel-body'>"+
                                      "<div class='col-sm-2'></div>"+
                                      "</div></div>");
                    $( "#Red" ).html( data );
                  });
                  //$("#re").show();
                }

                if($(this).val() == 7){
                  $.post( "HerramientaS_ajax.php" ,{herramienta:1,action:"ajax"},function( data ) {
                    $("#Soft").append("<div align='left' id='serv' class='Software panel panel-success'>"+
                                      "<div class='panel-heading'>Software: Servidor Virtual</div>"+
                                      "<div id='ServidorVirtual' class='panel-body'>"+
                                      "<div class='col-sm-2'></div>"+
                                      "</div></div>");
                    $( "#ServidorVirtual" ).html( data );
                  });
                  //$("#serv").show();
                }

                if($(this).val() == 8){
                  $.post( "HerramientaS_ajax.php",{herramienta:2,action:"ajax"},function( data ) {
                    $("#Soft").append("<div align='left' id='cont' class='Software panel panel-success'>"+
                                      "<div class='panel-heading'>Software: Contabilidad </div>"+
                                      "<div id='Contabilidad' class='panel-body'>"+
                                      "<div class='col-sm-2'></div>"+
                                      "</div></div>");
                    $( "#Contabilidad" ).html( data );
                  });
                  //$("#cont").show();
                }

                if($(this).val() == 9){
                  $.post( "HerramientaS_ajax.php",{herramienta:3,action:"ajax"},function( data ) {
                    $("#Soft").append("<div align='left' id='fac' class='Software panel panel-success'>"+
                                      "<div class='panel-heading'>Software: Facturación</div>"+
                                      "<div id='Facturacion' class='panel-body'>"+
                                      "<div class='col-sm-2'></div>"+
                                      "</div></div>");
                    $( "#Facturacion" ).html( data );
                  });
                    //$( "#fac" ).show();
                }

                if($(this).val() == 10){
                  $.post( "HerramientaS_ajax.php",{herramienta:4,action:"ajax"},function( data ) {
                    $("#Soft").append("<div align='left' id='gi' class='Software panel panel-success'>"+
                                      "<div class='panel-heading'>Software: Giro</div>"+
                                      "<div id='Giro' class='panel-body'>"+
                                      "<div class='col-sm-2'></div>"+
                                      "</div></div>");
                    $( "#Giro" ).html( data );
                  });
                  $("#gi").show();
                }

                if($(this).val() == 11){
                  $.post( "HerramientaS_ajax.php",{herramienta:5,action:"ajax"},function( data ) {
                    $("#Soft").append("<div align='left' id='sist' class='Software panel panel-success'>"+
                                    "<div class='panel-heading'>Software: Sistema de Tickets</div>"+
                                    "<div id='SistemaTicket' class='panel-body'>"+
                                    "<div class='col-sm-2'></div>"+
                                    "</div></div>");
                    $( "#SistemaTicket" ).html( data );
                  });
                  //$("#sist").show();
                }

                if($(this).val() == 12){
                  $.post( "HerramientaS_ajax.php",{herramienta:6,action:"ajax"},function( data ) {
                    $("#Soft").append("<div align='left' id='gir' class='Software panel panel-success'>"+
                                      "<div class='panel-heading'>Software: Giro Web</div>"+
                                      "<div id='GiroWeb' class='panel-body'>"+
                                      "<div class='col-sm-2'></div>"+
                                      "</div></div>");
                    $( "#GiroWeb" ).html( data );
                  });
                  //$("#git").show();
                }

                if($(this).val() == 13){
                  $.post( "HerramientaS_ajax.php",{herramienta:7,action:"ajax"},function( data ) {
                    $("#Soft").append("<div align='left' id='cor' class='Software panel panel-success'>"+
                                      "<div class='panel-heading'>Software: Correo</div>"+
                                      "<div id='Correo' class='panel-body'>"+
                                      "<div class='col-sm-2'></div></div></div>");
                    $( "#Correo" ).html( data );
                  });
                }
              });

              $( "#botones" ).html("<div class = 'col-sm-4'><button type='button' class='btn btn-default btn-block' id='btnguardar' data-personal='"+$personal+"'>Guardar</button></div>"+
                                   "<div class = 'col-sm-4'><button type='button' class='btn btn-default btn-block' id='btnregresar'>Regresar</button></div>");
              $( ".Hardware" ).show();
              $( ".Software" ).show();
              $( "#datosasignacion" ).hide();
              $( "#datosasignacion" ).removeClass( "panel panel-default" );
              $( "#panel" ).addClass( "col-sm-4" );
              $( "#botones" ).show();
              $( ".buscar" ).show();
              $( ".usuario" ).hide();
              $( "#busquedapor" ).hide();
              $( "#mostrarherramientas" ).hide();
          });

          $( "#btncancelar" ).click(function(){
            //alert("Cancelar");
            $( "#mostrarherramientas" ).hide();
            $("input[type=checkbox]").prop('checked', false);
            $( "#datosasignacion" ).show();
          });

          $( "#botones" ).on("click","#btnregresar", function(){
            //alert( "¡HOLA!" );
            $( ".Hardware" ).hide();
            $( ".Software" ).hide();
            $( "#botones" ).hide();
            $( ".buscar" ).hide();
            $( ".usuario" ).show();
            $( "#datosasignacion" ).show();
            $( "#panel" ).removeClass( "col-sm-4" );
            $( "#panel" ).addClass( "col-sm-8" );
            $( "#datosasignacion" ).addClass( "panel panel-default" );
          });

            //Aqui empiezan los checkeds
            $( "#Computadora" ).on( "click", "input.asignar",function() {
              $hardware = $(  ".asignar:checked" ).val();
              $estadoH = $(this).data("estado");
              //alert('Clave: '+$hardware);
              $nombre = $(this).data('nombrequipo');
              //alert("Estado: 2"+$estadoH);
              $estadoH = $(this).data("estado");
              if (hardware != "") {
                for (var i = 0; i < hardware.length; i++) {
                  if(hardware[i] == $hardware){
                    $ban=1;
                  }
                }

                  if($ban != 1 ){
                    //alert("Bandera: "+$ban);
                    hardware[$hcontador] = $hardware;
                    mostrar1[$hcontador] = $nombre+"<br>";
                    $hcontador++;
                    $ban=0;
                  }
              }else{
                //alert("No tiene Datos");
                hardware[$hcontador] = $hardware;
                mostrar1[$hcontador] = $nombre+"<br>";
                $hcontador++;
                //alert("Se Guardo");
              }
              //alert("Ultimo alert : Contador: "+$hcontador);
              $ban=0;
              $( "#shardware" ).html("HARDWARE:<br>"+mostrar1);
            });

            $( ".Hardware" ).on( "click", "input.accesorio",function() {
              if($(this).is( ":checked" )){
                $accesorio = $( this ).val();
                $nombre = $(this).data( "nombrequipo" );
                $estadoH = $(this).data("estado");
                //alert("Nombre:" +$nombre);
                if(accesorio != ""){
                  //alert("Tiene Datos, Contador: "+$acontador);
                  for (var i = 0; i < accesorio.length; i++) {
                    if(accesorio[i] == $accesorio){
                      $ban=1;
                      //alert("Bandera: "+$ban);
                    }
                  }
                  if($ban !=1 ){
                    $acontador++;
                    accesorio[$acontador] = $accesorio;
                    mostrar2[$acontador] = $nombre+"<br>";
                    $ban=0;
                    //alert("Bandera: "+$ban+" Contador: "+$acontador);
                    //$( "#saccesorio" ).html("ACCESORIO:<br>"+mostrar2+"<br>");
                  }
                }else{
                  //alert("No tiene Datos");
                  accesorio[$acontador] = $accesorio;
                  mostrar2[$acontador] = $nombre+"<br>";
                  //$( "#saccesorio" ).html();
                }
              }
              $ban=0;
              $( "#saccesorio" ).html("ACCESORIO:<br>"+mostrar2);
            });

            $( ".Software" ).on( "click", "input.software",function() {
              if($(this).is( ":checked" )){
                $software = $(this).val();
                $nombre = $(this).data( "nombrequipo" );
                $estadoH = $(this).data("estado");
                if(software != ""){
                  //alert("Si hay datos");
                  for (var i = 0; i < software.length; i++) {
                    if (software[i] == $software) {
                      $ban=1;
                    }
                  }
                  if($ban != 1){
                    $scontador++;
                    software[$scontador]= $software;
                    mostrar3[$scontador]= $nombre+"<br>";
                    $( "#ssoftware" ).html(software);
                  }
                }else{
                  //alert("No hay datos");
                  software[$scontador] = $software;
                  mostrar3[$scontador] = $nombre+"<br>";
                }
              }
              $ban=0;
              $( "#ssoftware" ).html("SOFTWARE:<br>"+mostrar3);
            });
            //Aqui terminan los checkeds

            //<!-- Aqui empieza checked de busqueda -->
            $( "#Hard" ).on( "click", "input.asignar",function() {
              $hardware = $(  ".asignar:checked" ).val();
              //alert('Clave: '+$hardware);
              $nombre = $(this).data('nombrequipo');
              $estadoH = $(this).data('estado');
              //alert("Estado: 3"+$estadoH);
              if (hardware != "") {
                for (var i = 0; i < hardware.length; i++) {
                  if(hardware[i] == $hardware){
                    $ban=1;
                  }
                }

                  if($ban != 1 ){
                    //alert("Bandera: "+$ban);
                    hardware[$hcontador] = $hardware;
                    mostrar1[$hcontador] = $nombre+"<br>";
                    $hcontador++;
                    $ban=0;
                  }
              }else{
                //alert("No tiene Datos");
                hardware[$hcontador] = $hardware;
                mostrar1[$hcontador] = $nombre+"<br>";
                $hcontador++;
                //alert("Se Guardo");
              }
              //alert("Ultimo alert : Contador: "+$hcontador);
              $ban=0;
              $( "#shardware" ).html("HARDWARE:<br>"+mostrar1);
            });

            $( "#Hard" ).on( "click", "input.accesorio",function() {
              if($(this).is( ":checked" )){
                $accesorio = $( this ).val();
                $nombre = $(this).data( "nombrequipo" );
                //alert("Nombre:" +$nombre);
                if(accesorio != ""){
                  //alert("Tiene Datos, Contador: "+$acontador);
                  for (var i = 0; i < accesorio.length; i++) {
                    if(accesorio[i] == $accesorio){
                      $ban=1;
                      //alert("Bandera: "+$ban);
                    }
                  }
                  if($ban !=1 ){
                    $acontador++;
                    accesorio[$acontador] = $accesorio;
                    mostrar2[$acontador] = $nombre+"<br>";
                    $ban=0;
                    //alert("Bandera: "+$ban+" Contador: "+$acontador);
                    //$( "#saccesorio" ).html("ACCESORIO:<br>"+mostrar2+"<br>");
                  }
                }else{
                  //alert("No tiene Datos");
                  accesorio[$acontador] = $accesorio;
                  mostrar2[$acontador] = $nombre+"<br>";
                  //$( "#saccesorio" ).html();
                }
              }
              $ban=0;
              $( "#saccesorio" ).html("ACCESORIO:<br>"+mostrar2);
            });

            $( "#Soft" ).on( "click", "input.software",function() {
              if($(this).is( ":checked" )){
                $software = $(this).val();
                $nombre = $(this).data( "nombrequipo" );
                if(software != ""){
                  //alert("Si hay datos");
                  for (var i = 0; i < software.length; i++) {
                    if (software[i] == $software) {
                      $ban=1;
                    }
                  }
                  if($ban != 1){
                    $scontador++;
                    software[$scontador]= $software;
                    mostrar3[$scontador]= $nombre+"<br>";
                    $( "#ssoftware" ).html(software);
                  }
                }else{
                  //alert("No hay datos");
                  software[$scontador] = $software;
                  mostrar3[$scontador] = $nombre+"<br>";
                }
              }
              $ban=0;
              $( "#ssoftware" ).html("SOFTWARE:<br>"+mostrar3);
            });


            //Aqui Termina checked de busqueda

            $( "#herramienta" ).on("keydown",function(){
              $claveherramienta = $("#herramienta").val();
              //alert("Nombre: "+$nomusuario);
              $.post( "buscarherramienta.php",{clave:$claveherramienta},function( data ) {
                $( "#datosasignacion" ).html( data );
                $( "#datosasignacion" ).removeClass( "panel panel-default" );
                $( "#panel" ).addClass( "col-sm-8" );
              });
            });

            $( "#usuario" ).on("keydown",function(){
              $nomusuario = $("#usuario").val();
              //alert("Nombre: "+$nomusuario);
              $.post( "buscarpersonal.php",
                {personal:$nomusuario,opcion:'Asignar'},
                function( data ) {
                $( "#datosasignacion" ).html( data );
                $( "#datosasignacion" ).removeClass( "panel panel-default" );
                $( "#panel" ).addClass( "col-sm-8" );
              });
            });

            $( "#hard" ).on("keyup",function(){
              $hard = $("#hard").val();
              if($hard != ""){/*alert( "vacio" );*/
              $( "#Hard" ).addClass("panel panel-info");
              $( ".Hardware" ).hide();
              }
              else{
                $( "#Hard" ).removeClass("panel panel-info");
                 $( ".Hardware" ).show();
               }
              //alert("Nombre: "+$hard);
              $.post( "hard.php",{hard:$hard},function( data ) {
                 $( "#Hard" ).html(data);
              });
            });

            $( "#soft" ).on("keyup",function(){
              $soft = $( "#soft" ).val();
              if($soft != ""){/*alert( "vacio" );*/
              $( "#Soft" ).addClass("panel panel-success");
              $( ".Software" ).hide();
              }
              else{
                $( "#Soft" ).removeClass( "panel panel-success" );
                $( ".Software" ).show();
              }
              //alert("Nombre: "+$soft);
              $.post( "soft.php",{soft:$soft},function( data ) {
                $( "#Soft" ).html(data);
              });
            });

            $( "#datosasignacion" ).on("click","#quitar",function(){
              //alert( "LOL" );
              $id=$(this).data("id");
              $clave=$(this).data("clave");
              $action="asignar";
              $nombre=$(this).data("nombre");
              $apellido=$(this).data("apellido");
              $departamento=$(this).data("departamento");
              $puesto=$(this).data("puesto");
              $localidad=$(this).data("localidad");
              $coordinador=$(this).data("coordinador");
              $perfil=$(this).data("perfil");
              //alert("Id personal: "+$id+" Clave herramienta: "+$clave);

              $.post( "quitar.php",{clave:$clave,id:$id},function( data ) {
                //document.getElementById("#datosasignacion").contentDocument.location.reload(true);
                //$( "#datosasignacion" ).html(data);
                //$( "#datosasignacion" ).addClass( "panel panel-default" );

                $( "label#nombre" ).html( $nombre+" "+$apellido );
                $( "label#departamento" ).html( $departamento );
                $( "label#localidad" ).html( $localidad );
                $( "label#coordinador" ).html( $coordinador );
                $.post( "consultaHerramientas.php" ,{
                  idp:$id,
                  nombrep:$nombre,
                  action:$action,
                  apellidop:$apellido,
                  departamentop:$departamento,
                  puestop:$puesto,
                  localidadp:$localidad,
                  coordinadorp:$coordinador,
                  perfilp:$perfil
                },function( data ) {
                  $( "#datosasignacion" ).html( data );
                });

              });

            });

            $( "#herramientaseleccionada" ).on("click","#bguardar",function(){
              $nuevousuario = $( "#nuevopersonal" ).val();
              //alert("Persona: "+$personal);
              if(hardware == "" && accesorio == "" && software == "" && unidadredbaja == "" && $borrartodounidadred == ""){
                alert("No a seleccionado ninguna herramienta");
              }else{
                alert("Guardando. . . . . !!!!!");
                //alert("Personal: "+$personal);
                //alert("Estado: "+$estadoH);
                $.post( "Insertasignacion.php",{
                  "nuevousuario":$nuevousuario,
                  "hardware":JSON.stringify(hardware),
                  "software":JSON.stringify(software),
                  "accesorio":JSON.stringify(accesorio),
                  "unidadredbaja":JSON.stringify(unidadredbaja),
                  "persona":$personal,
                  "borrartodounidadred":$borrartodounidadred,
                  "estadoH":$estadoH}
                  ,function( data ) {
                  $( "#herramientaseleccionada" ).html( data );
                });
                location.reload();
              }
            });

            $( "#herramientaseleccionada" ).on("click","#bregresar",function(){
               $( "#com" ).hide();
               $( "#imp" ).hide();
               $( "#tele" ).hide();
               $( "#comp" ).hide();
               $( "#alm" ).hide();
               $( "#re" ).hide();

               $( "#serv" ).hide();
               $( "#cont" ).hide();
               $( "#fac" ).hide();
               $( "#gi" ).hide();
               $( "#sist" ).hide();
               $( "#gir" ).hide();
               $( "#cor" ).hide();
              $( "#botones" ).hide();
              $( ".buscar" ).hide();

              $( "#Computadora" ).empty();
              $( "#Telefonia" ).empty();
              $( "#Impresora" ).empty();
              $( "#Accesorio" ).empty();
              $( "#Almacenamiento" ).empty();
              $( "#Red" ).empty();
              $( "#ServidorVirtual" ).empty();
              $( "#Contabilidad" ).empty();
              $( "#Facturacion" ).empty();
              $( "#Giro" ).empty();
              $( "#SistemaTicket" ).empty();
              $( "#GiroWeb" ).empty();
              $( "#Correo" ).empty();
              //$( ".usuario" ).show();
              $( "#datosasignacion" ).show();
              $( "#panel" ).removeClass( "col-sm-4" );
              $( "#panel" ).addClass( "col-sm-8" );
              $( "#datosasignacion" ).addClass( "panel panel-default" );
              //$( "#busquedapor" ).show();
              $("input[type=checkbox]").prop('checked', false);
            });

           $( "input[type=radio]" ).on( "click", function(){
             //alert("Kill");
             $busqueda = $(this).data("opcion");
             if($busqueda == "usuario"){$(".usuario").show(); $(".herramienta").hide(); $("#minibotones").show();}
             if($busqueda == "herramienta"){$(".herramienta").show(); $(".usuario").hide();  $("#minibotones").show();}
             $( "#usuario" ).focus();
             $( "#herramienta" ).focus();
           });

           $( "#bcancelar" ).click(function(){
             location.reload();
           });

        });
        </script>
    </head>
    <?php  if($_SESSION['departamento'] == "192 [SISTEMAS]" and $sistemas !== false){
      //echo "Si es de Sistemas.";
      ?>
    <body>
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
        <li><a href="altaherramienta.php"><i style="font-size:24px" class="fa fa-desktop"></i><br>Alta equipo</a></li>
        <li class="active"><a href="asignarherramientas.php"><i class="fa fa-edit" style="font-size:24px"></i><br>Asignar herramientas</a></li>
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

    <!-- Modal -->
    <div id="Modalherramienta" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Petición de asignatura</h4>
          </div>
          <div class="modal-body">
            <p><?php
             $sql = "SELECT * FROM peticion where atendido = 0";
             $resultado = sqlsrv_query($conexion,$sql);
             echo "<table class='table table-striped'>
                    <thead>
                    <tr>
                      <th>Nombre(s)</th>
                      <th>Apellidos</th>
                      <th>Hardware</th>
                      <th>Software</th>
                    </tr>
                    </thead><tbody>";
             while ($line = sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)) {
               $datos= explode(",",$line['datos']);
               $nombre = explode("Nombre(s):",$datos[1]);
               $apellido = explode("Apellidos:",$datos[2]);
               $departamento = explode("Departamento:",$datos[3]);
               $puesto = explode("Puesto:",$datos[4]);
               $localidad = explode("Localidad:",$datos[5]);
               $coordinador = explode("Coordinador:",$datos[6]);
               $perfil = explode("Perfil:",$datos[7]);

               $herrminetaH = explode(",",$line['hardware']);
               $herrminetaS = explode(",",$line['software']);
               $hcont = COUNT($herrminetaH);
               $scont = COUNT($herrminetaS);
               echo "<tr>
               <td>".$nombre[1]."</td>";
               echo "<td>".$apellido[1]."</td>";
               echo "<td>";
               for ($i=1; $i < $hcont; $i++) {
                 echo $herrminetaH[$i]."<br>";
               }
               echo "</td>";
               echo "<td>";
               for ($i=1; $i < $scont; $i++) {
                 echo $herrminetaS[$i]."<br>";
               }
               echo "</td>";
               $sq = sqlsrv_query($conexion,"select * from personal where apellidos like '%$apellido[1]%'");
               $lines = sqlsrv_fetch_array($sq,SQLSRV_FETCH_ASSOC);
               echo "<td align='right'><button id='btnasignacion' class='btn btn-primary' type='button' name='button' data-dismiss='modal'
               data-id = '".$lines['idpersonal']."',
               data-nombre='".$nombre[1]."',
               data-apellido='".$apellido[1]."',
               data-departamento='".$departamento[1]."',
               data-puesto= '".$puesto[1]."',
               data-localidad = '".$localidad[1]."',
               data-coordinador = '".$coordinador[1]."',
               data-perfil = '".$perfil[1]."',
               data-usuarion = '".$line['idpeticion']."'
               >Mandar datos</button></td>
               </tr>";
             }
             echo "</tbody>
             </table>";
             ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Slider -->
    <div class="col-sm-2">
      <div class="panel panel-default" id="busquedapor">
       <div class="" hidden>
         <label>Buscar por: </label>
       </div>
       <div class="radio-group" align="left" hidden>
         <div class="radio">
           <label><input type="radio" name="opcion" data-opcion = "usuario">Usuario.</label>
         </div>
         <div class="radio">
           <label><input type="radio" name="opcion" data-opcion = "herramienta">Herramienta.</label>
         </div>
       </div>
       <div align='left' class="usuario">
         <div class="form-group">
          <label for="usuario">Buscar usuario:</label>
          <input type="text" class="form-control" id="usuario" name="usuario">
        </div>
       </div>

       <div align='left' class="herramienta" hidden>
         <div class="form-group">
          <label for="herramienta">Buscar herramienta:</label>
          <input type="text" class="form-control" id="herramienta" name="herramienta">
        </div>
       </div>

       <div id="minibotones">
         <button type="button" id="bcancelar" class="btn btn-primary btn-xs">Cancelar</button>
         <button type="button" id="blimpiar" class="btn btn-default btn-xs">Limpiar</button>
       </div>

       </div>

       <div id="buscarhard" align='left' class="buscar" hidden>
         <div class="form-group">
          <label for="usuario">Buscar Hardware:</label>
          <input type="text" class="form-control" id="hard" name="usuario">
        </div>
       </div>

       <div id="buscarsoft" align='left' class="buscar" hidden>
         <div class="form-group">
          <label for="usuario">Buscar Software:</label>
          <input type="text" class="form-control" id="soft" name="usuario">
        </div>
       </div>

       <div id="herramientaseleccionada" class="panel panel-default">
         <h4>Herramientas Seleccionadas: </h4>
         <div id="shardware" class="panel panel-default">< Empty ></div>
         <div id="saccesorio" class="panel panel-default">< Empty ></div>
         <div id="ssoftware" class="panel panel-default">< Empty ></div>
         <button type='button' class='btn btn-default btn-block' id='bguardar' data-personal=''>Guardar</button>
         <button type='button' class='btn btn-default btn-block' id='bregresar'>Regresar</button>
       </div>

       <div id="nuevasignacion">
         <?php $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM peticion where atendido = 0");
         if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
         if($numrows != '0'){?>
          <button type='button' class='btn btn-block' data-toggle='modal' data-target='#Modalherramienta'>Petición de nuevo usuario</button>
        <?php } ?>
       </div>
     </div>

    <div id="mostrarherramientas" class="col-sm-6 panel panel-default" hidden>
      <div class="col-sm-12">
        <h3>Personal: <label id="nombrecompletos"></label></h3>
      </div>
      <div class="col-sm-4" id="" align="left">
        <h4>Hardware</h4>
        <input type="checkbox" value="1" id="hardware" name="check"/> Computadora<br/>
        <input type="checkbox" value="2" id="hardware" name="check"/> Telefonia<br/>
        <input type="checkbox" value="3" id="hardware" name="check"/> Impresora/Consumible<br/>
        <input type="checkbox" value="4" id="hardware" name="check"/> Accesorio<br/>
        <input type="checkbox" value="5" id="hardware" name="check"/> Almacenamiento<br/>
        <input type="checkbox" value="6" id="hardware" name="check"/> Red<br/>
      </div>
     <div class="col-sm-4" id="" align="left">
       <h4>Software</h4>
       <input type="checkbox" value="7" id="Software" name="check" /> Escritorio Remoto<br/>
       <!--<input type="checkbox" value="8" id="Software" name="check" /> Unidad de Red<br/> -->
       <input type="checkbox" value="8" id="Software" name="check" /> Contabilidad<br/>
       <input type="checkbox" value="9" id="Software" name="check" /> Facturación<br/>
       <input type="checkbox" value="10" id="Software" name="check" /> Giro<br/>
       <input type="checkbox" value="11" id="Software" name="check" /> Sistema de Tickets<br/>
       <input type="checkbox" value="12" id="Software" name="check" /> Giro Web<br/>
      </div>
      <div class="col-sm-4">
         <br><br>
         <input type="checkbox" value="13" id="Software" name="check" /> Correo<br/>
       </div>
       <div class="col-sm-12">
         <br><button id="btncancelar" class="btn btn-primary col-sm-6" type="button" name="button">Cancelar</button>
             <button id="btnsiguiente" class='btn btn-success col-sm-6' type="button" name="button">Siguiente</button>
       </div>
    </div>

    <div id="datosasignacion" class="col-sm-8"></div>
    <div class="col-sm-5" id="datosherramientas">
      <div id='Hard'></div>
    </div>

    <div id="datosherramientas2" class="col-sm-5">
      <div id='Soft'></div>

      <!-- <div align="left" id="uni" class="Software panel panel-success" hidden>
        <div class="panel-heading">Software: Unidad de Red</div>
        <div id="UnidadRed" class="panel-body">
          <div class="col-sm-2"></div>
        </div>
      </div> -->
    </div><!--<div id="asignacion" class="col-sm-5"></div><div class="col-sm-2"></div><div id="botones" class="col-sm-10"></div>-->

    <footer class="col-sm-12">
      <div class="container">
        <div class="row">
          <div class="col-sm- footer-copyright wow fadeIn">
            <p>&copy; <?php $año = date("Y"); echo $año; ?> Human Services 21</p>
          </div>
        </div>
      </div>
    </footer>
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

      <?php }elseif($_SESSION['departamento'] == "161 [RECLUTAMIENTO]" and $rh !== false){//echo "No es Sistemas.";?>
      <body>
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
              <li class="active"><a href="asignarherramientas.php"><i class="fa fa-edit" style="font-size:24px"></i><br>peticion herramientas</a></li>
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
        <!-- Slider -->

        <div class="col-sm-3" align="left">
         <h3 id="h2">Buscar personal: </h3>
          <input class="col-sm-12" type="textarea"  id="Pbuscar">
          <div id="presultado"></div>
        </div>

        <div class="fondo col-sm-6 panel panel-default">
         <div id="personaldatos"></div>
         <div id="linkherramienta"  hidden>
         <strong><h4>Herramientas<label id="personal"></label></h4></strong>
         <a data-toggle="collapse" data-target="#mostrarherramientas"><span class="glyphicon glyphicon-chevron-down"></span></a>
          </div>
         <div id="mostrarherramientas" class="collapse col-sm-12">
              <div class="col-sm-12"></div>
              <div class="col-sm-4" id="" align="left">
                <h4>Hardware</h4>
                <input type="checkbox" value="Computadora" class="hardware" name="check"/> Computadora<br/>
                <input type="checkbox" value="Telefonia" class="hardware" name="check"/> Telefonia<br/>
                <input type="checkbox" value="Impresora/Consumible" class="hardware" name="check"/> Impresora/Consumible<br/>
                <input type="checkbox" value="Accesorio" class="hardware" name="check"/> Accesorio<br/>
                <input type="checkbox" value="Almacenamiento" class="hardware" name="check"/> Almacenamiento<br/>
                <input type="checkbox" value="Red" class="hardware" name="check"/> Red<br/>
              </div>
             <div class="col-sm-4" id="" align="left">
               <h4>Software</h4>
               <input type="checkbox" value="ServidorVirtual" class="software" name="check" /> Servidor Virtual<br/>
               <!--<input type="checkbox" value="8" id="Software" name="check" /> Unidad de Red<br/> -->
               <input type="checkbox" value="Contabilidad" class="software" name="check" /> Contabilidad<br/>
               <input type="checkbox" value="Facturación" class="software" name="check" /> Facturación<br/>
               <input type="checkbox" value="Giro" class="software" name="check" /> Giro<br/>
               <input type="checkbox" value="SistemaTickets" class="software" name="check" /> Sistema de Tickets<br/>
               <input type="checkbox" value="GiroWeb" class="software" name="check" /> Giro Web<br/>
              </div>
              <div class="col-sm-4" align="left">
                 <br><br>
                 <input type="checkbox" value="Correo" class="software" name="check" /> Correo<br/>
               </div>
               <div class="col-sm-12"><br>
                 <div class="col-sm-6">
                   <button onclick="acancelar()" class="btn btn-primary col-sm-12" type="button" name="button">Cancelar</button>
                 </div>

                 <div class="col-sm-6">
                   <button id="btnenviar" class='btn btn-success col-sm-12' type="button" name="button">Enviar</button>
                 </div>
               </div>
           </div>
        </div>

        <div class="col-sm-3"></div>

        <footer class="col-sm-12">
          <div class="container">
            <div class="row">
              <div class="col-sm- footer-copyright wow fadeIn">
                <p>&copy; 2017 Human Services 21</p>
              </div>
            </div>
          </div>
        </footer>
        <!---->
          <!--  -->
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
