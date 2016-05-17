<?php
namespace Controller;
use \App\Session;
class AplicacionesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            $this->redirect_administrador(['index.php']);
        }
    }
    public function add(){
        if($this->checkUser()){
            $this->redirect_administrador(['add.php']);
        }
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}
