<?php
namespace Controller;
use App\Controller;
use App\Session;
use Model\UsuarioModel;
use Model\RolModel;
use Clases\Usuario;
class UsuariosController extends Controller
{
    private $mod_r;
    private $mod_u;
    function __construct(){
        parent::__construct();
        $this->mod_u= new UsuarioModel();
        $this->mod_r= new RolModel();
    }
    public function login(){
        if(Session::isLoggedIn()){
            Session::set("msg","Hay un usuario logueado");
            header("Location:index.php?c=main&a=index");
            exit();
        } 
        else if (isset($_POST['login'])) {
            if(empty($_POST['user']) or empty($_POST['pass'])){ 
                Session::set("msg","Ingrese los datos obligatorios (*) para continuar.");
            } else {
                $usuario = $this->mod_u->login(array($_POST['user'],$_POST['pass']));
                if (isset($usuario)){
                    Session::login();
                    Session::set("log_in",$usuario);                    
                    Session::set("msg","Acceso concedido... Usuario: ". $usuario->getNick());
                    header("Location:index.php?c=main&a=index");
                    exit();
                } else {
                    Session::set("msg","Acceso denegado.");
                }                 
            }            
        }
        $this->redirect(array('login.php'));
    }
    public function logout(){
        Session::logout();
        Session::set("msg","Acceso finalizado.");
        $this->redirect(array('Main','index.php'));
    }  
    public function tareas(){
        if($this->checkUser()){ 
            Session::set('b',"");
            $this->redirect(array('tareas.php'));         
        }
    }
    public function add(){
        if (isset($_POST['btnaceptar'])) {
            if($this->checkDates()) {  
                $rol = $this->mod_r->obtenerPorId($_POST['txtrol']);
                $usuario = new Usuario(0, $_POST['txtnick'], md5($_POST['txtpass']), $_POST['txtcor'], $_POST['txtnom'],$_POST['txtape'], 1, $rol);
                $this->mod_u->guardame($usuario);
                Session::set("msg","Usuario Creado");
                $ruta= $this->checkUser() ? "index.php?c=usuarios&a=index" : "index.php?c=main&a=index";
                header("Location:".$ruta);                
                exit();
            }
        }
        $this->redirect(array('add.php'), array(
            "roles" => $this->mod_r->obtenerTodos()
        ));
    }
    public function edit(){        
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){                            
                if($this->checkDates()) {
                    $rol = $this->mod_r->obtenerPorId($_POST['txtrol']);
                    $usuario = new Usuario($_POST['hid'], $_POST['txtnick'], md5($_POST['txtpass']), $_POST['txtcor'], $_POST['txtnom'],$_POST['txtape'], 1, $rol);
                    $this->mod_u->modificame($usuario);  
                    Session::set("msg","Usuario Editado");
                    header("Location:index.php?c=usuarios&a=index");
                    exit();
                }
            }
            $this->redirect(array('edit.php'), array(
                "usuario" => $this->mod_u->obtenerPorId(Session::get('id')),
                "roles" => $this->mod_r->obtenerTodos()
            ));
        }
    }
    
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $usuario = $this->mod_u->obtenerPorId($_GET['p']);
                $id = $this->mod_u->eliminame($usuario);                
                Session::set("msg", (isset($id)) ? "Usuario Borrado" : "No se pudo borrar el usuario");
                header("Location:index.php?c=usuarios&a=index");
            }            
        }
    }
    public function reload(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $usuario = $this->mod_u->obtenerPorId($_GET['p']);
                $id = $this->mod_u->reactivame($usuario);
                Session::set("msg", (isset($id)) ? "Usuario Reactivado" : "No se pudo reactivar el usuario");
                header("Location:index.php?c=usuarios&a=index");
            }        
        }
    }
    public function index(){  
        if($this->checkUser()){
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));     
            $usuarios= (Session::get('b')!="") ? $this->getPaginator()->paginar($this->mod_u->buscador(Session::get('b')), Session::get('p')) : array();
            $this->redirect(array("index.php"),array(
                "usuarios" => $usuarios,
                "paginador" => $this->getPaginator()->getPages()
            ));         
        }
    }  
    private function checkDates(){
        if(empty($_POST['txtnick']) or empty($_POST['txtpass']) or empty($_POST['txtcor'])){
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