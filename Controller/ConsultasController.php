<?php
namespace Controller;
use \App\Session;
use \Clases\Consulta;
class ConsultasController extends AppController
{
    function __construct() {
        parent::__construct();        
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
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}
