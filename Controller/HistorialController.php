<?php
namespace Controller;
use \App\Session;
use \Clases\Combustible;
use \Clases\Aplicacion;
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
            $apl = (new Aplicacion())->findById(Session::get("app"));
            $usado = $apl->getUsado(Session::get("v"));
            $this->redirect_administrador(["index.php"], [
                "usado" => $usado,
                "historiales" => $usado->getHistoriales(),
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set("v",$_GET['v']);
            Session::set("comb", isset($_POST['comb']) ? $_POST['comb'] : Session::get('comb'));
            $combustibles = (Session::get('comb')!= "") ? $this->getPaginator()->paginar((new Combustible())->find(Session::get('comb')),1) : array();
            $apl = (new Aplicacion())->findById(Session::get("app"));
            $usado = $apl->getUsado(Session::get("v"));
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
                "combustibles" => $combustibles
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set("v",$_GET['v']);
            Session::set("m",$_GET['m']);
            Session::set("f",$_GET['f']);
            Session::set("comb", isset($_POST['comb']) ? $_POST['comb'] : Session::get('comb'));
            $combustibles = (Session::get('comb')!= "") ? $this->getPaginator()->paginar((new Combustible())->find(Session::get('comb')),1) : array();
            $usado = (new Aplicacion())->findById(Session::get("app"))->getUsado(Session::get("v"));
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
                "combustibles" => $combustibles
            ]);
        }
    }
    public function delete(){
        if($this->checkUser()){
            Session::set("app",$_GET['v']);
            Session::set("v",$_GET['v']);
            Session::set("m",$_GET['m']);
            Session::set("f",$_GET['f']);
            $usado = (new Aplicacion())->findById(Session::get("id"))->getUsado(Session::get("v"));
            $historial = $usado->getHistorial([Session::get('m'),Session::get('f')]);
            $id = $usado->delHis($historial);
            Session::set("msg", (isset($id)) ? "Historial de Vehículo Borrado" : "No se pudo borrar el producto");
            header("Location:index.php?c=historial&a=index&d=".Session::get("app")."&v=".Session::get("v"));
        }
    }
    public function comb(){
        $this->redirect_administrador(["comb.php"], [
            "combustible" => (new Combustible())->findById($_GET['m'])
        ]);
    }
    private function createEntity(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        $usado =$apl->getUsado(Session::get("v"));
        $combustible = (new Combustible())->findById($_POST['comb']);
        $historial = new Historial();
        $historial->setUsado($usado);
        $historial->setCombustible($combustible);
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