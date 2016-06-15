<?php
namespace Controller;
use \App\Session;
use \Clases\TipoProducto;
class TipopController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){          
            $this->redirect_administrador(["index.php"],[
                "tipos" => (new TipoProducto())->find()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                $tp = $this->createEntity();
                $id = $tp->save();
                if(isset($id)){
                    Session::set("msg","Tipo de Producto Creado");
                    header("Location:index.php?c=tipop&a=index");
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
            Session::set("tp",$_GET['d']);
            if (Session::get('tp')!=null && isset($_POST['btnaceptar'])){
                $tp = $this->createEntity();
                $id = $tp->save();
                if(isset($id)){
                    Session::set("msg","Tipo de Producto Editado");
                    header("Location:index.php?c=tipop&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(["edit.php"],[
                "tipo" => (new TipoProducto())->findById(Session::get('tp'))
            ]);
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $tp = (new TipoProducto())->findById($_GET['d']);
                $id = $tp->del();                
                Session::set("msg", (isset($id)) ? "Tipo de Producto Borrado" : "No se pudo borrar el tipo");
                header("Location:index.php?c=tipop&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $tp = (new TipoProducto())->findById($_GET['d']);
                $id = $tp->del();
                Session::set("msg", (isset($id)) ? "Tipo de Producto Activado" : "No se pudo activar el tipo");
                header("Location:index.php?c=tipop&a=index");
            }        
        }
    }
    private function createEntity(){
        $tp = new TipoProducto();
        $tp->setId(isset($_POST["hid"]) ? $_POST["hid"] : 0);
        $tp->setNombre($this->clean($_POST["txtnombre"]));
        return $tp;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}