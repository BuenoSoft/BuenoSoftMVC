<?php
namespace Model;
use \Clases\Tiene;
class TieneModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    /*---------------------------------------------------------------------*/
    public function addTieneParameter($tiene){
        return [$tiene->getApl()->getId(),$tiene->getProducto()->getId(),$tiene->getDosis()];
    }
    public function addTiene($tiene){
        return $this->execute($this->getCreateQuery(), $this->addTieneParameter($tiene));
    }
    protected function getCreateQuery() {
        return "insert into tiene(aplId,proId,aplDosis) values (?,?,?)";
    }
    /*---------------------------------------------------------------------*/
    public function delTiene($id){
        return $this->execute($this->getDeleteQuery(false), $this->delTieneParameter($id));
    }
    public function delTieneParameter($id){
        return [$id];
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from tiene where aplId = ?";
    }
    /*---------------------------------------------------------------------*/
    public function getTiene($id){
        return $this->fetch($this->getFindQuery(), $this->getFindTieneParameter($id));
    }
    private function getFindTieneParameter($id){
        return [$id];        
    }
    protected function getFindQuery($criterio = null){        
        return "select * from tiene t where t.aplId = ?";
    }
    /*---------------------------------------------------------------------*/
    private function checkTieneParameter($tiene){
        return [$tiene->getApl()->getId(),$tiene->getProducto()->getId()];
    }
    public function checkTiene($tiene){
        return $this->execute($this->checkTieneQuery(), $this->checkTieneParameter($tiene));
    }
    private function checkTieneQuery() {
        return "select * from tiene where aplId = ? and proId = ?";
    }
    /*---------------------------------------------------------------------*/
    public function createEntity($row){
        $tiene = new Tiene();
        $tiene->setApl((new AplicacionModel())->findById($row['aplId']));
        $tiene->setProducto((new ProductoModel())->findById($row['proId']));
        $tiene->setDosis($row['aplDosis']);
        return $tiene;
    }
    protected function getCheckParameter($unique) { }
    protected function getCheckMessage() { }
    protected function getCheckQuery() { }
    protected function getCreateParameter($object) { }
    protected function getDeleteParameter($object) { }
    protected function getFindParameter($criterio = null) { }
    protected function getFindXIdQuery() { }
    protected function getUpdateParameter($object) { }
    protected function getUpdateQuery() { }
    protected function getCheckDelete($object) { }
}