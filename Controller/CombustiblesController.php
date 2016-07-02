<?php
namespace Controller;
use \App\Session;
use \Clases\TipoVehiculo;
use \Clases\Combustible;
class CombustiblesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $this->clean($_POST['txtbuscador']) : Session::get('b'));
            $combustibles = $this->getPaginator()->paginar((new Combustible())->find(Session::get('b')), Session::get('p'));
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
                if($combustible->getStock() >= $combustible->getStockMin()){
                    $id = $combustible->save();
                    if(isset($id)){
                        Session::set("msg",Session::msgSuccess("Combustible Creado"));
                        header("Location:index.php?c=combustibles&a=index");
                        exit();                
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                    
                } else {
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea mayor al stock mínimo"));
                }
            }
            $this->redirect_administrador(['add.php'],[
                "tipos" => (new TipoVehiculo())->find()
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("com",$_GET['d']);
            if (Session::get('com')!=null && isset($_POST['btnaceptar'])){
                $combustible = $this->createEntity();
                if($combustible->getStock() >= $combustible->getStockMin()){
                    $id = $combustible->save();
                    if(isset($id)){
                        Session::set("msg",Session::msgSuccess("Combustible Editado"));
                        header("Location:index.php?c=combustibles&a=index");
                        exit();                
                    }else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                
                } else {
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea mayor al stock mínimo"));
                }
            }
            $this->redirect_administrador(['edit.php'],[
                "combustible" => (new Combustible())->findById(Session::get('com')),
                "tipos" => (new TipoVehiculo())->find()
            ]); 
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $combustible = (new Combustible())->findById($_GET['d']);
                $id = $combustible->del();                
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Combustible Borrado") : Session::msgDanger("No se pudo borrar el combustible"));
                header("Location:index.php?&c=combustibles&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $combustible = (new Combustible())->findById($_GET['d']);
                $id = $combustible->del();
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Combustible Activado") : Session::msgDanger("No se pudo activar el combustible"));
                header("Location:index.php?c=combustibles&a=index");
            }        
        }
    }
    public function view(){
        if($this->checkUser()){
            $this->redirect_administrador(["view.php"], [
                "combustible" => (new Combustible())->findById($_GET['d'])
            ]);        
        }
    }
    private function createEntity(){
        $combustible = new Combustible();
        $combustible->setId((isset($_POST['hid']) ? $_POST['hid'] : 0));
        $combustible->setNombre($this->clean($_POST['txtnombre']));
        $combustible->setStock($_POST['txtstock']);
        $combustible->setStockMin($_POST['txtstockmin']);
        $combustible->setStockMax($_POST['txtstockmax']);
        $combustible->setFecUC($this->getUltimaAct($combustible->getId(),$_POST['txtstock']));
        $combustible->setTipo((new TipoVehiculo())->findById($_POST['tipo']));
        return $combustible;
    }
    private function getUltimaAct($id,$cantidad){
        if($id != 0){
            $combustible = (new Combustible())->findById(Session::get('com'));
            if($combustible->getStock() != $cantidad){
                return date("Y-m-d\TH:i:s");
            } else if($combustible->getStock() == $cantidad) {
                return $combustible->getFecUC();
            }
        } else {
            return null;
        }
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}