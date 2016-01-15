<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Clases\Consulta;
class ConsultasController extends Controller
{
    function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){ 
            $this->redirect(array('index.php'));         
        }
    }
    public function cons1(){
        if($this->checkUser()){  
            $compras=array();
            if(isset($_POST["rbtnperiodo"])){
                if($_POST["rbtnperiodo"] == "d"){
                    $compras = $this->getPaginator()->paginar((new Consulta())->cons1ByDay(Session::get('log_in')->getId()));
                }
                else if($_POST["rbtnperiodo"] == "m"){
                    $compras = $this->getPaginator()->paginar((new Consulta())->cons1ByMonth(Session::get('log_in')->getId()));
                }
                else {
                    $compras = $this->getPaginator()->paginar((new Consulta())->cons1ByYear(Session::get('log_in')->getId()));
                }            
            }
            $this->redirect(array('cons1.php'),array(
                "compras" => $compras,
                "paginador" => $this->getPaginator()->getPages()
            ));         
        }
    }
    public function cons2(){
        if($this->checkUser()){ 
            $this->redirect(array('cons2.php'),array(
                "compras" =>  $this->getPaginator()->paginar((new Consulta())->cons2(Session::get('log_in')->getId())),
                "paginador" => $this->getPaginator()->getPages()
            ));         
        }
    }
    public function cons3(){
        if($this->checkUser()){ 
            $compras=array();            
            if(isset($_POST["dtfecini"]) and isset($_POST["dtfecfin"])){
                if($_POST["dtfecini"] > $_POST["dtfecfin"]){
                    Session::set('msg', "La fecha de inicio debe ser menor a la fecha de cierre");
                }
                else {
                    $compras = $this->getPaginator()->paginar((new Consulta())->cons3($_POST["dtfecini"], $_POST["dtfecfin"], Session::get('log_in')->getId()));
                }
            }
            $this->redirect(array('cons3.php'),array(
                "compras" => $compras,
                "paginador" => $this->getPaginator()->getPages()
            ));         
        }
    }
    public function cons4(){
        if($this->checkUser()){ 
            $this->redirect(array('cons4.php'),array(
                "compras" =>  $this->getPaginator()->paginar((new Consulta())->cons4(Session::get('log_in')->getId())),
                "paginador" => $this->getPaginator()->getPages()
            ));         
        }
    }
    protected function getMessageRole() {
        return "cliente";
    }
    protected function getTypeRole() {
        return "NORMAL";
    }
}