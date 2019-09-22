<?php
require_once('plantilla.php');
require_once('../helpers/conexion.php');
require_once('../helpers/validator.php');
require_once('../models/platillos.php');

ini_set('date.timezone', 'America/El_Salvador');
/* Creamos el objeto pdf (con medidas en milímetros):  */
$pdf = new PDF('P', 'mm', 'Letter');
//Se establecen los margenes (izquierdo, superior, derecho)
$pdf->SetMargins(20, 20, 20);
//Se establece el auto salto de pagina, el segundo parámetro el que establece la activación por defecto son 2 cm
$pdf->SetAutoPageBreak(true,20);  
//Agregamos la primera pagina al documento pdf  
$pdf->addPage();
$platillos = new Platillos();
$pdf->SetFont('Arial','B',10);
$pdf->Ln();
$pdf->setX(60);
// Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto)
$pdf->Cell(100,5, utf8_decode('REPORTE DE GANANCIA POR PLATILLO'), 0, 0, 'C');  
$pdf->Ln(10);
// Seteamos la posición de la proxima celda en forma fija a 3.8 cm hacia la derecha de la pagina
$pdf->setX(20);
//Se coloca el color del fondo de las celdas en formato rgb
$pdf->SetFillColor(239, 127, 26);
$categoria = '';
if($platillos->platillos_vendidos()) {
  $data = $platillos->platillos_vendidos();
  //Se coloca el color del texto en formato rgb
  $pdf->SetTextColor(0,0,0);
  // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
  //convertimos el texto a utf8
  $pdf->Cell(125,10, utf8_decode('Platillo'),1,0,'C', true);
  $pdf->Cell(20,10, utf8_decode('Vendidos'),1,0,'C', true);
  $pdf->Cell(30,10, utf8_decode('Ganancia ($)'),1,0,'C', true);
  //Comienza a crear las filas de productos según la consulta mysql del modelo
  foreach($data as $datos){
      $pdf->Ln();
      $pdf->setX(20);
      // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
      //convertimos el texto a utf8
      $pdf->Cell(125,10, utf8_decode($datos['nombre_platillo']),1,0,'C');
      $pdf->Cell(20,10, utf8_decode($datos['Vendidos']),1,0,'C');
      $pdf->Cell(30,10, utf8_decode($datos['Ganancia']),1,0,'C');
  }
} else {
  $pdf->setX(37);
  $pdf->Cell(145,5, utf8_decode('NO HAY DATOS REGISTRADOS'), 0, 0, 'C');
}

$pdf->AliasNbPages();
$pdf->Output();
?>