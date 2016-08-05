<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\Usuario;
use \Clases\Vehiculo;
use \Clases\Notificacion;
class NotificacionesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
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
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            if (isset($_POST['btnaceptar'])) {                   
                $not = $this->createEntity();
                if($not->getVehiculo() == null and $not->getUsuario() == null){
                    Session::set("msg",Session::msgDanger("Asegurese de seleccionar un tipo de notificación"));
                } else if($not->getVehiculo() != null and $not->getUsuario() != null){
                    Session::set("msg",Session::msgDanger("Asegurese de que la notificación sea para el usuario o para vehículo"));
                } else {
                    $id = $not->save();
                    if(isset($id)){
                        Session::set("msg",Session::msgSuccess("Notificación Creada"));
                        header("Location:index.php?c=notificaciones&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }
                }             
            }
            $this->redirect_administrador(["add.php"],[
                "vehiculos" => (new Vehiculo())->find(),
                "usuarios" => (new Usuario())->find()
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("not",$_GET['d']);
            if (Session::get('not')!=null && isset($_POST['btnaceptar'])){
                $not = $this->createEntity();
                if($not->getVehiculo() == null and $not->getUsuario() == null){
                    Session::set("msg",Session::msgDanger("Asegurese de seleccionar un tipo de notificación"));
                } else if($not->getVehiculo() != null and $not->getUsuario() != null){
                    Session::set("msg",Session::msgDanger("Asegurese de que la notificación sea para el usuario o para vehículo"));
                } else {                
                    $id = $not->save();
                    if(isset($id)){
                        Session::set("msg",Session::msgSuccess("Notificación Editada"));
                        header("Location:index.php?c=notificaciones&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }
                }
            }
            $this->redirect_administrador(["edit.php"],[
                "notificacion" => (new Notificacion())->findById(Session::get("not")),
                "vehiculos" => (new Vehiculo())->find(),
                "usuarios" => (new Usuario())->find()
            ]);
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $not = (new Notificacion())->findById($_GET['d']);
                $id = $not->del();                
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Notificación Borrada") : Session::msgDanger("No se pudo borrar la notificación"));
                header("Location:index.php?c=notificaciones&a=index");
            }            
        }
    }
    public function view(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=notificaciones&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $not = (new Notificacion())->findById($_GET['d']);
            if($not->getEstado() == "N"){
                $not->save();
            }            
            $this->redirect_administrador(["view.php"], [
                "notificacion" => $not
            ]);        
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function inverseDate($date){
        $arrdate = explode("-", $date);
        return $arrdate[2]."-".$arrdate[1]."-".$arrdate[0];
    }
    private function createEntity(){
        $not = new Notificacion();
        $not->setId(isset($_POST["hid"]) ? $_POST["hid"] : 0);
        $not->setLog($this->clean($_POST["txtlog"])); 
        $not->setFechaini($this->inverseDate($_POST["dtfechaini"]));
        $not->setFechafin(isset($_POST["dtfechafin"]) ? $this->inverseDate($_POST["dtfechafin"]) : null);
        $not->setVehiculo((new Vehiculo())->findByMat((isset($_POST["veh"][0]) ? $_POST["veh"][0] : 0)));
        $not->setUsuario((new Usuario())->findByNombre((isset($_POST["usu"][0]) ? $_POST["usu"][0] : 0)));
        return $not;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}