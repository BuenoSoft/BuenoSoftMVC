<?php
namespace App;
use \Lib\Paginador;
include('./Lib/fpdf/FPDF.php');
abstract class Controller 
{
    private $enlaces;
    private $paginador;
    private $pdf;
    function __construct() {
        session_start();
        $this->enlaces = [];
        $this->paginador = new Paginador();
        $this->pdf = new \FPDF();
    }
    public function redirect_administrador($file = array(), $dates = array()) {
        try {
            $ns = explode('\\', get_called_class());
            $path = $this->createFile(APPLICATION_PATH . DS . "View" . DS . str_replace("Controller", "", $ns[1]) . DS . $file[0], $dates);
            $menu = $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'manejo_menu.php');
            echo $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'manejo.php', array('content' => $path, 'menu' => $menu, 'enlaces' => $this->getEnlaces()));
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    public function redirect_todos($file = array(), $dates = array()) {        
        try {
            $ns = explode('\\', get_called_class());
            $path = $this->createFile(APPLICATION_PATH . DS . "View" . DS . str_replace("Controller", "", $ns[1]) . DS . $file[0], $dates);
            echo $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'principal.php', array('content' => $path));
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    private function createFile($file, $dates = array()) {
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
            Session::set("msg", "Debe loguearse como " . $this->getMessageRole() . " para acceder.");
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
    protected function getEnlaces(){
        $this->enlaces[$this->generateTitle()] = $_SERVER['REQUEST_URI'];
        return $this->enlaces;
    }
    private function generateTitleAction(){
        $entidad = str_replace("localhost/BuenoSoftMVC/index.php?c=", "", $_SERVER['REQUEST_URI']);
        $d = explode("&", $entidad);
        $d1 = str_replace("a=", "", $d[1]);
        return $d1;
    }
    private function generateTitleEntity(){
        $entidad = str_replace("localhost/BuenoSoftMVC/index.php?c=", "", $_SERVER['REQUEST_URI']);
        $d = explode("&", $entidad);
        $d1 = explode("?", $d[0]);
        $d2 = explode("=", $d1[1]);
        return $d2[1];
    }
    private function generateTitle(){
        $array = [$this->generateTitleAction(), $this->generateTitleEntity()];
        if($array[0] == "index"){
            return $array[1];
        } else {
            return $array[0]." ".$array[1];
        }
        
    }
    protected function getMessageRole() { }
    protected function getRoles(){}
}