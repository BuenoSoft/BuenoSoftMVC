<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Lib\Upload;
use \Clases\TipoVehiculo;
use \Clases\Modelo;
use \Clases\Vehiculo;
class VehiculosController extends Controller
{
    private $upload;
    function __construct() {
        parent::__construct();
        $this->upload = new Upload("vehiculos");        
    }
    public function index(){
        if($this->checkUser()){
            Session::set('mod','');
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $vehiculos =(Session::get('b')!="") ? $this->getPaginator()->paginar((new Vehiculo())->find(Session::get('b')), Session::get('p')) : array();
            $this->redirect(array("index.php"),array(
                "vehiculos" => $vehiculos,
                "paginador" => $this->getPaginator()->getPages()
            ));
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set('mod', isset($_POST['txtmod']) ? $_POST['txtmod'] : Session::get('mod'));
            $modelos=(Session::get('mod')!="") ? (new Vehiculo())->findByModelos(Session::get('mod')) : array(); 
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) {
                    if(isset($_FILES['foto'])){
                        $ruta= $this->upload->uploadImage($_FILES['foto']);
                        if($ruta!= null){
                            $tipo = (new TipoVehiculo())->findById(htmlspecialchars($_POST['txt_tipo']));
                            $modelo = (new Modelo())->findById(htmlspecialchars($_POST['txtmod']));                            
                            $veh= new Vehiculo(0,$_POST['txtmat'],$_POST['txtprecio'],$_POST['txtcant'],$_POST['txtdes'],$ruta,1,$modelo,$tipo);
                            $id = $veh->save();
                            Session::set("msg",(isset($id)) ? "Vehículo Creado" : Session::get('msg'));
                            header("Location:index.php?c=vehiculos&a=index");
                            exit();
                        }
                    }
                }
            }
            $this->redirect(array('add.php'),array(
                'modelos' => $modelos,
                'tiposveh' => (new TipoVehiculo())->find()
            ));
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set('mod', isset($_POST['txtmod']) ? $_POST['txtmod'] : Session::get('mod'));
            $modelos = (Session::get('mod')!="") ? (new Vehiculo())->findByModelos(Session::get('mod')) : array();
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){
                if($this->checkDates()) {
                    $tipo = (new TipoVehiculo())->findById($_POST['txt_tipo']);
                    $modelo = (new Modelo())->findById($_POST['txtmod']);
                    $veh= new Vehiculo($_POST['hid'],$_POST['txtmat'],$_POST['txtprecio'],$_POST['txtcant'],$_POST['txtdes'],'',1,$modelo,$tipo);
                    $id = $veh->save();
                    Session::set("msg",(isset($id)) ? "Vehículo Editado" : Session::get('msg'));
                    header("Location:index.php?c=vehiculos&a=index");
                    exit();                                                     
                }
            }
            $this->redirect(array('edit.php'), array(
                'vehiculo' => (new Vehiculo())->findById(Session::get('id')),
                'modelos' => $modelos,
                'tiposveh' => (new TipoVehiculo())->find()
            ));
        }
    }
    public function foto(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                if(isset($_FILES['foto'])){
                    $ruta= $this->upload->uploadImage($_FILES['foto']);
                    if($ruta!= null){
                        $veh = (new Vehiculo())->findById(Session::get('id'));
                        $veh->setFoto($ruta);
                        $veh->saveImg();
                        header("Location:index.php?c=vehiculos&a=edit&p=".$veh->getId());
                        exit();                    
                    }
                }                                             
            }
            $this->redirect(array('foto.php'),array(
                'vehiculo' => (new Vehiculo())->findById(Session::get('id'))
            ));
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $veh = (new Vehiculo())->findById($_GET['p']);
                $id = $veh->del();
                Session::set("msg", (isset($id)) ? "Vehículo Borrado" : "No se pudo borrar el vehículo");
                header("Location:index.php?c=vehiculos&a=index");               
            }            
        }
    }
    public function reload(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $veh = (new Vehiculo())->findById($_GET['p']);
                $id = $veh->rec();
                Session::set("msg", (isset($id)) ? "Vehículo Reactivado" : "No se pudo reactivar el vehículo");
                header("Location:index.php?c=vehiculos&a=index");                
            }                     
        }
    }
    private function checkDates(){
        if(empty($_POST['txtmat']) or empty($_POST['txtcant']) or empty($_POST['txtmod']) or empty($_POST['txtprecio'])){
            Session::set("msg","Ingrese los datos obligatorios (*) para continuar.");
            return false;
        }
        else if(!ctype_digit($_POST['txtcant']) or !ctype_digit($_POST['txtprecio'])){
            Session::set("msg","Asegurese de que la cantidad y/o precio sean nros entero");
            return false;
        }
        else {
            return true;
        }
    }
    protected function getMessageRole() {
        return "administrador";
    }
    protected function getTypeRole() {
        return "ADMIN";
    }              
}