<?php
namespace Controller;
use \App\Session;
use \Clases\Usuario;
use \Clases\Aplicacion;
use \Clases\Consulta;
class ConsultasController extends AppController
{
    function __construct() {
        parent::__construct();        
    }
    public function index(){
        if($this->checkUser()){
            $this->redirect_administrador(["index.php"]);
        }
    }
    public function periodo(){
        if($this->checkUser()){
            $aplicaciones = array();
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            if(isset($_POST["rbtnperiodo"])){
                $aplicaciones = $this->getPaginator()->paginar((new Consulta())->periodo($_POST["rbtnperiodo"]),  Session::get("p"));
            }
            $this->redirect_administrador(["periodo.php"],[
                "aplicaciones" => $aplicaciones,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }        
    }
    public function cli(){
        if($this->checkUser()){
            Session::set("v",$_GET['v']);
            $this->redirect_administrador(['cliente.php'],[
                "usuario" => (new Usuario())->findById(Session::get("v"))
            ]);
        }
    }
    public function app(){
        if($this->checkUser()){
            Session::set("app",$_GET['ap']);
            $this->redirect_administrador(['aplicacion.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("app"))
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
