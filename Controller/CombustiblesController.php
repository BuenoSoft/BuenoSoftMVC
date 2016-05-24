<?php
namespace Controller;
use \App\Session;
use \Clases\Combustible;
class CombustiblesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $combustibles= (Session::get('b')!="") ? $this->getPaginator()->paginar((new Combustible())->find(Session::get('b')), Session::get('p')) : array();            
            $this->redirect_administrador(['index.php'],[
                "combustibles" => $combustibles,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            if(isset($_POST['btnaceptar'])){
                $combustible = $this->createEntity();
                $id = $combustible->save();
                if(isset($id)){
                    Session::set("msg","Combustible Creado");
                    header("Location:index.php?c=combustibles&a=index");
                    exit();                
                }
                else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(['add.php']);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){
                $combustible = $this->createEntity();
                $id = $combustible->save();
                if(isset($id)){
                    Session::set("msg","Combustible Editado");
                    header("Location:index.php?c=combustibles&a=index");
                    exit();                
                }
                else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(['edit.php'],["combustible" => (new Combustible())->findById(Session::get('id'))]); 
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $combustible = (new Combustible())->findById($_GET['p']);
                $id = $combustible->del();                
                Session::set("msg", (isset($id)) ? "Combustible Borrado" : "No se pudo borrar el combustible");
                header("Location:index.php?&c=combustibles&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $combustible = (new Combustible())->findById($_GET['p']);
                $id = $combustible->active();
                Session::set("msg", (isset($id)) ? "Combustible Activado" : "No se pudo activar el combustible");
                header("Location:index.php?c=combustibles&a=index");
            }        
        }
    }
    private function createEntity(){
        $combustibles = new Combustible();
        $combustibles->setId((isset($_POST['hid']) ? $_POST['hid'] : 0));
        $combustibles->setNombre($_POST['txtnombre']);
        $combustibles->setStock($_POST['txtstock']);
        $combustibles->setFecha($_POST['dtfecha']);
        return $combustibles;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}