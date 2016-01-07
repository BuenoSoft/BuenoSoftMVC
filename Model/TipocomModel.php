<?php
namespace Model;
use \PDO;
use App\Model;
use Clases\TipoCompra;
class TipocomModel extends Model
{
    function __construct() {
        parent::__construct();
    }
    public function obtenerTodos(){
        $sql="select * from tipo_compras";
        $datos= array();
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute();
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tc = new TipoCompra($row['tcId'], $row['tcNombre']);
            array_push($datos, $tc);
        }
        return $datos;
    }
    public function guardame($tc){
        $sql="insert into tipo_compras(tcNombre) values(?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tc->getNombre()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function modificame($tc){
        $sql="update tipo_compras set tcNombre=? where tcId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tc->getNombre(),$tc->getId()));
        return ($consulta->rowCount() > 0) ? $tc->getId() : null;
    }
    public function eliminame($tc){
        $sql="delete from tipo_compras where tcId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tc->getId()));
        return ($consulta->rowCount() > 0) ? $tc->getId() : null;
    }
    public function obtenerPorId($id) {
        $consulta = $this->getBD()->prepare("SELECT * FROM tipo_compras WHERE tcId = ?");
        $consulta->execute(array($id));
        if($consulta->rowCount() > 0) {
            $res= $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            return new TipoCompra($res['tcId'], $res['tcNombre']);
        }
        else {
            return null;
        }
    }
}