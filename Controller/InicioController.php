<?php
namespace Controller;
use \App\Breadcrumbs;
use \App\Session;
class InicioController extends AppController
{
    public function __construct() {
        parent::__construct();
    }    
    public function index(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(['index.php']);
        }
    }        
    protected function getRoles() {
        return ["Administrador","Supervisor","Cliente","Piloto"];
    }
    protected function getMessageRole() {
        return "cualquier usuario menos uno tipo cliente";
    }
}