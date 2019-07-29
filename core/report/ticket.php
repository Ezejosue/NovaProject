<?php
require_once('../libraries/fpdf/fpdf.php');
require_once('../helpers/Conexion.php');
require_once('../helpers/Validator.php');
require_once('../models/ordenes.php');

ini_set('date.timezone', 'America/El_Salvador');
session_start();

$pdf = new FPDF('P','mm', array(45,350));
$pdf->AddPage();
$ordenes = new Ordenes();
$pdf->SetFont('Arial','B',3); //Letra Arial, negrita (Bold), tam. 20
$textypos = 0;
$pdf->setY(2);
$pdf->setX(0);
$pdf->Cell(45,0,"PIZZA NOVA S.A DE C.V",0,0,'C');
$pdf->Ln(1.5);
$pdf->setX(0);
$pdf->Cell(45,0,"Boulevard Universitario, San Salvador",0,0,'C');
$pdf->Ln(1.5);
$pdf->setX(0);
$pdf->Cell(45,0,"2225-9362",0,0,'C');
$pdf->SetFont('Arial','',3);//Letra Arial, negrita (Bold), tam. 20
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,2,'--------------------------------------------------------------------------------------------------------------');
$pdf->Ln(3);
$pdf->setX(0);
$pdf->Cell(22,0,('Fecha: ' .date('d/m/Y')),0,0,'R');
$pdf->Cell(22,0,('Hora: ' .date('H:i:s')),0,0,'L');
$pdf->Ln(1.5);
$textypos+=6;
$total =0;
$off = $textypos+6;
if ($ordenes->setIdUsuario($_SESSION['idUsuario'])){
	$idPedido = ($ordenes->readUltimoPedido());
	$pdf->setX(0);
	$pdf->Cell(45,0,utf8_decode('N° de factura: #'.$idPedido['UltimoPedido']),0,0,'C');
	if ($ordenes->setIdPedido($idPedido['UltimoPedido'])){
		$data = $ordenes->readDetalleFactura();
		$pdf->setX(2);
		$pdf->Cell(5,5,'CANT.');
		$pdf->Cell(5,5,'ARTICULO');
		$pdf->setX(35);
		$pdf->Cell(5,5,'SUBTOTAL');
		$pdf->Ln(2);

		foreach($data as $datos){
		$subtotal = ($datos['cantidad'] * $datos['precio']);
		$pdf->setX(2);
		$pdf->Cell(5,5, utf8_decode($datos['cantidad']),0,0,'L');
		$pdf->setX(7);
		$pdf->Cell(5,5, utf8_decode($datos['nombre_platillo']),0,0,'L');
		$pdf->setX(35);
		$pdf->Cell(5,5, utf8_decode('$'.$subtotal),0,0,'C');
		$total = $total + $subtotal;
		$pdf->Ln(2);
		}
		$iva = $total * 0.13;
		$iva = number_format($iva,2, ".", ",");
		$total_iva = $total + $iva;
		$pdf->Ln(1);
		$pdf->setX(2);
		$pdf->Cell(5,2,'--------------------------------------------------------------------------------------------------------------');
		$pdf->setX(2);
		$pdf->Cell(5,7, utf8_decode('TOTAL:'),0,0,'L');
		$pdf->setX(35);
		$pdf->Cell(5,7, utf8_decode('$'.$total),0,0,'C');
		$pdf->Ln(1.5);
		$pdf->setX(2);
		$pdf->Cell(5,7, utf8_decode('IVA:'),0,0,'L');
		$pdf->setX(35);
		$pdf->Cell(5,7, utf8_decode('$'.$iva),0,0,'C');
		$pdf->Ln(1.5);
		$pdf->setX(2);
		$pdf->Cell(5,7, utf8_decode('TOTAL (IVA INCLUIDO):'),0,0,'L');
		$pdf->setX(35);
		$pdf->Cell(5,7, utf8_decode('$'.$total_iva),0,0,'C');
		$pdf->Ln(4);
		$pdf->setX(2);
		$pdf->Cell(5,2,'--------------------------------------------------------------------------------------------------------------');
		$pdf->Ln(1);
		$pdf->setX(2);
		$pdf->Cell(5,1,'--------------------------------------------------------------------------------------------------------------');
		$pdf->SetFont('Arial','B',3); //Letra Arial, negrita (Bold), tam. 20
		$pdf->Ln(2);
		$pdf->setX(0);
		$pdf->Cell(45,0,"GRACIAS POR SU COMPRA c:",0,0,'C');
		$pdf->Ln(1.5);


	}
}
$pdf->output();