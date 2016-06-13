<?php
namespace Controller;
use \App\Session;
use \Clases\Aplicacion;
class UsadosController extends AppController 
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set("app",$_GET['d']);
            Session::set('s', isset($_GET['s']) ? $_GET['s'] : 1);
            $apl = (new Aplicacion())->findById(Session::get("app"));
            $usados = $this->getPaginator()->paginar($apl->getUsados(), Session::get('s'));
            $this->redirect_administrador(['index.php'],[
                "aplicacion" => $apl,
                "usados" => $usados,
                "paginador" => $this->getPaginator()->getPages()
            ]);
        }
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}