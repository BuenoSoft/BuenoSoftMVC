<?php
namespace Model;
use \PDO;
use \App\Model;
use \App\Session;
use \Clases\TipoCompra;
class TipocomModel extends Model
{
    function __construct() {
        parent::__construct();
    }
    public function find($criterio = null){
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
    public function create($tc){
        if($this->check($tc->getNombre())){
            Session::set('msg', 'El Tipo de compra ya existe');
            return null;
        }
        $sql="insert into tipo_compras(tcNombre) values(?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tc->getNombre()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function update($tc){
        $aux = $this->findById($tc->getId()); 
        if(!$tc->equals($aux)){
            if($this->check($tc->getNombre())){
                Session::set('msg', 'El Tipo de compra ya existe');
                return null;
            }        
        }
        $sql="update tipo_compras set tcNombre=? where tcId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tc->getNombre(),$tc->getId()));
        return ($consulta->rowCount() > 0) ? $tc->getId() : null;
    }
    private function check($unique) { 
        $query = 'SELECT tcId FROM tipo_compras WHERE tcNombre = ?'; 
        $consulta = $this->getBD()->prepare($query); 
        $consulta->execute([$unique]); 
        // Indicar si hay algo en la base de datos con este nombre 
        return $consulta->rowCount() > 0; 
    }
    public function delete($tc, $notUsed = true){
        $sql="delete from tipo_compras where tcId=?";
        if ($notUsed === true) {
            $sql .= ' AND tcId NOT IN (SELECT DISTINCT tcId FROM compras)';
        }
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($tc->getId()));
        return ($consulta->rowCount() > 0) ? $tc->getId() : null;
    }
    public function findById($id) {
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