<?php
namespace Controller;
use \App\Session;
use \Clases\Aplicacion;
use \Clases\Vehiculo;
use \Clases\Usado;
class UsadosController extends AppController 
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set('s', isset($_GET['s']) ? $_GET['s'] : 1);
            $apl = (new Aplicacion())->findById(Session::get("app"));
            $usados = $this->getPaginator()->paginar($apl->getUsados(), Session::get('s'));
            $this->redirect_administrador(['index.php'],[
                "aplicacion" => $apl,
                "usados" => $usados,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set("v",$_GET['v']);
            $apl = (new Aplicacion())->findById(Session::get("app"));
            if (Session::get('app')!=null && isset($_POST['btnaceptar'])){
                $usado = $this->createEntity();
                $id = $apl->modUsu($usado);
                if(isset($id)){
                    Session::set("msg","Uso del Vehículo Editado");
                    header("Location:index.php?c=usados&a=index&d=".Session::get("app"));
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(['edit.php'],[
                "usado" => $apl->getUsado(Session::get("v"))                
            ]);
        }
    }
    public function veh(){
        if($this->checkUser()){
            $this->redirect_administrador(["veh.php"],[
                'vehiculo' => (new Vehiculo())->findById($_GET['v']),
            ]);
        }
    }
    private function createEntity(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        $veh = (new Vehiculo())->findById(Session::get("v"));
        $usado = new Usado();
        $usado->setAplicacion($apl);
        $usado->setVehiculo($veh);
        $usado->setConductor($_POST["txtcond"]);
        return $usado;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}