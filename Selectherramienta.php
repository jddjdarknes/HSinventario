<?php
include ('conexion.php');
?>
<!DOCTYPE html>
<html>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="assets/css/mystyle.css">
    <!-- CSS -->
  </head>
  <style>

  </style>
  <script type="text/javascript">
  function load(page,herramienta){
    //alert("Herramienta: "+herramienta+" pag: ");
    $.post( "Herramienta_ajax.php", { action:"ajax",page:page,herramienta:herramienta },function( data ) {
      $( "#"+herramienta ).html( data );
    });
  }

  function loading(page,herramienta){
    //alert("Herramienta: "+herramienta+" pag: ");
    $.post( "Software_ajax.php", { action:"ajax",page:page,herramienta:herramienta },function( data ) {
      $( "#"+herramienta ).html( data );
    });
  }
    $(document).ready(function(){
      $( "#btnhard" ).click(function(){
        $("#hard").show();
      });

      $( "#btnsoft" ).click(function(){
        $("#soft").show();
      });

      $( ".button-group" ).on("click","button",function(){
        //alert("boton");
        $id = $(this).data( "id" );
        //alert("ID: "+$id);
        if($id == 'complemento'){$("#complemento").show()}

        if($id == 'computer'){
          $tipo1 = "Escritorio";
          $tipo2 = "Laptop";
          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo1},function( data ) {
            $( "#Escritorio" ).html( data );
          });

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo2},function( data ) {
            $( "#Laptop" ).html( data );
          });
        }

        if($id == 'telefonia'){
          $tipo1 = "FijoTD";
          $tipo2 = "FijoTA";
          $tipo3 = "FijoTIP";
          $tipo4 = "FijoTI";
          $tipo5 = "MovilCelular";
          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo1},function( data ) {
            $( "#FijoTD" ).html( data );
          });
          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo2},function( data ) {
            $( "#FijoTA" ).html( data );
          });

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo3},function( data ) {
            $( "#FijoTIP" ).html( data );
          });

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo4},function( data ) {
            $( "#FijoTI" ).html( data );
          });

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo5},function( data ) {
            $( "#MovilCelular" ).html( data );
          });
        }

        if($id == 'impresora'){
          $tipo1 = "impresoraMono";
          //alert("Tipo1: "+$tipo1);
          $tipo2 = "impresoraMultiB/N";
          //alert("Tipo2: "+$tipo2);
          $tipo3 = "impresoraMultiColor";
          //alert("Tipo3: "+$tipo3);
          $tipo4 = "impresoraColor";
          //alert("Tipo4: "+$tipo4);
          $tipo5 = "impresoraCredencial";
          //alert("Tipo5: "+$tipo5);
          $tipo6 = "ConsumibleToner";
          //alert("Tipo6: "+$tipo6);
          $tipo7 = "ConsumibleTambor";
          //alert("Tipo7: "+$tipo7);
          $tipo8 = "TargetaPVC";
          //alert("Tipo8: "+$tipo8);

          $.post( "Herramienta_ajax.php",{action:"ajax",page:1,herramienta:$tipo1},function( data ) {
            $( "#impresoraMono" ).html( data );
          });

          $.post( "Herramienta_ajax.php",{action:"ajax",page:1,herramienta:$tipo2},function( data ) {
            $( "#impresoraMultiBN" ).html( data );
          });

          $.post( "Herramienta_ajax.php",{action:"ajax",page:1,herramienta:$tipo3},function( data ) {
            $( "#impresoraMultiColor" ).html( data );
          });

          $.post( "Herramienta_ajax.php",{action:"ajax",page:1,herramienta:$tipo4},function( data ) {
            $( "#impresoraColor" ).html( data );
          });

          $.post( "Herramienta_ajax.php",{action:"ajax",page:1,herramienta:$tipo5},function( data ) {
            $( "#impresoraCredencial" ).html( data );
          });

          $.post( "Herramienta_ajax.php",{action:"ajax",page:1,herramienta:$tipo6},function( data ) {
            $( "#ConsumibleToner" ).html( data );
          });

          $.post( "Herramienta_ajax.php",{action:"ajax",page:1,herramienta:$tipo7},function( data ) {
            $( "#ConsumibleTambor" ).html( data );
          });

          $.post( "Herramienta_ajax.php",{action:"ajax",page:1,herramienta:$tipo8},function( data ) {
            $( "#TargetaPVC" ).html( data );
          });

        }

        if($id == 'almacenamiento'){
          $tipo1 = "ALHDDLap";
          $tipo2 = "ALHDDPC";
          $tipo3 = "ALMEMORIMICROSD";
          $tipo4 = "ALMEMORIUsb";

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo1},function( data ) {
            $( "#ALHDDLap" ).html( data );
          });
          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo2},function( data ) {
            $( "#ALHDDPC" ).html( data );
          });

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo3},function( data ) {
            $( "#ALMEMORIMICROSD" ).html( data );
          });

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo4},function( data ) {
            $( "#ALMEMORIUsb" ).html( data );
          });
        }

        if($id == 'red'){
          $tipo1 = "RedRouter";
          $tipo2 = "RedSwicht";
          $tipo3 = "RedAccessP";

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo1},function( data ) {
            $( "#RedRouter" ).html( data );
          });

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo2},function( data ) {
            $( "#RedSwicht" ).html( data );
          });

          $.post( "Herramienta_ajax.php", {action:"ajax",page:1,herramienta:$tipo3},function( data ) {
            $( "#RedAccessP" ).html( data );
          });
        }

        $( ".button-group" ).hide();
        $( "#"+$id ).show();
      });

      $( ".boton-group" ).on("click","button",function(){
        //alert("boton");
        $id = $(this).data( "id" );
        //alert("ID: "+$id);
        if($id == 'Acceso'){
          $tipo1 = "ServidorVirtual";
          $tipo2 = "UnidadRed";
          $tipo3 = "Contabilidad";
          $tipo4 = "Facturacion";
          $tipo5 = "Giro";
          $tipo6 = "SistemaTicket";
          $tipo7 = "GiroWeb";

          $.post( "Software_ajax.php", {action:"ajax",page:1,herramienta:$tipo1},function( data ) {
            $( "#ServidorVirtual" ).html( data );
          });

          $.post( "Software_ajax.php", {action:"ajax",page:1,herramienta:$tipo2},function( data ) {
            $( "#UnidadRed" ).html( data );
          });

          $.post( "Software_ajax.php", {action:"ajax",page:1,herramienta:$tipo3},function( data ) {
            $( "#Contabilidad" ).html( data );
          });

          $.post( "Software_ajax.php", {action:"ajax",page:1,herramienta:$tipo4},function( data ) {
            $( "#Facturacion" ).html( data );
          });

          $.post( "Software_ajax.php", {action:"ajax",page:1,herramienta:$tipo5},function( data ) {
            $( "#Giro" ).html( data );
          });


          $.post( "Software_ajax.php", {action:"ajax",page:1,herramienta:$tipo6},function( data ) {
            $( "#SistemaTicket" ).html( data );
          });

          $.post( "Software_ajax.php", {action:"ajax",page:1,herramienta:$tipo7},function( data ) {
            $( "#GiroWeb" ).html( data );
          });
      }

      if($id == 'Correo'){
        $tipo1 = "Correo";

        $.post( "Software_ajax.php", {action:"ajax",page:1,herramienta:$tipo1},function( data ) {
          $( "#Correo" ).html( data );
          $( "#correoelectronico").show();
        });
      }
        $( ".boton-group" ).hide();
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

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="button-group">
        <button data-id="computer" stype="button" name="button"><i class="material-icons" style="font-size:150px;color:black">desktop_windows</i><br> Computadora </button> <!--<img src="imagenes/icons/computer.png" high = "150px" width = "150px" alt="">-->
        <button data-id="telefonia" type="button" name="button"><i class="material-icons" style="font-size:150px;color:black">phone</i><br> Telefonia </button> <!--<img src="imagenes/icons/Phone.png" high = "150px" width = "150px" alt="">-->
        <button data-id="impresora" type="button" name="button"><i class="material-icons" style="font-size:150px;color:black">print</i><br> Impresora </button> <!--<img src="imagenes/icons/impresora.png" high = "150px" width = "150px" alt="">-->
        <button data-id="complemento" type="button" name="button"><i class="material-icons" style="font-size:150px;color:black">important_devices</i><br> Complemento </button>  <!--<img src="imagenes/icons/complemento.png" high = "150px" width = "150px" alt="">-->
        <button data-id="almacenamiento" type="button" name="button"><span class="glyphicon glyphicon-hdd" style="font-size:150px;color:black"></span><br> Almacenaminto </button> <!--<img src="imagenes/icons/almacenamiento.png" high = "150px" width = "150px" alt="">-->
        <button data-id="red"type="button" name="button"><i class="material-icons" style="font-size:150px;color:black">router</i><br> Red </button>
      </div>

      <!---<div class=""> <button id = "ocultar" type="button" name="button">Ocultar</button> </div>-->

      <div id="computer" hidden>
        <div class="panel panel-primary">
          <div class="panel-heading">Escritorio</div>
          <div class="panel-body">
            <div align="left" id="Escritorio"></div>
          </div>
          Total: <?php $sqlescritorio = "select COUNT(*) AS Total from herramienta where tipo like '%HESCRITORIO%' and estadoherramienta = 'No Asignada'";
                                $consultaesc= sqlsrv_query( $conexion,$sqlescritorio );
                                $line1 = sqlsrv_fetch_array($consultaesc,SQLSRV_FETCH_ASSOC);
                                echo $line1['Total'];
          ?>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Laptop</div>
          <div class="panel-body">
            <div align="left" id="Laptop"></div>
          </div>
          Total: <?php $sqllaptop = "select COUNT(*) AS Total from herramienta where tipo like '%HLAPTOP%' and estadoherramienta = 'No Asignada'";
                            $consultalap= sqlsrv_query( $conexion,$sqllaptop );
                            $line2 = sqlsrv_fetch_array($consultalap,SQLSRV_FETCH_ASSOC);
                            echo $line2['Total']; ?>
        </div>
        Total de Maquinas: <?php $sqlcomputo = "select COUNT(*) AS Total from herramienta where tipo like '%HESCRITORIO%' or tipo like '%HLAPTOP%'";
                                 $consultacomputo = sqlsrv_query( $conexion,$sqlcomputo );
                                 $line3 = sqlsrv_fetch_array( $consultacomputo );
                                 echo $line3['Total'];?>
      </div>

      <div id="telefonia" hidden>
        <div class="panel panel-primary">
          <div class="panel-heading">Telefono con Diadema</div>
          <div class="panel-body">
            <div align="left" id="FijoTD"></div>
          </div>
          Total: <?php $sqlfijotd = "select COUNT(*) AS Total from herramienta where tipo like '%FijoTD%' and estadoherramienta = 'No Asignada'";
                                $consultafijotd= sqlsrv_query( $conexion,$sqlfijotd );
                                $linetd = sqlsrv_fetch_array($consultafijotd,SQLSRV_FETCH_ASSOC);
                                echo $linetd['Total'];
          ?>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Telefono Analogo</div>
          <div class="panel-body">
            <div align="left" id="FijoTA"></div>
          </div>
          Total: <?php $sqlfijota = "select COUNT(*) AS Total from herramienta where tipo like '%FijoTA%' and estadoherramienta = 'No Asignada'";
                       $consultafijota= sqlsrv_query( $conexion,$sqlfijota );
                       $lineta = sqlsrv_fetch_array($consultafijota,SQLSRV_FETCH_ASSOC);
                       echo $lineta['Total'];
          ?>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Telefono IP</div>
          <div class="panel-body">
            <div align="left" id="FijoTIP"></div>
          </div>
          Total: <?php $sqlfijotip = "select COUNT(*) AS Total from herramienta where tipo like '%FijoTA%' and estadoherramienta = 'No Asignada'";
                       $consultafijotip= sqlsrv_query( $conexion,$sqlfijotip );
                       $linetip = sqlsrv_fetch_array($consultafijotip,SQLSRV_FETCH_ASSOC);
                       echo $linetip['Total'];
                 ?>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Telefono Inalambrico</div>
          <div class="panel-body">
            <div align="left" id="FijoTI"></div>
          </div>
          Total: <?php $sqlfijoti = "select COUNT(*) AS Total from herramienta where tipo like '%FijoTA%' and estadoherramienta = 'No Asignada'";
                       $consultafijoti= sqlsrv_query( $conexion,$sqlfijoti );
                       $lineti = sqlsrv_fetch_array($consultafijoti,SQLSRV_FETCH_ASSOC);
                       echo $lineti['Total'];
                 ?>
        </div>

        <div class="panel panel-success">
          <div class="panel-heading">Celular</div>
          <div class="panel-body">
            <div align="left" id="MovilCelular"></div>
          </div>
          Total: <?php $sqlmovil = "select COUNT(*) AS Total from herramienta where tipo like '%MovilCelular%' and estadoherramienta = 'No Asignada'";
                       $consultamovil= sqlsrv_query( $conexion,$sqlmovil );
                       $linemovil = sqlsrv_fetch_array($consultamovil,SQLSRV_FETCH_ASSOC);
                       echo $linemovil['Total'];
                 ?>
        </div>
        Total de Telefonia: <?php $sqltelefonia = "
        select count(*) AS Total from herramienta
        where tipo in('HFijoTA',
        'HFijoTD',
        'HFijoTI',
        'HFijoTIP',
        'HMovilCelular');";
        $consultatelefonia= sqlsrv_query( $conexion,$sqltelefonia);
        $linetelefonia = sqlsrv_fetch_array($consultatelefonia,SQLSRV_FETCH_ASSOC);
        echo $linetelefonia['Total'];
        ?>
      </div>

      <div id="impresora" hidden>
          <div class="panel panel-primary">
            <div class="panel-heading">Impresora(s) Monocromatica.</div>
            <div class="panel-body">
              <div align="left" id="impresoraMono"></div>
            </div>
            Total:<?php $sqlmono = "select COUNT(*) AS Total from herramienta where tipo like '%impresoraMono%' and estadoherramienta = 'No Asignada'";
                         $consultamono= sqlsrv_query( $conexion,$sqlmono );
                         $linemono = sqlsrv_fetch_array($consultamono,SQLSRV_FETCH_ASSOC);
                         echo $linemono['Total'];
                   ?>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading">Impresora(s) Multifuncional (B/N)</div>
            <div class="panel-body">
              <div align="left" id="impresoraMultiBN"></div>
            </div>
            Total:<?php $sqlmultiBN = "select COUNT(*) AS Total from herramienta where tipo like '%impresoraMultiB/N%' and estadoherramienta = 'No Asignada'";
                         $consultamultiBN= sqlsrv_query( $conexion,$sqlmultiBN );
                         $linemultiBN = sqlsrv_fetch_array($consultamultiBN,SQLSRV_FETCH_ASSOC);
                         echo $linemultiBN['Total'];
                   ?>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading">Impresora(s) Multifuncional (Color)</div>
            <div class="panel-body">
              <div align="left" id="impresoraMultiColor"></div>
            </div>
            Total:<?php $sqlmulticolor = "select COUNT(*) AS Total from herramienta where tipo like '%impresoraMultiColor%' and estadoherramienta = 'No Asignada'";
                         $consultamulticolor= sqlsrv_query( $conexion,$sqlmulticolor );
                         $linemulticolor = sqlsrv_fetch_array($consultamulticolor,SQLSRV_FETCH_ASSOC);
                         echo $linemulticolor['Total'];
                   ?>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading">Impresora(s) Color</div>
            <div class="panel-body">
              <div align="left" id="impresoraColor"></div>
            </div>
            Total:<?php $sqlcolor = "select COUNT(*) AS Total from herramienta where tipo like '%impresoraColor%' and estadoherramienta = 'No Asignada'";
                         $consultacolor= sqlsrv_query( $conexion,$sqlcolor );
                         $linecolor = sqlsrv_fetch_array($consultacolor,SQLSRV_FETCH_ASSOC);
                         echo $linecolor['Total'];
                   ?>
          </div>

          <div class="panel panel-primary">
            <div class="panel-heading">Impresora(s) Credencial</div>
            <div class="panel-body">
              <div align="left" id="impresoraCredencial"></div>
            </div>
            Total:<?php $sqlcredencial = "select COUNT(*) AS Total from herramienta where tipo like '%impresoraCredencial%' and estadoherramienta = 'No Asignada'";
                         $consultacredencial= sqlsrv_query( $conexion,$sqlcredencial );
                         $linecredencial = sqlsrv_fetch_array($consultacredencial,SQLSRV_FETCH_ASSOC);
                         echo $linecredencial['Total'];
                   ?>
          </div>

          <div class="panel panel-success">
            <div class="panel-heading">Consumible(s) Toner.</div>
            <div class="panel-body">
              <div align="left" id="ConsumibleToner"></div>
            </div>
            Total:<?php $sqltoner = "select COUNT(*) AS Total from herramienta where tipo like '%ConsumibleToner%' and estadoherramienta = 'No Asignada'";
                         $consultatoner= sqlsrv_query( $conexion,$sqltoner );
                         $linetoner = sqlsrv_fetch_array($consultatoner,SQLSRV_FETCH_ASSOC);
                         echo $linetoner['Total'];
                   ?>
          </div>

          <div class="panel panel-success">
            <div class="panel-heading">Consumible(s) Tambor</div>
            <div class="panel-body">
              <div align="left" id="ConsumibleTambor"></div>
            </div>
            Total:<?php $sqltambor = "select COUNT(*) AS Total from herramienta where tipo like '%ConsumibleTambor%' and estadoherramienta = 'No Asignada'";
                         $consultambor = sqlsrv_query( $conexion,$sqltambor );
                         $linetambor = sqlsrv_fetch_array($consultambor,SQLSRV_FETCH_ASSOC);
                         echo $linetambor['Total'];
                   ?>
          </div>

          <div class="panel panel-success">
            <div class="panel-heading">Targeta(s) PVC</div>
            <div class="panel-body">
              <div align="left" id="TargetaPVC"></div>
            </div>
            Total:<?php $sqltargeta = "select COUNT(*) AS Total from herramienta where tipo like '%TargetaPVC%' and estadoherramienta = 'No Asignada'";
                         $consultargeta = sqlsrv_query( $conexion,$sqltargeta );
                         $linetargeta = sqlsrv_fetch_array($consultargeta,SQLSRV_FETCH_ASSOC);
                         echo $linetargeta['Total'];
                   ?>
          </div>
          Total de Impresora/Consumible:<?php $sqlimpresora = "
          select COUNT(*) AS Total from herramienta
          where tipo in('HConsumibleTambor',
          'HConsumibleToner',
          'HimpresoraColor',
          'HimpresoraCredencial',
          'HimpresoraMono',
          'HimpresoraMultiB/N',
          'HimpresoraMultiColor',
          'HTargetaPVC');";
          $consultaimpresora = sqlsrv_query( $conexion,$sqlimpresora );
          $lineimpresora = sqlsrv_fetch_array($consultaimpresora,SQLSRV_FETCH_ASSOC);
          echo $lineimpresora['Total'];
          ?>
      </div>

      <div id="complemento" hidden>
        <?php
        $sql_count = sqlsrv_query( $conexion,"SELECT count(tipo) As conteo FROM herramienta WHERE tipo like '%Otro%'" );
        $resultado = sqlsrv_fetch_array($sql_count,SQLSRV_FETCH_ASSOC);
        //echo "Conteo de Complemento: ".$resultado['conteo']."<br>";
        if( $resultado['conteo'] == 0 ){
          echo "
          <div class='panel panel-primary'>
            <div class='panel-heading'>Complemento(s)</div>
            <div class='panel-body'>
              <div align='left' id=''>
              <div class='alert alert-warning' role='alert'>
               <strong>Aviso!!!</strong><br>No hay datos para mostrar.
              </div>
              </div>
            </div>
          </div>";
        }
        $sql = "SELECT * FROM herramienta WHERE tipo like '%Otro%'";
        $consulta = sqlsrv_query( $conexion, $sql );
            while( $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC)){
              $herramienta = substr($line['Clave'], 0,-1);
              echo "<div class='panel panel-primary'>
                <div class='panel-heading'>".$line['nombreequipo']."</div>
                <div class='panel-body'>
                  <div align='left'><table class='table table-striped'>
        					<thead>
        					 <tr>
        					  <th>Nombre</th>
                    <th>Cantidad</th>
        						</tr>
        						</thead>
        						<tbody>";
        						echo "
                    <tr>
        						<td>".$line['nombreequipo']."</td>
                    <td>".$line['cantidad']."</td>
                    <td><a href='#' id='heditar'
                    data-herramienta='".$herramienta."'
                    data-id='".$line['Clave']."'
                    data-passwindows='".$line['passwindows']."'
                    data-nombreequipo='".$line['nombreequipo']."'
                    data-tipo='".$line['tipo']."'
                    data-usuariowindows='".$line['usuariowindows']."'
                    data-marca='".$line['marca']."'
                    data-modelo='".$line['modelo']."'
                    data-no_serie='".$line['no_serie']."'
                    data-procesador='".$line['procesador']."'
                    data-discoduro='".$line['discoduro']."'
                    data-ram='".$line['ram']."'
                    data-so='".$line['so']."'
                    data-direccionip='".$line['direccionip']."'
                    data-macadress='".$line['macadress']."'
                    data-idteamviewer='".$line['idteamviewer']."'
                    data-proyecto='".$line['proyecto']."'
                    data-asignar='".$line['asignar']."'
                    data-cantidad='".$line['cantidad']."'
                    data-macadresswi='".$line['macadresswi']."'
                    >Editar</a></td>";
                    if($line['clave'] == 'HOtro'){
                    echo "<td>
                    <a href='#' id='heliminar'
                    data-clave='".$line['Clave']."'>Eliminar</a></td>
        						</tr>";}
        					echo "</tbody>
        				  </table></div>
                </div>
              </div>";
            }
            ?>
      </div>

      <div id="almacenamiento" hidden>
        <div class="panel panel-primary">
          <div class="panel-heading">Disco duro de laptop</div>
          <div class="panel-body">
            <div align="left" id="ALHDDLap"></div>
          </div>
          Total:<?php $sqlalhddlap = "select COUNT(*) AS Total from herramienta where tipo like '%ALHDDLap%' and estadoherramienta = 'No Asignada'";
                       $consultalhddlap = sqlsrv_query( $conexion,$sqlalhddlap );
                       $linealhddlap = sqlsrv_fetch_array( $consultalhddlap,SQLSRV_FETCH_ASSOC );
                       echo $linealhddlap['Total'];
                 ?>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Disco duro de escritorio</div>
          <div class="panel-body">
            <div align="left" id="ALHDDPC"></div>
          </div>
          Total:<?php $sqlalhddpc = "select COUNT(*) AS Total from herramienta where tipo like '%ALHDDPC%' and estadoherramienta = 'No Asignada'";
                       $consultalhddpc = sqlsrv_query( $conexion,$sqlalhddpc );
                       $linealhddpc = sqlsrv_fetch_array( $consultalhddpc,SQLSRV_FETCH_ASSOC );
                       echo $linealhddpc['Total'];
                 ?>
        </div>

        <div class="panel panel-success">
          <div class="panel-heading">Flash Usb</div>
          <div class="panel-body">
            <div align="left" id="ALMEMORIUsb"></div>
          </div>
          Total:<?php $sqlalmemoriusb = "select COUNT(*) AS Total from herramienta where tipo like '%ALMEMORIUsb%' and estadoherramienta = 'No Asignada'";
                       $consultalmemoriusb = sqlsrv_query( $conexion,$sqlalmemoriusb );
                       $linealmemoriusb = sqlsrv_fetch_array( $consultalmemoriusb,SQLSRV_FETCH_ASSOC );
                       echo $linealmemoriusb['Total'];
                 ?>
        </div>

        <div class="panel panel-success">
          <div class="panel-heading">Memoria MICRO SD</div>
          <div class="panel-body">
            <div align="left" id="ALMEMORIMICROSD"></div>
          </div>
          Total:<?php $sqlalmemorimicrosd = "select COUNT(*) AS Total from herramienta where tipo like '%ALMEMORIMICROSD%' and estadoherramienta = 'No Asignada'";
                       $consultalmemorimicrosd = sqlsrv_query( $conexion,$sqlalmemorimicrosd );
                       $linealmemorimicrosd = sqlsrv_fetch_array( $consultalmemorimicrosd,SQLSRV_FETCH_ASSOC );
                       echo $linealmemorimicrosd['Total'];
                 ?>
        </div>
        Total de Almacenamiento:<?php $sqlalmecenamiento = "
        select count (*) AS Total from herramienta
        where tipo in('HALHDDLap',
        'HALHDDPC',
        'HALMEMORIMICROSD',
        'HALMEMORIUsb');";
        $consultalmacenamiento = sqlsrv_query( $conexion,$sqlalmecenamiento );
        $linealmacenamiento = sqlsrv_fetch_array( $consultalmacenamiento,SQLSRV_FETCH_ASSOC );
        echo $linealmacenamiento['Total'];
        ?>
      </div>

      <div id="red" hidden>
        <div class="panel panel-primary">
          <div class="panel-heading">Router(s)</div>
          <div class="panel-body">
            <div align="left" id="RedRouter"></div>
          </div>
          Total:<?php $sqlredrouter = "select COUNT(*) AS Total from herramienta where tipo like '%RedRouter%' and estadoherramienta = 'No Asignada'";
                       $consultaredrouter = sqlsrv_query( $conexion,$sqlredrouter );
                       $lineredrouter = sqlsrv_fetch_array( $consultaredrouter,SQLSRV_FETCH_ASSOC );
                       echo $lineredrouter['Total'];
                 ?>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Swicht(s)</div>
          <div class="panel-body">
            <div align="left" id="RedSwicht"></div>
          </div>
          Total:<?php $sqlredswicht = "select COUNT(*) AS Total from herramienta where tipo like '%RedSwicht%' and estadoherramienta = 'No Asignada'";
                       $consultaredswicht = sqlsrv_query( $conexion,$sqlredswicht );
                       $lineredswicht = sqlsrv_fetch_array( $consultaredswicht,SQLSRV_FETCH_ASSOC );
                       echo $lineredswicht['Total'];
                 ?>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Access Point(s)</div>
          <div class="panel-body">
            <div align="left" id="RedAccessP"></div>
          </div>
          Total:<?php $sqlredaccessp = "select COUNT(*) AS Total from herramienta where tipo like '%RedAccessP%' and estadoherramienta = 'No Asignada'";
                       $consultaredaccessp = sqlsrv_query( $conexion,$sqlredaccessp );
                       $lineredaccessp = sqlsrv_fetch_array( $consultaredaccessp,SQLSRV_FETCH_ASSOC );
                       echo $lineredaccessp['Total'];
                 ?>
        </div>
        Total de Red:<?php $sqlred = "select COUNT(*) AS Total from herramienta
                           where tipo in('HRedAccessP',
                           'HRedRouter',
                           'HRedSwicht');";
                     $consultared = sqlsrv_query( $conexion,$sqlred );
                     $linered = sqlsrv_fetch_array( $consultared,SQLSRV_FETCH_ASSOC );
                     echo $linered['Total'];
               ?>
      </div>
    </div>

    <div id="menu1" class="tab-pane fade">
      <div class="boton-group">
        <button data-id="Acceso" stype="button" name="button"> <img src="imagenes/icons/acceso.png" high = "150px" width = "150px" alt=""><br> Acceso a programa </button>
        <button data-id="Correo" type="button" name="button"> <img src="imagenes/icons/email.png" high = "150px" width = "150px" alt=""> <br> Correo electronico </button>
      </div>

      <div id="Acceso" hidden>
        <div class="panel panel-primary">
          <div class="panel-heading">Servidor Virtual</div>
          <div class="panel-body">
            <div align="left" id="ServidorVirtual"></div>
          </div>
        </div>

        <!--<div class="panel panel-primary">
          <div class="panel-heading">Unidades de Red</div>
          <div class="panel-body">
            <div align="left" id="UnidadRed"></div>
          </div>
        </div>-->

        <div class="panel panel-primary">
          <div class="panel-heading">Contabilidad</div>
          <div class="panel-body">
            <div align="left" id="Contabilidad"></div>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Facturación</div>
          <div class="panel-body">
            <div align="left" id="Facturacion"></div>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Giro</div>
          <div class="panel-body">
            <div align="left" id="Giro"></div>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Sistema Ticket</div>
          <div class="panel-body">
            <div align="left" id="SistemaTicket"></div>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Giro Web</div>
          <div class="panel-body">
            <div align="left" id="GiroWeb"></div>
          </div>
        </div>

      </div>

      <div id="correoelectronico" hidden>
        <div class="panel panel-primary">
          <div class="panel-heading">Correo Electronico</div>
          <div class="panel-body">
            <div align="left" id="Correo"></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
  </body>
</html>
