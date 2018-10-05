<?php
	$mensaje = $_REQUEST['mensaje'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Con esto garantizamos que se vea bien en dispositivos móviles -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<title>Human Services 21 | Error</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Servicios con Sentido Humano - Human Services 21</title>
		<meta name="Keywords" content="Recursos Humanos, Outsourcing, consultoria de recursos humanos, investigacion laboral, investigacion socioeconomica, visitas domiciliarias, operación de flotilla, nomina" >
		<meta name="description" content="Recursos Humanos, Outsourcing, consultoria de recursos humanos, investigacion laboral, investigacion socioeconomica, visitas domiciliarias, operación de flotilla, nomina" >
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic400">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:700,400">
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/elegant-font/code/style.css">
		<link rel="stylesheet" href="assets/css/animate.css">
		<link rel="stylesheet" href="assets/css/magnific-popup.css">
		<link rel="stylesheet" href="assets/flexslider/flexslider.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
		<link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/media-queries.css">
		<link rel="shortcut icon" href="assets/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <script src="http://maps.google.com/maps/api/js?sensor=true&region=en-US" type="text/javascript"></script>
	</head>
	<body>
		<?php if($mensaje == "1"){ ?>
		<script type="text/javascript">
	        function redireccionar(){
	            window.location="index.php";
	        }
	        setTimeout ("redireccionar()", 3000);
	    </script>
					<nav class="navbar" role="navigation">
						<div class="container">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="index.php">
									<img src="assets/img/logo-human.png" width="180px">
								</a>
							</div>
							<div class="collapse navbar-collapse" id="top-navbar-1">
								<ul class="nav navbar-nav navbar-right">
							</div>
						</div>
					</nav>
			        <div class="page-title-container">
								<img src="https://ayudawp.com/wp-content/uploads/2012/03/aviso.png" alt="Error........" height="280" width=""><br>
								<h1>Usuario y/o contraseña incorrecta, intentelo de nuevo, sera redireccionado en 3 segundos.</h1>
				      </div>



					<div class="call-to-action-container">

						<div class="container">
							<div class="row">

								<div class="col-sm-12 call-to-action-text wow fadeInLeftBig">
									<p class="text-center"><span class="colored-text">Human Services 21</span>
										Servicios con Sentido Humano</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Footer -->
					<footer>
						<div class="container">
							<div class="row">
								<div class="col-sm-7 footer-copyright wow fadeIn">
									<p>&copy; 2017 Human Services 21</p>
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
			        <script sr="assets/js/jquery.ui.map.min.js"></script>
			        <script src="assets/js/scripts.js"></script>
		<?php } ?>
		<?php if($mensaje == "2"){ ?>
		<script type="text/javascript">
	        function redireccionar(){
	            window.location="index.php";
	        }
	        setTimeout ("redireccionar()", 3000);
	    </script>
		Hubo un error en la base de datos, sera redireccionado en 3 segundos. O de clic <a href="administrarusuario.php">Aqui</a>
		<?php } ?>
		<?php if($mensaje == "3"){ ?>
		<script type="text/javascript">
            function redireccionar(){
                window.location="index.php";
            }
            setTimeout ("redireccionar()", 3000);
        </script>
        Usuario ya insertado, intente con otro usuario, sera redireccionado en 3 segundos. O de clic <a href="nuevoUsuario.php">Aqui</a>
		<?php } ?>
		<?php if($mensaje == "4"){ ?>

		<?php } ?>
		<?php if($mensaje == "5"){ ?>
		<script type="text/javascript">
            function redireccionar(){
                window.location="index.php";
            }
            setTimeout ("redireccionar()", 3000);
        </script>
        Tiene que tener sesion inciada como empleado o administrador, sera redireccionado en 3 segundos. O de clic <a href="index.php">Aqui</a>
		<?php } ?>
	</body>
</html>
