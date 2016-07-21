<?php
namespace App;
/**
 * Breadcrumbs
 *
 * Static class for Bootstarp 3 breadcrumbs
 */
class Breadcrumbs
{
    public $separator = ' &rsaquo; ';  
    private $_breadcrumb = [];
    public function __construct(){
        $this->_breadcrumb = [];  
    }  
    public function reset(){
        $this->_breadcrumb = [];
    }  
    public function add_crumb($url){
        $this->_breadcrumb[$this->generateTitle($url)] = $url;
    }  
    public function display(){
        $links = [];
        $last = $this->endKey($this->_breadcrumb);
        foreach($this->_breadcrumb as $name => $url){
            //echo $name." ".$url."<br/>";
            if($name != $last){
                array_push($links, "<a href=".$url.">". $name."</a>");
            } else {
                array_push($links, $name);
            }
        }    
        return implode($this->separator, array_unique($links));
    }
    private function endKey($array){
        end($array);
        return key($array);
    }
    /*-------para el título del link-------*/
    private function generateTitleAction($link){
        $d = explode("=", $link);
        $d1 = explode("&", $d[2]);
        return $d1[0];
    }
    private function generateTitleEntity($link){
        $d = explode("=", $link);        
        $d1 = explode("&", $d[1]);
        return $d1[0];
    }
    private function generateTitle($link){
        $array = [$this->generateTitleAction($link), $this->generateTitleEntity($link)];
        if($array[0] == "index"){
            return $this->removeRare($array[1]);
        } else if($array[0] == "add"){
            return "Crear ".$this->removePlural($array[1]);
        } else if($array[0] == "edit"){
            return "Editar ".$this->removePlural($array[1]);
        } else if($array[0] == "view"){
            return "Ver ".$this->removePlural($array[1]);
        } else if($array[0] == "avatar"){
            return "Avatar ".$this->removePlural($array[1]);
        } else if($array[0] == "usuario"){
            return "Ver Usuario";
        } else if($array[0] == "vehiculo"){
            return "Ver Vehículo";
        } else if($array[0] == "producto"){
            return "Ver Producto";
        } else if($array[0] == "historial"){
            return "Historial de Combustible";    
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
    private function  startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
    private function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }
}