<?php
namespace Model;
use \Clases\Tiene;
class TieneModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    /*---------------------------------------------------------------------*/
    private function getCheckTieneParameter($dates = []) {
        return [$dates[0],$dates[1]];
    }
    /*---------------------------------------------------------------------*/
    public function addTieneParameter($tiene){
        return [$tiene->getApl()->getId(),
            $tiene->getProducto()->getId(),
            $tiene->getDosis()];
    }
    public function addTiene($tiene){
        return $this->execute($this->getCreateQuery(), $this->addTieneParameter($tiene));
    }
    protected function getCreateQuery() {
        return "insert into tiene(aplId,proId,aplDosis) values (?,?,?)";
    }
    /*---------------------------------------------------------------------*/
    public function delPro($dates = []){
        return $this->execute($this->getDeleteQuery(false), $this->getCheckTieneParameter($dates));
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from tiene where aplId = ? and proId = ?";
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
    public function createEntity($row){
        $tiene = new Tiene((new AplicacionModel())->findById($row['aplId']));
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