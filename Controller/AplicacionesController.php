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
        if($this->checkUser()){
            Session::set("app",0);
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $apl = $this->getPaginator()->paginar((new Aplicacion())->find(Session::get('b')), Session::get('p'));
            $this->redirect_administrador(['index.php'],[
                "aplicaciones" => $apl,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function add(){
        if($this->checkUser()){
            $this->passDates();
            $productos = (Session::get("pass")[9] != "") ? (new Producto())->findByTipo(Session::get("pass")[9]) : array();
            $usuarios = (Session::get('pass')[16] != "") ? $this->getPaginator()->paginar((new Usuario())->find(Session::get('pass')[16]),1) : array();
            $pistas = (Session::get('pass')[2] != "") ? $this->getPaginator()->paginar((new Pista())->find(Session::get('pass')[2]),1) : array();            
            if (isset($_POST['btnaceptar'])) {
                $apl = $this->createEntity();
                $apl->save();
                $this->addProductos();
                $this->addVehiculos();
                $this->addFuncionarios();
                Session::set("msg","Aplicación Creada");
                header("Location:index.php?c=aplicaciones&a=index");
                exit();                
            }
            $this->redirect_administrador(['add.php'],[
                "usuarios" => $usuarios,
                "pistas" => $pistas,
                "funcionarios" => (new Usuario())->funcionarios(),
                "tipos" => (new TipoProducto())->find(),
                "productos" => $productos,
                "vehiculos" => (new Vehiculo())->find()
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
    private function addVehiculos(){
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        if(isset($_POST["vehiculos"])){
            foreach ($_POST["vehiculos"] as $veh){
                $apl->addUsu($veh);
            }
        }
    }
    private function addFuncionarios(){
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        if(isset($_POST["funcionarios"])){
            foreach ($_POST["funcionarios"] as $func){
                $apl->addTra($func);
            }
        }    
    }
    /*-------------------------------------------------------------------------------*/
    public function edit(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            $this->passEdit();
            $productos = (Session::get("pass")[9] != "") ? (new Producto())->findByTipo(Session::get("pass")[9]) : array();
            $usuarios = (Session::get('pass')[16] != "") ? $this->getPaginator()->paginar((new Usuario())->find(Session::get('pass')[16]),1) : array();
            $pistas = (Session::get('pass')[2] != "") ? $this->getPaginator()->paginar((new Pista())->find(Session::get('pass')[2]),1) : array();
            if (Session::get('app')!=null && isset($_POST['btnaceptar'])){
                $this->passDates();
                $apl = $this->createEntity();
                $apl->save();
                $this->modProductos($apl);
                $this->modVehiculos($apl);
                $this->modFuncionarios($apl);
                Session::set("msg","Aplicación Editada");
                header("Location:index.php?c=aplicaciones&a=index");
                exit();
            }
            $this->redirect_administrador(['edit.php'],[
                "usuarios" => $usuarios,
                "pistas" => $pistas,
                "funcionarios" => (new Usuario())->funcionarios(),
                "tipos" => (new TipoProducto())->find(),
                "productos" => $productos,
                "vehiculos" => (new Vehiculo())->find()
            ]);    
        }
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
    private function modVehiculos($apl){
        foreach($apl->getUsados() as $usado){
            $apl->delUsu($usado->getVehiculo()->getId());
        }        
        if(isset($_POST["vehiculos"])){
            foreach ($_POST["vehiculos"] as $veh){
                $apl->addUsu($veh);                                
            }
        }
    }
    private function modFuncionarios($apl){
        foreach($apl->getTrabajadores() as $funcionario){
            $apl->delTra($funcionario->getId());
        }
        if(isset($_POST["funcionarios"])){
            foreach ($_POST["funcionarios"] as $func){
                $apl->addTra($func);
            }
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function view(){
        if($this->checkUser()){
            $this->redirect_administrador(['view.php'],[
                "aplicacion" => (new Aplicacion())->findById($_GET['d'])
            ]);
        }
    }
    private function passDates(){
        $datos = array();
        array_push($datos, (Session::get("app")!= 0) ? Session::get("app") : 0);
        array_push($datos, isset($_POST['txtcoordcul']) ? $_POST['txtcoordcul'] : null);
        array_push($datos, isset($_POST["pista"]) ? $_POST["pista"] : null);
        array_push($datos, isset($_POST['txtarea_apl']) ? $_POST['txtarea_apl'] : null);
        array_push($datos, isset($_POST['txtfaja']) ? $_POST['txtfaja'] : null);
        array_push($datos, isset($_POST['dtfechaini']) ? $_POST['dtfechaini'] : null);
        array_push($datos, isset($_POST['dtfechafin']) ? $_POST['dtfechafin'] : null);
        array_push($datos, isset($_POST['txttrat']) ? $_POST['txttrat'] : null);
        array_push($datos, isset($_POST['txtviento']) ? $_POST['txtviento'] : null);
        array_push($datos, isset($_POST["tipo"]) ? $_POST["tipo"] : null);
        array_push($datos, isset($_POST['txttaquiIni']) ? $_POST['txttaquiIni'] : null);
        array_push($datos, isset($_POST['txttaquiFin']) ? $_POST['txttaquiFin'] : null);
        array_push($datos, isset($_POST['txtpadron']) ? $_POST['txtpadron'] : null);
        array_push($datos, isset($_POST['txtcultivo']) ? $_POST['txtcultivo'] : null);
        array_push($datos, isset($_POST['txtcaudal']) ? $_POST['txtcaudal'] : null);
        array_push($datos, isset($_POST['txtdosis']) ? $_POST['txtdosis'] : null);
        array_push($datos, isset($_POST['cliente']) ? $_POST['cliente'] : null);
        Session::set("pass", $datos);        
    }
    private function passEdit(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        $datos = array();
        array_push($datos, $apl->getId());
        array_push($datos, $apl->getCoordCul());
        array_push($datos, $apl->getPista()->getId());
        array_push($datos, $apl->getAreaapl());
        array_push($datos, $apl->getFaja());
        array_push($datos, $apl->getFechaIni());
        array_push($datos, $apl->getFechaFin());
        array_push($datos, $apl->getTratamiento());
        array_push($datos, $apl->getViento());
        array_push($datos, $apl->getTipo()->getId());
        array_push($datos, $apl->getTaquiIni());
        array_push($datos, $apl->getTaquiFin());
        array_push($datos, $apl->getPadron());
        array_push($datos, $apl->getCultivo());
        array_push($datos, $apl->getCaudal());
        array_push($datos, $apl->getDosis());
        array_push($datos, $apl->getCliente()->getId());
        Session::set("pass", $datos);
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
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}