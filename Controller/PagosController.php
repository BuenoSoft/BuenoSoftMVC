<?php
namespace Controller;
use \App\Controller;
use \App\Session;
use \Clases\Compra;
use \Clases\Pago;
class PagosController extends Controller
{
    function __construct() {
        parent::__construct();
    }
    public function index(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            $com = (new Compra())->obtenerPorId(Session::get('id'));
            Session::set('pg', isset($_GET['pg']) ? $_GET['pg'] : 1);
            if($com->getCuotas() == $com->obtenerNroPago() -1){
                Session::set("msg","Deuda Saldada...");
            }
            else if($com->checkFecVenc() == true){ 
                Session::set("msg","Pago atrasado...");            
            }           
            $this->redirect(array('index.php'),array(
                'pagos' => $this->getPaginator()->paginar($com->getPagos()),
                "paginador" => $this->getPaginator()->getPages()
            ));
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            $com = (new Compra())->obtenerPorId(Session::get('id'));
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) {
                    $pago = new Pago($_POST['hpag'], $_POST['hfec'], $com->generarFecVenc(), $_POST['txtmonto']);
                    $com->add_pago($pago);
                    Session::set("msg","Pago Registrado");
                    header("Location:index.php?c=pagos&a=index&p=".$com->getId());
                    exit();                
                }
            }
            $this->redirect(array('add.php'), array(
                'pago' => $com->obtenerNroPago()
            ));
        }
    }
    public function delete(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            if (isset($_GET['pag'])){
                $com = (new Compra())->obtenerPorId(Session::get('id'));
                $pag= $com->find_pago($_GET['pag']);
                $id = $com->del_pago($pag);
                Session::set("msg", (isset($id)) ? "Pago Borrado" : "No se pudo borrar el pago");
                header("Location:index.php?c=pagos&a=index&p=".$com->getId());
            }                           
        }
    }
    private function checkDates(){
        if(empty($_POST['txtmonto']) or !ctype_digit($_POST['txtmonto'])){
            Session::set("msg","Asegurese de ingresar el monto y/o que sea un nro entero");
            return false;
        }
        else if((new Compra())->obtenerPorId(Session::get('id'))->getCuotas() == (new Compra())->obtenerPorId(Session::get('id'))->obtenerNroPago() -1){
            Session::set("msg","Deuda Saldada.. no puede registrar más pagos");
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