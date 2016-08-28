<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\TipoVehiculo;
use \Clases\Combustible;
class CombustiblesController extends AppController
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
            $this->redirect_administrador(['index.php'],[
                "combustibles" => (new Combustible())->find()
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
            if(isset($_POST['btnaceptar'])){
                $combustible = $this->createEntity();
                if($combustible->getStock() < 0){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea mayor o igual a 0"));                    
                } else if($combustible->getStock() > $combustible->getStockMax()){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea menor al stock máximo"));
                } else if($combustible->getStockMin() >= $combustible->getStockMax()){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock mínimo sea menor al stock máximo"));
                } else if($combustible->getTipo() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Tipo de Vehículo"));    
                } else {                
                    if($combustible->save()){
                        Session::set("msg",Session::msgSuccess("Combustible Creado"));
                        header("Location:index.php?c=combustibles&a=index");
                        exit();                
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                    
                }
            }
            $this->redirect_administrador(['add.php'],[
                "tipos" => (new TipoVehiculo())->find()
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("com",$_GET['d']);
            if (Session::get('com')!=null && isset($_POST['btnaceptar'])){
                $combustible = $this->createEntity();
                if($combustible->getStock() < 0){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea mayor o igual a 0"));
                } else if($combustible->getStock() > $combustible->getStockMax()){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea menor al stock máximo"));
                } else if($combustible->getStockMin() >= $combustible->getStockMax()){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock mínimo sea menor al stock máximo")); 
                } else if($combustible->getTipo() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Tipo de Vehículo"));
                } else {
                    if($combustible->save()){
                        Session::set("msg",Session::msgSuccess("Combustible Editado"));
                        header("Location:index.php?c=combustibles&a=index");
                        exit();                
                    }else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                
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
                if($id){
                    Session::set("msg",Session::msgSuccess("Combustible Borrado"));
                } else {
                    Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                }                
                header("Location:index.php?&c=combustibles&a=index");
            }            
        }
    }
    public function view(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer" and Session::get('log_in')->getRol()->getNombre() != "Cliente")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["view.php"], [
                "combustible" => (new Combustible())->findById($_GET['d'])
            ]);        
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor o piloto para acceder."));
            header("Location:index.php?c=todos&a=index");
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
        $combustible->setTipo((new TipoVehiculo())->findByX((isset($_POST['tipo'][0])) ? $_POST['tipo'][0] : 0));
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