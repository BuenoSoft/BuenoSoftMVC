<?php
namespace Model;
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
    public function addPro($dates = []){
        return $this->execute($this->getCreateQuery(), $this->getCheckTieneParameter($dates));
    }
    protected function getCreateQuery() {
        return "insert into tiene(aplId,proId) values (?,?)";
    }
    /*---------------------------------------------------------------------*/
    public function delPro($dates = []){
        return $this->execute($this->getDeleteQuery(false), $this->getCheckTieneParameter($dates));
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from tiene where aplId = ? and proId = ?";
    }
    /*---------------------------------------------------------------------*/
    public function getProductos($dates = []){
        $datos= array();
        foreach($this->fetch($this->getFindQuery(), $this->getFindTieneParameter($dates)) as $row){
            $obj = $this->createEntity($row); 
            array_push($datos, $obj);
        }
        return $datos;
    }
    private function getFindTieneParameter($dates = []){
        return [$dates[0]];        
    }
    protected function getFindQuery($criterio = null){        
        return "select * from tiene t inner join productos p on t.proId = p.proId where t.aplId = ?";
    }
    public function createEntity($row){
        return (new ProductoModel())->findById($row['proId']);
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
}