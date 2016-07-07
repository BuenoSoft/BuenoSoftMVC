<?php
namespace Controller;
class EstadisticasController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
     public function index(){
        if($this->checkUser()){          
            $this->redirect_administrador(["index.php"]);
        }
    }
    protected function getRoles() {
        return ["Administrador"];
    }
    protected function getMessageRole() {
        return "administrador";
    }
}