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
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set('veh', isset($_POST['veh'][0]) ? $_POST['veh'][0] : Session::get('veh'));
            $vehiculos = (Session::get('veh')!= "") ? $this->getPaginator()->paginar((new Vehiculo())->find(Session::get('veh')),1) : array();
            if (isset($_POST['btnaceptar'])) {
                $not = $this->createEntity();
                if($not->getVehiculo() != null){
                    $id = $not->save();
                    if(isset($id)){
                        Session::set("msg",Session::msgSuccess("Notificación Creada"));
                        header("Location:index.php?c=notificaciones&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                
                } else {
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el vehículo"));
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
            Session::set('veh', isset($_POST['veh'][0]) ? $_POST['veh'][0] : Session::get('veh'));
            $vehiculos = (Session::get('veh')!= "") ? $this->getPaginator()->paginar((new Vehiculo())->find(Session::get('veh')),1) : array();
            if (Session::get('not')!=null && isset($_POST['btnaceptar'])){
                $not = $this->createEntity();
                if($not->getVehiculo() != null){
                    $id = $not->save();
                    if(isset($id)){
                        Session::set("msg",Session::msgSuccess("Notificación Editada"));
                        header("Location:index.php?c=notificaciones&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }
                } else {
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el vehículo"));
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
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function createEntity(){
        $not = new Notificacion();
        $not->setId(isset($_POST["hid"]) ? $_POST["hid"] : 0);
        $not->setLog($this->clean($_POST["txtlog"])); 
        $not->setFechaini($_POST["dtfechaini"]);
        $not->setFechafin(isset($_POST["dtfechafin"]) ? $_POST["dtfechafin"] : null);
        $not->setFechaAct(date("Y-m-d H:i:s"));
        $not->setVehiculo((new Vehiculo())->findByMat((isset($_POST["veh"][0]) ? $_POST["veh"][0] : 0)));
        return $not;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}