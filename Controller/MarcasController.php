<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Model\MarcaModel;
use \Clases\Marca;
class MarcasController extends Controller
{
    private $modelo;
    function __construct() {        
        parent::__construct();
        $this->modelo= new MarcaModel();
    }
    public function index(){  
        if($this->checkUser()){
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $marcas =(Session::get('b')!="") ? $this->getPaginator()->paginar($this->modelo->buscador(Session::get('b')), Session::get('p')) : array();
            $this->redirect(array("index.php"), array(
                "marcas" => $marcas,
                "paginador" => $this->getPaginator()->getPages()
            ));         
        }
    }
    public function add(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) {  
                    $marca = new Marca(0, $_POST['txtnom']);
                    $id = $this->modelo->guardame($marca);
                    Session::set("msg",(isset($id)) ? "Marca Creada" : Session::get('msg')); 
                    header("Location:index.php?c=marcas&a=index");
                    exit();
                }
            }
            $this->redirect(array('add.php'));
        }
    }
    public function edit(){
        Session::set("id",$_GET['p']);
        if($this->checkUser()){
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){                             
                if($this->checkDates()) {  
                    $marca = new Marca($_POST['hid'], $_POST['txtnom']);
                    $id = $this->modelo->modificame($marca);
                    Session::set("msg",(isset($id)) ? "Marca Editada" : Session::get('msg'));
                    header("Location:index.php?c=marcas&a=index");
                    exit();
                }
            }
            $this->redirect(array('edit.php'),array(
                "marca" => $this->modelo->obtenerPorId(Session::get('id'))
            ));
        }       
    }   
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $marca = $this->modelo->obtenerPorId($_GET['p']);
                $id = $this->modelo->eliminame($marca);
                Session::set("msg", (isset($id)) ? "Marca Borrada" : "No se pudo borrar la marca");
                header("Location:index.php?c=marcas&a=index");
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