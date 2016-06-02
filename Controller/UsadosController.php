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
            Session::set("id",$_GET['p']);
            Session::set('veh',"");
            Session::set('s', isset($_GET['s']) ? $_GET['s'] : 1);
            $apl = (new Aplicacion())->findById(Session::get("id"));
            $usados = $this->getPaginator()->paginar($apl->getUsados(), Session::get('s'));
            $this->redirect_administrador(['index.php'],[
                "aplicacion" => $apl,
                "usados" => $usados,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set('veh', isset($_POST['veh']) ? $_POST['veh'] : Session::get('veh'));
            $vehiculos = (Session::get('veh')!= "") ? $this->getPaginator()->paginar((new Vehiculo())->find(Session::get('veh')),1) : array();
            $apl = (new Aplicacion())->findById(Session::get("id"));
            if (isset($_POST['btnaceptar'])) {
                $usado = $this->createEntity();
                $id = $apl->addUsu($usado);
                if(isset($id)){
                    Session::set("msg","Vehículo Registrado");
                    header("Location:index.php?c=usados&a=index&p=".Session::get("id"));
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(['add.php'],[
                "aplicacion" => $apl,
                "vehiculos" => $vehiculos
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set("v",$_GET['v']);
            $apl = (new Aplicacion())->findById(Session::get("id"));
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){
                $usado = $this->createEntity();
                $id = $apl->modUsu($usado);
                if(isset($id)){
                    Session::set("msg","Uso del Vehículo Editado");
                    header("Location:index.php?c=usados&a=index&p=".Session::get("id"));
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
        $apl = (new Aplicacion())->findById(Session::get("id"));
        $veh = (new Vehiculo())->findById($_POST["veh"]);
        $usado = new Usado();
        $usado->setAplicacion($apl);
        $usado->setVehiculo($veh);
        $usado->setConductor($_POST["txtcond"]);
        $usado->setCapacidad($_POST["txtcap"]);
        return $usado;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}