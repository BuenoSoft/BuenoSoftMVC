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
use \Clases\Tiene;
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
            if (isset($_POST['btnaceptar'])) {
                $apl = $this->createEntity();
                if($apl->getAeronave() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Aeronave"));
                } else if($apl->getCliente() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Usuario"));
                } else if($apl->getTipo() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Tipo de Producto"));
                } else if($apl->getChofer() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Chofer"));
                } else if($apl->getTerrestre() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Terrestre"));
                } else if($apl->getPiloto() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Piloto"));                                    
                } else if($apl->getPista() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado la Pista"));
                } else if(($apl->getFechaIni() != null and $apl->getFechaFin() != null) and ($apl->getFechaIni() > $apl->getFechaFin())){
                    Session::set("msg",Session::msgDanger("Asegurese de que la fecha de inicio sea menor a la fecha final"));
                } else if(($apl->getTaquiIni() != null and $apl->getTaquiFin() != null) and ($apl->getTaquiIni() > $apl->getTaquiFin())){
                    Session::set("msg",Session::msgDanger("Asegurese de que el taquimetro inicial sea menor al final"));                    
                } else if($apl->getFechaIni() == null and ($apl->getTaquiIni() != null or $apl->getTaquiFin() != null)){
                    Session::set("msg",Session::msgDanger("Asegurese que para los taquímetros tener las fecha inicial ingresada"));
                } else {
                    $cont = $this->checkProductos($apl);
                    $apl->save();
                    $this->addProductos();
                    $this->increaseTaqui($apl);
                    if($cont == 0){
                        Session::set("msg",Session::msgSuccess("Aplicación Creada"));
                    } else {
                        if($cont == 1){
                            Session::set("msg",Session::msgInfo("La aplicación fue creada con un producto no acorde al tipo ".$apl->getTipo()->getNombre()));                        
                        } else {
                            Session::set("msg",Session::msgInfo("La aplicación fue creada con productos no acordes al tipo ".$apl->getTipo()->getNombre()));
                        }
                    }                    
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
                "productos" => (new Producto())->find()                 
            ]);
        }
    }
    private function addProductos(){
        $datos = [];
        $cant = count($_POST["producto"]);
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        for($int =0; $int < $cant; $int++){
            array_push($datos, $_POST["producto"][$int]."/".$_POST["dosis"][$int]);
        }
        echo "<br />";
        foreach($datos as $dat){
            $ele = explode("/",$dat);
            $producto = (new Producto())->findByX($ele[0]);
            $tiene = new Tiene();
            $tiene->setApl($apl);
            $tiene->setProducto($producto);
            $tiene->setDosis($ele[1]);
            $apl->addTiene($tiene);
        }
        
    }
    private function checkProductos($apl){
        $cont = 0;
        foreach ($_POST["producto"] as $pro){
            $producto = (new Producto())->findByX($pro);
            if($producto->getTipo() != $apl->getTipo()){
                $cont++;
            }
        }
        return $cont;
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
            if (Session::get('app')!=null && isset($_POST['btnaceptar'])){
                $apl = $this->createEntity();
                if($apl->getAeronave() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Aeronave"));
                } else if($apl->getCliente() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Usuario"));
                } else if($apl->getTipo() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Tipo de Producto"));
                } else if($apl->getChofer() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Chofer"));
                } else if($apl->getTerrestre() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Terrestre"));
                } else if($apl->getPiloto() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Piloto"));                                    
                } else if($apl->getPista() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado la Pista"));
                } else if(($apl->getFechaIni() != null and $apl->getFechaFin() != null) and ($apl->getFechaIni() > $apl->getFechaFin())){
                    Session::set("msg",Session::msgDanger("Asegurese de que la fecha de inicio sea menor a la fecha final"));
                } else if(($apl->getTaquiIni() != null and $apl->getTaquiFin() != null) and ($apl->getTaquiIni() > $apl->getTaquiFin())){
                    Session::set("msg",Session::msgDanger("Asegurese de que el taquimetro inicial sea menor al final"));                    
                } else if($apl->getFechaIni() == null and ($apl->getTaquiIni() != 0 or $apl->getTaquiFin() != 0)){
                    Session::set("msg",Session::msgDanger("Asegurese que para los taquímetros tener las fecha inicial ingresada"));
                } else {
                    $cont = $this->checkProductos($apl);
                    $apl->save();
                    $this->modProductos($apl);
                    $this->increaseTaqui($apl);
                    if($cont == 0){
                        Session::set("msg",Session::msgSuccess("Aplicación Editada"));
                    } else {
                        if($cont == 1){
                            Session::set("msg",Session::msgInfo("La aplicación fue editada con un producto no acorde al tipo ".$apl->getTipo()->getNombre()));                        
                        } else {
                            Session::set("msg",Session::msgInfo("La aplicación fue editada con productos no acordes al tipo ".$apl->getTipo()->getNombre()));
                        }
                    } 
                    header("Location:index.php?c=aplicaciones&a=index");
                    exit();                
                }
            } 
            $this->redirect_administrador(['edit.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("app")),
                "usuarios" => (new Usuario())->find(),
                "vehiculos" => (new Vehiculo())->find(),
                "pistas" => (new Pista())->find(),
                "tipos" => (new TipoProducto())->find(),
                "productos" => (new Producto())->find()  
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
    private function createEntity() {        
        $aplicacion = new Aplicacion();
        $aplicacion->setId(isset($_POST['hid']) ? $_POST['hid'] : 0);
        $aplicacion->setCoordCul($this->getCoords($_POST['txtsur'],$_POST['txtoeste']));
        $aplicacion->setPista((new Pista())->findByX((isset($_POST["pista"][0])) ? $_POST["pista"][0] : 0));
        $aplicacion->setAreaapl($this->clean($_POST['txtarea_apl']));
        $aplicacion->setFaja($this->clean($_POST['txtfaja']));
        $aplicacion->setFechaIni($this->inverseDate($_POST['dtfechaini']));
        $aplicacion->setFechaFin($this->inverseDate($_POST['dtfechafin']));
        $aplicacion->setTratamiento($this->clean($_POST['txttrat']));
        $aplicacion->setViento($this->clean($_POST['txtviento']));
        $aplicacion->setTipo((new TipoProducto())->findByX(isset($_POST["tipo"][0]) ? $_POST["tipo"][0] : 0));
        $aplicacion->setTaquiIni($_POST['txttaquiIni']);
        $aplicacion->setTaquiFin($_POST['txttaquiFin']);
        $aplicacion->setPadron($this->clean($_POST['txtpadron']));
        $aplicacion->setCultivo($this->clean($_POST['txtcultivo']));
        $aplicacion->setCaudal($this->clean($_POST['txtcaudal']));
        $aplicacion->setCliente((new Usuario())->findByNombre(isset($_POST['cliente'][0]) ?  $_POST['cliente'][0] : 0));
        $aplicacion->setPiloto((new Usuario())->findByNombre(isset($_POST['piloto'][0]) ? $_POST['piloto'][0] : 0));
        $aplicacion->setChofer((new Usuario())->findByNombre(isset($_POST['chofer'][0]) ? $_POST['chofer'][0] :  0));
        $aplicacion->setAeronave((new Vehiculo())->findByMat(isset($_POST['aeronave'][0]) ? $_POST['aeronave'][0] : 0));
        $aplicacion->setTerrestre((new Vehiculo())->findByMat(isset($_POST['terrestre'][0]) ? $_POST['terrestre'][0] : 0));
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