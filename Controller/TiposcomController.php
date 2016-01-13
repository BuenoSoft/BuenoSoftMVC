<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Clases\TipoCompra;
class TiposcomController extends Controller
{
    function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            $this->redirect(array("index.php"),array(
                "tiposcom" => (new TipoCompra())->find()
            )); 
        }    
    }
    public function add(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) { 
                    $tc= new TipoCompra(0, $_POST['txtnom']);
                    $id = $tc->save();
                    Session::set("msg",(isset($id)) ? "Tipo de Compra Creada" : Session::get('msg'));
                    header("Location:index.php?c=tiposcom&a=index");
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
                    $tc= new TipoCompra($_POST['hid'], $_POST['txtnom']);
                    $id = $tc->save();
                    Session::set("msg",(isset($id)) ? "Tipo de Compra Editada" : Session::get('msg'));
                    header("Location:index.php?c=tiposcom&a=index"); 
                    exit();
                }
            }
            $this->redirect(array('edit.php'),array(
                "tipocom" => (new TipoCompra())->findById(Session::get('id'))
            ));
        }       
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $tc = (new TipoCompra())->findById($_GET['p']); 
                $id = $tc->del($tc);
                Session::set("msg", (isset($id)) ? "Tipo de Compra Borrada" : "No se pudo borrar el tipo");
                header("Location:index.php?c=tiposcom&a=index");
            }                           
        }
        else {
            Session::set("msg","Debe ser administrador para acceder.");
            $this->redirect(array('Main','index.php'));
        }
    }
    private function checkDates(){
        if(empty($_POST['txtnom'])){
            Session::set("msg","Ingrese los datos obligatorios (*) para continuar.");
            return false;
        }
        else{
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