<?php
namespace Controller;
use \App\Session;
use \Lib\Upload;
use \Clases\DatosUsu;
use \Clases\Usuario;
class UsuariosController extends AppController
{
    public function __construct() {
        parent::__construct();
        $this->upload = new Upload("usuarios");
    }
    public function login(){
        if(isset($_POST['btnaceptar'])) {
            if(empty($_POST['txtuser']) or empty($_POST['txtpass'])){ 
                Session::set("msg","Ingrese los datos obligatorios (*) para continuar.");
            } else {
                $usuario = (new Usuario())->login([$_POST['txtuser'], $_POST['txtpass']]);
                if (isset($usuario) and $usuario->getEstado() == "H"){
                    Session::login();
                    Session::set("log_in",$usuario);  
                    Session::set("msg","Acceso concedido... Usuario: ". $usuario->getNombre());
                    header("Location:index.php?c=access&a=index");
                    exit();
                } else if (isset($usuario) and $usuario->getEstado() == "D"){
                    Session::set("msg","El usuario está desactivado");
                    header("Location:index.php?c=todos&a=index");
                } else {
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
            $usuarios= $this->getPaginator()->paginar((new Usuario)->find(Session::get('b')), Session::get('p'));
            $this->redirect_administrador(["index.php"],[
                "usuarios" => $usuarios,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            if(isset($_POST["btnaceptar"])){               
                $datousu = $this->createDatoUsu();
                $datousu->save();
                $usuario = $this->createUsuario();
                $id = $usuario->save();
                if(isset($id)){
                    Session::set("msg","Usuario Creado");
                    header("Location:index.php?c=usuarios&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }                
            }
            $this->redirect_administrador(["add.php"]);        
        }
    }
    public function edit(){
        if($this->checkUser()){
            Session::set("usu",$_GET['d']); 
            if (Session::get('usu')!=null && isset($_POST['btnaceptar'])){
                $datousu = $this->createDatoUsu();
                $idu = $datousu->save();
                $usuario = $this->createUsuario();
                $usuario->setDatoUsu($datousu);
                $id = $usuario->save();
                if(isset($idu) or isset($id)){
                    Session::set("msg","Usuario Editado");
                    header("Location:index.php?c=usuarios&a=index");
                    exit();
                } else {
                    Session::set("msg",Session::get('msg'));
                }                
            }
            $this->redirect_administrador(["edit.php"],["usuario" => (new Usuario())->findById(Session::get('usu'))]);  
        }
    }
    public function avatar(){
        if($this->checkUser()){
            if (isset($_POST['btnaceptar'])) {
                if(isset($_FILES['avatar'])){
                    $ruta = $this->upload->uploadImage($_FILES['avatar']);
                    if($ruta!= null){
                        $usuario = (new Usuario())->findById(Session::get('id'));
                        $usuario->setAvatar($ruta);
                        $usuario->avatar();
                       // header("Location:index.php?c=usuarios&a=edit&p=".$usuario->getId());
                        header("Location:index.php?c=usuarios&a=avatar");
                        exit();                    
                    }
                }                                             
            }
            $this->redirect_administrador(['avatar.php'],[
                'usuario' => (new Usuario())->findById(Session::get('id'))
            ]);
        }
    }
    public function view(){
        if(Session::get("log_in") != null){
            Session::set("id",$_GET['d']); 
            $this->redirect_administrador(["view.php"],["usuario" => (new Usuario())->findById(Session::get('id'))]);
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $usuario = (new Usuario())->findById($_GET['d']);
                $id = $usuario->del();                
                Session::set("msg", (isset($id)) ? "Usuario Borrado" : "No se pudo borrar el usuario");
                header("Location:index.php?&c=usuarios&a=index");
            }            
        }
    }
    public function active(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $usuario = (new Usuario())->findById($_GET['d']);
                $id = $usuario->del();
                Session::set("msg", (isset($id)) ? "Usuario Activado" : "No se pudo activar el usuario");
                header("Location:index.php?c=usuarios&a=index");
            }        
        }
    }
    private function createDatoUsu(){
        $dato = new DatosUsu();
        $dato->setId(isset($_POST['hid']) ? $_POST['hid'] : 0);
        $dato->setDocumento($_POST['txtdoc']);
        $dato->setNombre($_POST['txtnom']);
        $dato->setDireccion($_POST['txtdir']);
        $dato->setTelefono($_POST['txttelefono']);
        $dato->setCelular($_POST['txtcelular']);
        $dato->setTipo($_POST['rbtntipo']);
        return $dato;
    }
    private function createUsuario(){   
        $datousu = isset($_POST['hid']) ? $this->createDatoUsu() : (new DatosUsu())->findById((new DatosUsu())->maxID());
        $ruta= (isset($_FILES['avatar']) ? $this->upload->uploadImage($_FILES['avatar']) : '');
        $usuario = new Usuario();
        $usuario->setId(isset($_POST['hid']) ? $_POST['hid'] : 0);
        $usuario->setNombre($_POST['txtuser']);
        $usuario->setPass($_POST['txtpass']);
        $usuario->setTipo($_POST['cboxtipo']);
        $usuario->setAvatar($ruta);
        $usuario->setDatoUsu($datousu);
        return $usuario; 
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }    
}