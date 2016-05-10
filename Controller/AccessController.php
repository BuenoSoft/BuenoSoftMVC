<?php
namespace Controller;
class AccessController extends AppController
{
    public function __construct() {
        parent::__construct();
    }    
    public function index(){
        if($this->checkUser()){
            Session::set('b',"");
            $this->redirect_administrador(['index.php']);
        }
    }        
    protected function getRoles() {
        return ["Administrador","Supervisor","Usuario"];
    }
    protected function getMessageRole() {
        return "usuario en general";
    }
}