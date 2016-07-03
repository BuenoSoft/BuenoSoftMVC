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
            $this->getPdf()->Image('Public/img/manejo/logo.png', 165, 5, 40, 24,'PNG');
            $this->getPdf()->Ln(10);
            $this->getPdf()->SetFont('Arial','B',10);
            $this->getPdf()->Cell(40,10,'Hecho por: '.Session::get('log_in')->getDatoUsu()->getNombre());
            $this->getPdf()->Ln(10);
            $this->getPdf()->Cell(20, 8, utf8_decode('Aplicación'),"TB", 0 ,'C');
            $this->getPdf()->Cell(40, 8, 'Piloto',"TB", 0 ,'C');
            $this->getPdf()->Cell(29, 8, 'Aeronave',"TB", 0 ,'C');
            $this->getPdf()->Cell(27, 8, 'Cliente',"TB", 0 ,'C');
            $this->getPdf()->Cell(32, 8, 'Pista',"TB", 0 ,'C');
            $this->getPdf()->Cell(25, 8, 'Tipo',"TB", 0 ,'C');
            $this->getPdf()->Cell(20, 8, 'Fecha',"TB", 0 ,'C');
            $this->getPdf()->Ln(8);
            foreach ($aplicaciones as $aplicacion){
                $this->getPdf()->Cell(20, 8, $aplicacion->getId(), 0, 0 ,'C');
                $this->getPdf()->Cell(40, 8, $this->getPiloto($aplicacion)->getDatoUsu()->getNombre(), 0, 0 ,'C');
                $this->getPdf()->Cell(29, 8, $this->getAeronave($aplicacion)->getMatricula(), 0, 0 ,'C');
                $this->getPdf()->Cell(27, 8, $aplicacion->getCliente()->getNombre(), 0, 0 ,'C');
                $this->getPdf()->Cell(32, 8, $aplicacion->getPista()->getNombre(), 0, 0 ,'C');
                $this->getPdf()->Cell(25, 8, $aplicacion->getTipo()->getNombre(), 0, 0 ,'C');
                $this->getPdf()->Cell(20, 8, ($aplicacion->getFechaIni() == "0000-00-00 00:00:00") ? "" : $this->getDate($aplicacion->getFechaIni()), 0, 0 ,'C');
                $this->getPdf()->Ln(8);
            }
            $this->getPdf()->Output();         
        }
    }
    public function myapp(){
        if($this->checkUser()){
            $aplicacion = (new Aplicacion())->findById($_GET['d']);
            $this->getPdf()->AddPage();
            $this->getPdf()->SetFont('Arial','B',12);
            $this->getPdf()->Image('Public/img/manejo/logo.png', 25, 5, 72, 42,'PNG');
            $this->getPdf()->SetXY(115, 10);
            $this->getPdf()->Cell(40,10,  utf8_decode('FICHA DE OPERACIONES AGRICOLAS'));
            $this->getPdf()->SetXY(150, 20);
            $this->getPdf()->Cell(15, 10,  utf8_decode('Día'), "TLR",0,"C");
            $this->getPdf()->Cell(15, 10, 'Mes', "TR",0,"C");
            $this->getPdf()->Cell(15, 10, utf8_decode('Año'), "TR",0,"C");
            $this->getPdf()->Ln(10);
            $this->getPdf()->SetXY(150, 30);
            $this->getPdf()->Cell(15,10, $this->getDay($aplicacion->getFechaIni()), 1,0,"C");
            $this->getPdf()->Cell(15, 10, $this->getMonth($aplicacion->getFechaIni()), 1,0,"C");
            $this->getPdf()->Cell(15, 10, $this->getYear($aplicacion->getFechaIni()), 1,0,"C");
            $this->getPdf()->SetXY(10, 50);
            $this->getPdf()->Cell(23, 8, 'Aeronave:', 0);
            $this->getPdf()->Cell(40, 8, $this->getAeronave($aplicacion)->getMatricula(), "B");
            $this->getPdf()->SetXY(10, 60);
            $this->getPdf()->Cell(23, 8, 'Usuario:', 0);
            $this->getPdf()->Cell(40, 8, $aplicacion->getCliente()->getDatoUsu()->getNombre(), "B");
            $this->getPdf()->SetXY(10, 70);
            $this->getPdf()->Cell(23, 8, 'Cultivo:', 0);
            $this->getPdf()->Cell(40, 8, $aplicacion->getCultivo(), "B");
            $this->getPdf()->SetXY(10, 80);
            $this->getPdf()->Cell(28, 8, 'Tratamiento:', 0);
            $this->getPdf()->Cell(40, 8, $aplicacion->getTratamiento(), "B");
            $this->getPdf()->SetXY(10, 90);
            $this->getPdf()->Cell(33, 8, 'Area Aplicada:', 0);
            $this->getPdf()->Cell(40, 8, $aplicacion->getAreaApl(), "B");
            $this->getPdf()->SetXY(10, 100);
            $this->getPdf()->Cell(23, 8, 'Caudal:', 0);
            $this->getPdf()->Cell(40, 8, $aplicacion->getCaudal(), "B");
            /*---------------------------------------------------------------*/
            $this->getPdf()->SetXY(125, 50);
            $this->getPdf()->Cell(15, 8, 'Piloto:', 0);        
            $this->getPdf()->Cell(48, 8, $this->getPiloto($aplicacion)->getDatoUsu()->getNombre(), "B");  
            $this->getPdf()->SetXY(125, 60);
            $this->getPdf()->Cell(12, 8, 'RUT:', 0);
            $this->getPdf()->Cell(48, 8, $aplicacion->getCliente()->getDatoUsu()->getDocumento(), "B");
            $this->getPdf()->SetXY(125, 70);
            $this->getPdf()->Cell(18, 8, 'Padron:', 0);
            $this->getPdf()->Cell(48, 8, $aplicacion->getPadron(), "B");
            $this->getPdf()->SetXY(125, 80);
            $this->getPdf()->Cell(27, 8, 'Coord/Pista:', 0);
            $this->getPdf()->Cell(48, 8, $aplicacion->getPista()->getCoordenadas(), "B");  
            $this->getPdf()->SetXY(125, 90);
            $this->getPdf()->Cell(31, 8, 'Coord/Cultivo:', 0);           
            $this->getPdf()->Cell(48, 8, $aplicacion->getCoordCul(), "B");
            /*---------------------------------------------------------------*/
            $this->getPdf()->SetXY(10, 120);
            $this->getPdf()->Cell(27, 8, 'Productos:', 0);
            foreach($aplicacion->getProductos() as $producto){
                $this->getPdf()->Ln(8);
                $this->getPdf()->Cell(50, 8, $producto->getNombre(), "B");
            }
            /*---------------------------------------------------------------*/
            $this->getPdf()->SetXY(125, 120);
            $this->getPdf()->Cell(12, 8, 'Faja:', 0);
            $this->getPdf()->Cell(48, 8, $aplicacion->getFaja(), "B");
            $this->getPdf()->SetXY(125, 130);
            $this->getPdf()->Cell(15, 8, 'Dosis:', 0);
            $this->getPdf()->Cell(48, 8, $aplicacion->getDosis(), "B");                
            /*---------------------------------------------------------------*/
            $this->getPdf()->SetXY(10, 170);
            $this->getPdf()->Cell(27, 8, 'Viento:', 0);
            $this->getPdf()->SetXY(10, 180);
            $this->getPdf()->Cell(9, 8, 'HR:', 0);
            $this->getPdf()->Cell(40, 8, $aplicacion->getViento(), "B");
            /*---------------------------------------------------------------*/
            $this->getPdf()->SetXY(125, 170);
            $this->getPdf()->Cell(12, 8, 'Incidencia:', 0);
            $this->getPdf()->SetXY(125, 180);
            $this->getPdf()->Cell(25, 8, 'Hora Inicio', 1 , 0, "C");
            $this->getPdf()->Cell(25, 8, 'Hora Final', 1 , 0, "C");
            $this->getPdf()->SetXY(125, 188);
            $this->getPdf()->Cell(25, 8, $this->getTime($aplicacion->getFechaIni()), 1, 0, "C");
            $this->getPdf()->Cell(25, 8, $this->getTime($aplicacion->getFechaFin()), 1 ,0, "C");
            /*---------------------------------------------------------------*/
            $this->getPdf()->SetXY(10, 210);
            $this->getPdf()->Cell(17, 8, 'Chofer:', 0);
            $this->getPdf()->Cell(40, 8, $this->getChofer($aplicacion)->getDatoUsu()->getNombre(),"B");
            /*---------------------------------------------------------------*/
            $this->getPdf()->SetXY(40, 230);
            $this->getPdf()->Cell(50, 10, 'TE', 1,0,"C");
            $this->getPdf()->Cell(50, 10, 'TT', 1,0,"C");
            $this->getPdf()->Cell(30, 10, 'T/A', 1,0,"C");
            $this->getPdf()->SetXY(40, 240);
            $this->getPdf()->Cell(50, 10, $aplicacion->getTaquiIni(), 1,0,"C");
            $this->getPdf()->Cell(50, 10, $aplicacion->getTaquiFin(), 1,0,"C");
            $this->getPdf()->Cell(30, 10, $aplicacion->taquiDif(), 1,0,"C");
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
    private function getDate($datetime){
        if($datetime == "0000-00-00 00:00:00"){
            return null;
        } else {
            $date = date_create($datetime);
            return date_format($date,"d/m/Y");            
        }
    }
    private function getDay($datetime){
        if($datetime == "0000-00-00 00:00:00"){
            return null;
        } else {
            $date = date_create($datetime);
            return date_format($date,"d");            
        }
    }
    private function getMonth($datetime){
        if($datetime == "0000-00-00 00:00:00"){
            return null;
        } else {
            $date = date_create($datetime);
            return date_format($date,"m");            
        }
    }
    private function getYear($datetime){
        if($datetime == "0000-00-00 00:00:00"){
            return null;
        } else {
            $date = date_create($datetime);
            return date_format($date,"Y");            
        }
    }
    protected function getRoles() {
        return ["Administrador","Supervisor","Piloto","Cliente"];
    }
    protected function getMessageRole() {
        return "cualquier usuario menos uno tipo cliente";
    }
}