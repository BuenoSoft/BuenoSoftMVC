<?php
namespace Controller;
use \App\Session;
use \Clases\Aplicacion;
class PdfController extends AppController
{
    public function todos(){
        if($this->checkUser()){
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
    }
    public function myapp(){
        if($this->checkUser()){
            $aplicacion = (new Aplicacion())->findById($_GET['d']);
            $this->getPdf()->AddPage();
            $this->getPdf()->SetFont('Arial','B',16);
            $this->getPdf()->Cell(40,10,  utf8_decode('Fichas de Operaciones Agrícolas'));
            $this->getPdf()->Ln(15);
            $this->getPdf()->Cell(30, 8, 'Aeronave:', 0);
            $this->getPdf()->Cell(27, 8, $this->getAeronave($aplicacion)->getMatricula(), 0);
            $this->getPdf()->Cell(60, 8, 'Piloto:', 0,0,"R");        
            $this->getPdf()->Cell(40, 8, $this->getPiloto($aplicacion)->getDatoUsu()->getNombre(), 0,0,"R");             
            $this->getPdf()->Ln(10);
            $this->getPdf()->Cell(27, 8, 'Usuario:', 0);
            $this->getPdf()->Cell(27, 8, $aplicacion->getCliente()->getDatoUsu()->getNombre(), 0);
            $this->getPdf()->Cell(59, 8, 'RUT:', 0,0,"R");
            $this->getPdf()->Cell(40, 8, $aplicacion->getCliente()->getDatoUsu()->getDocumento(), 0,0,"R");
            $this->getPdf()->Ln(10);
            $this->getPdf()->Cell(27, 8, 'Cultivo:', 0);
            $this->getPdf()->Cell(27, 8, $aplicacion->getCultivo(), 0);
            $this->getPdf()->Cell(67, 8, 'Padron:', 0,0,"R");
            $this->getPdf()->Cell(30, 8, $aplicacion->getPadron(), 0,0,"R");
            $this->getPdf()->Ln(10);
            $this->getPdf()->Cell(37, 8, 'Tratamiento:', 0);
            $this->getPdf()->Cell(27, 8, $aplicacion->getTratamiento(), 0);
            $this->getPdf()->Cell(69, 8, 'Coord/Pista:', 0,0,"R");
            $this->getPdf()->Ln(10);
            $this->getPdf()->Cell(42, 8, 'Area Aplicada:', 0);
            $this->getPdf()->Cell(27, 8, $aplicacion->getAreaApl(), 0);
            $this->getPdf()->Cell(67, 8, $aplicacion->getPista()->getCoordenadas(), 0,0,"R");        
            $this->getPdf()->Ln(10);
            $this->getPdf()->Cell(27, 8, 'Caudal:', 0);
            $this->getPdf()->Cell(27, 8, $aplicacion->getCaudal(), 0);
            $this->getPdf()->Cell(85, 8, 'Coord/Cultivo:', 0,0,"R");
            $this->getPdf()->Ln(8);        
            $this->getPdf()->Cell(147, 8, $aplicacion->getCoordCul(), 0,0,"R");
            $this->getPdf()->Ln(20);
            $this->getPdf()->Cell(27, 8, 'Productos:', 0,0,"L");
            $this->getPdf()->Cell(85, 8, 'Faja:', 0,0,"R");
            $this->getPdf()->Cell(13, 8, $aplicacion->getFaja(), 0,0,"R");
            $this->getPdf()->Ln(8);
            $this->getPdf()->Cell(116, 8, 'Dosis:', 0,0,"R");
            $this->getPdf()->Cell(25, 8, $aplicacion->getDosis(), 0,0,"R");                
            foreach($aplicacion->getProductos() as $producto){
                $this->getPdf()->Ln(8);
                $this->getPdf()->Cell(27, 8, $producto->getNombre(), 0,0,"L");
            }        
            $this->getPdf()->Ln(20);
            $this->getPdf()->Cell(27, 8, 'Viento:', 0);
            $this->getPdf()->Cell(101, 8, 'Incidencia:', 0,0,"R");
            $this->getPdf()->Ln(10);
            $this->getPdf()->Cell(27, 8, 'HR:', 0);
            $this->getPdf()->Cell(27, 8, $aplicacion->getViento(), 0);
            $this->getPdf()->Cell(73, 8, 'Hora Inicio', 0,0,"R");
            $this->getPdf()->Cell(30, 8, 'Hora Final', 0,0,"R");
            $this->getPdf()->Ln(8);
            $this->getPdf()->Cell(118, 8, $this->getTime($aplicacion->getFechaIni()), 0,0,"R");
            $this->getPdf()->Cell(30, 8, $this->getTime($aplicacion->getFechaFin()), 0,0,"R");
            $this->getPdf()->Ln(20);
            $this->getPdf()->Cell(27, 8, 'Chofer:', 0);
            $this->getPdf()->Cell(27, 8, $this->getChofer($aplicacion)->getDatoUsu()->getNombre());
            $this->getPdf()->Ln(15);
            $this->getPdf()->Cell(35, 8, 'TE', 1,0,"R");
            $this->getPdf()->Cell(50, 8, 'TT', 1,0,"R");
            $this->getPdf()->Cell(45, 8, 'T/A', 1,0,"R");
            $this->getPdf()->Ln(8);
            $this->getPdf()->Cell(35, 8, $aplicacion->getTaquiIni(), 1,0,"R");
            $this->getPdf()->Cell(50, 8, $aplicacion->getTaquiFin(), 1,0,"R");
            $this->getPdf()->Cell(45, 8, $aplicacion->taquiDif(), 1,0,"R");
            $this->getPdf()->Output();
        }
    }
    private function getPiloto($aplicacion){
        foreach($aplicacion->getUsados() as $piloto){
            if($piloto->getUsuario()->getRol()->getNombre() == "Piloto"){
                return $piloto->getUsuario();                
            }
        }
        return null;
    }
    private function getChofer($aplicacion){
        foreach($aplicacion->getUsados() as $chofer){
            if($chofer->getUsuario()->getRol()->getNombre() == "Chofer"){
                return $chofer->getUsuario();                
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
    private function getTime($datetime){
        if($datetime == "0000-00-00 00:00:00"){
            return null;
        } else {
            $date = date_create($datetime);
            return date_format($date,"H:i");            
        }
    }
    protected function getRoles() {
        return ["Administrador","Supervisor","Piloto","Cliente"];
    }
    protected function getMessageRole() {
        return "cualquier usuario menos uno tipo cliente";
    }
}