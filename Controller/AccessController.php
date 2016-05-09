<?php
namespace Controller;
use \App\Session;
class AccessController extends AppController
{
    public function __construct() {
        parent::__construct();
    }    
    public function index(){
        if($this->checkUser()){
           $this->redirect_administrador(['index.php']);
        }
    }        
    protected function getMessageRole() {
        return "usuario";
    }
    protected function getTypeRole() {
        $opciones = ["Administrador","Supervisor","Usuario"];
        foreach($opciones as $opcion){
            if(Session::get("log_in")->getTipo() == $opcion){
                return $opcion;
            }
        }
        return null;
    }
}