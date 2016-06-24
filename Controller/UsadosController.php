<?php
namespace Controller;
use \App\Session;
use \Clases\Vehiculo;
use \Clases\Aplicacion;
use \Clases\Historial;
class UsadosController extends AppController 
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set('s', isset($_GET['p']) ? $_GET['p'] : 1);
            $apl = (new Aplicacion())->findById(Session::get("app"));
            $usados = $this->getPaginator()->paginar($apl->getUsados(), Session::get('s'));
            $this->redirect_administrador(['index.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("app")),
                "usados" => $usados,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function historial(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set("v",$_GET['v']);
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            $usado = $this->getUsado();
            if (isset($_POST['btnaceptar'])) {
                $historial = $this->createEntity();
                if($historial->getCombustible()->delStock($historial->getRecarga())){
                    $id = $usado->addHis($historial);
                    if(isset($id)){
                        Session::set("msg","Historial de Vehículo Registrado");
                        header("Location:index.php?c=usados&a=historial&d=".Session::get("app")."&v=".Session::get("v"));
                        exit();
                    } else {
                        Session::set("msg","Error al registrar historial");
                    }                
                } else {
                    Session::set("msg","No tiene suficiente stock para recargar");
                }
            }
            $this->redirect_administrador(['historial.php'],[
                "usado" => $usado,
                "historiales" => $usado->getHistoriales(),
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }                    
    }
    public function delete(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set("v",$_GET['v']);
            Session::set("m",$_GET['m']);
            Session::set("f",$_GET['f']);
            $usado = $this->getUsado();
            $historial = $this->getHistorial($usado);
            $historial->getCombustible()->addStock($historial->getRecarga());
            $id = $usado->delHis($historial);
            Session::set("msg", (isset($id)) ? "Historial de Vehículo Borrado" : "No se pudo borrar el producto");
            header("Location:index.php?c=usados&a=historial&d=".Session::get("app")."&v=".Session::get("v"));
        }
    }
    private function getUsado(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        $veh = (new Vehiculo())->findById(Session::get("v"));
        foreach($apl->getUsados() as $usado){
            if($usado->getVehiculo() == $veh){
                return $usado;
            }
        }
        return null;
    }
    private function getHistorial($usado){
        foreach($usado->getHistoriales() as $historial){
            if($historial->getCombustible()->getId() == Session::get("m") and $historial->getFecha() == Session::get("f")){
                return $historial;            
            }
        }
        return null;
    }
    private function createEntity(){
        $usado = $this->getUsado();
        $historial = new Historial();
        $historial->setUsado($usado);
        $historial->setCombustible($usado->getVehiculo()->getCombustible());
        $historial->setFecha($_POST['dtfecha']);
        $historial->setRecarga($_POST['txtrecarga']);
        return $historial;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor","Piloto"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor o piloto";
    }
}