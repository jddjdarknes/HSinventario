<?php
session_start();
include 'plantilla.php';
require 'conexion.php';
$idpersonal = $_GET['idper'];
$opcion = $_GET['op'];

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',18);
$pdf->SetX(15);
$pdf->Cell(180,12,'Datos Personales',1,1,'C',true);

$pdf->SetFont('Arial','',10);
$pdf->Rect(15,40,180,48);
$query = "Select * from personal where idpersonal = $idpersonal";
$resultado = sqlsrv_query($conexion,$query);

while ($line = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC)) {
  $nombres=utf8_decode($line['Nombres']);
  $apellidos=utf8_decode($line['apellidos']);

  $pdf->SetX(15);
  $pdf->MultiCell(90,6,"Nombre: ".$nombres." ".$apellidos);
  $pdf->SetX(15);
  $pdf->MultiCell(90,6,"Departamento: ".$line['departamentopersonal']);
  $pdf->SetX(15);
  $pdf->MultiCell(90,6,"Puesto: ".$line['puesto']);
  $pdf->SetX(15);
  $pdf->MultiCell(90,6,"Localidad: ".$line['localidad']);
  $pdf->SetX(15);
  $pdf->MultiCell(90,6,"Coordinador: ".$line['coordinador']);
  $pdf->SetX(15);
  date_default_timezone_set('America/Mexico_City');
  $fecha=date("d/m/Y h:i:s a");
  $pdf->MultiCell(90,6,"Fecha: ".$fecha);
}
$pdf->Ln(6);
$pdf->SetX(15);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(180,12,"Hardware Asignado: ",1,1,'C',true);
$pdf->SetX(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,6,"Nombre",1,0,'C',true);
$pdf->Cell(45,6,"Marca",1,0,'C',true);
$pdf->Cell(45,6,"Modelo",1,0,'C',true);
$pdf->Cell(45,6,"No. Serie",1,1,'C',true);

$query = "SELECT *
          FROM herramientas_personal HP
          inner join herramienta H on HP.Clave = H.Clave
          WHERE HP.idpersonal = $idpersonal and tipo like 'H%' and estado_herramienta = $opcion;";
$resultado = sqlsrv_query($conexion,$query);
while ($line = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC)) {
  $pdf->SetX(15);
  $pdf->Cell(45,6,$line['nombreequipo'],1,0,'C');
  $pdf->Cell(45,6,$line['marca'],1,0,'C');
  $pdf->Cell(45,6,$line['modelo'],1,0,'C');
  $pdf->Cell(45,6,$line['no_serie'],1,1,'C');
}

/*
$pdf->Ln(6);
$pdf->SetX(15);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(180,12,"Software asignado: ",1,1,'C',true);
$pdf->SetX(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,"Tipo",1,0,'C',true);
$pdf->Cell(80,6,"Nombre",1,0,'C',true);
$pdf->Cell(50,6,"Password",1,1,'C',true);
$query = "SELECT *
          FROM herramientas_personal HP
          inner join herramienta H on HP.Clave = H.Clave
          WHERE HP.idpersonal = $idpersonal and tipo like 'S%';";
$resultado = sqlsrv_query($conexion,$query);
while ($line = sqlsrv_fetch_array( $resultado, SQLSRV_FETCH_ASSOC)) {
  $pdf->SetX(15);
  $pdf->Cell(50,6,$line['tipo'],1,0,'C');
  $pdf->Cell(80,6,utf8_decode($line['correo']),1,0,'C');
  $pdf->Cell(50,6,$line['passcorreo'],1,1,'C');
}*/

//$pdf->Rect(15,16,180,64);
$pdf->Ln(12);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',18);
$pdf->SetX(15);
$pdf->Cell(180,12,'Observaciones',1,1,'C',true);
$pdf->SetX(15);
$pdf->Cell(180,6," _________________________________________________",1,1);
$pdf->SetX(15);
$pdf->Cell(180,6," _________________________________________________",1,1);
$pdf->SetX(15);
$pdf->Cell(180,6," _________________________________________________",1,1);
$pdf->SetX(15);
$pdf->Cell(180,6," _________________________________________________",1,1);
$pdf->SetX(15);
$pdf->Cell(180,6," _________________________________________________",1,1);
$pdf->SetX(15);
$pdf->Cell(180,6," _________________________________________________",1,1);
$pdf->SetX(15);
$pdf->Cell(180,6," _________________________________________________",1,1);

$pdf->Output();
?>
