<?php
require_once('plantilla.php');
require_once('../helpers/conexion.php');
require_once('../helpers/validator.php');
require_once('../models/pedidos.php');

ini_set('date.timezone', 'America/El_Salvador');
/* Creamos el objeto pdf (con medidas en milímetros):  */
$pdf = new PDF('P', 'mm', 'Letter');
//Se establecen los margenes (izquierdo, superior, derecho)
$pdf->SetMargins(10, 10, 10);
//Se establece el auto salto de pagina, el segundo parámetro el que establece la activación por defecto son 2 cm
$pdf->SetAutoPageBreak(true,20);  
//Agregamos la primera pagina al documento pdf  
$pdf->addPage();
$pedidos = new Pedidos();
$pdf->SetFont('Arial','B',10);
$data = $pedidos->readPedidosFecha();
// Cell(ancho, Alto, texto, borde, salto de linea, alineacion de texto)
$pdf->Ln();
$pdf->setX(60);
$pdf->Cell(100,5, utf8_decode('REPORTE DE PEDIDOS POR FECHA'), 0, 0, 'C');  
$pdf->Ln(10);
// Seteamos la posición de la proxima celda en forma fija a 3.8 cm hacia la derecha de la pagina
$pdf->setX(30);      
//Se coloca el color del fondo de las celdas en formato rgb
$pdf->SetFillColor(239, 127, 26);
//Se coloca el color del texto en formato rgb
$pdf->SetTextColor(0,0,0);
$pdf->Cell(125,10, utf8_decode('FECHA'),1,0,'C', true);
$pdf->Cell(25,10, utf8_decode('PEDIDOS'),1,0,'C', true);
$pdf->Ln();

 //Comienza a crear las filas de productos según la consulta mysql del modelo
foreach($data as $datos){
        $pdf->setX(30);
         // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
        //convertimos el texto a utf8
        $pdf->Cell(125,10, utf8_decode($datos['fecha_pedido']),1,0,'C');
        $pdf->Cell(25,10, utf8_decode($datos['Pedidos']),1,0,'C');
        //saldo de linea
        $pdf->Ln();
}


$pdf->AliasNbPages();
$pdf->Output();
?>