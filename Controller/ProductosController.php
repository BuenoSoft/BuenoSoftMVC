<?php
namespace Controller;
use \App\Session;
use \Clases\TipoProducto;
use \Clases\Producto;
class ProductosController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $this->clean($_POST['txtbuscador']) : Session::get('b'));
            $productos = $this->getPaginator()->paginar((new Producto())->find(Session::get('b')), Session::get('p'));
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
                    Session::set("msg",Session::msgSuccess("Producto Creado"));
                    header("Location:index.php?c=productos&a=index");
                    exit();                
                } else {
                    Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                }
            }
            $this->redirect_administrador(['add.php'],[
                "tipos" => (new TipoProducto())->find()
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("prod",$_GET['d']);
            if (Session::get('prod')!=null && isset($_POST['btnaceptar'])){
                $producto = $this->createEntity();
                $id = $producto->save();
                if(isset($id)){
                    Session::set("msg",Session::msgSuccess("Producto Editado"));
                    header("Location:index.php?c=productos&a=index");
                    exit();                
                } else {
                    Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                }
            }
            $this->redirect_administrador(['edit.php'],[
                "producto" => (new Producto())->findById(Session::get('prod')),
                "tipos" => (new TipoProducto())->find()
            ]); 
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $producto = (new Producto())->findById($_GET['d']);
                $id = $producto->del();                
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Producto Borrado") : Session::msgDanger("No se pudo borrar el producto"));
                header("Location:index.php?&c=productos&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $producto = (new Producto())->findById($_GET['d']);
                $id = $producto->del();
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Producto Activado") : Session::msgDanger("No se pudo activar el producto"));
                header("Location:index.php?c=productos&a=index");
            }        
        }
    }
    public function view(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $this->redirect_administrador(['view.php'],[
                "producto" => (new Producto())->findById($_GET['d'])
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function createEntity(){
        $producto = new Producto();
        $producto->setId((isset($_POST['hid'])) ? $_POST['hid'] : 0);
        $producto->setCodigo($_POST['txtcodigo']);
        $producto->setNombre($this->clean($_POST['txtnombre']));
        $producto->setMarca($_POST['txtmarca']);
        $producto->setTipo((new TipoProducto())->findByX($_POST['tipo']));
        return $producto;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}