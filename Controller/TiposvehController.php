<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Clases\TipoVehiculo;
class TiposvehController extends Controller
{
    function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            $this->redirect(array("index.php"), array(
                "tiposveh" => (new TipoVehiculo())->find()
            )); 
        } 
    }
    public function add(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) {  
                    $tv = new TipoVehiculo(0, $_POST['txtnom']);
                    $id = $tv->save();
                    Session::set("msg",(isset($id)) ? "Tipo de Vehículo Creado" : Session::get('msg'));
                    header("Location:index.php?c=tiposveh&a=index");
                    exit();
                }
            }            
            $this->redirect(array('add.php'));
        }
    }   
    public function edit(){        
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){ 
                if($this->checkDates()) {         
                    $tv = new TipoVehiculo($_POST['hid'], $_POST['txtnom']);
                    $id = $tv->save();
                    Session::set("msg",(isset($id)) ? "Tipo de Vehículos Editado" : Session::get('msg'));
                    header("Location:index.php?c=tiposveh&a=index");
                    exit();
                }
            }
            $this->redirect(array('edit.php'),array(
                "tv" => (new TipoVehiculo())->findById(Session::get('id'))
            ));
        }        
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $tv = (new TipoVehiculo())->findById($_GET['p']); 
                $id = $tv->del($tv);
                Session::set("msg", (isset($id)) ? "Tipo de Vehículo Borrado" : "No se pudo borrar el tipo");
                header("Location:index.php?c=tiposveh&a=index");
            }                            
        }
    }
    private function checkDates(){
        if(empty($_POST['txtnom'])){
            Session::set("msg","Ingrese los datos obligatorios (*) para continuar.");
            return false;            
        }
        else {
            return true;
        }
    }
    private function checkUser(){
        if(Session::get("log_in")!= null and Session::get("log_in")->getRol()->getNombre() == "ADMIN"){
            return true;
        }
        else {
            Session::set("msg","Debe ser administrador para acceder.");
            $this->redirect(array('Main','index.php'));
        }
    }
}