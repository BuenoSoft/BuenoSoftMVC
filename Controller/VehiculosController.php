<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\TipoVehiculo;
use \Clases\Combustible;
use \Clases\Vehiculo;
use \Clases\Notificacion;
class VehiculosController extends AppController
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
            Session::set('comb', '');
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $this->clean($_POST['txtbuscador']) : Session::get('b'));
            $vehiculos = $this->getPaginator()->paginar((new Vehiculo())->find(Session::get('b')), Session::get('p')); 
            $this->redirect_administrador(["index.php"],[
                "vehiculos" => $vehiculos,
                "paginador" => $this->getPaginator()->getPages()
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
                $veh = $this->createEntity();
                if($veh->getTipo() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el tipo"));
                } else if($veh->getStock() > $veh->getCapcarga()){
                    Session::set("msg",Session::msgDanger("El stock ingresado excede a la capacidad de carga"));
                } else if(!$veh->getCombustible()->hayStock($veh->getStock())){
                    Session::set("msg",Session::msgDanger("El combustible no puede cargar el stock ingresado"));    
                } else {                
                    $id = $veh->save();
                    if(isset($id)){
                        $veh->getCombustible()->delStock($veh->getStock());
                        $this->notifyDown($veh);
                        Session::set("msg",Session::msgSuccess("Vehículo Creado"));
                        header("Location:index.php?c=vehiculos&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                                    
                }
            }
            $this->redirect_administrador(["add.php"],[
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
            Session::set("vh",$_GET['d']);
            if (Session::get('vh')!=null && isset($_POST['btnaceptar'])){
                $veh = $this->createEntity();
                if($veh->getTipo() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el tipo"));
                } else if($veh->getStock() > $veh->getCapcarga()){
                    Session::set("msg",Session::msgDanger("El stock ingresado excede a la capacidad de carga"));
                } else if(!$veh->getCombustible()->hayStock($_POST['txtstock'])){
                    Session::set("msg",Session::msgDanger("El combustible no puede cargar el stock ingresado"));
                } else {                    
                    $id = $veh->save();
                    if(isset($id)){
                        $veh->getCombustible()->delStock(isset($_POST['txtstock']) ? $_POST['txtstock'] : 0);
                        $this->notifyDown($veh);
                        Session::set("msg",Session::msgSuccess("Vehículo Editado"));
                        header("Location:index.php?c=vehiculos&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                                    
                }
            }
            $this->redirect_administrador(["edit.php"],[
                'vehiculo' => (new Vehiculo())->findById(Session::get('vh')),
                "tipos" => (new TipoVehiculo())->find() 
            ]);
        }
    }
    private function notifyDown($veh){
        if($veh->getCombustible()->isDown()){
            $not = new Notificacion();
            $not->setId(0);
            $not->setLog("El combustible ".$veh->getCombustible()->getNombre()." necesita ser recargado");
            $not->setFechaini(date("Y-m-d"));
            $not->setVehiculo($veh);
            $not->save();
        }
    }
    public function view(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["view.php"],[
                'vehiculo' => (new Vehiculo())->findById($_GET['d']),
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $vehiculo = (new Vehiculo())->findById($_GET['d']);
                $id = $vehiculo->del();                
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Vehículo Borrado") : Session::msgDanger("No se pudo borrar el vehículo"));
                header("Location:index.php?&c=vehiculos&a=index");
            }            
        }
    }
    public function reiniciar(){
        if($this->checkUser()){
            Session::set("vh",$_GET['d']);
            $vehiculo = (new Vehiculo())->findById($_GET['d']);
            $vehiculo->setTaquiDif(0);
            $vehiculo->change();
            $this->redirect_administrador(["edit.php"],[
                "vehiculo" => $vehiculo,
                "tipos" => (new TipoVehiculo())->find() 
            ]);                        
        }
    }
    private function createEntity(){
        $tipo = (new TipoVehiculo())->findByX((isset($_POST['tipo'][0])) ? $_POST['tipo'][0] : 0);
        $vehiculo = new Vehiculo();
        $vehiculo->setId((isset($_POST['hid'])) ? $_POST['hid'] : 0);
        $vehiculo->setMatricula($this->clean($_POST['txtmat']));
        $vehiculo->setPadron($this->clean($_POST['txtpadron']));
        $vehiculo->setTipo($tipo);
        $vehiculo->setCapcarga($this->clean($_POST['txtcap']));
        $vehiculo->setStock((isset($_POST['hid'])) ? ($this->clean($_POST['txtstock']) + $this->clean($_POST['hdnstock'])) : $this->clean($_POST['txtstock']));
        $vehiculo->setModelo($this->clean($_POST['txtmodelo']));
        $vehiculo->setMarca($this->clean($_POST['txtmarca']));
        $vehiculo->setAnio($this->clean($_POST['txtanio']));
        $vehiculo->setCombustible($this->getCombustible($tipo->getId()));
        return $vehiculo;
    }
    private function getCombustible($tipo) {
        $combustible = (new Combustible())->findByTipo($tipo);
        return ($combustible != null) ? $combustible : null;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}