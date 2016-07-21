<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\Vehiculo;
use \Clases\Usuario;
use \Clases\Notificacion;
use \Clases\Aplicacion;
use \Clases\Historial;
class UsadosController extends AppController 
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=aplicaciones&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("app",$_GET['d']);
            Session::set('s', isset($_GET['p']) ? $_GET['p'] : 1);
            $apl = (new Aplicacion())->findById(Session::get("app"));
            $usados = $this->getPaginator()->paginar($apl->getUsados(), Session::get('s'));
            $this->redirect_administrador(['index.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("app")),
                "usados" => $usados,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function historial(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=aplicaciones&a=index");
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
    public function delete(){
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
    public function usuario(){
        if(Session::get("log_in") != null){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=aplicaciones&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["usuario.php"],["usuario" => (new Usuario())->findById($_GET['d'])]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    public function vehiculo(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=aplicaciones&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["vehiculo.php"],[
                'vehiculo' => (new Vehiculo())->findById($_GET['d']),
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function getRecarga($historial){
        if($historial->getCombustible()->isDown() or $historial->getCombustible()->isMedium()){
            $not = new Notificacion();
            $not->setId(0);
            $not->setFechaini($_POST['dtfecha']);
            $not->setFechafin(null);
            $not->setFechaAct($_POST['dtfecha']);
            $not->setLog("Por favor recargue el combustible general ".$historial->getCombustible()->getNombre()." que está en el ".$historial->getCombustible()->regla3()."%");
            $not->setVehiculo($historial->getUsado()->getVehiculo());
            $not->save();
        }
    }
    private function getUsado(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        $veh = (new Vehiculo())->findById(Session::get("v"));
        foreach($apl->getUsados() as $usado){
            if($usado->getVehiculo() == $veh){
                return $usado;
            }
        }
        return null;
    }
    private function getHistorial($usado){
        foreach($usado->getHistoriales() as $historial){
            if($historial->getCombustible()->getId() == Session::get("m") and $historial->getFecha() == Session::get("f")){
                return $historial;            
            }
        }
        return null;
    }
    private function createEntity(){
        $usado = $this->getUsado();
        $historial = new Historial();
        $historial->setUsado($usado);
        $historial->setCombustible($usado->getVehiculo()->getCombustible());
        $historial->setFecha($_POST['dtfecha']);
        $historial->setRecarga($_POST['txtrecarga']);
        return $historial;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor","Piloto"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor o piloto";
    }
}