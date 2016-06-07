<?php
namespace Controller;
use \App\Session;
use \Clases\Usuario;
use \Clases\Producto;
use \Clases\Vehiculo;
use \Clases\Aplicacion;
use \Clases\Usado;
class AplicacionesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set("app",0);
            Session::set('myuser',"");
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            Session::set('bus',"");
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
            Session::set("app",0);
            Session::set('myuser', isset($_POST['cliente']) ? $_POST['cliente'] : Session::get('myuser'));
            $usuarios = (Session::get('myuser')!= "") ? $this->getPaginator()->paginar((new Usuario())->find(Session::get('myuser')),1) : array();
            if (isset($_POST['btnaceptar'])) {
                $apl = $this->createEntity();
                $apl->save();
                $this->addProductos();
                $this->addVehiculos();
                Session::set("msg","Aplicación Creada");
                header("Location:index.php?c=aplicaciones&a=index");
                exit();                
            }
            $this->redirect_administrador(['add.php'],[
                "usuarios" => $usuarios,
                "productos" => (new Producto)->find(),
                "vehiculos" => (new Vehiculo)->find()
            ]);
        }
    }
    private function addProductos(){
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        if(isset($_POST["productos"])){
            foreach ($_POST["productos"] as $pro){
                $producto = (new Producto())->findById($pro);
                $apl->addPro($producto->getId());
            }
        }
    }
    private function addVehiculos(){
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        if(isset($_POST["vehiculos"])){
            foreach ($_POST["vehiculos"] as $veh){
                $usado = new Usado();
                $usado->setAplicacion($apl);
                $usado->setVehiculo((new Vehiculo())->findById($veh));
                $usado->setConductor(null);
                $apl->addUsu($usado);
            }
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function edit(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set('myuser', isset($_POST['cliente']) ? $_POST['cliente'] : Session::get('myuser'));
            $usuarios = (Session::get('myuser')!= "") ? $this->getPaginator()->paginar((new Usuario())->find(Session::get('myuser')),1) : array();
            if (Session::get('app')!=null && isset($_POST['btnaceptar'])){
                $apl = $this->createEntity();
                $apl->save();
                $this->modProductos($apl);
                $this->modVehiculos($apl);
                Session::set("msg","Aplicación Editada");
                header("Location:index.php?c=aplicaciones&a=index");
                exit();
            }
            $this->redirect_administrador(['edit.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("app")),
                "usuarios" => $usuarios,
                "productos" => (new Producto)->find(),
                "vehiculos" => (new Vehiculo)->find()
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
            $apl->delUsu($usado);
        }        
        if(isset($_POST["vehiculos"])){
            foreach ($_POST["vehiculos"] as $veh){
                $usado = new Usado();
                $usado->setAplicacion($apl);
                $usado->setVehiculo((new Vehiculo())->findById($veh));
                $usado->setConductor(null);
                $apl->addUsu($usado);
            }
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function view(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            $this->redirect_administrador(['view.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("app"))
            ]);
        }
    }
    public function cliente(){
        if($this->checkUser()){
            Session::set("v",$_GET['v']);
            $this->redirect_administrador(['cliente.php'],[
                "usuario" => (new Usuario())->findById(Session::get("v"))
            ]);
        }
    }
    private function createEntity() {
        $cliente = (new Usuario())->findById($_POST['cliente']);
        $aplicacion = new Aplicacion();
        $aplicacion->setId((Session::get("id")!= 0) ? Session::get("id") : 0);
        $aplicacion->setCultivoLat($_POST['txtcoordlat']);
        $aplicacion->setCultivoLong($_POST['txtcoordlong']);
        $aplicacion->setPistaLat($_POST['txtcoordlat']);
        $aplicacion->setPistaLong($_POST['txtcoordlong']);
        $aplicacion->setAreaapl($_POST['txtarea_apl']);
        $aplicacion->setFaja($_POST['txtfaja']);
        $aplicacion->setFechaIni($_POST['dtfechaini']);
        $aplicacion->setFechaFin(isset($_POST['dtfechafin']) ? $_POST['dtfechafin'] : null);
        $aplicacion->setTratamiento($_POST['txttrat']);
        $aplicacion->setViento($_POST['txtviento']);
        $aplicacion->setTaquiIni($_POST['txttaquiIni']);
        $aplicacion->setTaquiFin($_POST['txttaquiFin']);
        $aplicacion->setTipo($_POST['tipos']);
        $aplicacion->setPadron($_POST['txtpadron']);
        $aplicacion->setCultivo($_POST['txtcultivo']);
        $aplicacion->setCaudal($_POST['txtcaudal']);
        $aplicacion->setDosis($_POST['txtdosis']);
        $aplicacion->setCliente($cliente);
        return $aplicacion;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}