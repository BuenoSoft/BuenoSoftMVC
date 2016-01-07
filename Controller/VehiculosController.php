<?php
namespace Controller;
use App\Controller;
use App\Session;
use Lib\Upload;
use Model\ModeloModel;
use Model\TipovehModel;
use Model\VehiculoModel;
use Clases\Vehiculo;
class VehiculosController extends Controller
{
    private $upload;
    private $mod_m;
    private $mod_tv;
    private $mod_v;
    function __construct() {
        parent::__construct();
        $this->upload = new Upload("vehiculos");
        $this->mod_m = new ModeloModel();
        $this->mod_tv = new TipovehModel();
        $this->mod_v = new VehiculoModel();
    }
    public function index(){
        if($this->checkUser()){
            Session::set('mod','');
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $vehiculos =(Session::get('b')!="") ? $this->getPaginator()->paginar($this->mod_v->buscador(Session::get('b')), Session::get('p')) : array();
            $this->redirect(array("index.php"),array(
                "vehiculos" => $vehiculos,
                "paginador" => $this->getPaginator()->getPages()
            ));
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set('mod', isset($_POST['txtmod']) ? $_POST['txtmod'] : Session::get('mod'));
            $modelos=(Session::get('mod')!="") ? $this->mod_v->obtenerXDataList(Session::get('mod')) : array(); 
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) {
                    if(isset($_FILES['foto'])){
                        $ruta= $this->upload->uploadImage($_FILES['foto']);
                        if($ruta!= null){
                            $tipo = $this->mod_tv->obtenerPorId(htmlspecialchars($_POST['txt_tipo']));
                            $modelo = $this->mod_m->obtenerPorId(htmlspecialchars($_POST['txtmod']));                            
                            $veh= new Vehiculo(0,$_POST['txtmat'],$_POST['txtprecio'],$_POST['txtcant'],$_POST['txtdes'],$ruta,1,$modelo,$tipo);
                            $this->mod_v->guardame($veh);
                            Session::set("msg","Vehículo Creado");
                            header("Location:index.php?c=vehiculos&a=index");
                            exit();
                        }
                    }
                }
            }
            $this->redirect(array('add.php'),array(
                'modelos' => $modelos,
                'tiposveh' => $this->mod_tv->obtenerTodos()
            ));
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set('mod', isset($_POST['txtmod']) ? $_POST['txtmod'] : Session::get('mod'));
            $modelos = (Session::get('mod')!="") ? $this->mod_v->obtenerXDataList(Session::get('mod')) : array();
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){
                if($this->checkDates()) {
                    $tipo = $this->mod_tv->obtenerPorId($_POST['txt_tipo']);
                    $modelo = $this->mod_m->obtenerPorId($_POST['txtmod']);
                    $veh= new Vehiculo($_POST['hid'],$_POST['txtmat'],$_POST['txtprecio'],$_POST['txtcant'],$_POST['txtdes'],'',1,$modelo,$tipo);
                    $this->mod_v->modificame($veh);
                    Session::set("msg","Vehículo Editado");
                    header("Location:index.php?c=vehiculos&a=index");
                    exit();                                                     
                }
            }
            $this->redirect(array('edit.php'), array(
                'vehiculo' => $this->mod_v->obtenerPorId(Session::get('id')),
                'modelos' => $modelos,
                'tiposveh' => $this->mod_tv->obtenerTodos()
            ));
        }
    }
    public function foto(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                if(isset($_FILES['foto'])){
                    $ruta= $this->upload->uploadImage($_FILES['foto']);
                    if($ruta!= null){
                        $veh = $this->mod_v->obtenerPorId(Session::get('id'));
                        $veh->setFoto($ruta);
                        $this->mod_v->mod_foto($veh);
                        header("Location:index.php?c=vehiculos&a=edit&p=".$veh->getId());
                        exit();                    
                    }
                }                                             
            }
            $this->redirect(array('foto.php'),array(
                'vehiculo' => $this->mod_v->obtenerPorId(Session::get('id'))
            ));
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $veh = $this->mod_v->obtenerPorId($_GET['p']);
                $id = $this->mod_v->eliminame($veh);
                Session::set("msg", (isset($id)) ? "Vehículo Borrado" : "No se pudo borrar el vehículo");
                header("Location:index.php?c=vehiculos&a=index");               
            }            
        }
    }
    public function reload(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $veh = $this->mod_v->obtenerPorId($_GET['p']);
                $id = $this->mod_v->reactivame($veh);
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