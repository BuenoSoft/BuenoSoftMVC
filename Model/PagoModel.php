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
        $sql="insert into pagos(comId,pagId,pagFecPago,pagFecVenc,pagMonto) values(?,?,?,?,?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($com->getId(),$pago->getId(),$pago->getFecpago(),$pago->getFecvenc(),$pago->getMonto()));
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
    public function create($object) { }
    public function delete($object, $notUsed = true) { }
    public function find($criterio = null) { }
    public function findById($id) { }
    public function update($object) { }
}