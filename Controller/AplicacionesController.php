<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Lib\Upload;
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
        $this->upload = new Upload("aplicaciones");
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
            Session::set("msg", Session::msgDanger("Debe loguearse usuario no chofer para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function add(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            if (isset($_POST['btnaceptar'])) {
                $apl = $this->createEntity();
                if($apl->getAeronave() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Aeronave"));
                } else if($apl->getCliente() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Usuario"));
                } else if($apl->getTipo() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Tipo de Producto"));
                } else if($apl->getChofer() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Chofer"));
                } else if($apl->getTerrestre() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Terrestre"));
                } else if($apl->getPiloto() == null and Session::get("log_in")->getRol()->getNombre() != "Piloto" and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el Piloto"));                                    
                } else if($apl->getPista() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado la Pista"));
                } else if(($apl->getFechaIni() != null and $apl->getFechaFin() != null) and ($apl->getFechaIni() > $apl->getFechaFin())){
                    Session::set("msg",Session::msgDanger("Asegurese de que la fecha de inicio sea menor a la fecha final"));
                } else if(($apl->getTaquiIni() != null and $apl->getTaquiFin() != null) and ($apl->getTaquiIni() > $apl->getTaquiFin())){
                    Session::set("msg",Session::msgDanger("Asegurese de que el taquimetro inicial sea menor al final"));                    
                } else if($apl->getFechaIni() == null and ($apl->getTaquiIni() != null or $apl->getTaquiFin() != null)){
                    Session::set("msg",Session::msgDanger("Asegurese que para los taquímetros tener las fecha inicial ingresada"));
                } else {                    
                    $apl->save();
                    if(Session::get("log_in")->getRol()->getNombre() != "Cliente"){
                        $cont = $this->checkProductos($apl);
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
                    } else {
                        Session::set("msg",Session::msgSuccess("Aplicación Solicitada"));
                        $this->messageClient();
                    }                    
                    header("Location:index.php?c=aplicaciones&a=index");
                    exit(); 
                }             
            }
            $this->redirect_administrador(['add.php'],[
                "usuarios" => (new Usuario())->find(),
                "vehiculos" => (new Vehiculo())->find(),
                "pistas" => (new Pista())->find(),
                "tipos" => (new TipoProducto())->find(),
                "productos" => (new Producto())->find()                 
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse usuario no chofer para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function addProductos(){
        $datos = [];
        $tienes = [];
        $cant = count($_POST["producto"]);
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        for($int =0; $int < $cant; $int++){
            array_push($datos, $_POST["producto"][$int]."/".$_POST["dosis"][$int]);
        }
        foreach($datos as $dat){
            $ele = explode("/",$dat);
            $producto = (new Producto())->findByX($ele[0]);
            $tiene = new Tiene();
            $tiene->setApl($apl);
            $tiene->setProducto($producto);
            $tiene->setDosis($ele[1]);
            array_push($tienes, $tiene);
        }
        foreach ($tienes as $tiene){
            if(!$apl->checkTiene($tiene)){
                $apl->addTiene($tiene);
            }
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
    private function messageClient(){
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        $not = new Notificacion();
        $not->setId(0);
        $not->setMensaje("El cliente ".$apl->getCliente()->getNomReal()." solicitó una aplicación");
        $not->setFecha(date("Y-m-d\TH:i:s"));
        $not->setEstado("N");
        $not->setUsuario(null);
        $not->setVehiculo(null);
        $not->save();
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
                } else if($apl->getPiloto() == null and Session::get("log_in")->getRol()->getNombre() != "Piloto"){
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
        $apl->delTiene();
        $datos = [];
        $tienes = [];
        $cant = count($_POST["producto"]);
        for($int =0; $int < $cant; $int++){
            array_push($datos, $_POST["producto"][$int]."/".$_POST["dosis"][$int]);
        }
        foreach($datos as $dat){
            $ele = explode("/",$dat);
            $producto = (new Producto())->findByX($ele[0]);
            $tiene = new Tiene();
            $tiene->setApl($apl);
            $tiene->setProducto($producto);
            $tiene->setDosis($ele[1]);
            array_push($tienes, $tiene);
        }
        foreach ($tienes as $tiene){
            if(!$apl->checkTiene($tiene)){
                $apl->addTiene($tiene);
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
    public function avatar(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=usuarios&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            if (isset($_POST['btnaceptar'])) {
                if(isset($_FILES['avatar'])){
                    $ruta = $this->upload->uploadImage($_FILES['avatar']);
                    if($ruta!= null){
                        $aplicacion = (new Aplicacion())->findById(Session::get('app'));
                        $aplicacion->setAvatar($ruta);
                        $aplicacion->avatar();
                        header("Location:index.php?c=aplicaciones&a=avatar");
                        exit();                    
                    }
                }                                             
            }
            $this->redirect_administrador(['avatar.php'],[
                'aplicacion' => (new Aplicacion())->findById(Session::get('app'))
            ]);
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
        $aplicacion->setFaja(isset($_POST["txtfaja"]) ? $this->clean($_POST['txtfaja']) : null);
        $aplicacion->setFechaIni(isset($_POST['dtfechaini']) ? $this->inverseDate($_POST['dtfechaini']) : null);
        $aplicacion->setFechaFin(isset($_POST['dtfechafin']) ? $this->inverseDate($_POST['dtfechafin']) : null);
        $aplicacion->setTratamiento($this->clean($_POST['txttrat']));
        $aplicacion->setViento(isset($_POST['txtviento']) ? $this->clean($_POST['txtviento']) : null);
        $aplicacion->setTipo((new TipoProducto())->findByX(isset($_POST["tipo"][0]) ? $_POST["tipo"][0] : 0));
        $aplicacion->setTaquiIni(isset($_POST['txttaquiIni']) ? $_POST['txttaquiIni'] : null);
        $aplicacion->setTaquiFin(isset($_POST['txttaquiFin']) ? $_POST['txttaquiFin'] : null);
        $aplicacion->setPadron(isset($_POST['txtpadron']) ? $this->clean($_POST['txtpadron']) : null);
        $aplicacion->setCultivo($this->clean($_POST['txtcultivo']));
        $aplicacion->setCaudal(isset($_POST['txtcaudal']) ? $this->clean($_POST['txtcaudal']) : null);
        $aplicacion->setAvatar(!isset($_FILES['avatar']) ? null : ((isset($_FILES['avatar']) ? $this->upload->uploadImage($_FILES['avatar']) : (new Aplicacion())->findById($aplicacion->getId())->getAvatar())));
        $aplicacion->setCliente((new Usuario())->findByNombre((Session::get("log_in")->getRol()->getNombre() == "Cliente") ? Session::get("log_in")->getNomReal() : (isset($_POST['cliente'][0]) ?  $_POST['cliente'][0] : 0)));
        $aplicacion->setPiloto((new Usuario())->findByNombre((Session::get("log_in")->getRol()->getNombre() == "Piloto") ? Session::get("log_in")->getNomReal() : (isset($_POST['piloto'][0]) ? $_POST['piloto'][0] : 0)));
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
            $p2 = $arr[2] /3600;
            $p3 = $arr[0] + $p1 + $p2;
            return -1 * ($p3);
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