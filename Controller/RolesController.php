<?php
namespace Controller;
use App\Controller;
use App\Session;
use Model\RolModel;
use Clases\Rol;
class RolesController extends Controller 
{
    private $modelo;
    function __construct() {
        parent::__construct();
        $this->modelo= new RolModel();
    }
    public function index(){
        if($this->checkUser()){
            $this->redirect(array("index.php"),array(
                "roles" => $this->modelo->obtenerTodos()
            )); 
        }   
    }
    public function add(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) {                
                    $rol = new Rol(0, $_POST['txtnom']);
                    $this->modelo->guardame($rol);
                    Session::set("msg","Rol Creado");
                    header("Location:index.php?c=roles&a=index");
                    exit();
                }
            }
            $this->redirect(array('add.php'));
        }
    }   
    public function edit(){        
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){                             
                if($this->checkDates()) {                
                    $rol= new Rol($_POST['hid'],$_POST['txtnom']);
                    $this->modelo->modificame($rol);
                    Session::set("msg","Rol Editado");
                    header("Location:index.php?c=roles&a=index");
                    exit();
                }
            }
            $this->redirect(array('edit.php'),array(
                "rol" => $this->modelo->obtenerPorId(Session::get('id'))
            ));
        }        
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $rol = $this->modelo->obtenerPorId($_GET['p']);
                $id= $this->modelo->eliminame($rol);
                Session::set("msg", (isset($id)) ? "Rol Borrado" : "No se pudo borrar el rol");
                header("Location:index.php?c=roles&a=index");
            }                           
        }
    }
    private function checkDates(){
        if(empty($_POST['txtnom'])){
            Session::set("msg","Ingrese los datos obligatorios (*) para continuar.");
            return false;
        }
        else{
            return true;
        }
    }
    private function checkUser(){
        if(Session::get("log_in")!= null and Session::get("log_in")->getRol()->getNombre() == "admin"){
            return true;
        }
        else {
            Session::set("msg","Debe ser administrador para acceder.");
            $this->redirect(array('Main','index.php'));
        }
    }
}