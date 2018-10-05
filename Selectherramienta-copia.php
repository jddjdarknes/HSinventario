<?php
include ('conexion.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Servicios con Sentido Humano - Human Services 21</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="assets/css/mystyle.css">
      <!-- CSS -->
  <style>
  </style>
  <script type="text/javascript">
    $(document).ready(function(){

      $( "#btnhard" ).click(function(){
        $("#hard").show();
      });

      $( "#btnsoft" ).click(function(){
        $("#soft").show();
      });

      $( ".button-group" ).on("click","button",function(){
        //alert("boton");
        $id = $(this).data("id");
        alert($id);
        $( ".button-group" ).hide();
        $( "#"+$id ).show();
      });

    });
  </script>
  </head>
  <body>
  <div class="container col-sm-12">
    <ul class="nav nav-pills">
      <li class="active"><a data-toggle="pill" href="#home">Hardware</a></li>
      <li><a data-toggle="pill" href="#menu1">Software</a></li>
    </ul>
  </div>
  </body>
</html>
