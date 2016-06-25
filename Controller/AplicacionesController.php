<?php
namespace Controller;
use \App\Session;
use \Clases\Pista;
use \Clases\TipoProducto;
use \Clases\Usuario;
use \Clases\Producto;
use \Clases\Vehiculo;
use \Clases\Aplicacion;
class AplicacionesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            Session::set("app",0);
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            $apl = $this->getPaginator()->paginar(
                (new Aplicacion())->findAdvance([
                    "aeronave" => isset($_POST["aeronave"]) ? $_POST["aeronave"] : null,
                    "piloto" => (isset($_POST["piloto"]) and Session::get('log_in')->getRol()->getNombre() != "Piloto") ? $_POST["piloto"] : ((Session::get('log_in')->getRol()->getNombre() == "Piloto") ? Session::get('log_in')->getId() : null),
                    "tipo" => isset($_POST["tipo"]) ? $_POST["tipo"] : null,
                    "cliente" => (isset($_POST["cliente"]) and Session::get('log_in')->getRol()->getNombre() != "Cliente") ? $_POST["cliente"] : ((Session::get('log_in')->getRol()->getNombre() == "Cliente") ? Session::get('log_in')->getId() : null),
                    "fec1" => isset($_POST["fec1"]) ? $_POST["fec1"] : null,
                    "fec2" => isset($_POST["fec2"]) ? $_POST["fec2"] : null
                ]), 
                Session::get('p')
            );
            $this->redirect_administrador(['index.php'],[
                "aplicaciones" => $apl,
                "vehiculos" => (new Vehiculo())->find(),
                "usuarios" => (new Usuario())->find(),
                "tipos" => (new TipoProducto())->find(),
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function add(){
        if($this->checkUser()){
            $this->passDates();
            $productos = (Session::get("pass")[9] != "") ? $this->getPaginator()->paginar((new Producto())->findByTipo(Session::get("pass")[9])) : array();
            $clientes = (Session::get('pass')[16] != "") ? $this->getPaginator()->paginar((new Usuario())->find(Session::get('pass')[16]),1) : array();
            $pistas = (Session::get('pass')[2] != "") ? $this->getPaginator()->paginar((new Pista())->find(Session::get('pass')[2]),1) : array();            
            if (isset($_POST['btnaceptar'])) {
                $apl = $this->createEntity();
                $apl->save();
                $this->addProductos();
                $this->addExtras();
                Session::set("msg","Aplicación Creada");
                header("Location:index.php?c=aplicaciones&a=index");
                exit();                
            }
            $this->redirect_administrador(['add.php'],[
                "clientes" => $clientes,
                "usuarios" => (new Usuario())->find(),
                "vehiculos" => (new Vehiculo())->find(),
                "pistas" => $pistas,
                "tipos" => (new TipoProducto())->find(),
                "productos" => $productos                
            ]);
        }
    }
    private function addProductos(){
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        if(isset($_POST["productos"])){
            foreach ($_POST["productos"] as $pro){
                $apl->addPro($pro);
            }
        }
    }
    private function addExtras(){
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        $piloto = (new Usuario())->findById((Session::get("log_in")->getRol()->getNombre() == "Piloto") ? Session::get("log_in")->getId() : Session::get('pass')[17]);
        $chofer = (new Usuario())->findById(Session::get('pass')[18]);        
        $aeronave = (new Vehiculo())->findById(Session::get('pass')[19]);
        $terrestre = (new Vehiculo())->findById(Session::get('pass')[20]);
        $apl->addUsu($aeronave->getId(),$piloto->getId());
        $apl->addUsu($terrestre->getId(),$chofer->getId());
    }
    /*-------------------------------------------------------------------------------*/
    public function edit(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            $this->passDates();
            $productos = (Session::get("pass")[9] != "") ? $this->getPaginator()->paginar((new Producto())->findByTipo(Session::get("pass")[9])) : array();
            $clientes = (Session::get('pass')[16] != "") ? $this->getPaginator()->paginar((new Usuario())->find(Session::get('pass')[16]),1) : array();
            $pistas = (Session::get('pass')[2] != "") ? $this->getPaginator()->paginar((new Pista())->find(Session::get('pass')[2]),1) : array();
            if (Session::get('app')!=null && isset($_POST['btnaceptar'])){
                $apl = $this->createEntity();
                $apl->save();
                $this->modProductos($apl);
                $this->modExtras($apl);
                Session::set("msg","Aplicación Editada");
                header("Location:index.php?c=aplicaciones&a=index");
                exit();
            } 
            $this->redirect_administrador(['edit.php'],[
                "clientes" => $clientes,
                "usuarios" => (new Usuario())->find(),
                "vehiculos" => (new Vehiculo())->find(),
                "pistas" => $pistas,
                "tipos" => (new TipoProducto())->find(),
                "productos" => $productos
            ]);    
        }
    }
    private function getPiloto(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        foreach($apl->getUsados() as $piloto){
            if($piloto->getUsuario()->getRol()->getNombre() == "Piloto"){
                return $piloto->getUsuario();                
            }
        }
        return null;
    }
    private function getChofer(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        foreach($apl->getUsados() as $chofer){
            if($chofer->getUsuario()->getRol()->getNombre() == "Chofer"){
                return $chofer->getUsuario();                
            }
        }
        return null;
    }
    private function getAeronave(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        foreach($apl->getUsados() as $aereo){
            if($aereo->getVehiculo()->getTipo()->getNombre() == "Aeronave"){
                return $aereo->getVehiculo();
            }
        }
        return null;
    }
    private function getTerrestre(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        foreach($apl->getUsados() as $terrestre){
            if($terrestre->getVehiculo()->getTipo()->getNombre() == "Auto" or $terrestre->getVehiculo()->getTipo()->getNombre() == "Camion" or $terrestre->getVehiculo()->getTipo()->getNombre() == "Camioneta"){
                return $terrestre->getVehiculo();
            }            
        }
        return null;
    }
    //Colaboración: Rodrigo López
    private function modProductos($apl){         
        foreach ($apl->getProductos() as $producto){
            $apl->delPro($producto->getId());             
        }
        if(isset($_POST["productos"])){
            foreach ($_POST["productos"] as $pro){
                $apl->addPro($pro);                            
            }            
        }
    }
    private function modExtras($apl){
        foreach($apl->getUsados() as $usado){
            $apl->delUsu($usado->getVehiculo()->getId(),$usado->getUsuario()->getId());
        }        
        $piloto = (new Usuario())->findById((Session::get("log_in")->getRol()->getNombre() == "Piloto") ? Session::get("log_in")->getId() : Session::get('pass')[17]);
        $chofer = (new Usuario())->findById(Session::get('pass')[18]);        
        $aeronave = (new Vehiculo())->findById(Session::get('pass')[19]);
        $terrestre = (new Vehiculo())->findById(Session::get('pass')[20]);
        $apl->addUsu($aeronave->getId(),$piloto->getId());
        $apl->addUsu($terrestre->getId(),$chofer->getId());
    }
    /*-------------------------------------------------------------------------------*/
    public function view(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            Session::set("app",$_GET['d']);
            $this->redirect_administrador(['view.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("app")),
                "piloto" => $this->getPiloto(),
                "aeronave" => $this->getAeronave(),
                "chofer" => $this->getChofer(),
                "terrestre" => $this->getTerrestre()
            ]);
        }
    }
    private function passDates(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        Session::set("pass",[
            (Session::get("app")!= 0) ? Session::get("app") : 0, 
            isset($_POST['txtcoordcul']) ? $this->clean($_POST['txtcoordcul']) : 
                ((Session::get("app")!= 0) ? $apl->getCoordCul() : null),
            isset($_POST["pista"]) ? $this->clean($_POST["pista"]) : 
                ((Session::get("app")!= 0) ? $apl->getPista()->getId() : null), 
            isset($_POST['txtarea_apl']) ? $this->clean($_POST['txtarea_apl']) : 
                ((Session::get("app")!= 0) ? $apl->getAreaapl() : null),
            isset($_POST['txtfaja']) ? $this->clean($_POST['txtfaja']) : 
                ((Session::get("app")!= 0) ? $apl->getFaja() : null), 
            isset($_POST['dtfechaini']) ? $this->clean($_POST['dtfechaini']) : 
                ((Session::get("app")!= 0) ? $apl->mostrarDateTimeIni() : null),
            isset($_POST['dtfechafin']) ? $this->clean($_POST['dtfechafin']) : 
                ((Session::get("app")!= 0) ? $apl->mostrarDateTimeFin() : null), 
            isset($_POST['txttrat']) ? $this->clean($_POST['txttrat']) : 
                ((Session::get("app")!= 0) ? $apl->getTratamiento() : null),
            isset($_POST['txtviento']) ? $this->clean($_POST['txtviento']) : 
                ((Session::get("app")!= 0) ? $apl->getViento() : null), 
            isset($_POST["tipo"]) ? $this->clean($_POST["tipo"]) : 
                ((Session::get("app")!= 0) ? $apl->getTipo()->getId() : null),
            isset($_POST['txttaquiIni']) ? $this->clean($_POST['txttaquiIni']) : 
                ((Session::get("app")!= 0) ? $apl->getTaquiIni() : null), 
            isset($_POST['txttaquiFin']) ? $this->clean($_POST['txttaquiFin']) : 
                ((Session::get("app")!= 0) ? $apl->getTaquiFin() : null), 
            isset($_POST['txtpadron']) ? $this->clean($_POST['txtpadron']) : 
                ((Session::get("app")!= 0) ? $apl->getPadron() : null),
            isset($_POST['txtcultivo']) ? $this->clean($_POST['txtcultivo']) : 
                ((Session::get("app")!= 0) ? $apl->getCultivo() : null), 
            isset($_POST['txtcaudal']) ? $this->clean($_POST['txtcaudal']) : 
                ((Session::get("app")!= 0) ? $apl->getCaudal() : null),
            isset($_POST['txtdosis']) ? $this->clean($_POST['txtdosis']) : 
                ((Session::get("app")!= 0) ? $apl->getDosis() : null), 
            isset($_POST['cliente']) ? $this->clean($_POST['cliente']) : 
                ((Session::get("app")!= 0) ? $apl->getCliente()->getId() : null), 
            isset($_POST['piloto']) ? $this->clean($_POST['piloto']) : 
                ((Session::get("app")!= 0) ? $this->getPiloto()->getId() : null),
            isset($_POST['chofer']) ? $this->clean($_POST['chofer']) : 
                ((Session::get("app")!= 0) ? $this->getChofer()->getId() : null), 
            isset($_POST['aeronave']) ? $this->clean($_POST['aeronave']) : 
                ((Session::get("app")!= 0) ? $this->getAeronave()->getId() : null),
            isset($_POST['terrestre']) ? $this->clean($_POST['terrestre']) : 
                ((Session::get("app")!= 0) ? $this->getTerrestre()->getId() : null)
        ]);       
    }
    private function createEntity() {        
        $aplicacion = new Aplicacion();
        $aplicacion->setId(Session::get("pass")[0]);
        $aplicacion->setCoordCul(Session::get("pass")[1]);
        $aplicacion->setPista((new Pista())->findById(Session::get("pass")[2]));
        $aplicacion->setAreaapl(Session::get("pass")[3]);
        $aplicacion->setFaja(Session::get("pass")[4]);
        $aplicacion->setFechaIni(Session::get("pass")[5]);
        $aplicacion->setFechaFin(Session::get("pass")[6]);
        $aplicacion->setTratamiento(Session::get("pass")[7]);
        $aplicacion->setViento(Session::get("pass")[8]);
        $aplicacion->setTipo((new TipoProducto())->findById(Session::get("pass")[9]));
        $aplicacion->setTaquiIni(Session::get("pass")[10]);
        $aplicacion->setTaquiFin(Session::get("pass")[11]);
        $aplicacion->setPadron(Session::get("pass")[12]);
        $aplicacion->setCultivo(Session::get("pass")[13]);
        $aplicacion->setCaudal(Session::get("pass")[14]);
        $aplicacion->setDosis(Session::get("pass")[15]);
        $aplicacion->setCliente((new Usuario())->findById(Session::get("pass")[16]));
        return $aplicacion;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor","Piloto"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}