<?php
namespace Controller;
use \App\Session;
use \Clases\Cliente;
use \Clases\Usuario;
class UsuariosController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function login(){
        if(isset($_POST['btnaceptar'])) {
            if(empty($_POST['txtuser']) or empty($_POST['txtpass'])){ 
                Session::set("msg","Ingrese los datos obligatorios (*) para continuar.");
            } 
            else {
                $usuario = (new Usuario())->login([$_POST['txtuser'], $_POST['txtpass']]);
                if (isset($usuario)){
                    Session::login();
                    Session::set("log_in",$usuario);  
                    Session::set("msg","Acceso concedido... Usuario: ". $usuario->getNombre());
                    header("Location:index.php?c=access&a=index");
                    exit();
                }
                else {
                    Session::set("msg","Acceso denegado.");
                    header("Location:index.php?c=todos&a=index");
                }
            }
        }                
    }
    public function logout(){
        Session::logout();
        header("Location:index.php?c=todos&a=index");
        Session::set("msg","Acceso finalizado.");
        
    } 
    public function index(){
        if($this->checkUser()){
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));
            $usuarios= (Session::get('b')!="") ? $this->getPaginator()->paginar((new Usuario)->find(Session::get('b')), Session::get('p')) : array();
            $this->redirect_administrador(["index.php"],[
                "usuarios" => $usuarios,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            if(isset($_POST['btnaceptar'])){
                $cliente = $this->createCliente();
                $cliente->save();
                $usuario = $this->createUsuario();
                $usuario->setCliente((new Cliente())->findById((new Cliente())->maxID()));                 
                $id = $usuario->save();
                Session::set("msg",(isset($id)) ? "Usuario Creado" : Session::get('msg'));
                header("Location:index.php?c=usuarios&a=index");
                exit(); 
            }
            $this->redirect_administrador(["add.php"]);        
        }
    }
    private function createCliente(){
        $cliente = new Cliente();
        $cliente->setId(isset($_POST['idcli']) ? $_POST['idcli'] : 0);
        $cliente->setRuc($_POST['txtruc']);
        $cliente->setNombre($_POST['txtnomcli']);
        $cliente->setDireccion($_POST['txtdir']);
        $cliente->setTelefono($_POST['txttelefono']);
        $cliente->setCelular($_POST['txtcelular']);
        return $cliente;
    }
    private function createUsuario(){
        $cliente = $this->createCliente();
        $usuario = new Usuario();
        $usuario->setId(isset($_POST['idusu']) ? $_POST['idusu'] : 0);
        $usuario->setNombre($_POST['txtuser']);
        $usuario->setPass($_POST['txtpass']);
        $usuario->setTipo($_POST['cboxtipo']);
        $usuario->setCliente($cliente);
        return $usuario;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }    
}