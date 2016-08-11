<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Clases\Usuario;
use \Clases\Pista;
class PistasController extends AppController
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
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $this->clean($_POST['txtbuscador']) : Session::get('b'));
            $pistas = $this->getPaginator()->paginar((new Pista())->find(Session::get('b')), Session::get('p'));
            $this->redirect_administrador(["index.php"],[
                "pistas" => $pistas,
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
                $pis = $this->createEntity();
                if($pis->getCliente() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el usuario"));
                } else {
                    if($pis->save()){
                        Session::set("msg",Session::msgSuccess("Pista Creada"));
                        header("Location:index.php?c=pistas&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                    
                }
            }
            $this->redirect_administrador(["add.php"],[
                "usuarios" => (new Usuario())->find() 
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
            Session::set("pis",$_GET['d']);
            if (Session::get('pis')!=null && isset($_POST['btnaceptar'])){
                $pis = $this->createEntity();
                if($pis->getCliente() == null){
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el usuario"));
                } else {
                    if($pis->save()){
                        Session::set("msg",Session::msgSuccess("Pista Editada"));
                        header("Location:index.php?c=pistas&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                    
                }
            }
            $this->redirect_administrador(["edit.php"],[
                'pista' => (new Pista())->findById(Session::get('pis')),
                "usuarios" => (new Usuario())->find()
            ]);
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $pis = (new Pista())->findById($_GET['d']);
                $id = $pis->del();
                if(isset($id)){
                    if((new Pista())->findById($pis->getId()) == null){
                        Session::set("msg",Session::msgSuccess("Pista Borrada"));
                    } else {
                        Session::set("msg",Session::msgDanger("Hay aplicaciones que tienen esta pista"));
                    }
                }
                header("Location:index.php?c=pistas&a=index");
            }            
        }
    }
    public function view(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(['view.php'],[
                "pista" => (new Pista())->findById($_GET['d'])
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    public function usuario(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["usuario.php"],["usuario" => (new Usuario())->findById($_GET['d'])]);
        }
    }
    private function createEntity(){
        $pista = new Pista();
        $pista->setId(isset($_POST["hid"]) ? $_POST["hid"] : 0);
        $pista->setNombre($this->clean($_POST["txtnombre"]));
        $pista->setCoordenadas($this->getCoords($_POST["txtsur"],$_POST["txtoeste"]));
        $pista->setCliente((new Usuario())->findByNombre(isset
                ($_POST['cliente'][0]) ?  $_POST['cliente'][0] : 0));
        return $pista;
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
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}