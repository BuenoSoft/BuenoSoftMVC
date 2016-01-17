<?php
namespace Controller;
use \App\Controller;
use \Clases\Vehiculo;
include('./Lib/fpdf/FPDF.php');
class PdfController extends Controller
{
    private $pdf;
    function __construct() {
        parent::__construct();
        $this->pdf = new \FPDF();
    }
    public function rep_vehiculos(){
        if($this->checkUser()){
            $this->pdf->AddPage();
            $this->pdf->SetFont('Arial','B',16);
            $this->pdf->Cell(40,10,utf8_decode('Reporte de Vehículos'));
            $this->pdf->Ln(5);
            $this->pdf->SetFont('Arial','B',12);
            $this->pdf->Ln(8);
            foreach ((new Vehiculo())->find() as $vehiculo){
                $this->pdf->Cell(20,5,$this->pdf->Image($vehiculo->getFoto(),null,null,40,40));
                $this->pdf->Cell(30);
                $this->pdf->Cell(20,-70,utf8_decode('Vehículo:')." ".$vehiculo->getId()." ".utf8_decode('Matrícula:')." ".$vehiculo->getMat()." Tipo:"." ".$vehiculo->getTipo()->getNombre());                
                $this->pdf->Ln(5);
                $this->pdf->Cell(50);
                $this->pdf->Cell(20,-70,"Precio: ".$vehiculo->getPrecio()." Cantidad: ".$vehiculo->getCant()." Modelo: ".$vehiculo->getModelo()->getNombre());
                $this->pdf->Ln(5);
                $this->pdf->Cell(50);
                $this->pdf->Cell(20,-70,utf8_decode('Descripción:'));
                $this->pdf->Ln(5);
                $this->pdf->Cell(50);
                $this->pdf->Cell(20,-70,$vehiculo->getDescrip());
                $this->pdf->Ln(10);
            }
            $this->pdf->Output();
        }
    }
    protected function getMessageRole() {
        return "administrador";
    }
    protected function getTypeRole() {
        return "ADMIN";
    }
}