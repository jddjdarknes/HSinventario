<?php
require_once("../../conexion.php");
$fecha =  date('h-i-s, j-m-y, it is w Day');
function Ticket($estado,$conexion)
{
  $sl = "SELECT Count(estadoactual) As $estado From ticket where estadoactual = '$estado'";
  $resul = sqlsrv_query( $conexion,$sl );
  $l = sqlsrv_fetch_array( $resul, SQLSRV_FETCH_ASSOC );
  $valor = $l[$estado];
  return $valor;
}
$sql = "SELECT * FROM usuario WHERE tipousuario = 'Usuario'";
$resultado = sqlsrv_query( $conexion,$sql );
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

		</style>
	</head>
	<body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="code/highcharts.js"></script>
<script src="code/modules/exporting.js"></script>

<!-- style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto" -->
<!--  style="min-width: 310px; height: 400px; margin: 0 auto" -->

  <div class="col-sm-6">
    <div id="container"></div>
  </div>
  <div class="col-sm-6">
    <div id="contenedor" ></div>
  </div>

<script type="text/javascript">
Highcharts.chart('contenedor', {
  chart: {
      type: 'line'
  },
  title: {
      text: 'Solicitud de Tickets por Usuario '
  },
  subtitle: {
      text: 'Fuente:hscorporativo.dyndns-server.com:8080/HStickets/consultarticket.php'
  },
  xAxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
  },
  yAxis: {
      title: {
          text: 'Numero de veces que solicito Ticket'
      }
  },
  plotOptions: {
      line: {
          dataLabels: {
              enabled: true
          },
          enableMouseTracking: false
      }
  },
  series: [<?php while ($line = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC )) { ?>
     {
      name: '<?php echo $line ['usernameusu']; ?> ',
      data: [<?php for ($i = 1; $i <= 12; $i++){ echo $i; ?>,<?php } ?>]
    },<?php } ?>]
});
  </script>
		<script type="text/javascript">
$(document).ready(function () {

    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Datos estadisticos de Tickets'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Estado Actual',
            colorByPoint: true,
            data: [{
                name: 'Asignado',
                y: <?php echo Ticket('Asignado',$conexion);  ?>
            }, {
                name: 'Cancelado',
                y:  <?php echo Ticket('Cancelado',$conexion);  ?>,
                sliced: true,
                selected: true
            }, {
                name: 'EnProceso',
                y:<?php echo Ticket('EnProceso',$conexion);  ?>
            }, {
                name: 'EnEspera',
                y:<?php echo Ticket('EnEspera',$conexion);  ?>
            }, {
                name: 'Resuelto',
                y: <?php echo Ticket('Resuelto',$conexion);  ?>
            }, {
                name: 'Abierto',
                y:<?php echo Ticket('Abierto',$conexion);  ?>
            },]
        }]
    });
});
		</script>
	</body>
</html>
