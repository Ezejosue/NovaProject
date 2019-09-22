<?php
require_once('plantilla.php');
require_once('../helpers/conexion.php');
require_once('../helpers/validator.php');
require_once('../models/pedidos.php');

ini_set('date.timezone', 'America/El_Salvador');
// Creamos el objeto pdf (con medidas en milímetros)
$pdf = new PDF('P', 'mm', 'Letter');
$platillos = new Pedidos;
//Se establecen los margenes (izquierdo, superior, derecho)
$pdf->SetMargins(20, 20, 20);
//Se establece el auto salto de pagina, el segundo parámetro el que establece la activación por defecto son 2 cm
$pdf->SetAutoPageBreak(true,20);  
//Agregamos la primera pagina al documento pdf  
$pdf->addPage();
$pdf->SetFont('Arial','B',10);
$pdf->Ln();
$pdf->setX(60);
// Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto)
$pdf->Cell(100,5, utf8_decode('REPORTE DE PEDIDOS POR FECHA'), 0, 0, 'C');  
$pdf->Ln(20);
// Seteamos la posición de la proxima celda en forma fija a 3.8 cm hacia la derecha de la pagina
$pdf->setX(30);      
//Se coloca el color del fondo de las celdas en formato rgb
$pdf->SetFillColor(239, 127, 26);
//Se coloca el color del texto en formato rgb
$pdf->SetTextColor(0,0,0);


if($platillos->readPedidosFecha1($_GET['fecha'], $_GET['fecha2'])) {
        $data = $platillos->readPedidosFecha1($_GET['fecha'], $_GET['fecha2']);
        $fecha = '';
        foreach($data as $datos){
                if(utf8_decode($datos['fecha_pedido']) != $fecha){
                $fecha = $datos['fecha_pedido'];
                $pdf->Cell(25,10, utf8_decode('Fecha:'),1,0,'C');
                $pdf->Cell(125,10, utf8_decode($fecha),1,1,'C');
                $pdf->Ln();
                $pdf->setX(30);
                $pdf->Cell(25,10, utf8_decode('# PEDIDO'),1,0,'C', true);
                $pdf->Cell(50,10, utf8_decode('USUARIO'),1,0,'C', true);
                $pdf->Cell(50,10, utf8_decode('HORA DEL PEDIDO'),1,0,'C', true);
                $pdf->Cell(25,10, utf8_decode('# MESA'),1,0,'C', true);
                $pdf->Ln();
                }
        $pdf->setX(30);
        // Cell(ancho, Alto, texto, borde, salto de linea, alineación de texto, color)
        //convertimos el texto a utf8
        $pdf->Cell(25,10, utf8_decode($datos['id_pedido']),1,0,'C');
        $pdf->Cell(50,10, utf8_decode($datos['alias']),1,0,'C');
        $pdf->Cell(50,10, utf8_decode($datos['hora_pedido']),1,0,'C');
        $pdf->Cell(25,10, utf8_decode($datos['numero_mesa']),1,0,'C');
        //saldo de linea
        $pdf->Ln();
        }
} else {
        $pdf->setX(37);
        $pdf->Cell(145,5, utf8_decode('NO HAY DATOS REGISTRADOS'), 0, 0, 'C');
}



$pdf->AliasNbPages();
$pdf->Output();
?>