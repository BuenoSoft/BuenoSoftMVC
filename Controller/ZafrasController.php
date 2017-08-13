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
            Session::set('fec',(isset($_POST['txtanio'])) ? $this->clean($_POST['txtanio']) : Session::get('fec'));
            $this->redirect_administrador(["index.php"],[
                "anios" => (new ZafraModel())->anioList(),
                "periodos" => (new ZafraModel())->periodList($this->getDates(Session::get('fec')))
            ]);
        }
    }
    private function getDates($date){
        //print_r($date);
        $date2 = strtotime ('+1 year' , strtotime($date)); //Se añade un año mas
        $date2 = date ('Y-m-d',$date2);
        //echo "<br>";
        //print_r($date2);
        return [$date, $date2];
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }    
}