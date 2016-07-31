<?php
namespace Controller;
use \App\Session;
use App\Breadcrumbs;
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
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea mayor al stock mínimo"));                    
                } else if($combustible->getStock() > $combustible->getStockMax()){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea menor al stock máximo"));
                } else if($combustible->getStockMin() >= $combustible->getStockMax()){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock mínimo sea menor al stock máximo"));
                } else if($combustible->getTipo() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el tipo"));    
                } else {                
                    $id = $combustible->save();
                    if(isset($id)){
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
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea mayor al stock mínimo"));
                } else if($combustible->getStock() > $combustible->getStockMax()){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock sea menor al stock máximo"));
                } else if($combustible->getStockMin() >= $combustible->getStockMax()){
                    Session::set("msg",Session::msgDanger("Asegurese que el stock mínimo sea menor al stock máximo")); 
                } else if($combustible->getTipo() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el tipo"));
                } else {
                    $id = $combustible->save();
                    if(isset($id)){
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
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Combustible Borrado") : Session::msgDanger("No se pudo borrar el combustible"));
                header("Location:index.php?&c=combustibles&a=index");
            }            
        }
    }
    public function view(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["view.php"], [
                "combustible" => (new Combustible())->findById($_GET['d'])
            ]);        
        }
    }
    public function add_mov(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("app",$_GET['d']);
            Session::set("v",$_GET['v']);
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            $usado = $this->getUsado();
            if (isset($_POST['btnaceptar'])) {
                $historial = $this->createEntity();
                if($historial->getUsado()->getVehiculo()->checkCap($historial->getRecarga())){
                    if($historial->getCombustible()->delStock($historial->getRecarga())){
                        $id = $usado->addHis($historial);
                        if(isset($id)){
                            $this->getRecarga($historial);
                            Session::set("msg",Session::msgSuccess("Historial de Vehículo Registrado"));
                            header("Location:index.php?c=usados&a=historial&d=".Session::get("app")."&v=".Session::get("v"));
                            exit();
                        } else {
                            Session::set("msg",Session::msgDanger("Error al registrar historial"));
                        }                
                    } else {
                        Session::set("msg",Session::msgDanger("No tiene suficiente stock para recargar"));
                    }
                } else {
                    Session::set("msg",Session::msgDanger("El vehículo no tiene capacidad para la recarga ingresada"));
                }
            }
            $this->redirect_administrador(['historial.php'],[
                "usado" => $usado,
                "historiales" => $usado->getHistoriales(),
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }                    
    }
    public function del_mov(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set("v",$_GET['v']);
            Session::set("m",$_GET['m']);
            Session::set("f",$_GET['f']);
            $usado = $this->getUsado();
            $historial = $this->getHistorial($usado);
            $historial->getCombustible()->addStock($historial->getRecarga());
            $id = $usado->delHis($historial);
            $this->getRecarga($historial);
            Session::set("msg", (isset($id)) ? Session::msgSuccess("Historial de Vehículo Borrado") : Session::msgDanger("No se pudo borrar el producto"));
            header("Location:index.php?c=usados&a=historial&d=".Session::get("app")."&v=".Session::get("v"));
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