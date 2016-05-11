<?php
namespace Controller;
use \App\Session;
use \Clases\Sujeto;
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
                if($this->checkDates()){
                    $cliente = $this->createSujeto();
                    $cliente->save();
                    $usuario = $this->createUsuario();
                    $usuario->setSujeto((new Sujeto())->findById((new Sujeto())->maxID()));                 
                    $id = $usuario->save();
                    Session::set("msg",(isset($id)) ? "Usuario Creado" : Session::get('msg'));
                    header("Location:index.php?c=usuarios&a=index");
                    exit();                 
                }
            }
            $this->redirect_administrador(["add.php"]);        
        }
    }
    private function checkDates(){
        if($_POST['cboxtiposuj'] == "Empresa" and (strlen($_POST['txtdoc']) > 12) or strlen($_POST['txtdoc']) < 12){
            Session::set('msg', "Asegurese de ingresar bien el RUC de la empresa");
            return false;
        }
        else if($_POST['cboxtiposuj'] == "Persona" and (strlen($_POST['txtdoc']) > 8) or strlen($_POST['txtdoc']) < 8 ){
            Session::set('msg', "Asegurese de ingresar bien el C.I de la persona");
            return false;
        }
        else {
            return true;
        }
    }
    private function createSujeto(){
        $sujeto = new Sujeto();
        $sujeto->setId(isset($_POST['idsuj']) ? $_POST['idsuj'] : 0);
        $sujeto->setDocumento($_POST['txtdoc']);
        $sujeto->setNombre($_POST['txtnomsuj']);
        $sujeto->setDireccion($_POST['txtdir']);
        $sujeto->setTelefono($_POST['txttelefono']);
        $sujeto->setCelular($_POST['txtcelular']);
        $sujeto->setTiposuj($_POST['cboxtiposuj']);
        return $sujeto;
    }
    private function createUsuario(){
        $sujeto = $this->createSujeto();
        $usuario = new Usuario();
        $usuario->setId(isset($_POST['idusu']) ? $_POST['idusu'] : 0);
        $usuario->setNombre($_POST['txtuser']);
        $usuario->setPass($_POST['txtpass']);
        $usuario->setTipo($_POST['cboxtipo']);
        $usuario->setSujeto($sujeto);
        return $usuario;
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }    
}