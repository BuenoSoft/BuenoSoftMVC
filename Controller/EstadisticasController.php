<?php
namespace Controller;
use \Model\EstadisticaModel;
class EstadisticasController extends AppController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){          
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