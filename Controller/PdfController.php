<?php
namespace Controller;
use \App\Session;
use \Clases\Aplicacion;
use \Model\EstadisticaModel;
use \Model\ZafraModel;
class PdfController extends AppController
{
    public function imprimir(){
        if($this->checkUser()){
            $aplicaciones = (new Aplicacion())->findAdvance(Session::get("criterios"));
            $totales = Session::get("totales");
            $this->getPdf()->AddPage();
            $this->getPdf()->SetFont('Arial','B',16);
            $this->getPdf()->Cell(40,10,'Informe de Aplicaciones');
            $this->getPdf()->Image('Public/img/manejo/logo.png', 165, 5, 40, 24,'PNG');
            $this->getPdf()->Ln(10);
            $this->getPdf()->SetFont('Arial','B',10);
            $this->getPdf()->Cell(40,10,'Hecho por: '.Session::get('log_in')->getNomReal());
            $this->getPdf()->Ln(10);
            $this->getPdf()->Cell(30, 8, 'Piloto',"TB", 0 ,'C');
            $this->getPdf()->Cell(29, 8, 'Aeronave',"TB", 0 ,'C');
            $this->getPdf()->Cell(27, 8, 'Usuario',"TB", 0 ,'C');
            $this->getPdf()->Cell(32, 8, utf8_decode("Hectáreas"),"TB", 0 ,'C');            
            $this->getPdf()->Cell(32, 8, 'Caudal',"TB", 0 ,'C');
            $this->getPdf()->Cell(25, 8, 'Tipo',"TB", 0 ,'C');
            $this->getPdf()->Cell(20, 8, 'Fecha',"TB", 0 ,'C');
            $this->getPdf()->Ln(8);
            foreach ($aplicaciones as $aplicacion){
                $this->getPdf()->Cell(30, 8, $aplicacion->getPiloto()->getNomReal(), 0, 0 ,'C');
                $this->getPdf()->Cell(29, 8, $aplicacion->getAeronave()->getMatricula(), 0, 0 ,'C');
                $this->getPdf()->Cell(27, 8, $aplicacion->getCliente()->getNombre(), 0, 0 ,'C');
                $this->getPdf()->Cell(32, 8, $aplicacion->getAreaapl(), 0, 0 ,'C');                
                $this->getPdf()->Cell(32, 8, $aplicacion->getCaudal(), 0, 0 ,'C');
                $this->getPdf()->Cell(25, 8, $aplicacion->getTipo()->getNombre(), 0, 0 ,'C');
                $this->getPdf()->Cell(20, 8, ($aplicacion->getFechaIni() == "0000-00-00 00:00:00") ? "" : $this->getDate($aplicacion->getFechaIni()), 0, 0 ,'C');
                $this->getPdf()->Ln(8);
            }
            $this->getPdf()->Ln(8);
            $this->getPdf()->Cell(30, 8, utf8_decode("Total de Hectáreas: ").round($totales[0],2),0, 0 ,'L');
            $this->getPdf()->Ln(8);
            $this->getPdf()->Cell(29, 8, "Total de Horas de Vuelo: ".round($totales[1],2),0, 0 ,'L');
            $this->getPdf()->Output();         
        }
    }
    public function myapp(){
        if($this->checkUser()){
            $aplicacion = (new Aplicacion())->findById($_GET['d']);
            $this->getPdf()->AddPage();
            $this->getPdf()->SetFont('Arial','B',12);
            $this->getPdf()->Image('Public/img/manejo/logo.png', 35, 10, 52, 32,'PNG');
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
            $this->getPdf()->Cell(40, 8, $aplicacion->getAeronave()->getMatricula(), "B");
            $this->getPdf()->SetXY(10, 60);
            $this->getPdf()->Cell(23, 8, 'Usuario:', 0);
            $this->getPdf()->Cell(40, 8, $aplicacion->getCliente()->getNomReal(), "B");
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
            $this->getPdf()->Cell(48, 8, $aplicacion->getPiloto()->getNomReal(), "B");  
            $this->getPdf()->SetXY(125, 60);
            $this->getPdf()->Cell(12, 8, 'RUT:', 0);
            $this->getPdf()->Cell(48, 8, $aplicacion->getCliente()->getDocumento(), "B");
            $this->getPdf()->SetXY(125, 70);
            $this->getPdf()->Cell(18, 8, 'Padron:', 0);
            $this->getPdf()->Cell(48, 8, $aplicacion->getPadron(), "B");
            $this->getPdf()->SetXY(125, 80);
            $this->getPdf()->Cell(27, 8, 'Coord/Pista:', 0);
            $this->getPdf()->Cell(48, 8, "s: ".$aplicacion->getPista()->getGMDLat()." o: ".$aplicacion->getPista()->getGMDLong(), "B");  
            $this->getPdf()->SetXY(125, 90);
            $this->getPdf()->Cell(31, 8, 'Coord/Cultivo:', 0);           
            $this->getPdf()->Cell(48, 8, "s: ".$aplicacion->getGMDLat()." o: ".$aplicacion->getGMDLong(), "B");
            /*---------------------------------------------------------------*/
            $this->getPdf()->SetXY(10, 120);
            $this->getPdf()->Cell(27, 8, 'Productos | Dosis:', 0);
            foreach($aplicacion->getTiene() as $tiene){
                $this->getPdf()->Ln(8);
                $this->getPdf()->Cell(50, 8, $tiene->getProducto()->getNombre()." | ".$tiene->getDosis(), "B");
            }
            /*---------------------------------------------------------------*/
            $this->getPdf()->SetXY(125, 120);
            $this->getPdf()->Cell(12, 8, 'Faja:', 0);
            $this->getPdf()->Cell(48, 8, $aplicacion->getFaja(), "B");
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
            $this->getPdf()->Cell(40, 8, $aplicacion->getChofer()->getNomReal(),"B");
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
    /*---------------------------------------------------------------*/
    public function cant(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() == "Administrador" or Session::get('log_in')->getRol()->getNombre() == "Supervisor")){
            $this->getPdf()->AddPage();            
            $this->getPdf()->SetFont('Arial','B',16);
            $this->getPdf()->Cell(40,10,utf8_decode('Hectáreas aplicadas por tipo'));
            $this->getPdf()->Image('Public/img/manejo/logo.png', 165, 5, 40, 24,'PNG');
            $this->getPdf()->Ln(10);
            $this->getPdf()->SetFont('Arial','B',10);
            $this->getPdf()->Cell(40,10,'Hecho por: '.Session::get('log_in')->getNomReal());
            $this->getPdf()->Ln(10);
            $cantidades = (new EstadisticaModel())->lists();
            $totsol = 0;
            $totliq = 0;
            $totsiem = 0;
            $sim = " Has.";
            foreach ($cantidades as $cantidad){
                $this->getPdf()->SetFont('Arial','B',12);
                $subtotal = $cantidad[2] + $cantidad[3] + $cantidad[4];
                $this->getPdf()->Cell(40, 10, utf8_decode('Período: '.$this->getMonthString($cantidad[0])." - ".$cantidad[1]), 0,0,"L");
                $this->getPdf()->Ln(8);
                $this->getPdf()->SetFont('Arial','',11);
                $this->getPdf()->Cell(50 ,10, utf8_decode("Sólidas"), 0,0,"R");
                $this->getPdf()->Cell(45, 10, utf8_decode("Líquidas"), 0,0,"R");
                $this->getPdf()->Cell(45, 10, utf8_decode("Siembras"), 0,0,"R");
                $this->getPdf()->Cell(40, 10, "Subtotal",0,0,"R");
                $this->getPdf()->Ln(8);
                $this->getPdf()->Cell(50 ,10, $cantidad[2].$sim, "B",0,"R");
                $totsol += $cantidad[2];
                $this->getPdf()->Cell(45, 10, $cantidad[3].$sim, "B",0,"R");
                $totliq += $cantidad[3];
                $this->getPdf()->Cell(45, 10, $cantidad[4].$sim, "B",0,"R");
                $totsiem += $cantidad[4];
                $this->getPdf()->Cell(40, 10, $subtotal.$sim,"B",0,"R");
                $this->getPdf()->Ln(10);                
            }
            $this->getPdf()->SetFont('Arial','B',12);
            $this->getPdf()->Cell(40, 10, "Totales", 0,0,"L");
            $this->getPdf()->Ln(8);
            $this->getPdf()->SetFont('Arial','',11);
            $this->getPdf()->Cell(50 ,10, utf8_decode("Total de Sólidas"), 0,0,"R");
            $this->getPdf()->Cell(45, 10, utf8_decode("Total de Líquidas"), 0,0,"R");
            $this->getPdf()->Cell(45, 10, "Total de Siembras", 0,0,"R");
            $this->getPdf()->Cell(40, 10, "Total",0,0,"R");
            $this->getPdf()->Ln(8);
            $this->getPdf()->Cell(50 ,10, $totsol.$sim , "B",0,"R");
            $this->getPdf()->Cell(45, 10, $totliq.$sim , "B",0,"R");
            $this->getPdf()->Cell(45, 10, $totsiem.$sim, "B",0,"R");
            $this->getPdf()->Cell(40, 10, ($totsol + $totliq + $totsiem).$sim,"B",0,"R");
            $this->getPdf()->Output();
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    /*---------------------------------------------------------------*/
    public function xpil(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() == "Administrador" or Session::get('log_in')->getRol()->getNombre() == "Supervisor")){
            $this->getPdf()->AddPage();
            $this->getPdf()->SetFont('Arial','B',16);
            $this->getPdf()->Cell(40,10,'Horas de vuelo por piloto');
            $this->getPdf()->Image('Public/img/manejo/logo.png', 165, 5, 40, 24,'PNG');
            $this->getPdf()->Ln(10);
            $this->getPdf()->SetFont('Arial','B',10);
            $this->getPdf()->Cell(40,10,'Hecho por: '.Session::get('log_in')->getNomReal());
            $pilotos = (new EstadisticaModel())->listHsXPiloto();
            $titles = $this->getStringTitle($pilotos);
            $aux = $pilotos;            
            $max = 0;
            $hs = " Hs.";
            $this->getPdf()->Ln(10);
            foreach ($pilotos as $piloto) {
                if($piloto[0] > $max){
                    $max = $piloto[0];
                    $this->getPdf()->SetFont('Arial','B',12);
                    $this->getPdf()->Cell(40, 10, utf8_decode('Período: '.$this->getMonthString($piloto[0])." - ".$piloto[1]), 0,0,"L");
                    $this->getPdf()->Ln(8);
                    $this->getPdf()->SetFont('Arial','',11);
                    $this->getPdf()->Cell(40 ,10, "Piloto", 0,0,"R");
                    $this->getPdf()->Cell(25, 10, "Cantidad", 0,0,"R");
                    $this->getPdf()->Ln(8);
                    $last = end($titles);                    
                    foreach ($titles as $title) {
                        $cant = 0;
                        if($title != $last){
                            $this->getPdf()->Cell(40, 10, $title,0,0,"R");                        
                        } else {
                            $this->getPdf()->Cell(40, 10, $title,"B",0,"R");
                        }
                        foreach($aux as $a){
                            if($max == $a[0] and $title == $a[3]){ 
                               $cant += $a[2];
                            }
                        }
                        if($title != $last){
                            $this->getPdf()->Cell(25, 10, $cant.$hs,0,0,"R");                        
                        } else {
                            $this->getPdf()->Cell(25, 10, $cant.$hs,"B",0,"R");
                        }
                        $this->getPdf()->Ln(5);                             
                    }
                    $this->getPdf()->Ln(5);                    
                }                
            }
            $this->getPdf()->SetFont('Arial','B',12);
            $this->getPdf()->Cell(40, 10, "Totales", 0,0,"L");
            $this->getPdf()->Ln(8);
            $this->getPdf()->SetFont('Arial','',11);
            $this->getPdf()->Cell(40 ,10, "Piloto", 0,0,"R");
            $this->getPdf()->Cell(25, 10, "Total", 0,0,"R");
            $this->getPdf()->Ln(8);
            foreach ($titles as $title) {
                if($title != $last){
                    $this->getPdf()->Cell(40, 10, $title,0,0,"R");                        
                } else {
                    $this->getPdf()->Cell(40, 10, $title,"B",0,"R");
                }
                if($title != $last){
                    $this->getPdf()->Cell(25, 10, (new EstadisticaModel())->TotPiloto($title).$hs,0,0,"R");                        
                } else {
                    $this->getPdf()->Cell(25, 10, (new EstadisticaModel())->TotPiloto($title).$hs,"B",0,"R");
                }
                $this->getPdf()->Ln(5);
            }
            $this->getPdf()->Output();
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }    
    /*---------------------------------------------------------------*/
    public function xaero(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() == "Administrador" or Session::get('log_in')->getRol()->getNombre() == "Supervisor")){
            $this->getPdf()->AddPage();
            $this->getPdf()->SetFont('Arial','B',16);
            $this->getPdf()->Cell(40,10,'Horas de vuelo por aeronave');
            $this->getPdf()->Image('Public/img/manejo/logo.png', 165, 5, 40, 24,'PNG');
            $this->getPdf()->Ln(10);
            $this->getPdf()->SetFont('Arial','B',10);
            $this->getPdf()->Cell(40,10,'Hecho por: '.Session::get('log_in')->getNomReal());
            $vehiculos = (new EstadisticaModel())->listHsXVehiculo();
            $titles = $this->getStringTitle($vehiculos);
            $aux = $vehiculos;
            $max = 0;
            $hs = " Hs.";
            $this->getPdf()->Ln(10);
            foreach ($vehiculos as $vehiculo) {
                if($vehiculo[0] > $max){
                    $max = $vehiculo[0];
                    $this->getPdf()->SetFont('Arial','B',12);
                    $this->getPdf()->Cell(40, 10, utf8_decode('Período: '.$this->getMonthString($vehiculo[0])." - ".$vehiculo[1]), 0,0,"L");
                    $this->getPdf()->Ln(8);
                    $this->getPdf()->SetFont('Arial','',11);
                    $this->getPdf()->Cell(40 ,10, "Aeronave", 0,0,"R");
                    $this->getPdf()->Cell(25, 10, "Cantidad", 0,0,"R");
                    $this->getPdf()->Ln(8);
                    $last = end($titles);                    
                    foreach ($titles as $title) {
                        $cant = 0;
                        if($title != $last){
                            $this->getPdf()->Cell(40, 10, $title,0,0,"R");                        
                        } else {
                            $this->getPdf()->Cell(40, 10, $title,"B",0,"R");
                        }
                        foreach($aux as $a){
                            if($max == $a[0] and $title == $a[3]){ 
                                $cant += $a[2];
                            }
                        }
                        if($title != $last){
                            $this->getPdf()->Cell(25, 10, $cant.$hs,0,0,"R");                        
                        } else {
                            $this->getPdf()->Cell(25, 10, $cant.$hs,"B",0,"R");
                        }
                        $this->getPdf()->Ln(5);                             
                    }
                    $this->getPdf()->Ln(5);                    
                }                
            }
            $this->getPdf()->SetFont('Arial','B',12);
            $this->getPdf()->Cell(40, 10, "Totales", 0,0,"L");
            $this->getPdf()->Ln(8);
            $this->getPdf()->SetFont('Arial','',11);
            $this->getPdf()->Cell(40 ,10, "Aeronave", 0,0,"R");
            $this->getPdf()->Cell(25, 10, "Total", 0,0,"R");
            $this->getPdf()->Ln(8);
            foreach ($titles as $title) {
                if($title != $last){
                    $this->getPdf()->Cell(40, 10, $title,0,0,"R");                        
                } else {
                    $this->getPdf()->Cell(40, 10, $title,"B",0,"R");
                }
                if($title != $last){
                    $this->getPdf()->Cell(25, 10, (new EstadisticaModel())->TotAeronave($title).$hs,0,0,"R");                        
                } else {
                    $this->getPdf()->Cell(25, 10, (new EstadisticaModel())->TotAeronave($title).$hs,"B",0,"R");
                }
                $this->getPdf()->Ln(5);
            }
            $this->getPdf()->Output();
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    /*---------------------------------------------------------------*/
    public function xcomb(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() == "Administrador" or Session::get('log_in')->getRol()->getNombre() == "Supervisor")){
            $this->getPdf()->AddPage();
            $this->getPdf()->SetFont('Arial','B',16);
            $this->getPdf()->Cell(40,10,'Consumo de combustibles');
            $this->getPdf()->Image('Public/img/manejo/logo.png', 165, 5, 40, 24,'PNG');
            $this->getPdf()->Ln(10);
            $this->getPdf()->SetFont('Arial','B',10);
            $this->getPdf()->Cell(40,10,'Hecho por: '.Session::get('log_in')->getNomReal());
            $combustibles = (new EstadisticaModel())->ListCantXCombustible();
            $titles = $this->getStringTitle($combustibles);
            $aux = $combustibles;
            $max = 0;
            $lts = " Lts.";
            $this->getPdf()->Ln(10);
            foreach ($combustibles as $combustible) {
                if($combustible[0] > $max){
                    $max = $combustible[0];
                    $this->getPdf()->SetFont('Arial','B',12);
                    $this->getPdf()->Cell(40, 10, utf8_decode('Período: '.$this->getMonthString($combustible[0])." - ".$combustible[1]), 0,0,"L");
                    $this->getPdf()->Ln(8);
                    $this->getPdf()->SetFont('Arial','',11);
                    $this->getPdf()->Cell(40 ,10, "Combustible", 0,0,"R");
                    $this->getPdf()->Cell(25, 10, "Cantidad", 0,0,"R");
                    $this->getPdf()->Ln(8);
                    $last = end($titles);                    
                    foreach ($titles as $title) {
                        $cant = 0;
                        if($title != $last){
                            $this->getPdf()->Cell(40, 10, $title,0,0,"R");                        
                        } else {
                            $this->getPdf()->Cell(40, 10, $title,"B",0,"R");
                        }
                        foreach($aux as $a){
                            if($max == $a[0] and $title == $a[3]){ 
                                $cant += $a[2];
                            }
                        }
                        if($title != $last){
                            $this->getPdf()->Cell(25, 10, $cant.$lts,0,0,"R");                        
                        } else {
                            $this->getPdf()->Cell(25, 10, $cant.$lts,"B",0,"R");
                        }
                        $this->getPdf()->Ln(5);                             
                    }
                    $this->getPdf()->Ln(5);                    
                }                
            }
            $this->getPdf()->SetFont('Arial','B',12);
            $this->getPdf()->Cell(40, 10, "Totales", 0,0,"L");
            $this->getPdf()->Ln(8);
            $this->getPdf()->SetFont('Arial','',11);
            $this->getPdf()->Cell(40 ,10, "Combustible", 0,0,"R");
            $this->getPdf()->Cell(25, 10, "Total", 0,0,"R");
            $this->getPdf()->Ln(8);
            foreach ($titles as $title) {
                if($title != $last){
                    $this->getPdf()->Cell(40, 10, $title,0,0,"R");                        
                } else {
                    $this->getPdf()->Cell(40, 10, $title,"B",0,"R");
                }
                if($title != $last){
                    $this->getPdf()->Cell(25, 10, (new EstadisticaModel())->TotComb($title).$lts,0,0,"R");                        
                } else {
                    $this->getPdf()->Cell(25, 10, (new EstadisticaModel())->TotComb($title).$lts,"B",0,"R");
                }
                $this->getPdf()->Ln(5);
            }
            $this->getPdf()->Output();
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    /*---------------------------------------------------------------*/
    public function zafras(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() == "Administrador" or Session::get('log_in')->getRol()->getNombre() == "Supervisor")){
            $this->getPdf()->AddPage();
            $this->getPdf()->SetFont('Arial','B',16);
            $this->getPdf()->Cell(40,10,utf8_decode('Período de Zafras'));
            $this->getPdf()->Image('Public/img/manejo/logo.png', 165, 5, 40, 24,'PNG');
            $this->getPdf()->Ln(10);
            $this->getPdf()->SetFont('Arial','B',10);
            $this->getPdf()->Cell(40,10,utf8_decode('Período Inicial: ').Session::get('ped1'));
            $this->getPdf()->Ln(5);
            $this->getPdf()->Cell(40,10,utf8_decode('Período Final: ').Session::get('ped2'));
            $this->getPdf()->Ln(5);
            $this->getPdf()->Cell(40,10,'Hecho por: '.Session::get('log_in')->getNomReal());
            $this->getPdf()->Ln(10);
            $this->getPdf()->Cell(30, 8, utf8_decode('Período'),"TB", 0 ,'C');
            $this->getPdf()->Cell(130, 8, utf8_decode('Hectáreas'),"TB", 0 ,'C');
            $this->getPdf()->Cell(20, 8, 'Horas',"TB", 0 ,'C');
            $this->getPdf()->Ln(10);
            $periodos = (new ZafraModel())->periodList([Session::get('ped1'),Session::get('ped2')]);
            $tot_hec = 0;
            $tot_hs = 0;
            foreach($periodos as $periodo){
                $tot_hec += $periodo[1];
                $tot_hs += $periodo[2];
                $this->getPdf()->Cell(30, 8, $periodo[0], 0, 0 ,'C');
                $this->getPdf()->Cell(130, 8, $periodo[1], 0, 0 ,'C');
                $this->getPdf()->Cell(20, 8, $periodo[2], 0, 0 ,'C');
                $this->getPdf()->Ln(10);
            }
            //$this->getPdf()->Ln(3);
            $this->getPdf()->Cell(30, 8, "Total:", "T", 0 ,'C');
            $this->getPdf()->Cell(130, 8, $tot_hec, "T", 0 ,'C');
            $this->getPdf()->Cell(20, 8, $tot_hs, "T", 0 ,'C');
            $this->getPdf()->Output();
        }
    }
    /*---------------------------------------------------------------*/    
    public function getStringTitle($arr){
        $title = [];
        $unique = [];
        foreach ($arr as $a) {        
            array_push($unique, $a[3]);                                        
        }
        $res = array_unique($unique);
        foreach($res as $r){
            array_push($title, $r);
        }
        return $title;
    }
    public function getMonthString($int){
        switch ($int) {
            case 1: return "Enero";
            case 2: return "Febrero";
            case 3: return "Marzo";
            case 4: return "Abril";
            case 5: return "Mayo";
            case 6: return "Junio";
            case 7: return "Julio";
            case 8: return "Agosto";
            case 9: return "Septiembre";
            case 10: return "Octubre";
            case 11: return "Noviembre";
            case 12: return "Diciembre";
            default: return "--Error--";
        }
    }
    
    private function inverseDat($date){
        if($date != null){
            $arrdate = explode("-", $date);
            return $arrdate[2]."-".$arrdate[1]."-".$arrdate[0];        
        } else {
            return null;
        }
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