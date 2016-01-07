<?php
namespace Controller;
use App\Controller;
use App\Session;
use Model\VehiculoModel;
include(APPLICATION_PATH . '/Lib/fpdf/fpdf.php');
class PdfController extends Controller
{
    private $pdf;
    private $mod_v;
    function __construct() {
        parent::__construct();
        $this->pdf = new FPDF();
        $this->mod_v = new VehiculoModel();
    }
    private function getPDF(){
        return $this->pdf;
    }
    public function rep_vehiculos(){
        if($this->checkUser()){
            Session::set('pdf', $this->getPDF());
            $this->getPDF()->AddPage();
            $this->getPDF()->SetFont('Arial','B',16);
            $this->getPDF()->Cell(40,10,utf8_decode('Reporte de Vehículos'));
            $this->getPDF()->Ln(15);
            $this->getPDF()->SetFont('Arial','B',12);
            $this->getPDF()->Cell(30,5,utf8_decode('Vehículo'),1);
            $this->getPDF()->Cell(30,5,utf8_decode('Matrícula'),1);
            $this->getPDF()->Cell(30,5,'Cantidad',1);
            $this->getPDF()->Cell(30,5,utf8_decode('Descripción'),1);
            $this->getPDF()->Cell(40,5,'Modelo',1);
            $this->getPDF()->Cell(30,5,'Tipo',1);
            $this->getPDF()->Ln(8);
            foreach ($this->mod_v->obtenerTodos() as $vehiculo){
                $this->getPDF()->Cell(30,5,$vehiculo->getId(),1);
                $this->getPDF()->Cell(30,5,$vehiculo->getMat(),1);
                $this->getPDF()->Cell(30,5,$vehiculo->getCant(),1);
                $this->getPDF()->Cell(30,5,$vehiculo->getDescrip(),1);
                $this->getPDF()->Cell(40,5,$vehiculo->getModelo()->getNombre(),1);
                $this->getPDF()->Cell(30,5,utf8_decode($vehiculo->getTipo()->getNombre()),1);
                $this->getPDF()->Ln(5);
            }
            $this->getPDF()->Output();
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