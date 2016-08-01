<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\TipoVehiculo;
use \Clases\Vehiculo;
use \Clases\Combustible;
use \Clases\Movimiento;
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
            $bc->add_crumb("index.php?c=combustibles&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("com",$_GET['d']);
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            $comb = (new Combustible())->findById(Session::get("com"));
            if (isset($_POST['btnaceptar'])) {
                $mov = $this->createMov();                
                if($mov->getEmisor() == null){
                    Session::set("msg",Session::msgDanger("No ha seleccionado el vehículo emisor"));
                } else if($mov->getReceptor() == null){
                    Session::set("msg",Session::msgDanger("No ha seleccionado el vehículo receptor"));
                } else if($mov->getEmisor() == $mov->getReceptor()){
                    Session::set("msg",Session::msgDanger("El vehículo emisor debe ser distinto al receptor"));                    
                } else if(!$mov->getEmisor()->hayStock($mov->getCantidad())){
                    Session::set("msg",Session::msgDanger("el vehículo emisor no tiene suficiente carga para este movimiento"));                                    
                } else {
                    $id = $comb->addMov($mov);
                    if(isset($id)){
                        $mov->getEmisor()->delStock($mov->getCantidad());
                        $mov->getReceptor()->addStock($mov->getCantidad());
                        Session::set("msg",Session::msgSuccess("Movimiento Realizado"));
                        header("Location:index.php?c=combustibles&a=add_mov&d=".Session::get("com"));
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger("Error al realizar el movimiento"));
                    }
                }
            }
            $this->redirect_administrador(['add_mov.php'],[
                "combustible" => $comb,
                "vehiculos" => (new Vehiculo())->find(),
                "movimientos" => $comb->getMovimientos(),
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }                    
    }   
    public function del_mov(){
        if($this->checkUser()){
            Session::set("com",$_GET['d']);
            Session::set("f",$_GET['f']);
            $comb = (new Combustible())->findById(Session::get("com"));
            $mov = $this->getMov($comb);
            $id = $comb->delMov($mov);
            if(isset($id)){
                $mov->getEmisor()->addStock($mov->getCantidad());
                $mov->getReceptor()->delStock($mov->getCantidad());
                Session::set("msg",Session::msgSuccess("Movimiento Borrado"));
            } else {
                Session::set("msg",Session::msgDanger("No se pudo borrar el movimiento"));
            }
            header("Location:index.php?c=combustibles&a=add_mov&d=".Session::get("com"));
        }
    }
    private function createMov(){
        $mov = new Movimiento();
        $mov->setFecha($_POST["dtfecha"]);
        $mov->setCantidad($_POST["txtcant"]);
        $mov->setEmisor((new Vehiculo())->findByMat((isset($_POST['vehemi'][0])) ? $_POST['vehemi'][0] : 0));
        $mov->setReceptor((new Vehiculo())->findByMat((isset($_POST['vehrec'][0])) ? $_POST['vehrec'][0] : 0));
        $mov->setUsuario(Session::get("log_in"));
        return $mov;
    }
    private function getMov($comb){
        foreach ($comb->getMovimientos() as $mov) {
            if($mov->getFecha() == Session::get("f")){
                return $mov;
            }
        }
        return null;
    }
    public function vehiculo(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=combustibles&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["vehiculo.php"],[
                'vehiculo' => (new Vehiculo())->findById($_GET['d']),
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