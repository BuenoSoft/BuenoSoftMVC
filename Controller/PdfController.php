<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Model\VehiculoModel;
include('./Lib/fpdf/FPDF.php');
class PdfController extends Controller
{
    private $pdf;
    private $mod_v;
    function __construct() {
        parent::__construct();
        $this->pdf = new \FPDF();
        $this->mod_v = new VehiculoModel();
    }
   public function rep_vehiculos(){
        if($this->checkUser()){
            $this->pdf->AddPage();
            $this->pdf->SetFont('Arial','B',16);
            $this->pdf->Cell(40,10,utf8_decode('Reporte de Vehículos'));
            $this->pdf->Ln(15);
            $this->pdf->SetFont('Arial','B',12);
            $this->pdf->Cell(30,5,utf8_decode('Vehículo'),1);
            $this->pdf->Cell(30,5,utf8_decode('Matrícula'),1);
            $this->pdf->Cell(30,5,'Cantidad',1);
            $this->pdf->Cell(30,5,utf8_decode('Descripción'),1);
            $this->pdf->Cell(40,5,'Modelo',1);
            $this->pdf->Cell(30,5,'Tipo',1);
            $this->pdf->Ln(8);
            foreach ($this->mod_v->obtenerTodos() as $vehiculo){
                $this->pdf->Cell(30,5,$vehiculo->getId(),1);
                $this->pdf->Cell(30,5,$vehiculo->getMat(),1);
                $this->pdf->Cell(30,5,$vehiculo->getCant(),1);
                $this->pdf->Cell(30,5,$vehiculo->getDescrip(),1);
                $this->pdf->Cell(40,5,$vehiculo->getModelo()->getNombre(),1);
                $this->pdf->Cell(30,5,utf8_decode($vehiculo->getTipo()->getNombre()),1);
                $this->pdf->Ln(5);
            }
            $this->pdf->Output();
        }
    }
    private function checkUser(){
        if(Session::get("log_in")!= null and Session::get("log_in")->getRol()->getNombre() == "admin"){
            return true;
        }
        else {
            Session::set("msg","Debe ser administrador para acceder.");
            $this->redirect(array('Main','index.php'));
        }
    }
}