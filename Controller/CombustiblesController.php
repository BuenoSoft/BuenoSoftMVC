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
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer" and Session::get('log_in')->getRol()->getNombre() != "Cliente")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(['index.php'],[
                "combustibles" => (new Combustible())->find()
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor o piloto para acceder."));
            header("Location:index.php?c=todos&a=index");
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
                if(isset($id)){
                    if((new Combustible())->findById($combustible->getId()) == null){
                        Session::set("msg",Session::msgSuccess("Combustible Borrado"));
                    } else {
                        Session::set("msg",Session::msgDanger("Hay vehículos usando este combustible"));
                    }
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
    public function add_mov(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer" and Session::get('log_in')->getRol()->getNombre() != "Cliente")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=combustibles&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("com",$_GET['d']);
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            $comb = (new Combustible())->findById(Session::get("com"));
            if (isset($_POST['btnaceptar'])) {                 
                if(!isset($_POST['vehemi'][0]) and !isset($_POST['vehrec'][0])){
                    Session::set("msg",Session::msgDanger("Asegurese de seleccionar al menos el stock emisor o receptor"));
                } else if($_POST['vehemi'][0] == $_POST['vehrec'][0] ){
                    Session::set("msg",Session::msgDanger("Asegurese de que los stocks emisor y receptor sean distintos"));
                } else {
                    $mov = $this->createMov();
                    if($comb->addMov($mov)){
                        $this->changeStock($mov);
                        Session::set("msg",Session::msgSuccess("Movimiento Realizado"));
                        header("Location:index.php?c=combustibles&a=add_mov&d=".Session::get("com"));
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    } 
                }
            }
            $this->redirect_administrador(['add_mov.php'],[
                "combustible" => $comb,
                "vehiculos" => (new Vehiculo())->find(),
                "movimientos" => $comb->getMovimientos(),
                "paginador" => $this->getPaginator()->getPages()
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor o piloto para acceder."));
            header("Location:index.php?c=todos&a=index");
        }                    
    }
    public function del_mov(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer" and Session::get('log_in')->getRol()->getNombre() != "Cliente")){
            Session::set("com",$_GET['d']);
            Session::set("f",$_GET['f']);
            $comb = (new Combustible())->findById(Session::get("com"));
            $mov = $this->getMov($comb);
            if($comb->delMov($mov)){
                $this->changeDelStock($mov);
                Session::set("msg",Session::msgSuccess("Movimiento Borrado"));
            } else {
                Session::set("msg",Session::msgDanger("No se pudo borrar el movimiento"));
            }
            header("Location:index.php?c=combustibles&a=add_mov&d=".Session::get("com"));
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor o piloto para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function createMov(){
        $mov = new Movimiento();
        $mov->setFecha($this->inverseDate($_POST["dtfecha"]));
        $mov->setCantidad($_POST["txtcant"]);
        $mov->setEmisor((new Vehiculo())->findByMat((isset($_POST['vehemi'][0])) ? $_POST['vehemi'][0] : 0));
        $mov->setReceptor((new Vehiculo())->findByMat((isset($_POST['vehrec'][0])) ? $_POST['vehrec'][0] : 0));
        $mov->setUsuario(Session::get("log_in"));
        return $mov;
    }
    private function changeStock($mov){
        if($mov->getEmisor() != null and $mov->getReceptor() == null){
            $mov->getEmisor()->delStock($mov->getCantidad());
            $mov->getEmisor()->getCombustible()->addStock($mov->getCantidad());
        } else if($mov->getEmisor() == null and $mov->getReceptor() != null){
            $mov->getReceptor()->getCombustible()->delStock($mov->getCantidad());
            $mov->getReceptor()->addStock($mov->getCantidad());
        } else {
            $mov->getEmisor()->delStock($mov->getCantidad());
            $mov->getReceptor()->addStock($mov->getCantidad());
        }       
    }
    private function changeDelStock($mov){
        if($mov->getEmisor() != null and $mov->getReceptor() == null){
            $mov->getEmisor()->addStock($mov->getCantidad());
            $mov->getEmisor()->getCombustible()->delStock($mov->getCantidad());
        } else if($mov->getEmisor() == null and $mov->getReceptor() != null){
            $mov->getReceptor()->getCombustible()->addStock($mov->getCantidad());
            $mov->getReceptor()->delStock($mov->getCantidad());
        } else {
            $mov->getEmisor()->addStock($mov->getCantidad());
            $mov->getReceptor()->delStock($mov->getCantidad());
        }
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
    private function inverseDate($date){
        if($date != null){
            $arrdate = explode("-", $date);
            return $arrdate[2]."-".$arrdate[1]."-".$arrdate[0]." ".$arrdate[3].":".$arrdate[4].":".$arrdate[5];
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