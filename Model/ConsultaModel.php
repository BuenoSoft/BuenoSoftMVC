<?php
namespace Model;
use \PDO;
use \App\Model;
use \Clases\Compra;
use \Clases\Pago;
class ConsultaModel extends Model
{
    function __construct() {
        parent::__construct();
        $this->mod_tc = new TipocomModel();
        $this->mod_u = new UsuarioModel();
        $this->mod_v = new VehiculoModel();
    }
    public function cons1ByDay($user_id){
        $datos= array();
        $sql="SELECT * FROM compras WHERE comFecha = NOW() and usuId = ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute([$user_id]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tc->findById($row['tcId']);
            $user = $this->mod_u->findById($row['usuId']);
            $veh = $this->mod_v->findById($row['vehId']);
            $com = new Compra($row['comId'], $row['comFecha'], $row['comCuotas'], $row['comCantidad'], $tipo, $user, $veh);
            $com->setPagos($this->findPagosByCompra($com));
            array_push($datos, $com);          
        }
        return $datos;
    }
    public function cons1ByMonth($user_id){
        $datos= array();
        $sql="SELECT * FROM compras WHERE MONTH(comFecha) = MONTH(NOW()) and YEAR(comFecha) = YEAR(NOW()) and usuId = ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute([$user_id]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tc->findById($row['tcId']);
            $user = $this->mod_u->findById($row['usuId']);
            $veh = $this->mod_v->findById($row['vehId']);
            $com = new Compra($row['comId'], $row['comFecha'], $row['comCuotas'], $row['comCantidad'], $tipo, $user, $veh);
            $com->setPagos($this->findPagosByCompra($com));
            array_push($datos, $com);          
        }
        return $datos;
    }
    public function cons1ByYear($user_id){
        $datos= array();
        $sql="SELECT * FROM compras WHERE YEAR(comFecha) = YEAR(NOW()) and usuId = ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute([$user_id]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tc->findById($row['tcId']);
            $user = $this->mod_u->findById($row['usuId']);
            $veh = $this->mod_v->findById($row['vehId']);
            $com = new Compra($row['comId'], $row['comFecha'], $row['comCuotas'], $row['comCantidad'], $tipo, $user, $veh);
            $com->setPagos($this->findPagosByCompra($com));
            array_push($datos, $com);          
        }
        return $datos;
    }
    public function cons2($user_id){
        $datos= array();
        $sql="select c.comId as id, c.tcId as tipoc, c.usuId as usuario, c.vehId as veh, c.comFecha as fecha,"
                . "c.comCuotas as cuotas, c.comCantidad as cant from compras c inner join pagos p on c.comId = p.comId "
                . "inner join vehiculos v on c.vehId = v.vehId where c.usuId = ? having c.comCuotas > max(p.pagId)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute([$user_id]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tc->findById($row['tipoc']);
            $user = $this->mod_u->findById($row['usuario']);
            $veh = $this->mod_v->findById($row['veh']);
            $com = new Compra($row['id'], $row['fecha'], $row['cuotas'], $row['cant'], $tipo, $user, $veh);
            $com->setPagos($this->findPagosByCompra($com));
            array_push($datos, $com);          
        }
        return $datos;
    }
    public function cons3($fec_ini,$fec_fin,$user_id){
        $datos= array();
        $sql="SELECT * FROM compras WHERE comFecha between ? and ? and usuId = ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute([$fec_ini,$fec_fin,$user_id]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tc->findById($row['tcId']);
            $user = $this->mod_u->findById($row['usuId']);
            $veh = $this->mod_v->findById($row['vehId']);
            $com = new Compra($row['comId'], $row['comFecha'], $row['comCuotas'], $row['comCantidad'], $tipo, $user, $veh);
            $com->setPagos($this->findPagosByCompra($com));
            array_push($datos, $com);          
        }
        return $datos;
    }
    public function cons4($user_id){
        $datos= array();
        $sql="SELECT * FROM compras WHERE usuId = ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute([$user_id]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tc->findById($row['tcId']);
            $user = $this->mod_u->findById($row['usuId']);
            $veh = $this->mod_v->findById($row['vehId']);
            $com = new Compra($row['comId'], $row['comFecha'], $row['comCuotas'], $row['comCantidad'], $tipo, $user, $veh);
            $com->setPagos($this->findPagosByCompra($com));
            array_push($datos, $com);          
        }
        return $datos;
    }
    private function findPagosByCompra($com){
        $datos = array();
        $consulta = $this->getBD()->prepare("SELECT * from pagos where comId = ? order by pagId desc");
        $consulta->execute([$com->getId()]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $pago = new Pago($row['pagId'], $row['pagFecPago'], $row['pagFecVenc'], $row['pagMonto']);
            array_push($datos, $pago); 
        } 
        return $datos;
    }
    public function create($object) { }
    public function delete($object, $notUsed = true) { }
    public function find($criterio = null) { }
    public function findById($id) { }
    public function update($object) { }
}