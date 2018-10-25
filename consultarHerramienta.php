<?php
include ("conexion.php");
session_start();
error_reporting(E_ALL);
date_default_timezone_set('America/Mexico_City');

$idp = $_POST['idp'];
$nombrep = $_POST['nombrep'];
$apellidop = $_POST['apellidop'];
$departamentop = $_POST['departamentop'];
$puestop  = $_POST['puestop'];
$localidadp = $_POST['localidadp'];
$coordinadorp = $_POST['coordinadorp'];
$perfilp = $_POST['perfilp'];
$opcionp = $_POST['opcionp'];
$nuevousuario="";
//echo "Opcion Resivida: ".$opcionp."<br>";
//echo "Accion a Realizar: ".$action."<br>";
echo "<input type='text' name='fname' id='nuevopersonal' value='$nuevousuario' hidden>";
echo "<div class='panel panel-info'>
  <div class='panel-heading'>Datos del personal</div>
  <div align='left' class='panel-body'>
    Nombre: <label>".$nombrep." ".$apellidop."</label><br>
    Departamento: <label>".$departamentop."</label><br>
    Puesto: <label>".$puestop."</label><br>
    Localidad: <label>".$localidadp."</label><br>
    Coordinador: <label>".$coordinadorp."</label><br>
    Perfil: <label>".$perfilp."</label><br>
  </div>
</div>";

if($opcionp == "Asignada"){
  $queryH = "SELECT * from herramientas_personal HP
  inner join herramienta H on HP.Clave = H.Clave
  inner join personal P on HP.Idpersonal = P.idpersonal
  where HP.idpersonal = $idp and H.tipo like 'H%' and estado_herramienta = 'Asignada';";
  $consultaH = sqlsrv_query($conexion,$queryH);

  $count_queryH = sqlsrv_query($conexion,"SELECT count(*) AS numrows from herramientas_personal HP
  inner join herramienta H on HP.Clave = H.Clave
  inner join personal P on HP.Idpersonal = P.idpersonal
  where HP.idpersonal = $idp and H.tipo like 'H%' and estado_herramienta = 'Asignada';");
}else{
  $queryH = "SELECT * from herramientas_personal HP
  inner join herramienta H on HP.Clave = H.Clave
  inner join personal P on HP.Idpersonal = P.idpersonal
  where HP.idpersonal = $idp and H.tipo like 'H%' and estado_herramienta = 'Prestada';";
  $consultaH = sqlsrv_query($conexion,$queryH);

  $count_queryH = sqlsrv_query($conexion,"SELECT count(*) AS numrows from herramientas_personal HP
  inner join herramienta H on HP.Clave = H.Clave
  inner join personal P on HP.Idpersonal = P.idpersonal
  where HP.idpersonal = $idp and H.tipo like 'H%' and estado_herramienta = 'Prestada';");
}

$queryS = "SELECT * from herramientas_personal HP
inner join herramienta H on HP.Clave = H.Clave
inner join personal P on HP.Idpersonal = P.idpersonal
where HP.idpersonal = $idp and H.tipo like 'S%'";
$consultaS = sqlsrv_query($conexion,$queryS);

$count_queryS = sqlsrv_query($conexion,"SELECT count(*) AS numrows from herramientas_personal HP
inner join herramienta H on HP.Clave = H.Clave
inner join personal P on HP.Idpersonal = P.idpersonal
where HP.idpersonal = $idp and H.tipo like 'S%'");

$rowH = sqlsrv_fetch_array($count_queryH);
$rowS = sqlsrv_fetch_array($count_queryS);

if($rowH['numrows'] > 0){
  echo "<strong>Herramientas asignadas(Hardware): </strong><br>";
  echo "<table class='table table-striped'>
  <thead>
    <tr>
      <th>Nombre del equipo</th>
      <th>Tipo</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>";
  while( $line = sqlsrv_fetch_array( $consultaH, SQLSRV_FETCH_ASSOC) ){
    echo "<tr>
    <td>".$line['nombreequipo']."</td>
    <td>".$line['tipo']."</td>
    <td>".$line['estado_herramienta']."</td>
    </tr>";
  }
  echo "</tbody>
  </table>";
}else{
  echo "<br><strong>Herramientas asignadas(Hardware):</strong><br>";
  echo "<div class='alert alert-warning'>
  <strong>Aviso!!!!</strong><br> No hay datos para mostrar.
  </div>";
}

if($opcionp != "Prestada"){
  if($rowS['numrows']>0){
  echo "<br><strong>Herramientas asignadas(Software): </strong><br>";
  echo "<table class='table table-striped'>
  <thead>
    <tr>
      <th>Nombre: </th>
      <th>Password: </th>
      <th>PST: </th>
    </tr>
  </thead>
  <tbody>";
  while( $line = sqlsrv_fetch_array( $consultaS, SQLSRV_FETCH_ASSOC) ){
    echo "<tr>
    <td>".$line['correo']."</td>
    <td>".$line['passcorreo']."</td>
    <td>".$line['passpst']."</td>
    </tr>";
  }
  echo "</tbody>
  </table>";
  }else{
    echo "<br><strong>Herramientas asignadas(Software):<strong><br>";
    echo "<div class='alert alert-warning'>
    <strong>Aviso!!!!</strong><br> No hay datos para mostrar.
    </div>";
  }

$conteored=0;
$count_unidadred = sqlsrv_query($conexion,"SELECT count(*) AS numrows from herramientas_personal
                                            where Clave like '%UnidadRed%' and idpersonal = $idp");
$rowred = sqlsrv_fetch_array($count_unidadred);
//echo "Conteo: ".$rowred['numrows']."<br>";
if($rowred['numrows'] != 0){
  echo "Aqui deveria estar.<br>";
  echo "<div class='form-group col-sm-12'>
         <div class='col-sm-1'>
         <label for='unidadred'>Unidad de Red: </label>
         </div>
         <div class='col-sm-2'>
         <select class='form-control' id='unidadred'>
           <option value='si'>Si</option>
           <option value='no'>No</option>
         </select>
         </div>
        </div>";
    //Sql server Sociolaborales:
    $sql = sqlsrv_query($conexion,"SELECT H.Clave as hclave, correo FROM herramienta H
                                   INNER JOIN herramientas_personal HP
                                   ON H.Clave = HP.Clave
                                   where H.id between 1 and 10 and idpersonal = $idp order by H.id;");

    $sql2 = sqlsrv_query($conexion,"SELECT H.Clave as hclave, correo
                                    FROM herramienta H
                                    LEFT JOIN herramientas_personal HP
                                    ON H.Clave = HP.Clave and HP.idpersonal = $idp
                                    WHERE HP.Clave IS null and tipo = 'UnidadRed'
                                    and H.id between 1 and 10 order by id;");
    //Fin de Sociolaborales:

    //Sql server Finanzas:
    $sql3 = sqlsrv_query($conexion,"SELECT H.Clave as hclave, correo
                                    FROM herramienta H
                                    INNER JOIN herramientas_personal HP
                                    ON H.Clave = HP.Clave
                                    where H.id between 11 and 20 and HP.idpersonal = $idp order by H.id;");

    $sql4 = sqlsrv_query($conexion,"SELECT H.Clave as hclave, correo
                                    FROM herramienta H
                                    LEFT JOIN herramientas_personal HP
                                    ON H.Clave = HP.Clave and HP.idpersonal = $idp
                                    WHERE HP.Clave IS null and tipo = 'UnidadRed'
                                    and H.id between 11 and 20 order by id;");
    //Fin Finanzas:

    echo "<div class='col-sm-3'></div>
         <div id='unidadesredes' class='col-sm-6 panel panel-default'>
          <div id='sociolaborales' class='col-sm-6' align='left'>
          <label for='unidadesredes'>Sociolaborales:</label>";
          while ($line = sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)) {
            echo"<div class='checkbox'>
                  <label><input class='unidades' type='checkbox' checked value='".$line['hclave']."' data-estado='Asignada' data-texto='".$line['correo']."'>".$line['correo']."</label>
                 </div>";
          }

          while ($line = sqlsrv_fetch_array($sql2,SQLSRV_FETCH_ASSOC)) {
          echo "<div class='checkbox'>
                 <label><input class='unidades' type='checkbox' value='".$line['hclave']."' data-estado='Asignada' data-texto='".$line['correo']."'>".$line['correo']."</label>
                </div>";
          }
          echo "</div>

          <div id='finanzas' class='col-sm-6' align='left'>
           <label for='unidadesredes'>Finanzas:</label>";
           while ($line = sqlsrv_fetch_array($sql3,SQLSRV_FETCH_ASSOC)) {
             echo"<div class='checkbox'>
                   <label><input class='unidades' type='checkbox' checked value='".$line['hclave']."' data-estado='Asignada' data-texto='".$line['correo']."'>".$line['correo']."</label>
                  </div>";
           }

           while ($line = sqlsrv_fetch_array($sql4,SQLSRV_FETCH_ASSOC)) {
           echo "<div class='checkbox'>
                  <label><input class='unidades' type='checkbox' value='".$line['hclave']."' data-estado='Asignada' data-texto='".$line['correo']."'>".$line['correo']."</label>
                 </div>";
           }
           echo "</div>
          </div>
          <div class='col-sm-3'></div>";

}else{
  $sql5 = sqlsrv_query($conexion,"SELECT *
                                  FROM herramienta
                                  where id between 1 and 10 order by id;");

  $sql6 = sqlsrv_query($conexion,"SELECT *
                                  FROM herramienta
                                  WHERE id between 11 and 20 order by id");

  echo "<div class='form-group col-sm-12'>
         <div class='col-sm-2'>
         <label for='unidadred'>Unidad de Red: </label>
         </div>
         <div class='col-sm-2'>
         <select class='form-control' id='unidadred'>
           <option value='no'>No</option>
           <option value='si'>Si</option>
         </select>
         </div>
        </div>";

        echo "<div class='col-sm-3'></div>
             <div id='unidadesredes' class='col-sm-6 panel panel-default'>
              <div id='sociolaborales' class='col-sm-6' align='left' hidden>
              <label for='unidadesredes'>Sociolaborales:</label>";
              while ($line = sqlsrv_fetch_array($sql5,SQLSRV_FETCH_ASSOC)) {
                echo"<div class='checkbox'>
                      <label><input class='unidades' type='checkbox' value='".$line['Clave']."' data-estado='Asignada' data-texto='".$line['correo']."'>".$line['correo']."</label>
                     </div>";
              }
              echo "</div>
              <div id='finanzas' class='col-sm-6' align='left' hidden>
               <label for='unidadesredes'>Finanzas:</label>";
                while ($line = sqlsrv_fetch_array($sql6,SQLSRV_FETCH_ASSOC)) {
                 echo"<div class='checkbox'>
                       <label><input class='unidades' type='checkbox' value='".$line['Clave']."' data-estado='Asignada' data-texto='".$line['correo']."' >".$line['correo']."</label>
                      </div>";
               }
               echo "</div>
              </div>
              <div class='col-sm-3'></div>";
            }
          }
            $fecha = localtime();
            $fecha = date('Y-m-d');
            //echo "Fecha Actual: ".$fecha."<br>2018/07/13";
            if($opcionp == "Prestada"){
              $fechas = sqlsrv_query($conexion,"select Top 1 * from herramientas_personal where idpersonal = $idp and estado_herramienta='Prestada'");
              $link = sqlsrv_fetch_array($fechas,SQLSRV_FETCH_ASSOC);
              $f_inicio = date_format($link['inicio_prestamo'],"Y-m-d");
              $f_fin = date_format($link['fin_prestamo'],"Y-m-d");
              $intervalo="";
              //$intervalo = $f_inicio->diff($f_fin);
              //echo $intervalo->format('%Y Año(s) %m Mes(es) %d Día(s) %H Hora(s) %i Minuto(s) %s Segundo(s)');

              if($f_inicio != null and $f_fin != null){
                echo"
                  <div class='col-sm-12 panel panel-default'>
                    <div class=''><H3>Fecha de prestamo.</H3></div>
                    <div class='col-sm-4'><strong>Fecha.<br><strong><input id='inicio' type='date' min='".$fecha."' value='".$fecha."' disabled></div>
                    <div class='col-sm-4'><strong>Inicio.<br><strong><input id='inicio' type='date' min='".$fecha."' value='".$f_inicio."' disabled></div>
                    <div class='col-sm-4'><strong>Termino.<br><strong><input id='termino' id='date' type='date' min='".$fecha."' value='".$f_fin."' disabled></div>
                  </div>";
              }else{
                  echo"
                    <div class='col-sm-12 panel panel-default'>
                      <div><H3>Fecha de prestamo.</H3></div>
                      <div class='col-sm-6'><strong>Inicio<br><strong><input id='inicio' type='date' min='' value='' disabled></div>
                      <div class='col-sm-6'><strong>Termino<br><strong><input id='termino' id='date' type='date' min='' value='' disabled></div>
                    </div>";
                }
            }

            echo"<br><div align = 'right' class='col-sm-4'><button class='btn btn-primary btn-block' id='btnbuscar'>Buscar otra persona</button></div>";
            if($_SESSION['perfil'] == "Coordinador"){
              echo"<div align = 'right' class='col-sm-4'><button class='btn btn-primary btn-block' id='pasignacion'>Peticion de asignacion</button></div>";
            }else{
              echo "<div class='col-sm-4'></div>";
            }
            echo"<div align = 'right' class='col-sm-4'><button class='btn btn-danger btn-block' onclick='redireccionar({$idp},".'"'."$opcionp".'"'.")'>Convertir a PDF</button></div>";
?>
