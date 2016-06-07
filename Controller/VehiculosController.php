<?php
namespace Controller;
use \App\Session;
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
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $vehiculos = $this->getPaginator()->paginar((new Vehiculo())->find(Session::get('b')), Session::get('p')); 
            $this->redirect_administrador(["index.php"],[
                "vehiculos" => $vehiculos,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set('comb', isset($_POST['cboxcomb']) ? $_POST['cboxcomb'] : Session::get('comb'));
            $combustibles = (Session::get('comb')!= "") ? $this->getPaginator()->paginar((new Combustible())->find(Session::get('comb')),1) : array();
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
                'combustibles' => $combustibles
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("vh",$_GET['d']);
            Session::set('comb', isset($_POST['cboxcomb']) ? $_POST['cboxcomb'] : Session::get('comb'));
            $combustibles = (Session::get('comb')!= "") ? $this->getPaginator()->paginar((new Combustible())->find(Session::get('comb')),1) : array();
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
                'combustibles' => $combustibles
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
                $id = $vehiculo->active();
                Session::set("msg", (isset($id)) ? "Vehículo Activado" : "No se pudo activar el vehículo");
                header("Location:index.php?c=vehiculos&a=index");
            }        
        }
    }
    private function createEntity(){
        $combustible =(new Combustible())->findById($_POST['cboxcomb']);
        $vehiculo = new Vehiculo();
        $vehiculo->setId((isset($_POST['hid'])) ? $_POST['hid'] : 0);
        $vehiculo->setMatricula($_POST['txtmat']);
        $vehiculo->setPadron($_POST['txtpadron']);
        $vehiculo->setTipo($_POST['cboxtipo']);
        $vehiculo->setMotor($_POST['txtmotor']);
        $vehiculo->setChasis($_POST['txtchasis']);
        $vehiculo->setUnimedida($_POST['cboxuni']);
        $vehiculo->setCapcarga($_POST['txtcap']);
        $vehiculo->setModelo($_POST['txtmodelo']);
        $vehiculo->setMarca($_POST['txtmarca']);
        $vehiculo->setAnio($_POST['txtanio']);
        $vehiculo->setCombustible($combustible);
        return $vehiculo;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}