<?php
namespace Controller;
use \App\Controller;
use \Clases\Notificacion;
abstract class AppController extends Controller 
{
    function __construct() {
        parent::__construct();        
    }       
    public function redirect_administrador($file = [], $dates = []) {
        try {
            $ns = explode('\\', get_called_class());
            $path = $this->createFile(APPLICATION_PATH . DS . "View" . DS . str_replace("Controller", "", $ns[1]) . DS . $file[0], $dates);
            $menu = $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'manejo_menu.php',[
                'notificaciones' => (new Notificacion())->notify()
            ]);
            echo $this->createFile(APPLICATION_PATH . DS . 'Public' . DS . 'manejo.php', [
                'content' => $path, 
                'menu' => $menu ,
                'enlaces' => $this->breadcrumbs()
            ]);
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}