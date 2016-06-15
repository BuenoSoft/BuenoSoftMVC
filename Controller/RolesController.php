<?php
namespace Controller;
use \App\Session;
use \Clases\Rol;
class RolesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
     public function index(){
        if($this->checkUser()){          
            $this->redirect_administrador(["index.php"],[
                "roles" => (new Rol())->find()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                $rol = $this->createEntity();
                $id = $rol->save();
                if(isset($rol)){
                    Session::set("msg","Rol Creado");
                    header("Location:index.php?c=roles&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(["add.php"]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("rol",$_GET['d']);
            if (Session::get('rol')!=null && isset($_POST['btnaceptar'])){
                $rol = $this->createEntity();
                $id = $rol->save();
                if(isset($id)){
                    Session::set("msg","Rol Editado");
                    header("Location:index.php?c=roles&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(["edit.php"],[
                "rol" => (new Rol())->findById(Session::get('rol'))
            ]);
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $rol = (new Rol())->findById($_GET['d']);
                $id = $rol->del();                
                Session::set("msg", (isset($id)) ? "Rol Borrado" : "No se pudo borrar el rol");
                header("Location:index.php?c=roles&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $rol = (new Rol())->findById($_GET['d']);
                $id = $rol->del();
                Session::set("msg", (isset($id)) ? "Rol Activado" : "No se pudo activar el rol");
                header("Location:index.php?c=roles&a=index");
            }        
        }
    }
    private function createEntity(){
        $rol = new Rol();
        $rol->setId(isset($_POST["hid"]) ? $_POST["hid"] : 0);
        $rol->setNombre($this->clean($_POST["txtnombre"]));
        return $rol;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}