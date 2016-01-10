<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Model\TipovehModel;
use \Clases\TipoVehiculo;
class TiposvehController extends Controller
{
    private $modelo;
    function __construct() {
        parent::__construct();
        $this->modelo= new TipovehModel();
    }
    public function index(){
        if($this->checkUser()){
            $this->redirect(array("index.php"), array(
                "tiposveh" => $this->modelo->obtenerTodos()
            )); 
        } 
    }
    public function add(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) {  
                    $tv = new TipoVehiculo(0, $_POST['txtnom']);
                    $id = $this->modelo->guardame($tv);
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
                    $id = $this->modelo->modificame($tv);
                    Session::set("msg",(isset($id)) ? "Tipo de Vehículos Editado" : Session::get('msg'));
                    header("Location:index.php?c=tiposveh&a=index");
                    exit();
                }
            }
            $this->redirect(array('edit.php'),array(
                "tv" => $this->modelo->obtenerPorId(Session::get('id'))
            ));
        }        
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $tv = $this->modelo->obtenerPorId($_GET['p']); 
                $id = $this->modelo->eliminame($tv);
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
        if(Session::get("log_in")!= null and Session::get("log_in")->getRol()->getNombre() == "admin"){
            return true;
        }
        else {
            Session::set("msg","Debe ser administrador para acceder.");
            $this->redirect(array('Main','index.php'));
        }
    }
}