<?php
namespace Model;
use \Clases\Combustible;
class CombustibleModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    public function active($object){
        return $this->executeQuery($this->getDeleteQuery(false), $this->getActiveParameter($object));
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
        return [$object->getNombre(),$object->getStock(),$object->getFecha(),'H'];
    }
    protected function getCreateQuery() {
        return "insert into combustibles(comNombre,comStock,comFecCarga,comEstado) values(?,?,?,?)";
    }
    protected function getDeleteParameter($object) {
        return ['D',$object->getId()];
    }
    protected function getActiveParameter($object) {
        return ['H',$object->getId()];
    }
    protected function getDeleteQuery($notUsed = true) {
        return "update combustibles set comEstado = ? where comId = ?";
    }
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from combustibles where comNombre like ? order by comEstado, comNombre";
    }
    protected function getFindXIdQuery() {
        return "select * from combustibles where comId = ?";
    }
    protected function getUpdateParameter($object) {
        return [$object->getNombre(),$object->getStock(),$object->getFecha(),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update combustibles set comNombre = ?, comStock = ?, comFecCarga = ? where comId = ?";
    }
    public function createEntity($row) {
        $combustible = new Combustible();
        $combustible->setId($row["comId"]);
        $combustible->setNombre($row["comNombre"]);
        $combustible->setStock($row["comStock"]);
        $combustible->setFecha($row["comFecCarga"]);
        $combustible->setEstado($row["comEstado"]);
        return $combustible;
    }
}