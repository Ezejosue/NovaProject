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
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239, 127, 26);
$pdf->Ln();
$pdf->setX(60);
// Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto)
$pdf->Cell(100,5, utf8_decode('REPORTE DE PRODUCTOS DESPERDICIADOS'), 0, 0, 'C');  
$pdf->Ln(10);
// Seteamos la posición de la próxima celda en forma fija a 3.0 cm hacia la derecha de la pagina
$pdf->setX(30);
$pdf->Ln();
if($platillos->readRecetaDesperdicio($_GET['fecha3'], $_GET['fecha4'])) {
  $data = $platillos->readRecetaDesperdicio($_GET['fecha3'], $_GET['fecha4']);
  $categoria = '';
  // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
  $pdf->Cell(33,10, utf8_decode('EMPLEADO'),1,0,'C',1);
  $pdf->Cell(40,10, utf8_decode('FECHA Y HORA'),1,0,'C',1);
  $pdf->Cell(80,10, utf8_decode('RECETA'),1,0,'C',1);
  $pdf->Cell(22,10, utf8_decode('CANTIDAD'),1,0,'C',1);
  foreach($data as $datos){
    //Se coloca el color del fondo de las celdas en formato rgb
    $pdf->SetFillColor(239, 127, 26);
    //Se coloca el color del texto en formato rgb
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln();
    $pdf->Cell(33,10, utf8_decode($datos['nombre_empleado']),1,0,'C');
    $pdf->Cell(40,10, utf8_decode($datos['fecha_desperdicio']),1,0,'C');
    $pdf->Cell(80,10, utf8_decode($datos['nombre_receta']),1,0,'C');
    $pdf->Cell(22,10, utf8_decode($datos['cantidad']),1,0,'C');
  }
} else {
  $pdf->setX(37);
  $pdf->Cell(145,5, utf8_decode('NO HAY DATOS REGISTRADOS'), 0, 0, 'C');
}
$pdf->AliasNbPages();
$pdf->Output();
?>