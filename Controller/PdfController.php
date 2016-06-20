<?php
namespace Controller;
use \App\Session;
use \Clases\Aplicacion;
class PdfController extends AppController
{
    public function todos(){
        $aplicaciones = (new Aplicacion())->findAdvance([
            "aeronave" => isset($_POST["aeronave"]) ? $_POST["aeronave"] : null,
            "piloto" => isset($_POST["piloto"]) ? $_POST["piloto"] : null,
            "tipo" => isset($_POST["tipo"]) ? $_POST["tipo"] : null,
            "cliente" => isset($_POST["cliente"]) ? $_POST["cliente"] : null,
            "fec1" => isset($_POST["fec1"]) ? $_POST["fec1"] : null,
            "fec2" => isset($_POST["fec2"]) ? $_POST["fec2"] : null
        ]);
        $this->getPdf()->AddPage();
        $this->getPdf()->SetFont('Arial','B',16);
        $this->getPdf()->Cell(40,10,'Informe de Aplicaciones');
        $this->getPdf()->Ln(5);
        $this->getPdf()->SetFont('Arial','B',12);
        $this->getPdf()->Cell(40,10,'Hecho por: '.Session::get('log_in')->getDatoUsu()->getNombre());
        $this->getPdf()->Ln(10);
        $this->getPdf()->Cell(27, 8, utf8_decode('Aplicación'), 0);
	$this->getPdf()->Cell(24, 8, 'Piloto', 0);
	$this->getPdf()->Cell(27, 8, 'Aeronave', 0);
	$this->getPdf()->Cell(26, 8, 'Cliente', 0);
	$this->getPdf()->Cell(24, 8, 'Pista', 0);
	$this->getPdf()->Cell(23, 8, 'Tipo', 0);
	$this->getPdf()->Cell(25, 8, 'Fecha', 0);
	$this->getPdf()->Ln(8);
        foreach ($aplicaciones as $aplicacion){
            $this->getPdf()->Cell(27, 8, $aplicacion->getId(), 0);
            $this->getPdf()->Cell(24, 8, $this->getPiloto($aplicacion)->getDatoUsu()->getNombre(), 0);
            $this->getPdf()->Cell(27, 8, $this->getAeronave($aplicacion)->getMatricula(), 0);
            $this->getPdf()->Cell(26, 8, $aplicacion->getCliente()->getNombre(), 0);
            $this->getPdf()->Cell(24, 8, $aplicacion->getPista()->getNombre(), 0);
            $this->getPdf()->Cell(23, 8, $aplicacion->getTipo()->getNombre(), 0);
            $this->getPdf()->Cell(25, 8, ($aplicacion->getFechaIni() == "0000-00-00 00:00:00") ? "" : $aplicacion->getFechaIni(), 0);
        }
        $this->getPdf()->Output();
    }
    private function getPiloto($aplicacion){
        foreach($aplicacion->getUsados() as $piloto){
            if($piloto->getUsuario()->getRol()->getNombre() == "Piloto"){
                return $piloto->getUsuario();                
            }
        }
        return null;
    }
    private function getAeronave($aplicacion){
        foreach($aplicacion->getUsados() as $aereo){
            if($aereo->getVehiculo()->getTipo()->getNombre() == "Aeronave"){
                return $aereo->getVehiculo();
            }
        }
        return null;
    }
}