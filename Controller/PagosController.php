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
            $com = (new Compra())->findById(Session::get('id'));
            Session::set('pg', isset($_GET['pg']) ? $_GET['pg'] : 1);
            if($com->getCuotas() == $com->find_max_pago() -1){
                Session::set("msg","Deuda Saldada...");
            }
            else if($com->check_fec_venc()){ 
                Session::set("msg","Pago atrasado...");            
            }           
            $this->redirect(array('index.php'),array(
                'compra' => $com,
                'pagos' => $this->getPaginator()->paginar($com->getPagos()),
                "paginador" => $this->getPaginator()->getPages()
            ));
        }
    }
    public function add(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            $com = (new Compra())->findById(Session::get('id'));
            if (isset($_POST['btnaceptar'])) {
                if($this->checkDates()) {
                    $pago = new Pago($_POST['hpag'], $_POST['hfec'],$com->generarFecVenc(), $_POST['txtmonto'],$_POST['txtcuotas']);
                    $com->add_pago($pago);
                    Session::set("msg","Monto Depositado: $".$pago->getMonto()." Cambio: $".($pago->getMonto() - $com->obtenerPagoMinimo() * $pago->getCuotas()));                     
                    header("Location:index.php?c=pagos&a=index&p=".$com->getId());
                    exit();                
                }
            }
            $this->redirect(array('add.php'), array(
                'compra' => $com,
                'pago' => $com->find_max_pago()
            ));
        }
    }
    public function delete(){
        if($this->checkUser()){
            Session::set("id",$_GET['p']);
            if (isset($_GET['pag'])){
                $com = (new Compra())->findById(Session::get('id'));
                $pag= $com->find_pago($_GET['pag']);
                $id = $com->del_pago($pag);
                Session::set("msg", (isset($id)) ? "Pago Borrado" : "No se pudo borrar el pago");
                header("Location:index.php?c=pagos&a=index&p=".$com->getId());
            }                           
        }
    }
    private function checkDates(){
        if(empty($_POST['txtmonto']) or !ctype_digit($_POST['txtmonto']) or empty($_POST['txtcuotas']) or !ctype_digit($_POST['txtcuotas'])){
            Session::set("msg","Asegurese de ingresar el monto y/o cuotas sean nros enteros");
            return false;
        }
        else if($_POST['txtmonto'] < (new Compra())->findById(Session::get('id'))->obtenerPagoMinimo() * $_POST['txtcuotas']){
            Session::set("msg","Monto no válido.. Ingrese nuevamente el monto");
            return false;
        }
        else if($_POST['txtcuotas'] > (new Compra())->findById(Session::get('id'))->obtenerCuotasRestantes()){
            Session::set("msg","Cantidad no válida.. Ingrese nuevamente la cantidad de cuotas");
            return false;
        }
        else if((new Compra())->findById(Session::get('id'))->getCuotas() == (new Compra())->findById(Session::get('id'))->find_max_pago() -1){
            Session::set("msg","Deuda Saldada.. no puede registrar más pagos");
            return false;
        }
        else {
            return true;        
        }
    }
    protected function getMessageRole() {
        return "administrador";
    }
    protected function getTypeRole() {
        return "ADMIN";
    } 
}