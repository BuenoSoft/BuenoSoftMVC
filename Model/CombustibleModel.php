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
    /*-------------------------------------------------------------------------------*/
    protected function getCheckMessage() {
        return "El Combustible ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from combustibles where comNombre = ?";
    }
    /*-------------------------------------------------------------------------------*/
    protected function getCreateParameter($object) {
        return [$object->getNombre(),$object->getStock(),$object->getStockMin(), 
            $object->getStockMax(),$object->getFecUC(),$object->getTipo()->getId()];
    }
    protected function getCreateQuery() {
        return "insert into combustibles(comNombre,comStock,comStockMin,comStockMax,comFecUC,tvId) values(?,?,?,?,?,?)";
    }
    /*-------------------------------------------------------------------------------*/
    protected function getDeleteParameter($object) {
        return [$object->getId()];        
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from combustibles where comId = ?";
    }
    /*-------------------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null) {
            return "select * from combustibles order by comNombre";
        } else {
            return "select * from combustibles where comNombre like ? order by comNombre";
        }        
    }
    /*-------------------------------------------------------------------------------*/
    protected function getFindXIdQuery() {
        return "select * from combustibles where comId = ?";
    }
    /*-------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [$object->getNombre(),$object->getStock(),$object->getStockMin(), $object->getStockMax(),
            $object->getFecUC(),$object->getTipo()->getId(),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update combustibles set comNombre = ?, comStock = ?, comStockMin = ?, comStockMax = ?, comFecUC = ?, tvId = ? where comId = ?";
    }
    /*-------------------------------------------------------------------------------*/
    public function createEntity($row) {
        $combustible = new Combustible();
        $combustible->setId($row["comId"]);
        $combustible->setNombre($row["comNombre"]);
        $combustible->setStock($row["comStock"]);
        $combustible->setStockMin($row["comStockMin"]);
        $combustible->setStockMax($row["comStockMax"]);
        $combustible->setFecUC($row["comFecUC"]);
        $combustible->setTipo((new TipoVehiculoModel())->findById($row["tvId"]));
        return $combustible;
    }
    /*-------------------------------------------------------------------------------*/
    public function addMov($mov){
        return (new MovimientoModel())->addMov($mov);
    }
    public function delMov($mov){
        return (new MovimientoModel())->delMov($mov);        
    }
    public function getMovimientos($comb){
        return (new MovimientoModel())->getMovimientos($comb);
    }
}