<?php
namespace Controller;
use \App\Session;
use \Clases\Usuario;
use \Clases\Aplicacion;
class AplicacionesController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){            
            Session::set('myuser',"");
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            Session::set('bus',"");
            $apl =(Session::get('b')!="") ? $this->getPaginator()->paginar((new Aplicacion())->find(Session::get('b')), Session::get('p')) : array();
            $this->redirect_administrador(['index.php'],[
                "aplicaciones" => $apl,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set('myuser', isset($_POST['cliente']) ? $_POST['cliente'] : Session::get('myuser'));
            $usuarios = (Session::get('myuser')!= "") ? $this->getPaginator()->paginar((new Usuario())->find(Session::get('myuser')),1) : array();
            if (isset($_POST['btnaceptar'])) {
                $apl = $this->createEntity();
                $id = $apl->save();
                if(isset($id)){
                    Session::set("msg","Aplicación Creada");
                    header("Location:index.php?c=aplicaciones&a=index");
                    exit();
                } else {
                    Session::set("msg","error al crear aplicación");
                }
            }
            $this->redirect_administrador(['add.php'],[
                "usuarios" => $usuarios
            ]);
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            Session::set('myuser', isset($_POST['cliente']) ? $_POST['cliente'] : Session::get('myuser'));
            $usuarios = (Session::get('myuser')!= "") ? $this->getPaginator()->paginar((new Usuario())->find(Session::get('myuser')),1) : array();
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){
                $apl = $this->createEntity();
                $id = $apl->save();
                if(isset($id)){
                    Session::set("msg","Aplicación Editada");
                    header("Location:index.php?c=aplicaciones&a=index");
                    exit();
                } else {
                    Session::set("msg","error al editar aplicación");
                }
            }
            $this->redirect_administrador(['edit.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("id")),
                "usuarios" => $usuarios
            ]);
        }
    }
    public function view(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            $this->redirect_administrador(['view.php'],[
                "aplicacion" => (new Aplicacion())->findById(Session::get("id"))
            ]);
        }
    }
    public function cliente(){
        if($this->checkUser()){
            Session::set("v",$_GET['v']);
            $this->redirect_administrador(['cliente.php'],[
                "usuario" => (new Usuario())->findById(Session::get("v"))
            ]);
        }
    }
    private function createEntity() {
        $cliente = (new Usuario())->findById($_POST['cliente']);
        $aplicacion = new Aplicacion();
        $aplicacion->setId(isset($_POST['hid']) ? $_POST['hid'] : 0);
        $aplicacion->setCoordlat($_POST['txtcoordlat']);
        $aplicacion->setCoordlong($_POST['txtcoordlong']);
        $aplicacion->setAreaapl($_POST['txtarea_apl']);
        $aplicacion->setFaja($_POST['txtfaja']);
        $aplicacion->setFechaIni($_POST['dtfechaini']);
        $aplicacion->setFechaFin(isset($_POST['dtfechafin']) ? $_POST['dtfechafin'] : null);
        $aplicacion->setEstado($_POST['estados']);
        $aplicacion->setTratamiento($_POST['txttrat']);
        $aplicacion->setViento($_POST['txtviento']);
        $aplicacion->setTaquiIni($_POST['txttaquiIni']);
        $aplicacion->setTaquiFin($_POST['txttaquiFin']);
        $aplicacion->setTipo($_POST['tipos']);
        $aplicacion->setPadron($_POST['txtpadron']);
        $aplicacion->setCultivo($_POST['txtcultivo']);
        $aplicacion->setCaudal($_POST['txtcaudal']);
        $aplicacion->setImporte($_POST['txtimporte']);
        $aplicacion->setDosis($_POST['txtdosis']);
        $aplicacion->setHectareas($_POST['txthectareas']);
        $aplicacion->setCliente($cliente);
        return $aplicacion;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}