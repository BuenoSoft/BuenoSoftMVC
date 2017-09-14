<?php
namespace Controller;
use \App\Session;
use \App\Breadcrumbs;
use \Model\ZafraModel;
class ZafrasController extends AppController
{
    public function index(){
        if($this->checkUser()){
            $bc = new Breadcrumbs();
            $bc->add_crumb("index.php?c=inicio&a=index");
            $bc->add_crumb($_SERVER['REQUEST_URI']);
            Session::set('enlaces', $bc->display());
            Session::set('ped1',(isset($_POST['txtped1'])) ? $this->clean($_POST['txtped1']) : Session::get('ped1'));
            Session::set('ped2',(isset($_POST['txtped2'])) ? $this->clean($_POST['txtped2']) : Session::get('ped2'));
            $this->redirect_administrador(["index.php"],[
                "anios" => (new ZafraModel())->anioList(),
                "periodos" => (new ZafraModel())->periodList([Session::get('ped1'),Session::get('ped2')])
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