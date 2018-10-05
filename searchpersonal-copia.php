<?php
include ('paginacion.php');
include ('conexion.php');
$buscar = $_POST['personal'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h3>Personal Registrado:</h3>
    <table width="100%">
    <ul>
    <?php

    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$user = (isset($_REQUEST['user']) && !empty($_REQUEST['user']))?$_REQUEST['user']:"";
		$per_page = 10 ; //la cantidad de registros que desea mostrar
		$adjacents  = 5; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1 ) * $per_page;
    $contador1 = 10;
    $contador2 = 1;
    if($offset != 0){$contador1=$offset+10;}
    if($offset != 0){$contador2 = $offset+1; }
		//Cuenta el número total de filas de la tabla*/
		$count_query = sqlsrv_query($conexion,"SELECT count(*) AS numrows FROM ticket");
		if ($row= sqlsrv_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'index.php';

    $query = "SELECT * from personal where nombres+' '+apellidos like '%$buscar%'";
    $consulta = sqlsrv_query($conexion,$query);
    while( $line = sqlsrv_fetch_array( $consulta, SQLSRV_FETCH_ASSOC) ){
      echo "constraseña: ".$line['contrasena']."<br>";
      echo "usuario: ".$line['usuario']."<br>";
      echo "
      <tr>
       <td>
        <li align='left' align='left' style='list-style:none;'>".$line['Nombres']." ".$line['apellidos']."</li>
       </td>
       <td align='right'><button id='botonpersonal' class='btn btn-xs' type='button' name='button'
       data-id='".$line['idpersonal']."',
       data-nombre='".$line['Nombres']."',
       data-apellidos='".$line['apellidos']."',
       data-usuario='".$line['usuario']."',
       data-contraseña='".$line['contrasena']."',
       data-departamento='".$line['departamentopersonal']."',
       data-localidad='".$line['localidad']."',
       data-coordinador='".$line['coordinador']."'
       >Editar</button>
        <button id='borrar' data-id ='".$line['idpersonal']."' data-usuario = 'personal' class='btn btn-xs' type='button' name='button'>Borrar</button>
       </td>
      </tr>";
    }
    ?>
    </ul>
    </table>
    <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
  </body>
</html>
