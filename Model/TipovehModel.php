<?php
namespace Model;
use \PDO;
use App\Model;
use Clases\TipoVehiculo;
class TipovehModel extends Model
{
    function __construct() {
        parent::__construct();
    }
    public function obtenerTodos(){
        $sql="select * from tipo_vehiculos";
        $datos= array();
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute();
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tc = new TipoVehiculo($row['tvId'], $row['tvNombre']);
            array_push($datos, $tc);
        }
        return $datos;
    }
    public function guardame($tv){
        $sql="insert into tipo_vehiculos(tvNombre) values(?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tv->getNombre()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function modificame($tv){
        $sql="update tipo_vehiculos set tvNombre=? where tvId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tv->getNombre(),$tv->getId()));
        return ($consulta->rowCount() > 0) ? $tv->getId() : null;
    }
    public function eliminame($tv){
        $sql="delete from tipo_vehiculos where tvId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tv->getId()));
        return ($consulta->rowCount() > 0) ? $tv->getId() : null;                
    }
    public function obtenerPorId($id) {
        $consulta = $this->getBD()->prepare("SELECT * FROM tipo_vehiculos WHERE tvId = ?");
        $consulta->execute(array($id));
        if($consulta->rowCount() > 0) {
            $res= $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            return new TipoVehiculo($res['tvId'], $res['tvNombre']);
        }
        else {
            return null;
        }
    }
}
