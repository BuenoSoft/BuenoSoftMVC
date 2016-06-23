<?php
namespace App;
use \Lib\Paginador;
include('./Lib/fpdf/FPDF.php');
abstract class Controller 
{
    private $paginador;
    private $pdf;
    function __construct() {
        session_start();
        $this->paginador = new Paginador();
        $this->pdf = new \FPDF();
    }
    public function redirect_administrador($file = [], $dates = []) {
        try {
            $ns = explode('\\', get_called_class());
            $path = $this->createFile(APPLICATION_PATH . DS . "View" . DS . str_replace("Controller", "", $ns[1]) . DS . $file[0], $dates);
            $menu = $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'manejo_menu.php');
            echo $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'manejo.php', array('content' => $path, 'menu' => $menu, 'enlaces' => $this->breadcrumbs()));
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
    /*----------para el tema de los enlaces----------*/
    
    function breadcrumbs($separator = ' &rsaquo; ', $home = 'Inicio') {        
        $actual = $_SERVER['REQUEST_URI'];
        $base = "index.php?c=access&a=index";
        $breadcrumbs = [];
        array_push($breadcrumbs, "<a href=$base>".$home."</a>");
        //array_push($breadcrumbs, $actual);
        return implode($separator, array_unique($breadcrumbs)); 
    }
    
    private function createPath($path){
        return array_filter(explode('=', $path));        
    }
    private function generateTitleAction(){
        $d = explode("=", $_SERVER['REQUEST_URI']);
        $d1 = explode("&", $d[2]);
        return $d1[0];
    }
    private function generateTitleEntity(){
        $d = explode("=", $_SERVER['REQUEST_URI']);        
        $d1 = explode("&", $d[1]);
        return $d1[0];
    }
    
    private function generateTitle(){
        return [$this->generateTitleAction(), $this->generateTitleEntity()];
    }
    /*
    private function generateTitleAction(){
        $d = explode("=", $_SERVER['REQUEST_URI']);
        $d1 = explode("&", $d[2]);
        return $d1[0];
    }
    private function generateTitleEntity(){
        $d = explode("=", $_SERVER['REQUEST_URI']);        
        $d1 = explode("&", $d[1]);
        return $d1[0];
    }
    private function generateTitle(){
        $array = [$this->generateTitleAction(), $this->generateTitleEntity()];
        if($array[0] == "index"){
            return $this->removeRare($array[1]);
        } else if($array[0] == "add"){
            return "Crear ".$this->removePlural($array[1]);
        } else if($array[0] == "edit"){
            return "Editar ".$this->removePlural($array[1]);
        } else if($array[0] == "view"){
            return "Ver ".$this->removePlural($array[1]);    
        } else {
            return $array[0]." ".$array[1];
        }        
    }
    private function removePlural($palabra){
        $cambio = "";
        if($this->endsWith($palabra, "bles")){
            $cambio = rtrim($palabra, "s");
        } else if($this->endsWith($palabra, "es")){
            $cambio = rtrim($palabra, "es");
        } else if($this->endsWith($palabra, "s")){
            $cambio = rtrim($palabra, "s");
        } else if($this->endsWith($palabra, "p")){
            $cambio = rtrim($palabra, "p");
        } else if($this->endsWith($palabra, "v")){
            $cambio = rtrim($palabra, "v");
        } else {
            $cambio = $palabra;
        }
        return ucwords($cambio);
    }
    private function removeRare($palabra){
        $cambio = "";
        if($this->endsWith($palabra, "p")){
            $cambio = rtrim($palabra, "p")."s";
        } else if($this->endsWith($palabra, "v")){
            $cambio = rtrim($palabra, "v")."s";
        } else {
            $cambio = $palabra;
        } 
        return ucwords($cambio);
    }
    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
    function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }*/
    protected function getMessageRole() { }
    protected function getRoles(){}
}