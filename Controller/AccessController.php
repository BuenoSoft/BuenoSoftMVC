<?php
namespace Controller;
use App\Session;
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
        return ["Administrador","Supervisor","Cliente","Piloto"];
    }
    protected function getMessageRole() {
        return "cualquier usuario menos uno tipo cliente";
    }
}