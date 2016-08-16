<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\Usuario;
use \Clases\Combustible;
use \Clases\Vehiculo;
use \Clases\Movimiento;
class MovimientosController extends AppController
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
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $this->clean($_POST['txtbuscador']) : Session::get('b'));
            $movimientos = $this->getPaginator()->paginar((new Movimiento())->find(Session::get('b')), Session::get('p'));
            $this->redirect_administrador(["index.php"],[
                "movimientos" => $movimientos,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor o piloto para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function add(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer" and Session::get('log_in')->getRol()->getNombre() != "Cliente")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            if (isset($_POST['btnaceptar'])) {
                if(!isset($_POST['emi'][0]) and !isset($_POST['rec'][0])){
                    Session::set("msg",Session::msgDanger("Asegurese de seleccionar el stock emisor y receptor"));
                } else if(!isset($_POST['emi'][0]) and isset($_POST['rec'][0])){
                    Session::set("msg",Session::msgDanger("Asegurese de seleccionar el stock emisor"));
                } else if(isset($_POST['emi'][0]) and !isset($_POST['rec'][0])){
                    Session::set("msg",Session::msgDanger("Asegurese de seleccionar el stock receptor"));
                } else if($_POST['emi'][0] == $_POST['rec'][0] ){
                    Session::set("msg",Session::msgDanger("Asegurese de que los stocks emisor y receptor sean distintos"));
                } else {
                    $mov = $this->createEntity();
                    if($mov->save()){
                        $this->changeStock($mov);
                        Session::set("msg",Session::msgSuccess("Movimiento Realizado"));
                        header("Location:index.php?c=movimientos&a=index");
                        exit();                              
                    }                      
                }
            }
            $this->redirect_administrador(["add.php"],[
                "combustibles" => (new Combustible())->find(),   
                "vehiculos" => (new Vehiculo())->find()
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor o piloto para acceder."));
            header("Location:index.php?c=todos&a=index");
        } 
    }
    private function changeStock($mov){
        if($mov->getComEmi() != null){
            if($mov->getComRec() != null){
                $mov->getComEmi()->delStock($mov->getCantidad());
                $mov->getComRec()->addStock($mov->getCantidad());
            } else {
                $mov->getComEmi()->delStock($mov->getCantidad());
                $mov->getVehRec()->addStock($mov->getCantidad());
            }
        } else {
            if($mov->getVehEmi() != null){
                if($mov->getComRec() != null){
                    $mov->getVehEmi()->delStock($mov->getCantidad());
                    $mov->getComRec()->addStock($mov->getCantidad());
                } else {
                    $mov->getVehEmi()->delStock($mov->getCantidad());
                    $mov->getVehRec()->addStock($mov->getCantidad());
                }
            } 
        }       
    }
    /*-------------------------------------------------------------------------------*/
    public function delete(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer" and Session::get('log_in')->getRol()->getNombre() != "Cliente")){
            Session::set("mov",$_GET['d']);
            $mov = (new Movimiento())->findById(Session::get("mov"));
            $id = $mov->del();
            if(isset($id)){
                $this->rebornStock($mov);
                Session::set("msg",Session::msgSuccess("Movimiento Borrado"));
            } else {
                Session::set("msg",Session::msgDanger("Error al borrar el movimiento"));
            }
            header("Location:index.php?c=movimientos&a=index");
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor o piloto para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function rebornStock($mov){
        if($mov->getComEmi() != null){
            if($mov->getComRec() != null){
                $mov->getComEmi()->addStock($mov->getCantidad());
                $mov->getComRec()->delStock($mov->getCantidad());
            } else {
                $mov->getComEmi()->addStock($mov->getCantidad());
                $mov->getVehRec()->delStock($mov->getCantidad());
            }
        } else {
            if($mov->getVehEmi() != null){
                if($mov->getComRec() != null){
                    $mov->getVehEmi()->addStock($mov->getCantidad());
                    $mov->getComRec()->delStock($mov->getCantidad());
                } else {
                    $mov->getVehEmi()->addStock($mov->getCantidad());
                    $mov->getVehRec()->delStock($mov->getCantidad());
                }
            } 
        }
    }
    /*-------------------------------------------------------------------------------*/
    public function vehiculo(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer" and Session::get('log_in')->getRol()->getNombre() != "Cliente")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["vehiculo.php"],[
                'vehiculo' => (new Vehiculo())->findById($_GET['d']),
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor o piloto para acceder."));
            header("Location:index.php?c=todos&a=index");
        } 
    }
    public function combustible(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer" and Session::get('log_in')->getRol()->getNombre() != "Cliente")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["combustible.php"], [
                "combustible" => (new Combustible())->findById($_GET['d'])
            ]);        
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como administrador o supervisor o piloto para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    public function usuario(){
        if(Session::get("log_in") != null){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["usuario.php"],["usuario" => (new Usuario())->findById($_GET['d'])]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function createEntity(){
        $mov = new Movimiento();
        $mov->setId(0);
        $mov->setFecha($this->inverseDate($_POST["dtfecha"]));
        $mov->setCantidad($_POST["txtcant"]);
        $mov->setComEmi((new Combustible())->findByX((isset($_POST['emi'][0])) ? $_POST['emi'][0] : 0));
        $mov->setComRec((new Combustible())->findByX((isset($_POST['rec'][0])) ? $_POST['rec'][0] : 0));
        $mov->setVehEmi((new Vehiculo())->findByMat((isset($_POST['emi'][0])) ? $_POST['emi'][0] : 0));
        $mov->setVehRec((new Vehiculo())->findByMat((isset($_POST['rec'][0])) ? $_POST['rec'][0] : 0));
        $mov->setUsuario(Session::get("log_in"));
        return $mov;
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
        return ["Administrador","Supervisor","Piloto"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}