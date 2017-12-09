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
            $this->searchSession();
            $this->listSession();
            $this->redirect_administrador(['index.php'],[
                "anios" => (new Aplicacion())->getAnios(),
                "vehiculos" => (new Vehiculo())->find(),
                "usuarios" => (new Usuario())->find(),
                "tipos" => (new TipoProducto())->find(),
                "paginador" => $this->getPaginator()->getPages(),
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse usuario no chofer para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function searchSession(){
        Session::set("criterios", [
            "zafra" => (Session::get("criterios")["zafra"] != null && empty($_POST)) ? Session::get("criterios")["zafra"] : (isset($_POST["txtzafra"]) ? $_POST["txtzafra"] : null),
            "aeronave" => (Session::get("criterios")["aeronave"] != null && empty($_POST)) ? Session::get("criterios")["aeronave"] : (isset($_POST["aeronave"][0]) ? $_POST["aeronave"][0] : null),
            "piloto" =>  (Session::get("criterios")["piloto"] != null && empty($_POST)) ? Session::get("criterios")["piloto"] : ((isset($_POST["piloto"][0]) and Session::get('log_in')->getRol()->getNombre() != "Piloto") ? $_POST["piloto"][0] : ((Session::get('log_in')->getRol()->getNombre() == "Piloto") ? Session::get('log_in')->getNomReal() : null)),
            "tipo" =>  (Session::get("criterios")["tipo"] != null && empty($_POST)) ? Session::get("criterios")["tipo"] : (isset($_POST["tipo"][0]) ? $_POST["tipo"][0] : null),
            "cliente" => (Session::get("criterios")["cliente"] != null && empty($_POST)) ? Session::get("criterios")["cliente"] : ((isset($_POST["cliente"][0]) and Session::get('log_in')->getRol()->getNombre() != "Cliente") ? $_POST["cliente"][0] : ((Session::get('log_in')->getRol()->getNombre() == "Cliente") ? Session::get('log_in')->getNomReal() : null)),
            "chofer" => (Session::get("criterios")["chofer"] != null && empty($_POST)) ? Session::get("criterios")["chofer"] : ((isset($_POST["chofer"][0]) and Session::get('log_in')->getRol()->getNombre() != "Chofer") ? $_POST["cliente"][0] : ((Session::get('log_in')->getRol()->getNombre() == "Chofer") ? Session::get('log_in')->getNomReal() : null)),
            "fec1" => (Session::get("criterios")["fec1"] != null && empty($_POST)) ? Session::get("criterios")["fec1"] : (isset($_POST["fec1"]) ? $this->inverseDat($_POST["fec1"]) : null),
            "fec2" => (Session::get("criterios")["fec2"] != null && empty($_POST)) ? Session::get("criterios")["fec2"] : (isset($_POST["fec2"]) ? $this->inverseDat($_POST["fec2"]) : null)
        ]); 
        
    }
    private function listSession(){
        Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
        Session::set("filtro", $this->getPaginator()->paginar(
            (new Aplicacion())->findAdvance(Session::get("criterios")), Session::get('p'),30)
        );        
        Session::set("totales", (new Aplicacion())->totAdvance(Session::get('criterios')));
    }
    /*-------------------------------------------------------------------------------*/
    public function add(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->passDates();
            if (isset($_POST['btnaceptar'])) {
                $apl = $this->createEntity();
                if($this->checkDates($apl)){
                    if(Session::get("log_in")->getRol()->getNombre() != "Cliente"){
                        $apl->save();                    
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
                        $this->messageToClient();
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
        if(isset($_POST["producto"])){
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
    }
    private function checkProductos($apl){
        $cont = 0;
        if(isset($_POST["producto"])){
            foreach ($_POST["producto"] as $pro){
                $producto = (new Producto())->findByX($pro);
                if($producto->getTipo() != $apl->getTipo()){
                    $cont++;
                }
            }        
        }
        return $cont;
    }
    private function messageClient(){
        $not = new Notificacion();
        $not->setId(0);
        $not->setMensaje("El cliente ".Session::get("log_in")->getNomReal()." solicitó una aplicación de tipo ".Session::get("pass")[10]." de ".Session::get("pass")[4]." hectáreas para su cultivo de ".Session::get("pass")[14]);
        $not->setFecha(date("Y-m-d\TH:i:s"));
        $not->setEstado("N");
        $not->setUsuario(null);
        $not->setVehiculo(null);
        $not->save();
    }
    private function messageToClient(){
        $apl = (new Aplicacion())->findById((new Aplicacion())->maxID());
        $id = $apl->getId();
        $not = new Notificacion();
        $not->setId(0);
        $not->setMensaje("El ".Session::get("log_in")->getRol()->getNombre()." ".Session::get("log_in")->getNomReal()." creó una <a href='index.php?c=aplicaciones&a=view&d=$id'>aplicación</a> a su nombre.");
        $not->setFecha(date("Y-m-d\TH:i:s"));
        $not->setEstado("N");
        $not->setUsuario($apl->getCliente());
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
            $this->passDates();
            if (Session::get('app')!=null && isset($_POST['btnaceptar'])){
                $apl = $this->createEntity();
                if($this->checkDates($apl)){
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
        if(isset($_POST["producto"])){
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
    /*-------------------------------------------------------------------------------*/
    private function checkDates($apl){
        if($apl->getAeronave() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
            Session::set("msg",Session::msgDanger("No se ha seleccionado el Aeronave"));
            return false;
        } else if($apl->getCliente() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
            Session::set("msg",Session::msgDanger("No se ha seleccionado el Usuario"));
            return false;
        } else if($apl->getTipo() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
            Session::set("msg",Session::msgDanger("No se ha seleccionado el Tipo de Producto"));
            return false;
        } else if($apl->getChofer() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
            Session::set("msg",Session::msgDanger("No se ha seleccionado el Chofer"));
            return false;
        } else if($apl->getTerrestre() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
            Session::set("msg",Session::msgDanger("No se ha seleccionado el Terrestre"));
            return false;
        } else if($apl->getPiloto() == null and Session::get("log_in")->getRol()->getNombre() != "Piloto" and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
            Session::set("msg",Session::msgDanger("No se ha seleccionado el Piloto"));
            return false;
        } else if($apl->getPista() == null and Session::get("log_in")->getRol()->getNombre() != "Cliente"){
            Session::set("msg",Session::msgDanger("No se ha seleccionado la Pista"));
            return false;
        } else if(($apl->getFechaIni() != null and $apl->getFechaFin() != null) and ($apl->getFechaIni() > $apl->getFechaFin())){
            Session::set("msg",Session::msgDanger("Asegurese de que la fecha de inicio sea menor a la fecha final"));
            return false;
        } else if(($apl->getTaquiIni() != null and $apl->getTaquiFin() != null) and ($apl->getTaquiIni() > $apl->getTaquiFin())){
            Session::set("msg",Session::msgDanger("Asegurese de que el taquimetro inicial sea menor al final"));                    
            return false;            
        } else if($apl->getFechaIni() == null and ($apl->getTaquiIni() != null or $apl->getTaquiFin() != null)){
            Session::set("msg",Session::msgDanger("Asegurese que para los taquímetros tener las fecha inicial ingresada"));
            return false;
        } else if($apl->getFechaIni() == null and ($apl->getTaquiIni() != 0 or $apl->getTaquiFin() != 0)){
            Session::set("msg",Session::msgDanger("Asegurese que para los taquímetros tener las fecha inicial ingresada"));
            return false;        
        } else {
            return true;
        }
    }
    /*-------------------------------------------------------------------------------*/
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
    private function passDates(){
        $apl = (new Aplicacion())->findById(Session::get("app"));
        Session::set("pass",[
            (Session::get("app")!= 0) ? Session::get("app") : 0, 
            isset($_POST['txtsur']) ? $this->clean($_POST['txtsur']) : 
                ((Session::get("app")!= 0) ? $apl->getGMDLat() : null),
            isset($_POST['txtoeste']) ? $this->clean($_POST['txtoeste']) : 
                ((Session::get("app")!= 0) ? $apl->getGMDLong() : null),
            isset($_POST["pista"][0]) ? $_POST["pista"][0]: 
                ((Session::get("app")!= 0) ? (($apl->getPista() != null) ? $apl->getPista()->getNombre() : " ") : null), 
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
                ((Session::get("app")!= 0) ? (($apl->getTipo() != null) ? $apl->getTipo()->getNombre(): " ") : null),
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
            isset($_POST['cliente'][0]) ?  $_POST['cliente'][0] : 
                ((Session::get("app")!= 0) ? $apl->getCliente()->getNomReal() : null), 
            isset($_POST['piloto'][0]) ? $_POST['piloto'][0] : 
                ((Session::get("app")!= 0) ? (($apl->getPiloto() != null) ? $apl->getPiloto()->getNomReal() : " ") : null),
            isset($_POST['chofer'][0]) ? $_POST['chofer'][0] : 
                ((Session::get("app")!= 0) ? (($apl->getChofer() != null) ? $apl->getChofer()->getNomReal() : " ") : null), 
            isset($_POST['aeronave'][0]) ? $_POST['aeronave'][0] : 
                ((Session::get("app")!= 0) ? (($apl->getAeronave() != null) ? $apl->getAeronave()->getMatricula() : " ") : null),
            isset($_POST['terrestre'][0]) ? $_POST['terrestre'][0] : 
                ((Session::get("app")!= 0) ? (($apl->getTerrestre() != null) ? $apl->getTerrestre()->getMatricula(): " ") : null),
            isset($_POST['avatar']) ? $this->upload->uploadImage($_FILES['avatar']) : 
                ((Session::get("app")!= 0) ? $apl->getAvatar() : null)
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
        $aplicacion->setAvatar(Session::get("pass")[21]);
        $aplicacion->setCliente((new Usuario())->findByNombre((Session::get("log_in")->getRol()->getNombre() == "Cliente") ? Session::get("log_in")->getNomReal() : ((Session::get("pass")[16] != null) ? Session::get("pass")[16] : 0)));
        $aplicacion->setPiloto((new Usuario())->findByNombre((Session::get("log_in")->getRol()->getNombre() == "Piloto") ? Session::get("log_in")->getNomReal() : ((Session::get("pass")[17] != null) ? Session::get("pass")[17] : 0)));
        $aplicacion->setChofer((new Usuario())->findByNombre((Session::get("pass")[18] != null) ? Session::get("pass")[18] : 0));
        $aplicacion->setAeronave((new Vehiculo())->findByMat((Session::get("pass")[19] != null) ? Session::get("pass")[19] : 0));
        $aplicacion->setTerrestre((new Vehiculo())->findByMat((Session::get("pass")[20] != null) ? Session::get("pass")[20] : 0));
        return $aplicacion;
      }
    private function getCoords($sur,$oeste){
        $lat = $this->getCoord($sur);
        $lon = $this->getCoord($oeste);
        return $lat.",".$lon;
    }
    private function getCoord($date){
        if($date == null or $date == " "){
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