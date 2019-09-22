<?php

	ini_set('date.timezone', 'America/El_Salvador');
	require '../libraries/fpdf/fpdf.php';	
	session_start();
	
	//Creamos la nueva clase pdf que hereda de fpdf
	if (isset($_SESSION['idUsuario'])){
		class PDF extends FPDF
		{
			function Header()
			{
				// seteamos el tipo de letra Arial Negrita 10 
				$this->SetFont('Arial','B',10);
				$this->Image('../../resources/img/logo.png', 28, 15, 33 );
				$this->SetX(150);
				$this->Cell(50,5,('Fecha: ' .date('d/m/Y')),0,0,'L');
				$this->Ln();
				$this->SetX(150);
				$this->Cell(50,5,('Hora: ' .date('H:i:s')),0,0,'L');
				$this->Ln();
				$this->SetX(150);
				$this->Cell(50,5,('Usuario:'.$_SESSION['aliasUsuario']),0,0,'L');
				$this->Ln();
				// Seteamos la posición de la próxima celda en forma fija a 15 cm hacia la derecha de la pagina
				$this->SetX(150);/* 
				$this->Cell(50,5,('Usuario: '.$_SESSION['nombreUsuario']),0,0,'L');
				// Salto de línea salta 10 lineas */
				$this->Ln(10);
			}
			
			function Footer()
			{
				// Seteamos la posición de la próxima celda en forma fija a 1,5 cm del final de la pagina
				$this->SetY(-15);
				// seteamos el tipo de letra Arial Negrita 8 
				$this->SetFont('Arial','B', 8);
				// Número de página, el numero de de pagina se establece mediante la función pageno
				$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
			
			}
		}
	} else {
		header('location: ../../views/');
	}
?>