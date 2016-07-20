<?php
namespace Controller;
use \App\Session;
use \Clases\TipoVehiculo;
class TipovController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){           
            $this->redirect_administrador(["index.php"],[
                "tipos" => (new TipoVehiculo())->find()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                $tv = $this->createEntity();
                if($tv->getMedida() != null){
                    $id = $tv->save();
                    if(isset($id)){
                        Session::set("msg",Session::msgSuccess("Tipo de Vehículo Creado"));
                        header("Location:index.php?c=tipov&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                
                } else {
                    Session::set("msg",Session::msgDanger("No se ha seleccionado la unidad de medida"));
                }
            }
            $this->redirect_administrador(["add.php"]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("tv",$_GET['d']);
            if (Session::get('tv')!=null && isset($_POST['btnaceptar'])){
                $tv = $this->createEntity();
                if($tv->getMedida() != null){
                    $id = $tv->save();
                    if(isset($id)){
                        Session::set("msg",Session::msgSuccess("Tipo de Vehículo Editado"));
                        header("Location:index.php?c=tipov&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }
                } else {
                    Session::set("msg",Session::msgDanger("No se ha seleccionado la unidad de medida"));
                }
            }
            $this->redirect_administrador(["edit.php"],[
                "tipo" => (new TipoVehiculo())->findById(Session::get('tv'))
            ]);
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $tp = (new TipoVehiculo())->findById($_GET['d']);
                $id = $tp->del();                
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Tipo de Vehículo Borrado") : Session::msgDanger("No se pudo borrar el tipo"));
                header("Location:index.php?c=tipov&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $tp = (new TipoVehiculo())->findById($_GET['d']);
                $id = $tp->del();
                Session::set("msg", (isset($id)) ? Session::msgSuccess("Tipo de Vehículo Activado") : Session::msgDanger("No se pudo activar el tipo"));
                header("Location:index.php?c=tipov&a=index");
            }        
        }
    }
    private function createEntity(){
        $tv = new TipoVehiculo();
        $tv->setId(isset($_POST["hid"]) ? $_POST["hid"] : 0);
        $tv->setNombre($this->clean($_POST["txtnombre"]));
        $tv->setMedida((isset($_POST["medida"][0]) ? $_POST["medida"][0] : null));
        return $tv;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}