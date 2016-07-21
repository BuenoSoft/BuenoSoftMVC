<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\Rol;
class RolesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
     public function index(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["index.php"],[
                "roles" => (new Rol())->find()
            ]);
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
                $rol = $this->createEntity();
                $id = $rol->save();
                if(isset($id)){
                    Session::set("msg",Session::msgSuccess("Rol Creado"));
                    header("Location:index.php?c=roles&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                }
            }
            $this->redirect_administrador(["add.php"]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("rol",$_GET['d']);
            if (Session::get('rol')!=null && isset($_POST['btnaceptar'])){
                $rol = $this->createEntity();
                $id = $rol->save();
                if(isset($id)){
                    Session::set("msg",Session::msgSuccess("Rol Editado"));
                    header("Location:index.php?c=roles&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
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
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Rol Borrado") : Session::msgDanger("No se pudo borrar el rol"));
                header("Location:index.php?c=roles&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $rol = (new Rol())->findById($_GET['d']);
                $id = $rol->del();
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Rol Activado") : Session::msgDanger("No se pudo activar el rol"));
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