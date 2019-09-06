<?php
require_once('plantilla.php');
require_once('../helpers/conexion.php');
require_once('../helpers/validator.php');
require_once('../models/categorias.php');

ini_set('date.timezone', 'America/El_Salvador');
/* Creamos el objeto pdf (con medidas en milímetros):  */
$pdf = new PDF('P', 'mm', 'Letter');
$platillos = new Categorias;
//Se establecen los margenes (izquierdo, superior, derecho)
$pdf->SetMargins(20, 20, 20);
//Se establece el auto salto de pagina, el segundo parámetro el que establece la activación por defecto son 2 cm
$pdf->SetAutoPageBreak(true,20);  
//Agregamos la primera pagina al documento pdf  
$pdf->addPage();

$pdf->SetFont('Arial','B',10);
$data = $platillos->ventas_categoria_reporte($_GET['id_categoria']);
$pdf->Ln();
$pdf->setX(60);
// Cell(ancho, Alto, texto, borde, salto de linea, alineacion de texto)
$pdf->Cell(100,5, utf8_decode('REPORTE DE GANANCIAS POR CATEGORÍA'), 0, 0, 'C');  
$pdf->Ln(10);
// Seteamos la posición de la proxima celda en forma fija a 3.8 cm hacia la derecha de la pagina
$pdf->setX(38);
$pdf->Ln();
$categoria = '';

//Comienza a crear las filas de productos según la consulta mysql del modelo
foreach($data as $datos){
    if(utf8_decode($datos['nombre_platillo']) != $categoria){
        //Se coloca el color del fondo de las celdas en formato rgb
        $pdf->SetFillColor(239, 127, 26);
        //Se coloca el color del texto en formato rgb
        $pdf->SetTextColor(0,0,0);
        $pdf->Ln();
        $pdf->setX(30);
        // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
        //convertimos el texto a utf8
        $pdf->Cell(155,10, utf8_decode($datos['nombre_platillo']),1,0,'C',true);
        $pdf->Ln();        
        $pdf->setX(30);
        $pdf->Cell(15,10, utf8_decode('Cantidad'),1,0,'C');
        $pdf->Cell(140,10, utf8_decode('Ganancia'),1,0,'C');
        $categoria = $datos['nombre_platillo'];
        //saldo de linea
        $pdf->Ln();
    }
        
        $pdf->setX(30);
          // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
        //convertimos el texto a utf8
        $pdf->Cell(15,10, utf8_decode($datos['cantidad']),1,0,'C');
        $pdf->Cell(140,10, utf8_decode($datos['subtotal']),1,0,'C');
        $pdf->Ln();
}


$pdf->AliasNbPages();
$pdf->Output();
?>