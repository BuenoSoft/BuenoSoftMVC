<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Model\MarcaModel;
use \Model\ModeloModel;
use \Clases\Modelo;
class ModelosController extends Controller
{
    private $mod_mar;
    private $mod_mod;
    function __construct() {
        parent::__construct();
        $this->mod_mar = new MarcaModel();
        $this->mod_mod = new ModeloModel();
    }
    public function index(){
        if($this->checkUser()){
            Session::set('mar', '');
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $modelos =(Session::get('b')!="") ? $this->getPaginator()->paginar($this->mod_mod->buscador(Session::get('b')), Session::get('p')) : array();
            $this->redirect(array("index.php"),array(
                "modelos" => $modelos,
                "paginador" => $this->getPaginator()->getPages()
            ));         
        }
    }
    public function add(){
        if($this->checkUser()){ 
            Session::set('mar', isset($_POST['txtmar']) ? $_POST['txtmar'] : Session::get('mar'));
            $marcas = (Session::get('mar')!="") ? $this->mod_mod->obtenerXDataList(Session::get('mar')) : array();
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) {
                    $marca = $this->mod_mar->obtenerPorId($_POST['txtmar']);
                    $modelo = new Modelo(0,$_POST['txtnom'] , $marca);
                    $id = $this->mod_mod->guardame($modelo);
                    Session::set("msg",(isset($id)) ? "Modelo Creado" : Session::get('msg')); 
                    header("Location:index.php?c=modelos&a=index");
                    exit();
                }
            }
            $this->redirect(array('add.php'),array(
                'marcas' => $marcas
            ));
        }
    }
    public function edit(){
        if($this->checkUser()){           
            Session::set("id",$_GET['p']);
            Session::set('mar', isset($_POST['txtmar']) ? $_POST['txtmar'] : Session::get('mar'));
            $marcas = (Session::get('mar')!="") ? $this->mod_mod->obtenerXDataList(Session::get('mar')) : array();
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){                                         
                if($this->checkDates()) { 
                    $marca = $this->mod_mar->obtenerPorId($_POST['txtmar']);
                    $modelo = new Modelo($_POST['hid'],$_POST['txtnom'] , $marca);
                    $id = $this->mod_mod->modificame($modelo);
                    Session::set("msg",(isset($id)) ? "Modelo Editado" : Session::get('msg'));
                    header("Location:index.php?c=modelos&a=index");
                    exit();
                }
            }
            $this->redirect(array('edit.php'),array(
                "modelo" => $this->mod_mod->obtenerPorId(Session::get('id')),
                'marcas' => $marcas
            ));
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $modelo= $this->mod_mod->obtenerPorId($_GET['p']);
                $id = $this->mod_mod->eliminame($modelo);
                Session::set("msg", (isset($id)) ? "Modelo Borrado" : "No se pudo borrar el modelo");
                header("Location:index.php?c=modelos&a=index"); 
            }                           
        }
    }
    private function checkDates(){
        if(empty($_POST['txtnom']) || empty($_POST['txtmar'])){
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