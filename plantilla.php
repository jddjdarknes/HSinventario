<?php

require 'fpdf/fpdf.php';

class PDF extends FPDF
{
  function Header()
  {
    $this->Rect(15,15,180,20);
    $this->Image('assets/img/logo-human.png',16,17,30);
    $this->SetFont('Arial','B',35);
    $this->Ln(10);
    $this->Cell(40);
    $this->Cell(120,13,utf8_decode("      Asignación de Equipo"),0,0,'C');
    $this->Ln(20);
  }

  function Footer()
  {
    $this->SetY(-50);
    $this->SetX(15);
    $this->SetFont('Arial','', 12);
    $this->Cell(45,20,'Aprobado por: ',1,0,'C');
    $this->Cell(45,10,'',1,0,'C');
    $this->Cell(45,20,'Recibido',1,0,'C');
    $this->Cell(45,10,'',1,1,'C');
    $this->SetX(15);
    $this->Cell(45,10,'',0,0,'C');
    $this->Cell(45,10,'Sistemas',1,0,'C');
    $this->Cell(45,10,'Por: ',0,0,'C');
    $this->Cell(45,10,'',1,1,'C');
    $this->SetX(15);
    $this->SetFont('Arial','',8);
    $this->MultiCell(180,10,utf8_decode("EL solicitante acepta los terminos y condiciones de las politicas de uso de Software, equipos y servicios de cómputo de Human Services & Logistic Solutions S.A. de C.V"),0,'C');
  }
}
 ?>
