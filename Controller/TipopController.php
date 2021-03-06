<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\TipoProducto;
class TipopController extends AppController
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
                "tipos" => (new TipoProducto())->find()
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
                $tp = $this->createEntity();
                if($tp->save()){
                    Session::set("msg",Session::msgSuccess("Tipo de Producto Creado"));
                    header("Location:index.php?c=tipop&a=index");
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
            Session::set("tp",$_GET['d']);
            if (Session::get('tp')!=null && isset($_POST['btnaceptar'])){
                $tp = $this->createEntity();
                if($tp->save()){
                    Session::set("msg",Session::msgSuccess("Tipo de Producto Editado"));
                    header("Location:index.php?c=tipop&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
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
                if($id){
                    Session::set("msg",Session::msgSuccess("Tipo de producto Borrado"));
                } else {
                    Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                }
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