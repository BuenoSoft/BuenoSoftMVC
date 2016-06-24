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
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            Session::set('veh',"");
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $this->clean($_POST['txtbuscador']) : Session::get('b'));
            $not = $this->getPaginator()->paginar((new Notificacion())->find(Session::get('b')), Session::get('p'));
            $this->redirect_administrador(["index.php"],[
                "notificaciones" => $not,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set('veh', isset($_POST['cboxveh']) ? $_POST['cboxveh'] : Session::get('veh'));
            $vehiculos = (Session::get('veh')!= "") ? $this->getPaginator()->paginar((new Vehiculo())->find(Session::get('veh')),1) : array();
            if (isset($_POST['btnaceptar'])) {
                $not = $this->createEntity();
                $id = $not->save();
                if(isset($id)){
                    Session::set("msg","Notificación Creada");
                    header("Location:index.php?c=notificaciones&a=index");
                    exit();
                } else {
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
            Session::set("not",$_GET['d']);
            Session::set('veh', isset($_POST['cboxveh']) ? $_POST['cboxveh'] : Session::get('veh'));
            $vehiculos = (Session::get('veh')!= "") ? $this->getPaginator()->paginar((new Vehiculo())->find(Session::get('veh')),1) : array();
            if (Session::get('not')!=null && isset($_POST['btnaceptar'])){
                $not = $this->createEntity();
                $id = $not->save();
                if(isset($id)){
                    Session::set("msg","Notificación Editada");
                    header("Location:index.php?c=notificaciones&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(["edit.php"],[
                "notificacion" => (new Notificacion())->findById(Session::get("not")),
                "vehiculos" => $vehiculos
            ]);
        }
    }
    public function view(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $this->redirect_administrador(["view.php"], [
                "notificacion" => (new Notificacion())->findById($_GET['d'])
            ]);        
        }
    }
    private function createEntity(){
        $not = new Notificacion();
        $not->setId(isset($_POST["hid"]) ? $_POST["hid"] : 0);
        $not->setLog($this->clean($_POST["txtlog"])); 
        $not->setFechaini($_POST["dtfechaini"]);
        $not->setFechafin(isset($_POST["dtfechafin"]) ? $_POST["dtfechafin"] : null);
        $not->setVehiculo((new Vehiculo())->findById($_POST["cboxveh"]));
        return $not;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}