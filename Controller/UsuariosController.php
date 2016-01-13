<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Clases\Rol;
use \Clases\Usuario;
class UsuariosController extends Controller
{
    function __construct(){
        parent::__construct();
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
                $usuario = (new Usuario())->findByLogin(array($_POST['user'],$_POST['pass']));
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
                $rol = (new Rol())->findById($_POST['txtrol']);
                $usuario = new Usuario(0, $_POST['txtnick'], md5($_POST['txtpass']), $_POST['txtcor'], $_POST['txtnom'],$_POST['txtape'], 1, $rol);
                $id = $usuario->save();
                Session::set("msg",(isset($id)) ? "Usuario Creado" : Session::get('msg'));
                $ruta= $this->checkUser() ? "index.php?c=usuarios&a=index" : "index.php?c=main&a=index";
                header("Location:".$ruta);                
                exit();
            }
        }
        $this->redirect(array('add.php'), array(
            "roles" => (new Rol())->obtenerTodos()
        ));
    }
    public function edit(){        
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            if (Session::get('id')!=null && isset($_POST['btnaceptar'])){                            
                if($this->checkDates()) {
                    $rol = (new Rol())->findById($_POST['txtrol']);
                    $usuario = new Usuario($_POST['hid'], $_POST['txtnick'], md5($_POST['txtpass']), $_POST['txtcor'], $_POST['txtnom'],$_POST['txtape'], 1, $rol);
                    $id = $usuario->save();  
                    Session::set("msg",(isset($id)) ? "Usuario Editado" : Session::get('msg'));
                    header("Location:index.php?c=usuarios&a=index");
                    exit();
                }
            }
            $this->redirect(array('edit.php'), array(
                "usuario" => (new Usuario())->findById(Session::get('id')),
                "roles" => (new Rol())->find()
            ));
        }
    }
    
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $usuario = (new Usuario())->findById($_GET['p']);
                $id = $usuario->del();                
                Session::set("msg", (isset($id)) ? "Usuario Borrado" : "No se pudo borrar el usuario");
                header("Location:index.php?c=usuarios&a=index");
            }            
        }
    }
    public function reload(){
        if($this->checkUser()){
            if (isset($_GET['p'])){
                $usuario = (new Usuario())->findById($_GET['p']);
                $id = $usuario->rec();
                Session::set("msg", (isset($id)) ? "Usuario Reactivado" : "No se pudo reactivar el usuario");
                header("Location:index.php?c=usuarios&a=index");
            }        
        }
    }
    public function index(){  
        if($this->checkUser()){
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $_POST['txtbuscador'] : Session::get('b'));     
            $usuarios= (Session::get('b')!="") ? $this->getPaginator()->paginar((new Usuario)->find(Session::get('b')), Session::get('p')) : array();
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
        if(Session::get("log_in")!= null and Session::get("log_in")->getRol()->getNombre() == "ADMIN"){
            return true;
        }
        else {
            Session::set("msg","Debe ser administrador para acceder.");
            $this->redirect(array('Main','index.php'));
        }
    }
}