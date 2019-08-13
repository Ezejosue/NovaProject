<?php
require_once('plantilla.php');
require_once('../helpers/conexion.php');
require_once('../helpers/validator.php');
require_once('../models/desperdicios.php');

ini_set('date.timezone', 'America/El_Salvador');
/* Creamos el objeto pdf (con medidas en milímetros):  */
$pdf = new PDF('P', 'mm', 'Letter');
$platillos = new Desperdicios;
//Se establecen los margenes (izquierdo, superior, derecho)
$pdf->SetMargins(20, 20, 20);
//Se establece el auto salto de pagina, el segundo parámetro el que establece la activación por defecto son 2 cm
$pdf->SetAutoPageBreak(true,20);  
//Agregamos la primera pagina al documento pdf  
$pdf->addPage();
$pdf->SetFont('Helvetica','B',10);
$pdf->SetFillColor(239, 127, 26);
$data = $platillos->readRecetaDesperdicio($_GET['fecha'], $_GET['fecha2']);
// Cell(ancho, Alto, texto, borde, salto de linea, alineacion de texto)
$pdf->Ln();
$pdf->setX(60);
$pdf->Cell(100,5, utf8_decode('REPORTE DE PRODUCTOS DESPERDICIADOS'), 0, 0, 'C');  
$pdf->Ln(10);
// Seteamos la posición de la proxima celda en forma fija a 3.8 cm hacia la derecha de la pagina
$pdf->setX(38);
$pdf->Ln();
$categoria = '';
// Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
//convertimos el texto a utf8
$pdf->Cell(30,10, utf8_decode('Empleado'),1,0,'C',1);
$pdf->Cell(40,10, utf8_decode('Fecha'),1,0,'C',1);
$pdf->Cell(80,10, utf8_decode('Receta'),1,0,'C',1);
$pdf->Cell(0,10, utf8_decode('Cantidad'),1,0,'C',1);

//Comienza a crear las filas de productos según la consulta mysql del modelo
foreach($data as $datos){
  //Se coloca el color del fondo de las celdas en formato rgb
  $pdf->SetFillColor(239, 127, 26);
  //Se coloca el color del texto en formato rgb
  $pdf->SetTextColor(0,0,0);
  $pdf->Ln();
    // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
  //convertimos el texto a utf8
  $pdf->Cell(30,10, utf8_decode($datos['nombre_empleado']),1,0,'C');
  $pdf->Cell(40,10, utf8_decode($datos['fecha_desperdicio']),1,0,'C');
  $pdf->Cell(80,10, utf8_decode($datos['nombre_receta']),1,0,'C');
  $pdf->Cell(0,10, utf8_decode($datos['cantidad']),1,0,'C');
}


$pdf->AliasNbPages();
$pdf->Output();
?>