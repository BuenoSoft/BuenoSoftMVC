<?php
namespace Controller;
use \App\Session;
use \Clases\Aplicacion;
class HistorialController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set("v",$_GET['v']);
            $apl = (new Aplicacion())->findById(Session::get("id"));
            $usado =$apl->getUsado(Session::get("v"));
            $this->redirect_administrador(["index.php"], [
                "usado" => $usado
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set("v",$_GET['v']);
            $apl = (new Aplicacion())->findById(Session::get("id"));
            $usado =$apl->getUsado(Session::get("v"));
            $this->redirect_administrador(["add.php"], [
                "usado" => $usado
            ]);
        }
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}