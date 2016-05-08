<?php
namespace Controller;
use \App\Session;
class AccessController extends AppController
{
    public function __construct() {
        parent::__construct();
    }    
    public function index(){
        //if($this->checkUser()){
            $this->redirect_administrador(['index.php']);
        //}
    }        
    protected function getMessageRole() {
        return "un usuario registrado";
    }
    protected function getTypeRole() {
        return "Administrador";
    }
}