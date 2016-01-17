<?php
namespace Model;
use \PDO;
use App\Model;
use Clases\Pago;
class PagoModel extends Model
{
    function __construct() {
        parent::__construct();
    }
    public function add_pago($com,$pago){
        $sql="insert into pagos(comId,pagId,pagFecPago,pagFecVenc,pagMonto,pagCuotas) values(?,?,?,?,?,?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array(
                $com->getId(),$pago->getId(),$pago->getFecpago(),
                $pago->getFecvenc(),$pago->getMonto(),$pago->getCuotas()
            ));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function del_pago($com,$pago){
        $sql="delete from pagos where comId=? and pagId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($com->getId(),$pago->getId()));
        return ($consulta->rowCount() > 0) ? $pago->getId() : null;                
    }
    public function find_pago($com_id,$pago_id){
        $sql="select * from pagos where comId=? and pagId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($com_id,$pago_id));
        if($consulta->rowCount() > 0) {
            $res = $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            return new Pago($res['pagId'], $res['pagFecPago'], $res['pagFecVenc'], $res['pagMonto']); 
        }
        else {
            return null;
        }
    }
    public function find_max_pago($com){
        $consulta = $this->getBD()->prepare("SELECT max(pagId) as pago from pagos where comId = ?");
        $consulta->execute(array($com));
        return $consulta->fetch(PDO::FETCH_ASSOC)['pago'] +1;
    }
    public function check_fec_venc($com){
        $consulta = $this->getBD()->prepare("SELECT pagFecVenc as vence from pagos where comId = ? order by pagId desc limit 0,1");
        $consulta->execute([$com]);
        return count($this->find_pagos($com))>0 and date("Y-m-d") > $consulta->fetch(PDO::FETCH_ASSOC)['vence'];
    }
    public function find_pagos($com){
        $datos = array();
        $consulta = $this->getBD()->prepare("SELECT * from pagos where comId = ? order by pagId desc");
        $consulta->execute([$com]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $pago = new Pago($row['pagId'], $row['pagFecPago'], $row['pagFecVenc'], $row['pagMonto'],$row['pagCuotas']);
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