<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Model\EstadisticaModel;
class EstadisticasController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            $this->redirect_administrador(["index.php"],[
                "estadistica" => (new EstadisticaModel())->lists()
            ]);
        }
    }
    protected function getRoles() {
        return ["Administrador"];
    }
    protected function getMessageRole() {
        return "administrador";
    }
}