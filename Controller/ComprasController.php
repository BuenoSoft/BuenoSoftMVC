<?php
namespace Controller;
use App\Controller;
use App\Session;
use Model\TipocomModel;
use Model\VehiculoModel;
use Model\UsuarioModel;
use Model\CompraModel;
use Clases\Compra;
class ComprasController extends Controller
{
    private $mod_tc;
    private $mod_u;
    private $mod_c;
    private $mod_v;
    function __construct() {
        parent::__construct();
        $this->mod_tc= new TipocomModel();
        $this->mod_v= new VehiculoModel();
        $this->mod_u = new UsuarioModel();
        $this->mod_c= new CompraModel();
    }
    public function index(){
        if($this->checkUser()){
            Session::set('tic', '');
            Session::set('cli', '');
            Session::set('veh', '');
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $compras =(Session::get('b')!="") ? $this->getPaginator()->paginar($this->mod_c->buscador(Session::get('b')), Session::get('p')) : array();
            $this->redirect(array('index.php'),array(
                "compras" => $compras,
                "paginador" => $this->getPaginator()->getPages()
            ));
        }
    }
    public function add(){
        if($this->checkUser()){            
            Session::set('tic', isset($_POST['txttipcom']) ? $_POST['txttipcom'] : Session::get('tic'));
            Session::set('cli', isset($_POST['txtcli']) ? $_POST['txtcli'] : Session::get('cli'));
            Session::set('veh', isset($_POST['txtveh']) ? $_POST['txtveh'] : Session::get('veh'));
            $clientes = (Session::get('cli')!="") ? $this->mod_c->obtenerListXCliente(Session::get('cli')) : array();
            $vehiculos = (Session::get('veh')!="") ? $this->mod_c->obtenerListXVeh(Session::get('veh')) : array();
            if(isset($_POST['btnaceptar'])){
                if($this->checkDates()) {
                    $tipo =  $this->mod_tc->obtenerPorId($_POST['txttipcom']);
                    $user = $this->mod_u->obtenerPorId($_POST['txtcli']);
                    $veh = $this->mod_v->obtenerPorId($_POST['txtveh']); 
                    $com = new Compra(0, $_POST['dtfecha'], $_POST['txtcuotas'], $_POST['txtcant'], $tipo, $user, $veh);
                    $this->mod_c->guardame($com);
                    $veh->quitarStock($com->getCant());
                    $this->mod_v->modificame($veh);
                    Session::set("msg","Compra Creada");
                    header("Location:index.php?c=compras&a=index");
                    exit();
                }
            }
            $this->redirect(array('add.php'),array(
                'clientes' => $clientes,
                'vehiculos' => $vehiculos,
                'tiposcom' => $this->mod_tc->obtenerTodos()
            ));
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            $compra=$this->mod_c->obtenerXId(Session::get('id'));
            Session::set('tic', isset($_POST['txttipcom']) ? $_POST['txttipcom'] : $compra->getTipo()->getId());
            Session::set('cli', isset($_POST['txtcli']) ? $_POST['txtcli'] : $compra->getUser()->getId());
            Session::set('veh', isset($_POST['txtveh']) ? $_POST['txtveh'] : $compra->getVeh()->getId());
            $clientes = (Session::get('cli')!="") ? $this->mod_c->obtenerListXCliente(Session::get('cli')) : array();
            $vehiculos = (Session::get('veh')!="") ? $this->mod_c->obtenerListXVeh(Session::get('veh')) : array();
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){
                 if($this->checkDates()) {
                    $tipo =  $this->mod_tc->obtenerPorId($_POST['txttipcom']);
                    $user = $this->mod_u->obtenerPorId($_POST['txtcli']);
                    $veh = $this->mod_v->obtenerXId($_POST['txtveh']); 
                    $com = new Compra($_POST['hid'], $_POST['dtfecha'], $_POST['txtcuotas'], $_POST['txtcant'], $tipo, $user, $veh);
                    $this->mod_c->modificame($com);
                    $veh->quitarStock($com->getCant());
                    $this->mod_v->modificame($veh);
                    Session::set("msg","Compra Editada");
                    header("Location:index.php?c=compras&a=index");
                    exit();
                 }
            }
            $this->redirect(array('edit.php'),array(
                'clientes' => $clientes,
                'vehiculos' => $vehiculos,
                'tiposcom' => $this->mod_tc->obtenerTodos(),
                'compra' =>  $compra
            ));
        }
    }
    public function view(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            $this->redirect(array('view.php'),array(
                'compra' => $this->mod_c->obtenerXId(Session::get('id'))
            ));
        }        
    }
    private function checkDates(){
        if(empty($_POST['txttipcom']) or empty($_POST['txtcli']) or empty($_POST['txtveh']) or empty($_POST['dtfecha']) or empty($_POST['txtcant'])){
            Session::set("msg","Ingrese los datos obligatorios (*) para continuar.");
            return false;
        }
        else if(!ctype_digit($_POST['txtcuotas']) or !ctype_digit($_POST['txtcant'])){
            Session::set("msg","Asegurese de que la cantidad y/o las cuotas sean nros enteros");
            return false;
        }
        else if($this->mod_v->obtenerPorId($_POST['txtveh'])->getCant() < $_POST['txtcant']){
            Session::set("msg","El vehículo no cuenta con la cantidad ingresada");
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