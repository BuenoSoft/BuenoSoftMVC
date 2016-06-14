<?php
namespace Controller;
use \App\Session;
use \Clases\Aplicacion;
use \Clases\Vehiculo;
use \Clases\Historial;
class HistorialController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set("comb","");
            Session::set("app",$_GET['d']);
            Session::set("v",$_GET['v']);
            Session::set('s', isset($_GET['s']) ? $_GET['s'] : 1);
            $usado = $this->getUsado();
            $this->redirect_administrador(["index.php"], [
                "usado" => $usado,
                "historiales" => $usado->getHistoriales(),
                "paginador" => $this->getPaginator()->getPages()
            ]);
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
    public function add(){
        if($this->checkUser()){
            $usado = $this->getUsado();
            if (isset($_POST['btnaceptar'])) {
                $historial = $this->createEntity();
                $id = $usado->addHis($historial);
                if(isset($id)){
                    Session::set("msg","Historial de Vehículo Registrado");
                    header("Location:index.php?c=historial&a=index&d=".Session::get("app")."&v=".Session::get("v"));
                    exit();
                } else {
                    Session::set("msg","Error al registrar historial");
                }
            }
            $this->redirect_administrador(["add.php"], [
                "usado" => $usado,
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set("v",$_GET['v']);
            Session::set("m",$_GET['m']);
            Session::set("f",$_GET['f']);
            $usado = $this->getUsado();
            if (Session::get('app')!=null && Session::get('v')!=null && Session::get('m')!=null && Session::get('f')!=null && isset($_POST['btnaceptar'])){
                $historial = $this->createEntity();
                $id = $usado->modHis($historial);
                if(isset($id)){
                    Session::set("msg","Historial de Vehículo Editado");
                    header("Location:index.php?c=historial&a=index&d=".Session::get("app")."&v=".Session::get("v"));
                    exit();
                } else {
                    Session::set("msg","Error al editar historial");
                }
            }
            $this->redirect_administrador(["edit.php"], [
                "historial" => $usado->getHistorial([Session::get('m'),Session::get('f')]),
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
            $historial = $usado->getHistorial([Session::get('m'),Session::get('f')]);
            $id = $usado->delHis($historial);
            Session::set("msg", (isset($id)) ? "Historial de Vehículo Borrado" : "No se pudo borrar el producto");
            header("Location:index.php?c=historial&a=index&d=".Session::get("app")."&v=".Session::get("v"));
        }
    }
    private function createEntity(){
        $usado = $this->getUsado();
        $historial = new Historial();
        $historial->setUsado($usado);
        $historial->setCombustible($usado->getVehiculo()->getCombustible());
        $historial->setFecha($_POST['dtfecha']);
        $historial->setCargaIni($_POST['txtcargaini']);
        $historial->setCargaFin($_POST['txtcargafin']);
        return $historial;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}