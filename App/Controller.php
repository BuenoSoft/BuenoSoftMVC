<?php
namespace App;
use Lib\Paginador;
abstract class Controller 
{
    private $paginador;
    function __construct() {
        session_start();  
        $this->paginador = new Paginador();
    }
    public function redirect($route=array(),$dates = array()) {
        try {
            $folder= (count($route)>1) ? $route[0] : $this->deleteWordController();
            $file= (count($route)>1) ? $route[1] : $route[0]; 
            $path = $this->createFile(APPLICATION_PATH . DS . "View" . DS . $folder. DS . $file,$dates);
            echo $this->createFile(APPLICATION_PATH . DS . 'Public'. DS .'layout.php', array('content' => $path));             
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
        }       
    }
    private function createFile($file,$dates=array()) {
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
    private function deleteWordController(){
        return preg_replace("/[^a-zA-Z0-9]+/", "", str_replace("Controller", "", get_class($this)));
    }
    protected function getPaginator(){
        return $this->paginador;
    }
}