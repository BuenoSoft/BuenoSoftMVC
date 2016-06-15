<?php
namespace Controller;
use \App\Session;
use \Clases\TipoVehiculo;
use \Clases\Combustible;
use \Clases\Vehiculo;
class VehiculosController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set('comb', '');
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $this->clean($_POST['txtbuscador']) : Session::get('b'));
            $vehiculos = $this->getPaginator()->paginar((new Vehiculo())->find(Session::get('b')), Session::get('p')); 
            $this->redirect_administrador(["index.php"],[
                "vehiculos" => $vehiculos,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                $veh = $this->createEntity();
                $id = $veh->save();
                if(isset($id)){
                    Session::set("msg","Vehículo Creado");
                    header("Location:index.php?c=vehiculos&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(["add.php"],[
                "tipos" => (new TipoVehiculo())->find()    
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("vh",$_GET['d']);
            if (Session::get('vh')!=null && isset($_POST['btnaceptar'])){
                $veh = $this->createEntity();
                $id = $veh->save();
                if(isset($id)){
                    Session::set("msg","Vehículo Editado");
                    header("Location:index.php?c=vehiculos&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(["edit.php"],[
                'vehiculo' => (new Vehiculo())->findById(Session::get('vh')),
                "tipos" => (new TipoVehiculo())->find() 
            ]);
        }
    }
    public function view(){
        if($this->checkUser()){
            $this->redirect_administrador(["view.php"],[
                'vehiculo' => (new Vehiculo())->findById($_GET['d']),
            ]);
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $vehiculo = (new Vehiculo())->findById($_GET['d']);
                $id = $vehiculo->del();                
                Session::set("msg", (isset($id)) ? "Vehículo Borrado" : "No se pudo borrar el vehículo");
                header("Location:index.php?&c=vehiculos&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $vehiculo = (new Vehiculo())->findById($_GET['d']);
                $id = $vehiculo->del();
                Session::set("msg", (isset($id)) ? "Vehículo Activado" : "No se pudo activar el vehículo");
                header("Location:index.php?c=vehiculos&a=index");
            }        
        }
    }
    private function createEntity(){
        $vehiculo = new Vehiculo();
        $vehiculo->setId((isset($_POST['hid'])) ? $_POST['hid'] : 0);
        $vehiculo->setMatricula($this->clean($_POST['txtmat']));
        $vehiculo->setPadron($this->clean($_POST['txtpadron']));
        $vehiculo->setTipo((new TipoVehiculo())->findById($_POST['tipo']));
        $vehiculo->setMotor($this->clean($_POST['txtmotor']));
        $vehiculo->setChasis($this->clean($_POST['txtchasis']));
        $vehiculo->setCapcarga($this->clean($_POST['txtcap']));
        $vehiculo->setModelo($this->clean($_POST['txtmodelo']));
        $vehiculo->setMarca($this->clean($_POST['txtmarca']));
        $vehiculo->setAnio($this->clean($_POST['txtanio']));
        $vehiculo->setCombustible($this->getCombustible($_POST['tipo']));
        return $vehiculo;
    }
    private function getCombustible($tipo) {
        $combustible = (new Combustible())->findByTipo($tipo);
        return ($combustible != null) ? $combustible : null;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}