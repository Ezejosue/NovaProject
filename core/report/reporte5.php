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
//Se coloca el color del fondo de las celdas en formato rgb
$pdf->SetFillColor(239, 127, 26);
//Se coloca el color del texto en formato rgb
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
$pdf->setX(60);
// Cell(ancho, Alto, texto, borde, salto de linea, alineacion de texto)
$pdf->Cell(100,5, utf8_decode('REPORTE DE GANANCIAS POR CATEGORÍA'), 0, 0, 'C');  
$pdf->Ln(10);
$categoria = '';

if($platillos->platillos_vendidos_categoria()) {
  $data = $platillos->platillos_vendidos_categoria();
  foreach($data as $datos){
    if(utf8_decode($datos['nombre_categoria']) != $categoria){
        $cuenta = 0;
        $ganacias = 0;
        $vendidos = 0;
        $pdf->Ln();
        $pdf->setX(30);
        // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
        //convertimos el texto a utf8
        $pdf->Cell(155,10, utf8_decode($datos['nombre_categoria']),1,0,'C',true);
        $pdf->Ln();        
        $pdf->setX(30);
        $pdf->Cell(123,10, utf8_decode('Platillo'),1,0,'C');
        $pdf->Cell(15,10, utf8_decode('Vendido'),1,0,'C');
        $pdf->Cell(17,10, utf8_decode('Ganancia'),1,0,'C');
        $categoria = $datos['nombre_categoria'];
        //saldo de linea
        $pdf->Ln();
    }
        $pdf->setX(30);
        $pdf->Cell(123,10, utf8_decode($datos['nombre_platillo']),1,0,'C');
        $pdf->Cell(15,10, utf8_decode($datos['cant']),1,0,'C');
        $pdf->Cell(17,10, utf8_decode('$'.$datos['Ganancia']),1,1,'C');
        $ganacias = $ganacias + $datos['Ganancia'];
        $vendidos = $vendidos + $datos['cant'];
        $cuenta = $cuenta + 1;
        if($cuenta != 1) {
          $pdf->setX(30);
          $pdf->Cell(123,10, 'TOTAL',1,0,'C');
          $pdf->Cell(15,10, utf8_decode($vendidos),1,0,'C');
          $pdf->Cell(17,10, utf8_decode('$'.$ganacias),1,0,'C');
          $pdf->Ln();
        }
  }
  
} else {
  $pdf->setX(37);
  $pdf->Cell(145,5, utf8_decode('NO HAY DATOS REGISTRADOS'), 0, 0, 'C');
}

$pdf->AliasNbPages();
$pdf->Output();
?>