<?php
require_once('plantilla.php');

ini_set('date.timezone', 'America/El_Salvador');
//manda los parametros para crear el reporte en tamaño carta
$pdf = new PDF('P', 'mm', array(100,150));
$pdf -> SetFont('Arial', '', 20);
//se manda el parametro y se manda a llamar la función
$pdf->head('Prueba');
$pdf->date();


$pdf->Ln();

$pdf->SetFillColor(36, 113, 163);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial', 'b', 8);
$pdf->Cell(22,7, utf8_decode('Nombre'),0,0,'C', true);
$pdf->Cell(21,7, utf8_decode('Apellido'),0,0,'C', true);
$pdf->Cell(21,7, utf8_decode('Telefono'),0,0,'C', true);
$pdf->Cell(21,7, utf8_decode('Direccion'),0,0,'C', true);

$pdf->Ln();

$pdf->Output();
?>