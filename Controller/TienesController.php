<?php
namespace Controller;
use \App\Session;
use \Clases\Aplicacion;
use \Clases\Producto;
class TienesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set('pro',"");
            Session::set('s', isset($_GET['s']) ? $_GET['s'] : 1);
            $apl = (new Aplicacion())->findById(Session::get("id"));
            $productos = $this->getPaginator()->paginar($apl->getProductos(),  Session::get('s'));
            $this->redirect_administrador(['index.php'],[
                "aplicacion" => $apl,
                "productos" => $productos,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set('pro', isset($_POST['pro']) ? $_POST['pro'] : Session::get('pro'));
            $productos = (Session::get('pro')!= "") ? $this->getPaginator()->paginar((new Producto())->find(Session::get('pro')),1) : array();
            if (isset($_POST['btnaceptar'])) {
                $pro = (new Producto())->findById(Session::get('pro'));
                $apl = (new Aplicacion())->findById(Session::get("id"));
                $id = $apl->addPro($pro->getId());
                if(isset($id)){
                    Session::set("msg","Producto Registrado");
                    header("Location:index.php?c=tienes&a=index&p=".Session::get("id"));
                    exit();
                } else {
                    Session::set("msg", Session::get("msg"));
                }                
            }
            $this->redirect_administrador(['add.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("id")),
                "productos" => $productos
            ]);
        } 
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['ap']) and isset($_GET['p'])){
                Session::set("id",$_GET['ap']);
                $pro = (new Producto())->findById($_GET['p']);
                $apl = (new Aplicacion())->findById(Session::get("id"));
                $id = $apl->delPro($pro->getId());
                Session::set("msg", (isset($id)) ? "Producto Borrado" : "No se pudo borrar el producto");
                header("Location:index.php?c=tienes&a=index&p=".Session::get("id"));
            }
        }
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}