<?php
session_start();
include ('conexion.php');
//echo "Perfil: ".$_SESSION['perfil']."<br>"

$cadena1 = $_SESSION['puesto'];
$rh = strpos($cadena1,"RECURSOS HUMANOS");
$sistemas = strpos($cadena1,"SISTEMAS");

function encriptar($cadena){
  $key='darks';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
  $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
  return $encrypted; //Devuelve el string encriptado
}

function desencriptar($cadena){
   $key='darks';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
   $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
   return $decrypted;  //Devuelve el string desencriptado
}

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
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/elegant-font/code/style.css">
      <link rel="stylesheet" href="assets/css/animate.css">
      <link rel="stylesheet" href="assets/css/magnific-popup.css">
      <link rel="stylesheet" href="assets/flexslider/flexslider.css">
      <link rel="stylesheet" href="assets/css/form-elements.css">
      <link rel="stylesheet" href="assets/css/style.css">
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
       #guardar,#limpiar{margin: 10px 10px 10px 10px;}
       /*footer {position: absolute; bottom: 0px;  width: 100%;}*/
       #h2{background-color: #FFFEFE}
       #borrar{background-color:red;}
       #botonperfil,#botonpersonal{margin: 1px;}
       #btnsiguiente{background-color:green;}
       #btnsiguiente:hover {background-color: #003300; color: white;}
       #cancelar{margin: 6px;}
       .btn{height: 30px; margin: 0; padding: 0 20px; vertical-align: middle;
            background: #0089ff; border: 0; font-family: 'Open Sans', sans-serif;
            font-weight: 400;
            line-height: 30px;
            color: #fff;
            text-shadow: none;
            -moz-border-radius: 0;
            -webkit-border-radius: 0;
            border-radius: 0;
            -moz-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
            -webkit-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
            box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
            -o-transition: all .3s;
            -moz-transition: all .3s;
            -webkit-transition: all .3s;
            -ms-transition: all .3s;
            transition: all .3s;
          }
        </style>
        <script >
        function Limpiar(){
          $( "input" ).val("");
          //$( "select" ).address("<option></option>");
        }

        function acancelar(){
          /*$( "#actualizar" ).hide();
          $( "#botones" ).empty();
          $( "#boton" ).empty();*/
          location.reload();
          //alert("Cancelar");
        }

        function carga(page){
          $.post( "usuario_ajax.php", { action:"ajax",page:page, usuario:"personal"},function( data ) {
            $( "#personal" ).html( data );
          });
        }

        $(document).ready(function(){
          $( "#bpersonal" ).focus();
          //Aqui empiezan las funciones de Manejo de personal.
          var nuevosdatos = Array();
          var asignarharware = Array();
          var asignarsofware = Array();
          $conta=0;

          $( "#btn" ).on("click","#btnsiguiente",function(){
            $lleno=0;
            $alert=false;
            //alert("siguiente");
            /**/
            //$conta ++;
            $( ".form-control" ).each(function(){
              $texto = $(this).val();
              if($texto == ""){
                $(this).focus();
              }else{
                $lleno ++;
              }
            });

            if( $lleno == 7){
              $( "#nuevosdatos" ).hide();
              $( "#btn" ).hide();
              $( "#mostrarherramientas").show();
              nuevosdatos.push("Nombre(s): "+$( "#nombre" ).val(),"Apellidos: "+$("#apellidos" ).val(),"Departamento: "+$( "#departamento" ).val());
              nuevosdatos.push("Puesto: "+$( "#puesto" ).val(),"Localidad: "+$( "#localidad" ).val(),"Coordinador: "+$( "#coordinador" ).val(),"Perfil: "+$( "#perfil" ).val());
              $alert=true;
            }else{alert("No puede aver campos vacios.");}
            /*for (var i = 0; i < nuevosdatos.length; i++) {
             alert("Nuevos datos: "+nuevosdatos[i] );
             alert("Contador: "+$lleno);
           }*/
          });

          $( "#botones" ).on("click",".cancelar",function(){
            //alert("Cancelar");
            location.reload();
          });

          $( "#btnguardar" ).click(function(){
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

              /*for (var i = 0; i < asignarharware.length; i++) {
                alert("Hardware: "+asignarharware[i]);
              }*/

              /*for (var i = 0; i < asignarsofware.length; i++) {
                alert("Software: "+asignarsofware[i]);
              }*/

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

          $("#Modalusuario").on("click","#botonmandar",function(){
            $id=$(this).data('id');
            //alert("IDpeticion: "+$id);
            $nombre=$(this).data('nombre');
            $apellidos=$(this).data('apellidos');
            $departamento=$(this).data('departamento');
            $localidad=$(this).data('localidad');
            $coordinador=$(this).data('coordinador');
            $perfil=$(this).data('perfil');
            $puesto=$(this).data('puesto');
            //alert("Perfil: "+$perfil);
            $( "#peticion" ).val($id);
            $( "#nombre" ).val($nombre);
            $( "#apellidos" ).val($apellidos);
            $( "#departamento" ).val($departamento);
            $( "#puesto" ).val($puesto);
            $( "#localidad" ).val($localidad);
            $( "#coordinador" ).append("<option selected='selected'>"+$coordinador+"</option>");
            $( "#perfil" ).append("<option selected='selected'>"+$perfil+"</option>");
            $( "#nuevo" ).show();
            $( "#boton" ).empty();
            //$( "#datos" ).html("");
            $( "#botones" ).html( "<button id='guardar' class='btn' type='submit' name='button'>Guardar</button>"+
                                  "<button onclick='Limpiar()' id='limpiar' class='btn' type='button' name='button'>Limpiar</button>"+
                                  "<button onclick='acancelar()' id='cancelar' class='btn' type='button' name='button'>Cancelar</button>");
            //$( "#actualizar" ).html("");

          });
          //Aqui terminan.

          //load(1);
          //carga(1);

          $("#bperfil").keyup(function(e){
              //obtenemos el texto introducido en el campo de búsqueda
              var consulta = $("#bperfil").val();
              //alert("Si: "+consulta);
              //hace la búsqueda
              $.post( "searchperfil.php", { perfil: consulta},function( data ) {
                $( "#perfil" ).html( data );
              });
          });

          $("#bpersonal").keyup(function(e){
              //obtenemos el texto introducido en el campo de búsqueda
              var consulta = $("#bpersonal").val();
              //alert("Si2: "+consulta);
              //hace la búsqueda
              if(consulta == ""){
                 //$("#personal").load("#personal");
                 $("#personal").load(location.href + " #accordion");
              }else{
                $.post( "searchpersonal.php", { personal: consulta},function( data ) {
                  $( "#personal" ).html( data );
                });
              }
          });

        $("#personal").on("click",".btn#borrar",function(){
            alert("Borrar Personal");
            $id = $(this).data('id');
            $usuario = $(this).data('usuario');
            $.post( "deleteusuario.php", {id : $id, usuario : $usuario},function( data ) {
              $( '#boton' ).empty();
              $( '#actualizar' ).html(data);
            });
          });

          /*$("#personal").on("click",".btn#editar",function(){
            alert("Editar");
          });*/

          $("#boton").on("click",".btn#editar",function(){
                $id = $(this).data("id");
                //alert("id: "+$id);
                $user = $('#euser').val();
                //alert("user: "+$user);
                $password = $('#epassword').val();
                //alert("contraseña: "+$password);
                $nombre = $('#enombre').val();
                $apellidos = $('#eapellidos').val();
                $departamento = $('#edepartamento').val();
                $puesto = $("#epuesto").val();
                //alert("puesto: "+$puesto);
                $localidad = $('#elocalidad').val();
                $coordinador = $('#ecoordinador').val();
                $perfil = $( '#eperfil' ).val();
                $estatus = $( '#estatus' ).val();
                //if($nombre != "" && $apellidos !="" && $departamento != "" &&   $localidad != "" && $coordinador != "" && $user != "" && $password !="" && $perfil != "")
                //{
                  $.post( "Updateusuario.php",{
                    id : $id,
                    user : $user,
                    password : $password,
                    nombre : $nombre,
                    apellidos : $apellidos,
                    departamento : $departamento,
                    puesto : $puesto,
                    localidad : $localidad,
                    coordinador : $coordinador,
                    perfil : $perfil,
                    estatus : $estatus
                  },function( data ) {
                    $( '#boton' ).empty();
                    $( '#actualizar' ).html(data);
                  });
                  location.reload();
                //}else{alert("Los campos no pueden estar vacios.");}
                //alert("$"+$id+","+$nombre+","+$apellidos+","+$departamento+","+$localidad+","+$coordinador+","+$perfil+"/$/");
          });

          //$( ".btn#botonperfil" ).click(function() {});
          $("#personal").on("click",".btn#botonpersonal",function(){
            $id=$(this).data('id');
            $nombre=$(this).data('nombre');
            $apellidos=$(this).data('apellidos');
            $usuario=$(this).data('usuario');
            $contrasena=$(this).data('contraseña');
            $departamento=$(this).data('departamento');
            $localidad=$(this).data('localidad');
            $coordinador=$(this).data('coordinador');
            $perfil=$(this).data('perfil');
            $puesto=$(this).data('puesto');
            $estatus=$(this).data('estatus');
            if($estatus == 1){
            $( "#status" ).html(
            "<label class='control-label col-sm-3' for='perfil'>Estatus: </label>"+
            "<div class='col-sm-8'>"+
              "<select class='form-control' id='estatus' name='estatus'>"+
                "<option value='1'>Alta</option>"+
                "<option value='0'>Baja</option>"+
              "</select>"+
            "</div>");}
            if($estatus == 0){
              $( "#status" ).html(
              "<label class='control-label col-sm-3' for='perfil'>Estatus: </label>"+
              "<div class='col-sm-8'>"+
                "<select class='form-control' id='estatus' name='estatus'>"+
                  "<option value='0'>Baja</option>"+
                  "<option value='1'>Alta</option>"+
                "</select>"+
              "</div>");
            }
            //alert("Perfil: "+$perfil);
            $( "#nombrecompleto" ).html($nombre+" "+$apellidos);
            $( "#enombre" ).val($nombre);
            $( "#eapellidos" ).val($apellidos);
            $( "#euser" ).val($usuario);
            $( "#epassword" ).val($contrasena);
            $( "#edepartamento" ).val($departamento);
            $( "#epuesto" ).val($puesto);
            $( "#elocalidad" ).val($localidad);
            //$( "#ecoordinador" ).val($coordinador);
            $( "#ecoordinador" ).append("<option selected='selected'>"+$coordinador+"</option>");
            //$( "#estatus" ).append("<option selected='selected'>"+$estatus+"</option>");
            $( "#eperfil" ).val($perfil);
            $( "#actualizar" ).show();
            $( "#nuevo" ).hide();
            $( "#botones" ).empty();
            //$( "#actualizar" ).html("");
            $( "#boton" ).html( "<button id='editar' data-id = '"+$id+"' class='btn' type='submit' name='button'>Editar</button><button id='cancelar' onclick = 'Limpiar()' class='btn' type='button' name='button'>Limpiar</button><button id='cancelar' onclick = 'acancelar()' class='btn' type='button' name='button'>Cancelar</button>" );
          });

          $( "#btnperfil" ).click(function() {
           $( "#boton" ).empty();
           $( "#datos" ).html("<div class='form-group col-sm-12'>"+
                               "<div id='fondo' align='left'> <h2 id='h2'>Nuevo Perfil:</h2>"+
                               "</div><label class='control-label col-sm-3' for='user'>Departamento: </label>"+
                               "<div class='col-sm-9'><input type='textbox' class='form-control' name='user' id='user' placeholder='Introdusca el Departamento' required>"+
                               "</div>"+
                               "</div>"+
                               "<div class='form-group col-sm-12'><label class='control-label col-sm-3' for='password'>Contraseña:</label>"+
                               "<div class='col-sm-9'><input type='textbox' class='form-control' name='password' id='password' placeholder='Introdusca contraseña.' required>"+
                               "</div>"+
                               "</div>");
           $( "#botones" ).html("<button id='guardar' class='btn' type='submit' name='button'>Guardar</button>"+
                                "<button onclick='Limpiar()' id='limpiar' class='btn' type='button' name='button'>Limpiar</button>"+
                                "<button onclick='acancelar()' id='cancelar' class='btn' type='button' name='button'>Cancelar</button>");
         });

          $( "#btnpersonal" ).click(function() {
            //alert("personal");
            $( "#actualizar" ).hide();
            $( "#nuevo" ).show();
            $( "#boton" ).empty();
            //$( "#datos" ).html("");
            $( "#botones" ).html( "<button id='guardar' class='btn' type='submit' name='button'>Guardar</button>"+
                                  "<button onclick='Limpiar()' id='limpiar' class='btn' type='button' name='button'>Limpiar</button>"+
                                  "<button onclick='acancelar()' id='cancelar' class='btn' type='button' name='button'>Cancelar</button>");
         });

        });
        </script>
    </head>
    <?php  if($_SESSION['departamento'] == '192 [SISTEMAS]' and $sistemas !== false){?>
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
         <li class="active"><a href="altausuario.php"><i style="font-size:24px" class="fa fa-user-plus"></i><br>Alta usuario</a></li>
         <li><a href="altaherramienta.php"><i style="font-size:24px" class="fa fa-desktop"></i><br>Alta equipo</a></li>
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

        <!-- Slider -->
        <div class="slider-container">
          <div class="col-sm-2">
            <div class="" align="left">
              <h3 id="h2">Nuevo usuario.</h3>
              <!-- <button id="btnperfil" class="btn" type="button" name="button"></button>-->
              <button id="btnpersonal" class="btn btn-block" type="button" name="button">Usuario</button>
            </div>

            <div class="" align="left">
             <h3 id="h2">Buscar usuario.</h3>
              <input class="col-sm-12" type="textarea"  id="bpersonal" >
            </div>

            <div><br>
            <?php
            $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM peticion where atendido = 1");
            if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
            if($numrows != '0'){
               echo "<button type='button' class='btn btn-block' data-toggle='modal' data-target='#Modalusuario'>Petición de nuevo usuario</button>";
              /*$parts = explode(",",$frace);
              print_r($parts);*/
            }
            ?>
           </div>
          </div>

          <!-- Modal -->
          <div id="Modalusuario" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Petición de nuevo usuario</h4>
                </div>
                <div class="modal-body">
                  <p><?php
                   $sql = "SELECT * FROM peticion where atendido != 0";
                   $resultado = sqlsrv_query($conexion,$sql);
                   echo "<table class='table table-striped'>
                          <thead>
                          <tr>
                            <th>Nombre(s)</th>
                            <th>Apellidos</th>
                            <th>Departamento</th>
                            <th>Puesto</th>
                            <th>Localidad</th>
                            <th>Coordinador</th>
                            <th>Perfil</th>
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
                     echo "<tr>
                     <td>".$nombre[1]."</td>";
                     echo "<td>".$apellido[1]."</td>";
                     echo "<td>".$departamento[1]."</td>";
                     echo "<td>".$puesto[1]."</td>";
                     echo "<td>".$localidad[1]."</td>";
                     echo "<td>".$coordinador[1]."</td>";
                     echo "<td>".$perfil[1]."</td>";
                     echo "<td align='right'><button id='botonmandar' class='btn btn-xs' type='button' name='button' data-dismiss='modal'
                     data-id = '".$line['idpeticion']."',
                     data-nombre='".$nombre[1]."',
                     data-apellidos='".$apellido[1]."',
                     data-departamento='".$departamento[1]."',
                     data-puesto='".$puesto[1]."',
                     data-localidad='".$localidad[1]."',
                     data-coordinador='".$coordinador[1]."',
                     data-perfil='".$perfil[1]."''
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

          <div class="fondo col-sm-5 panel panel-default">
              <form id='form' class="form-horizontal" action="Insertusuario.php" method="POST" enctype='multipart/form-data'>
                <div id="datos">
                 <div id="nuevo" hidden>
                  <div class='form-group col-sm-12'>
                    <div id='fondo' align='left'> <h2 id='h2'>Nuevo Usuario:</h2> </div>
                    <label class='control-label col-sm-3' for='usuario'>Usuario (ID): </label>
                    <div class='col-sm-9'>
                      <input type='textbox' class='form-control' id='usuario' name = 'usuario' placeholder='Ingrese usuario(ID).' required>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='contraseña'>Contraseña: </label>
                    <div class='col-sm-9'>
                      <input type='textbox' class='form-control' id='contraseña' name = 'contraseña' placeholder='Ingrese contraseña.' required>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='nombre'>Nombre(s): </label>
                    <div class='col-sm-9'>
                      <input type='textbox' class='form-control' name='nombre' id='nombre' placeholder='Ingrese nombre' required>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='apellidos'>Apellidos: </label>
                    <div class='col-sm-9'>
                      <input type='textbox' class='form-control' id='apellidos' name = 'apellidos' placeholder='Ingrese apellidos.' required>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='departamento'>Departamento: </label>
                    <div class='col-sm-9'>
                      <input type='textbox' class='form-control' name = 'departamento' id='departamento' placeholder='Ingrese departamento.'>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='puesto'>Puesto: </label>
                    <div class='col-sm-9'>
                      <input type='textbox' class='form-control' name = 'puesto' id='puesto' placeholder='Ingrese puesto.'>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='localidad'>Localidad: </label>
                    <div class='col-sm-9'>
                      <input type='textbox' class='form-control' name = 'localidad' id='localidad' placeholder='Ingrese localidad.'>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='coordinador'>Coordinador: </label>
                    <div class='col-sm-9'>
                      <select class='form-control' id='coordinador' name='coordinador'>
                        <option value=""></option>
                        <?php
                        $sql = "Select * from personal where perfil = 'Coordinador' and estatus != '0';";
                        $resultado = sqlsrv_query($conexion,$sql);
                        while( $rows = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC) ) {
                          echo "<option value='".$rows['Nombres']." ".$rows['apellidos']."'>".$rows['Nombres']." ".$rows['apellidos']."</option>";
                        }
                        ?>
                        <!-- Ingrid Vasquez Rios</option> -->
                      </select>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='perfil'>Perfil: </label>
                    <div class='col-sm-9'>
                      <select class='form-control' id='perfil' name='perfil'>
                        <option value=''></option>
                        <option value='Sistemas'>Sistemas</option>
                        <option value='Coordinador'>Coordinador</option>
                        <option value='Recursos Humanos'>Recursos Humanos</option>
                        <option value='Usuario'>Usuario</option>
                      </select>
                    </div>
                  </div>
                  <input type='textbox' class='form-control' id='peticion' name = 'peticion' style="visibility:hidden">

                </div>
              </div>
                <div id="botones"></div>
              </form>

              <div id="actualizar" hidden> <div id='fondo' align='left'> <h2 id='h2'>Personal: <lavel id='nombrecompleto'></lavel></h2></div>

                <div class='form-group col-sm-12'>
                  <label class='control-label col-sm-3' for='user'>usuario: </label>
                  <div class='col-sm-8'>
                    <input value = '' type='textbox' class='form-control' id='euser' name = 'euser' required>
                  </div>
                </div>

                <div class='form-group col-sm-12'>
                  <label class='control-label col-sm-3' for='password'>Contraseña: </label>
                  <div class='col-sm-8'>
                    <input value = '' type='textbox' class='form-control' id='epassword' name = 'epassword'>
                  </div>
                </div>

                <div class='form-group col-sm-12'>
                  <label class='control-label col-sm-3' for='nombre'>Nombre(s): </label>
                  <div class='col-sm-8'>
                    <input value='' type='textbox' class='form-control' name='enombre' id='enombre'>
                  </div>
                </div>

                <div class='form-group col-sm-12'>
                  <label class='control-label col-sm-3' for='apellidos'>Apellidos: </label>
                  <div class='col-sm-8'>
                    <input value = '' type='textbox' class='form-control' id='eapellidos' name = 'eapellidos'>
                  </div>
                </div>

                <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='departamento'>Departamento: </label>
                    <div class='col-sm-8'>
                      <input value = '' type='textbox' class='form-control' name = 'edepartamento' id='edepartamento'>
                  </div>
                </div>

                <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='puesto'>Puesto: </label>
                    <div class='col-sm-8'>
                      <input value = '' type='textbox' class='form-control' name = 'epuesto' id='epuesto'>
                  </div>
                </div>

                <div class='form-group col-sm-12'>
                  <label class='control-label col-sm-3' for='localidad'>Localidad: </label>
                  <div class='col-sm-8'>
                    <input value = '' type='textbox' class='form-control' name = 'elocalidad' id='elocalidad'>
                  </div>
                </div>

                <div class='form-group col-sm-12'>
                  <label class='control-label col-sm-3' for='coordinador'>Coordinador: </label>
                  <div class='col-sm-8'>
                    <select class='form-control' id='ecoordinador' name='ecoordinador'>
                      <?php
                      $sql = "Select * from personal where perfil = 'Coordinador' and estatus != '0';";
                      $resultado = sqlsrv_query($conexion,$sql);
                      while( $rows = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC) ) {
                        echo "<option value='".$rows['Nombres']." ".$rows['apellidos']."'>".$rows['Nombres']." ".$rows['apellidos']."</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='form-group col-sm-12'>
                  <label class='control-label col-sm-3' for='perfil'>Perfil: </label>
                  <div class='col-sm-8'>
                    <select class='form-control' id='eperfil' name='perfil'>
                      <option value='Sistemas'>Sistemas</option>
                      <option value='Coordinador'>Coordinador</option>
                      <option value='Recursos Humanos'>Recursos Humanos</option>
                      <option value='Usuario'>Usuario</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-sm-12" id='status'> </div>
              </div>
              <div id="boton"></div>
          </div>
          <div class="col-sm-5">
            <div id="personal" class="col-sm-12 panel panel-default">
              <div class="panel-group" id="accordion"><h3>Personal Registrado:</h3>
                  <?php $contador = 0;
                  $query = "select nombredepartamento
                            from servicio.dbo.departamento";
                  $consulta = sqlsrv_query($conexion,$query);
                  while ($rows = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) {
                  echo "
                  <div class='panel panel-default'>
                  <div class='panel-heading'>
                    <h4 class='panel-title'>
                      <a data-toggle='collapse' data-parent='#accordion' href='#collapse".$contador."'>".$rows['nombredepartamento']."</a>
                    </h4>
                  </div>";

                  echo "<div id='collapse".$contador."' class='panel-collapse collapse'>
                    <div class='panel-body'>";
                    $quer = "select * from personal where departamentopersonal = '".$rows['nombredepartamento']."' and estatus !=0 ";
                    $cons = sqlsrv_query($conexion,$quer);
                    echo"
                    <table width=100%>
                     <ul>";
                    while ($row = sqlsrv_fetch_array($cons,SQLSRV_FETCH_ASSOC)) {
                      echo"
                      <tr>
                       <td>
                       <li align='left' align='left' style='list-style:none;'>".$row['Nombres']." ".$row['apellidos']."</li>
                       </td>
                       <td align='right'>
                       <a href='#form' id = 'botonpersonal' class='btn btn-xs' role='button' name='button'
                       data-id='".$row['idpersonal']."',
                       data-nombre='".$row['Nombres']."',
                       data-apellidos='".$row['apellidos']."',
                       data-usuario='".desencriptar($row['usuario'])."',
                       data-contraseña='".desencriptar($row['contrasena'])."',
                       data-departamento='".$row['departamentopersonal']."',
                       data-puesto='".$row['puesto']."',
                       data-localidad='".$row['localidad']."',
                       data-coordinador='".$row['coordinador']."',
                       data-perfil='".$row['perfil']."',
                       data-estatus='".$row['estatus']."''
                       >Editar</a>
                       <button id='borrar' data-id ='".$row['idpersonal']."' data-usuario = 'personal' class='btn btn-xs' type='button' name='button'>Borrar</button>
                       </td>
                       </tr>";
                      }
                      echo "</ul></table>";
                      echo "
                      </div>
                    </div>
                  </div>";
                  $contador ++;
                }
                  ?>
                  </div>
              </div>
          </div>
          <div class="col-sm-12">
            <footer>
              <div class="container">
                <div class="row">
                  <div class="col-sm- footer-copyright wow fadeIn">
                    <p>&copy; <?php $año = date("Y"); echo $año; ?> Human Services 21</p>
                  </div>
                </div>
              </div>
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
           <li class="active"><a href="altausuario.php"><i style="font-size:24px" class="fa fa-user-plus"></i><br>Alta usuario</a></li>
           <li><a href="asignarherramientas.php"><i class="fa fa-edit" style="font-size:24px"></i><br>peticion herramientas</a></li>
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
          <div class="slider-container">
            <div class="col-sm-2">
              <div class="" align="left">
                <h3 id="h2">Nuevo usuario.</h3>
                <!-- <button id="btnperfil" class="btn" type="button" name="button"></button>-->
                <button id="btnpersonal" class="btn btn-block" type="button" name="button">Usuario</button>
              </div>

              <div class="" align="left">
               <h3 id="h2">Buscar usuario.</h3>
                <input class="col-sm-12" type="textarea"  id="bpersonal" >
              </div>

              <div><br>
              <?php
              $count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM peticion where atendido = 1");
              if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
              if($numrows != '0'){
                 echo "<button type='button' class='btn btn-block' data-toggle='modal' data-target='#Modalusuario'>Petición de nuevo usuario</button>";
                /*$parts = explode(",",$frace);
                print_r($parts);*/
              }
              ?>
             </div>
            </div>

            <!-- Modal -->
            <div id="Modalusuario" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Petición de nuevo usuario</h4>
                  </div>
                  <div class="modal-body">
                    <p><?php
                     $sql = "SELECT * FROM peticion where atendido != 0";
                     $resultado = sqlsrv_query($conexion,$sql);
                     echo "<table class='table table-striped'>
                            <thead>
                            <tr>
                              <th>Nombre(s)</th>
                              <th>Apellidos</th>
                              <th>Departamento</th>
                              <th>Puesto</th>
                              <th>Localidad</th>
                              <th>Coordinador</th>
                              <th>Perfil</th>
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
                       echo "<tr>
                       <td>".$nombre[1]."</td>";
                       echo "<td>".$apellido[1]."</td>";
                       echo "<td>".$departamento[1]."</td>";
                       echo "<td>".$puesto[1]."</td>";
                       echo "<td>".$localidad[1]."</td>";
                       echo "<td>".$coordinador[1]."</td>";
                       echo "<td>".$perfil[1]."</td>";
                       echo "<td align='right'><button id='botonmandar' class='btn btn-xs' type='button' name='button' data-dismiss='modal'
                       data-id = '".$line['idpeticion']."',
                       data-nombre='".$nombre[1]."',
                       data-apellidos='".$apellido[1]."',
                       data-departamento='".$departamento[1]."',
                       data-puesto='".$puesto[1]."',
                       data-localidad='".$localidad[1]."',
                       data-coordinador='".$coordinador[1]."',
                       data-perfil='".$perfil[1]."''
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

            <div class="fondo col-sm-5 panel panel-default">
                <form id='form' class="form-horizontal" action="Insertusuario.php" method="POST" enctype='multipart/form-data'>
                  <div id="datos">
                   <div id="nuevo" hidden>
                    <div class='form-group col-sm-12'>
                      <div id='fondo' align='left'> <h2 id='h2'>Nuevo Usuario:</h2> </div>
                      <label class='control-label col-sm-3' for='usuario'>Usuario (ID): </label>
                      <div class='col-sm-9'>
                        <input type='textbox' class='form-control' id='usuario' name = 'usuario' placeholder='Ingrese usuario(ID).' required>
                      </div>
                    </div>

                    <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='contraseña'>Contraseña: </label>
                      <div class='col-sm-9'>
                        <input type='textbox' class='form-control' id='contraseña' name = 'contraseña' placeholder='Ingrese contraseña.' required>
                      </div>
                    </div>

                    <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='nombre'>Nombre(s): </label>
                      <div class='col-sm-9'>
                        <input type='textbox' class='form-control' name='nombre' id='nombre' placeholder='Ingrese nombre' required>
                      </div>
                    </div>

                    <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='apellidos'>Apellidos: </label>
                      <div class='col-sm-9'>
                        <input type='textbox' class='form-control' id='apellidos' name = 'apellidos' placeholder='Ingrese apellidos.' required>
                      </div>
                    </div>

                    <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='departamento'>Departamento: </label>
                      <div class='col-sm-9'>
                        <input type='textbox' class='form-control' name = 'departamento' id='departamento' placeholder='Ingrese departamento.'>
                      </div>
                    </div>

                    <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='puesto'>Puesto: </label>
                      <div class='col-sm-9'>
                        <input type='textbox' class='form-control' name = 'puesto' id='puesto' placeholder='Ingrese puesto.'>
                      </div>
                    </div>

                    <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='localidad'>Localidad: </label>
                      <div class='col-sm-9'>
                        <input type='textbox' class='form-control' name = 'localidad' id='localidad' placeholder='Ingrese localidad.'>
                      </div>
                    </div>

                    <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='coordinador'>Coordinador: </label>
                      <div class='col-sm-9'>
                        <select class='form-control' id='coordinador' name='coordinador'>
                          <option value=""></option>
                          <?php
                          $sql = "Select * from personal where perfil = 'Coordinador' and estatus != '0';";
                          $resultado = sqlsrv_query($conexion,$sql);
                          while( $rows = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC) ) {
                            echo "<option value='".$rows['Nombres']." ".$rows['apellidos']."'>".$rows['Nombres']." ".$rows['apellidos']."</option>";
                          }
                          ?>
                          <!-- Ingrid Vasquez Rios</option> -->
                        </select>
                      </div>
                    </div>

                    <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='perfil'>Perfil: </label>
                      <div class='col-sm-9'>
                        <select class='form-control' id='perfil' name='perfil'>
                          <option value=''></option>
                          <option value='Sistemas'>Sistemas</option>
                          <option value='Coordinador'>Coordinador</option>
                          <option value='Recursos Humanos'>Recursos Humanos</option>
                          <option value='Usuario'>Usuario</option>
                        </select>
                      </div>
                    </div>
                    <input type='textbox' class='form-control' id='peticion' name = 'peticion' style="visibility:hidden">

                  </div>
                </div>
                  <div id="botones"></div>
                </form>

                <div id="actualizar" hidden> <div id='fondo' align='left'> <h2 id='h2'>Personal: <lavel id='nombrecompleto'></lavel></h2></div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='user'>usuario: </label>
                    <div class='col-sm-8'>
                      <input value = '' type='textbox' class='form-control' id='euser' name = 'euser' required>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='password'>Contraseña: </label>
                    <div class='col-sm-8'>
                      <input value = '' type='textbox' class='form-control' id='epassword' name = 'epassword'>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='nombre'>Nombre(s): </label>
                    <div class='col-sm-8'>
                      <input value='' type='textbox' class='form-control' name='enombre' id='enombre'>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='apellidos'>Apellidos: </label>
                    <div class='col-sm-8'>
                      <input value = '' type='textbox' class='form-control' id='eapellidos' name = 'eapellidos'>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='departamento'>Departamento: </label>
                      <div class='col-sm-8'>
                        <input value = '' type='textbox' class='form-control' name = 'edepartamento' id='edepartamento'>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                      <label class='control-label col-sm-3' for='puesto'>Puesto: </label>
                      <div class='col-sm-8'>
                        <input value = '' type='textbox' class='form-control' name = 'epuesto' id='epuesto'>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='localidad'>Localidad: </label>
                    <div class='col-sm-8'>
                      <input value = '' type='textbox' class='form-control' name = 'elocalidad' id='elocalidad'>
                    </div>
                  </div>

                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='coordinador'>Coordinador: </label>
                    <div class='col-sm-8'>
                      <select class='form-control' id='ecoordinador' name='ecoordinador'>
                        <?php
                        $sql = "Select * from personal where perfil = 'Coordinador' and estatus != '0';";
                        $resultado = sqlsrv_query($conexion,$sql);
                        while( $rows = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC) ) {
                          echo "<option value='".$rows['Nombres']." ".$rows['apellidos']."'>".$rows['Nombres']." ".$rows['apellidos']."</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class='form-group col-sm-12'>
                    <label class='control-label col-sm-3' for='perfil'>Perfil: </label>
                    <div class='col-sm-8'>
                      <select class='form-control' id='eperfil' name='perfil'>
                        <option value='Sistemas'>Sistemas</option>
                        <option value='Coordinador'>Coordinador</option>
                        <option value='Recursos Humanos'>Recursos Humanos</option>
                        <option value='Usuario'>Usuario</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-sm-12" id='status'> </div>
                </div>
                <div id="boton"></div>
            </div>
            <div class="col-sm-5">
              <div id="personal" class="col-sm-12 panel panel-default">
                <div class="panel-group" id="accordion"><h3>Personal Registrado:</h3>
                    <?php $contador = 0;
                    $query = "select nombredepartamento
                              from servicio.dbo.departamento";
                    $consulta = sqlsrv_query($conexion,$query);
                    while ($rows = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) {
                    echo "
                    <div class='panel panel-default'>
                    <div class='panel-heading'>
                      <h4 class='panel-title'>
                        <a data-toggle='collapse' data-parent='#accordion' href='#collapse".$contador."'>".$rows['nombredepartamento']."</a>
                      </h4>
                    </div>";

                    echo "<div id='collapse".$contador."' class='panel-collapse collapse'>
                      <div class='panel-body'>";
                      $quer = "select * from personal where departamentopersonal = '".$rows['nombredepartamento']."' and estatus !=0 ";
                      $cons = sqlsrv_query($conexion,$quer);
                      echo"
                      <table width=100%>
                       <ul>";
                      while ($row = sqlsrv_fetch_array($cons,SQLSRV_FETCH_ASSOC)) {
                        echo"
                        <tr>
                         <td>
                         <li align='left' align='left' style='list-style:none;'>".$row['Nombres']." ".$row['apellidos']."</li>
                         </td>
                         <td align='right'>
                         <a href='#form' id = 'botonpersonal' class='btn btn-xs' role='button' name='button'
                         data-id='".$row['idpersonal']."',
                         data-nombre='".$row['Nombres']."',
                         data-apellidos='".$row['apellidos']."',
                         data-usuario='".desencriptar($row['usuario'])."',
                         data-contraseña='".desencriptar($row['contrasena'])."',
                         data-departamento='".$row['departamentopersonal']."',
                         data-puesto='".$row['puesto']."',
                         data-localidad='".$row['localidad']."',
                         data-coordinador='".$row['coordinador']."',
                         data-perfil='".$row['perfil']."',
                         data-estatus='".$row['estatus']."''
                         >Editar</a>
                         <button id='borrar' data-id ='".$row['idpersonal']."' data-usuario = 'personal' class='btn btn-xs' type='button' name='button'>Borrar</button>
                         </td>
                         </tr>";
                        }
                        echo "</ul></table>";
                        echo "
                        </div>
                      </div>
                    </div>";
                    $contador ++;
                  }
                    ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
              <footer>
                <div class="container">
                  <div class="row">
                    <div class="col-sm- footer-copyright wow fadeIn">
                      <p>&copy; <?php $año = date("Y"); echo $año; ?> Human Services 21</p>
                    </div>
                  </div>
                </div>
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
