<?php
session_start();
include ('conexion.php');
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
         footer {position: absolute; bottom: 0px;  width: 100%;}
         #h2{background-color: #FFFEFE}
         #borrar{background-color:red;}
         #botonperfil,#botonpersonal{margin: 1px;}
         #btnperfil,#buscarperfil{margin: 2px;}
         #editar{margin: 6px;}
        </style>
        <script >
        function load(page){
          var parametros = {"action":"ajax","page":page};
                    $("#usuarios").fadeIn("slow");
                    $.ajax({
                        url:'usuario_ajax.php',
                        data: parametros,
                        beforeSend: function(objeto){
                         $("#usuarios").html("<img src='images/loader.gif'>");
                         },
                        success:function(data){
                          //$( "#usuarios" ).addClass( "" );
                          $("#usuarios").html(data).fadeIn("slow");
                          $("#loader").html("");
                        }
                    })
        }
        $(document).ready(function(){
          load(1);
        });
      </script>
  </head>
  <body>
    
  </body>
</html>
