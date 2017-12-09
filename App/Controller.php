<?php
namespace App;
use \Lib\Paginador;
use \Lib\PDF;
abstract class Controller 
{
    private $paginador;
    private $pdf;
    function __construct() {
        session_start();
        $this->paginador = new Paginador();
        $this->pdf = new PDF();
    }
    public function redirect_administrador($file = [], $dates = []) {
        try {
            $ns = explode('\\', get_called_class());
            $path = $this->createFile(APPLICATION_PATH . DS . "View" . DS . str_replace("Controller", "", $ns[1]) . DS . $file[0], $dates);
            $menu = $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'manejo_menu.php');
            echo $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'manejo.php', array('content' => $path, 'menu' => $menu));
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    public function redirect_todos($file = [], $dates = []) {        
        try {
            $ns = explode('\\', get_called_class());
            $path = $this->createFile(APPLICATION_PATH . DS . "View" . DS . str_replace("Controller", "", $ns[1]) . DS . $file[0], $dates);
            echo $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'principal.php', array('content' => $path));
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    protected function createFile($file, $dates = []) {
        try {
            extract($dates);
            ob_start();
            require $file;
            return ob_get_clean();
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    protected function getPaginator() {
        return $this->paginador;
    }
    protected function getPdf() {
        return $this->pdf;
    }    
    protected function checkUser() {                
        if (Session::get("log_in") != null and Session::get("log_in")->getRol()->getNombre() == $this->getTypeRole()) {
            return true;
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }    
    protected function getTypeRole() { 
        $opciones = $this->getRoles();
        foreach($opciones as $opcion){
            if(Session::get("log_in")->getRol()->getNombre() == $opcion){
                return $opcion;
            }
        }
        return null;
    }
    protected function clean($cadena){
        return htmlentities($cadena);
    }
    protected function getMessageRole() { }
    protected function getRoles(){}
}