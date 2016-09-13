<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Lib\Upload;
use \Clases\Rol;
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
                if (isset($usuario) and $usuario->getRol()->getNombre()!= "Chofer"){
                    Session::login();
                    Session::set("log_in",$usuario);  
                    Session::set("msg", Session::msgInfo("Acceso concedido... Usuario: ". $usuario->getNombre()));
                    header("Location:index.php?c=inicio&a=index");
                    exit();
                } else {     
                    Session::set("msg",Session::msgDanger("Acceso denegado."));
                    header("Location:index.php?c=todos&a=index#popup");                    
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
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set('p', isset($_GET['p']) ? $_GET['p'] : 1);
            Session::set('b',(isset($_POST['txtbuscador'])) ? $this->clean($_POST['txtbuscador']) : Session::get('b'));
            $usuarios= $this->getPaginator()->paginar((new Usuario)->find(Session::get('b')), Session::get('p'));
            $this->redirect_administrador(["index.php"],[
                "usuarios" => $usuarios,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    public function add(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            if(isset($_POST["btnaceptar"])){               
                $usuario = $this->createEntity();
                if($usuario->getRol() != null) {
                    if($usuario->save()){
                        Session::set("msg",Session::msgSuccess("Usuario Creado"));
                        header("Location:index.php?c=usuarios&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }                 
                } else {
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el rol"));
                }              
            }
            $this->redirect_administrador(["add.php"],[
                "roles" => (new Rol())->find()
            ]);        
        }
    }
    public function edit(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set("usu",$_GET['d']); 
            if (Session::get('usu')!=null && isset($_POST['btnaceptar'])){
                $usuario = $this->createEntity();
                if($usuario->getRol() != null) {
                    if($usuario->save()){
                        Session::set("msg",Session::msgSuccess("Usuario Editado"));
                        header("Location:index.php?c=usuarios&a=index");
                        exit();
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }
                } else {
                    Session::set("msg",Session::msgDanger("No se ha seleccionado el rol"));
                }    
            }
            $this->redirect_administrador(["edit.php"],[
                "usuario" => (new Usuario())->findById(Session::get('usu')),
                "roles" => (new Rol())->find()
            ]);  
        }
    }
    public function avatar(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=usuarios&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            if (isset($_POST['btnaceptar'])) {
                if(isset($_FILES['avatar'])){
                    $ruta = $this->upload->uploadImage($_FILES['avatar']);
                    if($ruta!= null){
                        $usuario = (new Usuario())->findById(Session::get('usu'));
                        $usuario->setAvatar($ruta);
                        $usuario->avatar();
                        header("Location:index.php?c=usuarios&a=avatar");
                        exit();                    
                    }
                }                                             
            }
            $this->redirect_administrador(['avatar.php'],[
                'usuario' => (new Usuario())->findById(Session::get('usu'))
            ]);
        }
    }
    public function av_view(){
        if(Session::get("log_in") != null){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb("index.php?c=usuarios&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            if (isset($_POST['btnaceptar'])) {
                if(isset($_FILES['avatar'])){
                    $ruta = $this->upload->uploadImage($_FILES['avatar']);
                    if($ruta!= null){
                        $usuario = (new Usuario())->findById(Session::get('usu'));
                        $usuario->setAvatar($ruta);
                        $usuario->avatar();
                        header("Location:index.php?c=usuarios&a=av_view");
                        exit();                    
                    }
                }                                             
            }
            $this->redirect_administrador(['av_view.php'],[
                'usuario' => (new Usuario())->findById(Session::get('usu'))
            ]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    public function view(){
        if(Session::get("log_in") != null){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['HTTP_REFERER']);
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set("usu",$_GET['d']); 
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["view.php"],["usuario" => (new Usuario())->findById(Session::get('usu'))]);
        } else {
            Session::set("msg", Session::msgDanger("Debe loguearse como " . $this->getMessageRole() . " para acceder."));
            header("Location:index.php?c=todos&a=index");
        }
    }
    public function delete(){
        if($this->checkUser()){
            if (isset($_GET['d'])){
                $usuario = (new Usuario())->findById($_GET['d']);
                if(Session::get("log_in")->equals($usuario)){
                    Session::set("msg",Session::msgDanger("No se puede eliminar a usted mismo"));
                } else {
                    $id = $usuario->del();
                    if($id){
                        Session::set("msg",Session::msgSuccess("Usuario Borrado"));
                    } else {
                        Session::set("msg",Session::msgDanger(Session::get('msg')[2]));
                    }
                }
                header("Location:index.php?&c=usuarios&a=index");
            }            
        }
    }
    private function createEntity(){   
        $usuario = new Usuario();
        $usuario->setId(isset($_POST['hid']) ? $_POST['hid'] : 0);
        $usuario->setDocumento($_POST['txtdoc']);        
        $usuario->setNomReal($_POST['txtnom']);        
        $usuario->setNombre($this->clean($_POST['txtuser']));
        $usuario->setPass($_POST['txtpass']);
        $usuario->setAvatar((isset($_FILES['avatar']) ? $this->upload->uploadImage($_FILES['avatar']) : (new Usuario())->findById($usuario->getId())->getAvatar()));
        $usuario->setDireccion($_POST['txtdir']);
        $usuario->setTelefono($_POST['txttelefono']);
        $usuario->setCelular($_POST['txtcelular']);
        $usuario->setTipo($_POST['rbtntipo']);
        $usuario->setRol((new Rol())->findByX((isset($_POST['rol'][0])) ? $_POST['rol'][0] : 0));
        return $usuario; 
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }    
}