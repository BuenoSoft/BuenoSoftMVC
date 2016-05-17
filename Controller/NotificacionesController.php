<?php
namespace Controller;
use \App\Session;
use \Clases\Vehiculo;
use \Clases\Notificacion;
class NotificacionesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set('veh',"");
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $not =(Session::get('b')!="") ? $this->getPaginator()->paginar((new Notificacion())->find(Session::get('b')), Session::get('p')) : array();
            $this->redirect_administrador(["index.php"],[
                "notificaciones" => $not,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set('veh', isset($_POST['cboxveh']) ? $_POST['cboxveh'] : Session::get('veh'));
            $vehiculos = (Session::get('veh')!= "") ? (new Vehiculo())->find(Session::get('veh')) : array();
            if (isset($_POST['btnaceptar'])) {
                $not = $this->createEntity();
                $id = $not->save();
                if(isset($id)){
                    Session::set("msg","Notificación Creada");
                    header("Location:index.php?c=notificaciones&a=index");
                    exit();
                }
                else {
                    Session::set("msg",Session::get('msg'));
                }                
            }
            $this->redirect_administrador(["add.php"],[
                "vehiculos" => $vehiculos
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set('veh', isset($_POST['cboxveh']) ? $_POST['cboxveh'] : Session::get('veh'));
            $vehiculos = (Session::get('veh')!= "") ? (new Vehiculo())->find(Session::get('veh')) : array();
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){
                $not = $this->createEntity();
                $id = $not->save();
                if(isset($id)){
                    Session::set("msg","Notificación Editada");
                    header("Location:index.php?c=notificaciones&a=index");
                    exit();
                }
                else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(["edit.php"],[
                "notificacion" => (new Notificacion())->findById(Session::get("id")),
                "vehiculos" => $vehiculos
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
        $veh = (new Vehiculo())->findById($_POST["cboxveh"]);
        $not = new Notificacion();
        $not->setId(isset($_POST["hid"]) ? $_POST["hid"] : 0);
        $not->setLog($_POST["txtlog"]); 
        $not->setFechaini($_POST["dtfechaini"]);
        $not->setFechafin(isset($_POST["dtfechafin"]) ? $_POST["dtfechafin"] : null);
        $not->setVehiculo($veh);
        return $not;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}