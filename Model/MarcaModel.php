<?php
namespace Model;
use \PDO;
use \App\Model;
use \App\Session;
use \Clases\Marca;
class MarcaModel extends Model
{
    function __construct() {
        parent::__construct();
    }
    public function buscador($criterio){
        $datos= array();
        $sql="select * from marcas where marNombre like ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array("%".$criterio."%")); 
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $marca = new Marca($row['marId'], $row['marNombre']);
            array_push($datos,$marca);
        }
        return $datos;
    }
    public function obtenerPorId($id) {
        $consulta = $this->getBD()->prepare("SELECT * FROM marcas WHERE marId = ?");
        $consulta->execute(array($id));
        if($consulta->rowCount() > 0) {
            $res= $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            return new Marca($res['marId'], $res['marNombre']);
        }
        else {
            return null;
        }
    }
    public function eliminame($marca, $notUsed = true){
        $sql="delete from marcas where marId=?";
        if ($notUsed === true) {
            $sql .= ' AND marId NOT IN (SELECT DISTINCT marId FROM modelos)';
        }
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($marca->getId()));
        return ($consulta->rowCount() > 0) ? $marca->getId() : null;                
    }
    public function guardame($marca){
        if($this->check($marca->getNombre())){
            Session::set('msg', 'La Marca ya existe');
            return null;
        }
        $sql="insert into marcas(marNombre) values(?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($marca->getNombre()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function modificame($marca){
        $aux = $this->obtenerPorId($marca->getId()); 
        if(!$marca->equals($aux)){
            if($this->check($marca->getNombre())){
                Session::set('msg', 'La Marca ya existe');
                return null;
            }        
        }
        $sql="update marcas set marNombre=? where marId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($marca->getNombre(),$marca->getId()));
        return ($consulta->rowCount() > 0) ? $marca->getId() : null;
    }
    private function check($unique) { 
        $query = 'SELECT marId FROM marcas WHERE marNombre = ?'; 
        $consulta = $this->getBD()->prepare($query); 
        $consulta->execute([$unique]); 
        // Indicar si hay algo en la base de datos con este nombre 
        return $consulta->rowCount() > 0; 
    }
}
