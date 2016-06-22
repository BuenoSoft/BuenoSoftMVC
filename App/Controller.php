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
    public function redirect_administrador($file = array(), $dates = array()) {
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
    /*----------para el tema de los enlaces----------*/
    
    function breadcrumbs($separator = ' &rsaquo; ', $home = 'Inicio') {        
        $actual = $this->createPath($_SERVER['REQUEST_URI']);
        $c= explode("&", $actual[1])[0];
        $a = $actual[2];
        $base = $this->createPath("localhost/BuenoSoftMVC/index.php?c=access&a=index");
        $c1= explode("&", $base[1])[0];
        $a1 =$base[2];
        $breadcrumbs = [];
        array_push($breadcrumbs, "<a href=index.php?c=$c1&a=$a1>".$home."</a>");
        // Find out the index for the last value in our path array
        $last = end(array_keys($actual));
        // Build the rest of the breadcrumbs
        foreach ($actual AS $x => $crumb) {
            // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
            $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));
            // If we are not on the last index, then display an <a> tag
            if ($x != $last) {
                if($c == $c1 and $a == $a1){
                    
                } else {
                    $href="?c=".$c."&a=".$a;
                    array_push($breadcrumbs, "<a href=".$href.">".$c."</a>");                
                }
                // Otherwise, just display the title (minus)
            } else {
                array_push($breadcrumbs, $title);
            }            
        }            
        // Build our temporary array (pieces of bread) into one big string :)
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
    protected function checkEnlace(){
        $this->enlaces[$this->generateTitle()] = $_SERVER['REQUEST_URI'];        
    }
    protected function getEnlaces(){
        return $this->enlaces;
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