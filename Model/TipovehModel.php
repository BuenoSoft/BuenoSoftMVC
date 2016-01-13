<?php
namespace Model;
use \PDO;
use \App\Model;
use \App\Session;
use \Clases\TipoVehiculo;
class TipovehModel extends Model
{
    function __construct() {
        parent::__construct();
    }
    public function find($criterio = null){
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
    public function create($tv){
        if($this->check($tv->getNombre())){
            Session::set('msg', 'El Tipo de vehículo ya existe');
            return null;
        }
        $sql="insert into tipo_vehiculos(tvNombre) values(?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tv->getNombre()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function update($tv){
        $aux = $this->findById($tv->getId()); 
        if(!$tv->equals($aux)){
            if($this->check($tv->getNombre())){
                Session::set('msg', 'El Tipo de vehículo ya existe');
                return null;
            }        
        }
        $sql="update tipo_vehiculos set tvNombre=? where tvId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tv->getNombre(),$tv->getId()));
        return ($consulta->rowCount() > 0) ? $tv->getId() : null;
    }
    private function check($unique) { 
        $query = 'SELECT tvId FROM tipo_vehiculos WHERE tvNombre = ?'; 
        $consulta = $this->getBD()->prepare($query); 
        $consulta->execute([$unique]); 
        // Indicar si hay algo en la base de datos con este nombre 
        return $consulta->rowCount() > 0; 
    }
    public function delete($tv, $notUsed = true){
        $sql="delete from tipo_vehiculos where tvId=?";
        if ($notUsed === true) {
            $sql .= ' AND tvId NOT IN (SELECT DISTINCT tvId FROM vehiculos)';
        }
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tv->getId()));
        return ($consulta->rowCount() > 0) ? $tv->getId() : null;                
    }
    public function findById($id) {
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
