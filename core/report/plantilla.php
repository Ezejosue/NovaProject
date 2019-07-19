<?php
    require_once('../libraries/fpdf/fpdf.php');

    class PDF extends FPDF

    {
        private $title;

        //función para el titulo de los reportes
        function head($title){
            //aqui se llama el titulo según el parámetro que se le mando en el reporte
            $this->title = $title;
            //agregar pagina al reporte
            $this->AddPage();
            $this->AliasNbPages();
            //asignación de margenes izquierda, derecha, arriba
            $this->SetMargins(10, 15 ,20); 
            //asignación de margenes de abajo
            $this->SetAutoPageBreak(true,25);
           
        }

        //función para el header de los reportes
        function Header()
        {
            //cuando se inicia la sesión se ejecuta la función
            session_start();
            //imagen del logo con sus respectivas propiedades
            $this->Image('../../resources/img/logo.png', 5, 7, 20);
            //la celda en donde esta ubicado
            $this->Cell(20, 1);
            //se setean las fuentes de letra que se van a usar al igual que los atributos del texto y la posicion
            $this->SetFont('Arial', 'B', 10);
            //se setea el color del texto
            $this->SetTextColor(255,255,255);
            //en el caso que posea un cuadro donde se encuentre el texto se setea el color de ese cuadro donde esta ubicado
            $this->SetFillColor(36, 113, 163);
            //se manda una celda donde se encuentra el texto que se fijo anteriormente en el reporte
            $this->Cell(65,8, utf8_decode($this->title),0,0,'C', true);
            //salto de linea
            $this->Ln(3);
        }

        //función para mostrar las fechas de elaboración de los reportes
        function date()
        {
            //salto de linea
            $this->Ln(10);
            //se setea cual es el tipo de letra con sus propiedades
            $this->SetFont('Arial', '', 7);
            //se setea la posición en x y y de la fecha
            $this->SetXY(40.2,19); 
            //se setea el color del texto
            $this->SetTextColor(0, 0, 0);
            //en el caso que posea un cuadro donde se encuentre el texto se setea el color de ese cuadro donde esta ubicado
            $this->SetFillColor(255,255,255);
            //celda donde se encuentra el texto de hora y fecha
            $this->Cell(7,8, utf8_decode('Hora y fecha del reporte:'),0,0,'R', false);
            //función para llamar la fecha de elaboración del reporte
            $this->Cell(40,8, utf8_decode(date('G:i j/n/Y') ),0,0,'L', false);
            //salto de linea
            $this->Ln(1);
        }

        //función para el footer de los reportes en donde se encuentra el numero de pagina
        function Footer()
        {
            //se setea la posición en x y y del texto
            $this->SetXY(47.10,134); 
            //se setea el tipo de letra y las propiedades que contenga este texto
            $this->SetFont('Arial', 'B', 6);
            //se setea el color de la letra
            $this->SetTextColor(0, 0, 0);
            //se manda una celda donde contenga el numero de pagina que es una función ya establecida en fdpf
            $this->Cell(10,20, utf8_decode('Pagina ').$this->PageNo(),0,0,'C' );
        }
    }