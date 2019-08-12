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
$pdf->SetMargins(10, 10, 10);
//Se establece el auto salto de pagina, el segundo parámetro el que establece la activación por defecto son 2 cm
$pdf->SetAutoPageBreak(true,20);  
//Agregamos la primera pagina al documento pdf  
$pdf->addPage();

$pdf->SetFont('Arial','B',10);
$data = $platillos->readRecetaDesperdicio($_GET['receta']);
// Cell(ancho, Alto, texto, borde, salto de linea, alineacion de texto)
$pdf->Ln();
$pdf->setX(60);
$pdf->Cell(100,5, utf8_decode('REPORTE DE PRODUCTOS DESPERDICIADOS'), 0, 0, 'C');  
$pdf->Ln(10);
// Seteamos la posición de la proxima celda en forma fija a 3.8 cm hacia la derecha de la pagina
$pdf->setX(38);
$pdf->Ln();
$categoria = '';

//Comienza a crear las filas de productos según la consulta mysql del modelo
foreach($data as $datos){
    if(utf8_decode($datos['nombre_receta']) != $categoria){
        //Se coloca el color del fondo de las celdas en formato rgb
        $pdf->SetFillColor(239, 127, 26);
        //Se coloca el color del texto en formato rgb
        $pdf->SetTextColor(0,0,0);
        $pdf->Ln();
        $pdf->setX(30);
        // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
        //convertimos el texto a utf8
        $pdf->Cell(155,10, utf8_decode($datos['nombre_receta']),1,0,'C',true);
        $pdf->Ln();        
        $pdf->setX(30);
        $pdf->Cell(15,10, utf8_decode('Alias'),1,0,'C');
        $pdf->Cell(40,10, utf8_decode('Fecha'),1,0,'C');
        $pdf->Cell(100,10, utf8_decode('Desperdicios'),1,0,'C');
        $categoria = $datos['nombre_receta'];
        //saldo de linea
        $pdf->Ln();
    }
        
        $pdf->setX(30);
          // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
        //convertimos el texto a utf8
        $pdf->Cell(15,10, utf8_decode($datos['alias']),1,0,'C');
        $pdf->Cell(40,10, utf8_decode($datos['fecha_desperdicio']),1,0,'C');
        $pdf->Cell(100,10, utf8_decode($datos['Desperdicio']),1,0,'C');
        $pdf->Ln();
}


$pdf->AliasNbPages();
$pdf->Output();
?>