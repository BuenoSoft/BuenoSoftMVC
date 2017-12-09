<?php
namespace Lib;
include('./Lib/fpdf/FPDF.php');
class PDF extends \FPDF
{
    function Footer(){
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','B',10);
        // Número de página
        $this->Cell(0,10,$this->PageNo(),"T",0,'R');
    }
}
