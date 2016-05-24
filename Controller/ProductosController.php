<?php
namespace Controller;
use \App\Session;
use \Clases\Producto;
class ProductosController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $productos= (Session::get('b')!="") ? $this->getPaginator()->paginar((new Producto())->find(Session::get('b')), Session::get('p')) : array();            
            $this->redirect_administrador(['index.php'],[
                "productos" => $productos,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            if(isset($_POST['btnaceptar'])){
                $producto = $this->createEntity();
                $id = $producto->save();
                if(isset($id)){
                    Session::set("msg","Producto Creado");
                    header("Location:index.php?c=productos&a=index");
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
                $producto = $this->createEntity();
                $id = $producto->save();
                if(isset($id)){
                    Session::set("msg","Producto Editado");
                    header("Location:index.php?c=productos&a=index");
                    exit();                
                }
                else {
                    Session::set("msg",Session::get('msg'));
                }
            }
            $this->redirect_administrador(['edit.php'],["producto" => (new Producto())->findById(Session::get('id'))]); 
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $producto = (new Producto())->findById($_GET['p']);
                $id = $producto->del();                
                Session::set("msg", (isset($id)) ? "Producto Borrado" : "No se pudo borrar el producto");
                header("Location:index.php?&c=productos&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $producto = (new Producto())->findById($_GET['p']);
                $id = $producto->active();
                Session::set("msg", (isset($id)) ? "Producto Activado" : "No se pudo activar el producto");
                header("Location:index.php?c=productos&a=index");
            }        
        }
    }
    private function createEntity(){
        $producto = new Producto();
        $producto->setId((isset($_POST['hid'])) ? $_POST['hid'] : 0);
        $producto->setCodigo($_POST['txtcodigo']);
        $producto->setNombre($_POST['txtnombre']);
        $producto->setMarca($_POST['txtmarca']);
        return $producto;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}