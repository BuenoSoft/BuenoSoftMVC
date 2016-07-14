<?php
namespace Controller;
use \App\Session;
use \Clases\Pista;
class PistasController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
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
            if (isset($_POST['btnaceptar'])) {
                $pis = $this->createEntity();
                $id = $pis->save();
                if(isset($id)){
                    Session::set("msg",Session::msgSuccess("Pista Creada"));
                    header("Location:index.php?c=pistas&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                }
            }
            $this->redirect_administrador(["add.php"]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("pis",$_GET['d']);
            if (Session::get('pis')!=null && isset($_POST['btnaceptar'])){
                $pis = $this->createEntity();
                $id = $pis->save();
                if(isset($id)){
                    Session::set("msg",Session::msgSuccess("Pista Editada"));
                    header("Location:index.php?c=pistas&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                }
            }
            $this->redirect_administrador(["edit.php"],[
                'pista' => (new Pista())->findById(Session::get('pis')),
            ]);
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $pis = (new Pista())->findById($_GET['d']);
                $id = $pis->del();                
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Pista Borrada") : Session::msgDanger("No se pudo borrar la pista"));
                header("Location:index.php?c=pistas&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $pis = (new Pista())->findById($_GET['d']);
                $id = $pis->del();
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Pista Activada") : Session::msgDanger("No se pudo activar la pista"));
                header("Location:index.php?c=pistas&a=index");
            }        
        }
    }
    public function view(){
        if(Session::get('log_in') != null and (Session::get('log_in')->getRol()->getNombre() != "Chofer")){
            $this->redirect_administrador(['view.php'],[
                "pista" => (new Pista())->findById($_GET['d'])
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    private function createEntity(){
        $pista = new Pista();
        $pista->setId(isset($_POST["hid"]) ? $_POST["hid"] : 0);
        $pista->setNombre($this->clean($_POST["txtnombre"]));
        $pista->setCoordenadas($_POST["txtcoord"]);
        return $pista;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}