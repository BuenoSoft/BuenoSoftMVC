<?php
namespace Model;
use \Clases\Combustible;
class CombustibleModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    public function findByTipo($tipo){
        return $this->findByCondition("select * from combustibles where tvId = ?", [$tipo]);
    }
    protected function getCheckMessage() {
        return "El Combustible ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from combustibles where comNombre = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getNombre(),$object->getStock(),$object->getTipo()->getId(),'H'];
    }
    protected function getCreateQuery() {
        return "insert into combustibles(comNombre,comStock,tvId,comEstado) values(?,?,?,?,?)";
    }
    protected function getDeleteParameter($object) {
        if($object->getEstado() == "H"){
            return ['D',$object->getId()];
        } else {
            return ['H',$object->getId()];
        }
    }
    protected function getDeleteQuery($notUsed = true) {
        return "update combustibles set comEstado = ? where comId = ?";
    }
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null) {
            return "select * from combustibles order by comEstado, comId";
        } else {
            return "select * from combustibles where comNombre like ? order by comEstado, comId";
        }
        
    }
    protected function getFindXIdQuery() {
        return "select * from combustibles where comId = ?";
    }
    protected function getUpdateParameter($object) {
        return [$object->getNombre(),$object->getStock(),$object->getTipo()->getId(),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update combustibles set comNombre = ?, comStock = ?, tvId = ? where comId = ?";
    }
    public function createEntity($row) {
        $combustible = new Combustible();
        $combustible->setId($row["comId"]);
        $combustible->setNombre($row["comNombre"]);
        $combustible->setStock($row["comStock"]);
        $combustible->setTipo((new TipoVehiculoModel())->findById($row["tvId"]));
        $combustible->setEstado($row["comEstado"]);
        return $combustible;
    }
}