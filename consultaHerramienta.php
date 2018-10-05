<?php
include ("conexion.php");
$idher = $_POST['idh'];

$queryH = "SELECT * from herramientas_personal HP
inner join herramienta H on HP.Clave = H.Clave
inner join personal P on HP.Idpersonal = P.idpersonal
where HP.Clave = '$idher'";
$consultaH = sqlsrv_query($conexion,$queryH);
$line = sqlsrv_fetch_array( $consultaH, SQLSRV_FETCH_ASSOC);

$idp = $line['idpersonal'];
$nombrep = $line['Nombres'];
$apellidop = $line['apellidos'];
$departamentop = $line['departamentopersonal'];
$localidadp = $line['localidad'];
$coordinadorp = $line['coordinador'];

echo "<div class='panel panel-info'>
  <div class='panel-heading'>Datos del personal</div>
  <div align='left' class='panel-body'>
    Nombre: <label>".$nombrep." ".$apellidop."</label><br>
    Departamento: <label>".$departamentop."</label><br>
    Localidad:<label>".$localidadp."</label><br>
    coordinador: <label>".$coordinadorp."</label><br>
  </div>
</div>";
$queryH = "SELECT * from herramientas_personal HP
inner join herramienta H on HP.Clave = H.Clave
inner join personal P on HP.Idpersonal = P.idpersonal
where HP.idpersonal = $idp and H.tipo like 'H%'";
$consultaH = sqlsrv_query($conexion,$queryH);

$queryS = "SELECT * from herramientas_personal HP
inner join herramienta H on HP.Clave = H.Clave
inner join personal P on HP.Idpersonal = P.idpersonal
where HP.idpersonal = $idp and H.tipo like 'S%'";
$consultaS = sqlsrv_query($conexion,$queryS);

$count_queryH = sqlsrv_query($conexion,"SELECT count(*) AS numrows from herramientas_personal HP
inner join herramienta H on HP.Clave = H.Clave
inner join personal P on HP.Idpersonal = P.idpersonal
where HP.idpersonal = $idp and H.tipo like 'H%'");

$count_queryS = sqlsrv_query($conexion,"SELECT count(*) AS numrows from herramientas_personal HP
inner join herramienta H on HP.Clave = H.Clave
inner join personal P on HP.Idpersonal = P.idpersonal
where HP.idpersonal = $idp and H.tipo like 'S%'");

$rowH = sqlsrv_fetch_array($count_queryH);
$rowS = sqlsrv_fetch_array($count_queryS);

if($rowH['numrows'] > 0){
  echo "Herramientas asignadas(Hardware): <br>";
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
    <td>".$line['estadoherramienta']."</td>
    <td><a href='#' id='quitar'
          data-id='".$line['idpersonal']."'
          data-clave='".$line['Clave']."'
          data-nombre='".$line['Nombres']."'
          data-apellido='".$line['apellidos']."'
          data-departamento='".$line['departamentopersonal']."'
          data-localidad='".$line['localidad']."'
          data-coordinador='".$line['coordinador']."' >Reasignar
        </a></td>
    </tr>";
  }
  echo "</tbody>
  </table>";
}else{
  echo "<br>Herramientas asignadas(Hardware):<br>";
  echo "<div class='alert alert-warning'>
  <strong>Aviso!!!!</strong><br> No hay datos para mostrar.
  </div>";
}

if($rowS['numrows']>0){
echo "<br>Herramientas asignadas(Software): <br>";
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
  <td><a href='#' id='quitar'
        data-id='".$line['idpersonal']."'
        data-clave='".$line['Clave']."'
        data-nombre='".$line['Nombres']."'
        data-apellido='".$line['apellidos']."'
        data-departamento='".$line['departamentopersonal']."'
        data-localidad='".$line['localidad']."'
        data-coordinador='".$line['coordinador']."' >Reasignar
      </a></td>
  </tr>";
}
echo "</tbody>
</table>";
}else{
  echo "<br>Herramientas asignadas(Software):<br>";
  echo "<div class='alert alert-warning'>
  <strong>Aviso!!!!</strong><br> No hay datos para mostrar.
  </div>";
}
echo"<div align = 'right' class='col-sm-4'><button class='btn btn-primary btn-block' id='asignar'>";
if($rowH['numrows']>0 or $rowS['numrows']){echo "Editar";} else{echo "Asignar";}
echo "</button></div>";
echo"<div align = 'right' class='col-sm-4'><button class='btn btn-primary btn-block' id='cancelar'>Cancelar</button></div>";
echo"<div align = 'right' class='col-sm-4'><button class='btn btn-danger btn-block' onclick='redireccionar(".$idp.")'>Convertir a PDF</button></div>";
?>
