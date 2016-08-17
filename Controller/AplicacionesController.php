<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\Pista;
use \Clases\TipoProducto;
use \Clases\Usuario;
use \Clases\Producto;
use \Clases\Vehiculo;
use \Clases\Notificacion;
use \Clases\Aplicacion;
class AplicacionesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("app",0);
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);            
            $apl = $this->getPaginator()->paginar(
                (new Aplicacion())->findAdvance([
                    "aeronave" => isset($_POST["aeronave"][0]) ? $_POST["aeronave"][0] : null,
                    "piloto" => (isset($_POST["piloto"][0]) and Session::get('log_in')->getRol()->getNombre() != "Piloto") ? $_POST["piloto"][0] : ((Session::get('log_in')->getRol()->getNombre() == "Piloto") ? Session::get('log_in')->getNomReal() : null),
                    "tipo" => isset($_POST["tipo"][0]) ? $_POST["tipo"][0] : null,
                    "cliente" => (isset($_POST["cliente"][0]) and Session::get('log_in')->getRol()->getNombre() != "Cliente") ? $_POST["cliente"][0] : ((Session::get('log_in')->getRol()->getNombre() == "Cliente") ? Session::get('log_in')->getNomReal() : null),
                    "fec1" => isset($_POST["fec1"]) ? $this->inverseDat($_POST["fec1"]) : null,
                    "fec2" => isset($_POST["fec2"]) ? $this->inverseDat($_POST["fec2"]) : null
                ]), 
                Session::get('p')
            );
            Session::set("filtro", $apl);
            $this->redirect_administrador(['index.php'],[
                "aplicaciones" => Session::get('filtro'),
                "vehiculos" => (new Vehiculo())->find(),
                "usuarios" => (new Usuario())->find(),
                "tipos" => (new TipoProducto())->find(),
                "paginador" => $this->getPaginator()->getPages()
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function add(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->passDates();
            $productos = (Session::get("pass")[10] != "") ? (new Producto())->findByTipo((new TipoProducto())->findByX(Session::get("pass")[10])->getId()) : array();
            if (isset($_POST['btnaceptar'])) {                
                if(Session::get("pass")[20] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Aeronave"));
                } else if(Session::get("pass")[17] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Usuario"));
                } else if(Session::get("pass")[10] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Tipo de Producto"));
                } else if(Session::get("pass")[19] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Chofer"));
                } else if(Session::get("pass")[21] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Terrestre"));
                } else if(Session::get("pass")[18] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Piloto"));                                    
                } else if(Session::get("pass")[3] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado la Pista"));
                } else if((Session::get("pass")[6] != null and Session::get("pass")[7] != null) and (Session::get("pass")[6] > Session::get("pass")[7])){
                    Session::set("msg",Session::msgDanger("Asegurese de que la fecha de inicio sea menor a la fecha final"));
                } else if((Session::get("pass")[11] != null and Session::get("pass")[12] != null) and (Session::get("pass")[11] > Session::get("pass")[12])){
                    Session::set("msg",Session::msgDanger("Asegurese de que el taquimetro inicial sea menor al final"));                    
                } else if((Session::get("pass")[6] == null or Session::get("pass")[7] == null) and (Session::get("pass")[11] != null or Session::get("pass")[12] != null)){
                    Session::set("msg",Session::msgDanger("Asegurese que para los taquímetros tener las fechas ingresadas"));
                } else {
                    $apl = $this->createEntity();
                    $apl->save();
                    $this->addProductos();
                    $this->increaseTaqui($apl);
                    Session::set("msg",Session::msgSuccess("Aplicación Creada"));
                    header("Location:index.php?c=aplicaciones&a=index");
                    exit();
                    $this->addProductos();
                }             
            }
            $this->redirect_administrador(['add.php'],[
                "usuarios" => (new Usuario())->find(),
                "vehiculos" => (new Vehiculo())->find(),
                "pistas" => (new Pista())->find(),
                "tipos" => (new TipoProducto())->find(),
                "productos" => $productos                
            ]);
        }
    }
    private function addProductos(){
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        if(isset($_POST["producto"])){
            foreach ($_POST["producto"] as $pro){
                $producto = (new Producto())->findByX($pro);
                $apl->addPro($producto->getId());
            }
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function edit(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("app",$_GET['d']);
            $this->passDates();
            $productos = (Session::get("pass")[10] != "") ? (new Producto())->findByTipo((new TipoProducto())->findByX(Session::get("pass")[10])->getId()) : array();
            if (Session::get('app')!=null && isset($_POST['btnaceptar'])){                
                if(Session::get("pass")[20] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Aeronave"));
                } else if(Session::get("pass")[17] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Usuario"));
                } else if(Session::get("pass")[10] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Tipo de Producto"));
                } else if(Session::get("pass")[19] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Chofer"));
                } else if(Session::get("pass")[21] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Terrestre"));
                } else if(Session::get("pass")[18] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Piloto"));                                    
                } else if(Session::get("pass")[3] == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado la Pista"));
                } else if((Session::get("pass")[6] != null and Session::get("pass")[7] != null) and (Session::get("pass")[6] > Session::get("pass")[7])){
                    Session::set("msg",Session::msgDanger("Asegurese de que la fecha de inicio sea menor a la fecha final"));
                } else if((Session::get("pass")[11] != null and Session::get("pass")[12] != null) and (Session::get("pass")[11] > Session::get("pass")[12])){
                    Session::set("msg",Session::msgDanger("Asegurese de que el taquimetro inicial sea menor al final"));
                } else if((Session::get("pass")[6] == null or Session::get("pass")[7] == null) and (Session::get("pass")[11] > 0 or Session::get("pass")[12] > 0)){
                    Session::set("msg",Session::msgDanger("Asegurese que para los taquímetros tener las fechas ingresadas"));
                } else {
                    $apl = $this->createEntity();
                    $apl->save();
                    $this->modProductos($apl);
                    $this->increaseTaqui($apl);
                    Session::set("msg",Session::msgSuccess("Aplicación Editada"));
                    header("Location:index.php?c=aplicaciones&a=index");
                    exit();                
                }
            } 
            $this->redirect_administrador(['edit.php'],[
                "usuarios" => (new Usuario())->find(),
                "vehiculos" => (new Vehiculo())->find(),
                "pistas" => (new Pista())->find(),
                "tipos" => (new TipoProducto())->find(),
                "productos" => $productos  
            ]);    
        }
    }
    //Colaboración: Rodrigo López
    private function modProductos($apl){         
        foreach ($apl->getProductos() as $producto){
            $apl->delPro($producto->getId());             
        }
        if(isset($_POST["producto"])){
            foreach ($_POST["producto"] as $pro){
                $producto = (new Producto())->findByX($pro);
                $apl->addPro($producto->getId());
            }
        }
    }
    private function increaseTaqui($apl){
        if($apl->getFechaFin() != null){
            if($apl->getTaquiIni() != null and $apl->getTaquiFin() != null){
                $sum = $apl->taquiDif();
                $apl->getAeronave()->addTaqui($sum);
                if($apl->getAeronave()->getTaquiDif() >= $apl->getAeronave()->getHorasRec()){
                    $not = new Notificacion();
                    $not->setId(0);
                    $not->setMensaje("Usted debe realizar a la aeronave ".$apl->getAeronave()->getMatricula()." un mantenimiento");
                    $not->setFecha(date("Y-m-d"));
                    $not->setVehiculo($apl->getAeronave());
                    $not->save();
                    $apl->getAeronave()->setTaquiDif(($apl->getAeronave()->getTaquiDif() - $apl->getAeronave()->getHorasRec()));
                    $apl->getAeronave()->change();
                }
            }
        }                
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $apl = (new Aplicacion())->findById($_GET['d']);
                $id = $apl->del();                
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Aplicación Borrada") : Session::msgDanger("No se pudo borrar la aplicación"));
                header("Location:index.php?c=aplicaciones&a=index");
            }            
        }
    }
    public function view(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=aplicaciones&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("app",$_GET['d']);
            $this->redirect_administrador(['view.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("app")),
            ]);
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
    public function producto(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=aplicaciones&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(['producto.php'],[
                "producto" => (new Producto())->findById($_GET['d'])
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function passDates(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        Session::set("pass",[
            (Session::get("app")!= 0) ? Session::get("app") : 0, 
            isset($_POST['txtsur']) ? $this->clean($_POST['txtsur']) : 
                ((Session::get("app")!= 0) ? $apl->getGMDLat() : null),
            isset($_POST['txtoeste']) ? $this->clean($_POST['txtoeste']) : 
                ((Session::get("app")!= 0) ? $apl->getGMDLong() : null),
            isset($_POST["pista"][0]) ? $_POST["pista"][0]: 
                ((Session::get("app")!= 0) ? $apl->getPista()->getNombre() : null), 
            isset($_POST['txtarea_apl']) ? $this->clean($_POST['txtarea_apl']) : 
                ((Session::get("app")!= 0) ? $apl->getAreaapl() : null),
            isset($_POST['txtfaja']) ? $this->clean($_POST['txtfaja']) : 
                ((Session::get("app")!= 0) ? $apl->getFaja() : null), 
            isset($_POST['dtfechaini']) ? $this->inverseDate($_POST['dtfechaini']) : 
                ((Session::get("app")!= 0) ? $apl->mostrarDateTimeIni() : null),
            isset($_POST['dtfechafin']) ? $this->inverseDate($_POST['dtfechafin']) : 
                ((Session::get("app")!= 0) ? $apl->mostrarDateTimeFin() : null), 
            isset($_POST['txttrat']) ? $this->clean($_POST['txttrat']) : 
                ((Session::get("app")!= 0) ? $apl->getTratamiento() : null),
            isset($_POST['txtviento']) ? $this->clean($_POST['txtviento']) : 
                ((Session::get("app")!= 0) ? $apl->getViento() : null), 
            isset($_POST["tipo"][0]) ? $_POST["tipo"][0] : 
                ((Session::get("app")!= 0) ? $apl->getTipo()->getNombre() : null),
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
            isset($_POST['cliente'][0]) ?  $_POST['cliente'][0] : 
                ((Session::get("app")!= 0) ? $apl->getCliente()->getNomReal() : null), 
            isset($_POST['piloto'][0]) ? $_POST['piloto'][0] : 
                ((Session::get("app")!= 0) ? $apl->getPiloto()->getNomReal() : null),
            isset($_POST['chofer'][0]) ? $_POST['chofer'][0] : 
                ((Session::get("app")!= 0) ? $apl->getChofer()->getNomReal() : null), 
            isset($_POST['aeronave'][0]) ? $_POST['aeronave'][0] : 
                ((Session::get("app")!= 0) ? $apl->getAeronave()->getMatricula() : null),
            isset($_POST['terrestre'][0]) ? $_POST['terrestre'][0] : 
                ((Session::get("app")!= 0) ? $apl->getTerrestre()->getMatricula() : null)
        ]);       
    }
    private function createEntity() {        
        $aplicacion = new Aplicacion();
        $aplicacion->setId(Session::get("pass")[0]);
        $aplicacion->setCoordCul($this->getCoords(Session::get("pass")[1],Session::get("pass")[2]));
        $aplicacion->setPista((new Pista())->findByX((Session::get("pass")[3] != null) ? Session::get("pass")[3] : 0));
        $aplicacion->setAreaapl(Session::get("pass")[4]);
        $aplicacion->setFaja(Session::get("pass")[5]);
        $aplicacion->setFechaIni(Session::get("pass")[6]);
        $aplicacion->setFechaFin(Session::get("pass")[7]);
        $aplicacion->setTratamiento(Session::get("pass")[8]);
        $aplicacion->setViento(Session::get("pass")[9]);
        $aplicacion->setTipo((new TipoProducto())->findByX((Session::get("pass")[10] != null) ? Session::get("pass")[10] : 0));
        $aplicacion->setTaquiIni(Session::get("pass")[11]);
        $aplicacion->setTaquiFin(Session::get("pass")[12]);
        $aplicacion->setPadron(Session::get("pass")[13]);
        $aplicacion->setCultivo(Session::get("pass")[14]);
        $aplicacion->setCaudal(Session::get("pass")[15]);
        $aplicacion->setDosis(Session::get("pass")[16]);
        $aplicacion->setCliente((new Usuario())->findByNombre((Session::get("pass")[17] != null) ? Session::get("pass")[17] : 0));
        $aplicacion->setPiloto((new Usuario())->findByNombre((Session::get("pass")[18] != null) ? Session::get("pass")[18] : 0));
        $aplicacion->setChofer((new Usuario())->findByNombre((Session::get("pass")[19] != null) ? Session::get("pass")[19] : 0));
        $aplicacion->setAeronave((new Vehiculo())->findByMat((Session::get("pass")[20] != null) ? Session::get("pass")[20] : 0));
        $aplicacion->setTerrestre((new Vehiculo())->findByMat((Session::get("pass")[21] != null) ? Session::get("pass")[21] : 0));
        return $aplicacion;
    }
    private function getCoords($sur,$oeste){
        $lat = $this->getCoord($sur);
        $lon = $this->getCoord($oeste);
        return $lat.",".$lon;
    }
    private function getCoord($date){
        if($date == null){
            return null;
        } else {
            $arr=  explode(" ",$date);
            $p1 = $arr[1] /60;
            $p2 = $p1 + $arr[1];
            $p3 = $p2 /60;
            return -1 * ($p3 + $arr[0]);         
        }
    }
    private function inverseDate($date){
        if($date != null){
            $arrdate = explode("-", $date);
            return $arrdate[2]."-".$arrdate[1]."-".$arrdate[0]." ".$arrdate[3].":".$arrdate[4];
        } else {
            return null;
        }
    }
    private function inverseDat($date){
        if($date != null){
            $arrdate = explode("-", $date);
            return $arrdate[2]."-".$arrdate[1]."-".$arrdate[0];        
        } else {
            return null;
        }
    }
    protected function getRoles() {
        return ["Administrador","Supervisor","Piloto"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}