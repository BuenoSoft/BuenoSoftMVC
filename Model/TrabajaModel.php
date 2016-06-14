<?php
namespace Model;
class TrabajaModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    /*---------------------------------------------------------------------*/
    public function getCheckTraParameter($dates = []) {
        return [$dates[0],$dates[1]];
    }
    /*---------------------------------------------------------------------*/
    public function addTra($dates = []){
        return $this->execute($this->getCreateQuery(), $this->getCheckTraParameter($dates));
    }
    protected function getCreateQuery() {
        return "insert into trabajan(aplId,usuId) values(?,?)";
    }
    /*---------------------------------------------------------------------*/
    public function delTra($dates = []){
        return $this->execute($this->getDeleteQuery(false), $this->getCheckTraParameter($dates));
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from trabajan where aplId = ? and usuId = ?";
    }
    /*---------------------------------------------------------------------*/
    public function getTrabajadores($dates = []){
        $datos = array();
        foreach($this->fetch($this->getFindQuery(), $this->getFindTraParameter($dates)) as $row){
            $obj = $this->createEntity($row); 
            array_push($datos, $obj);
        }
        return $datos;
    }
    protected function getFindQuery($criterio = null) {
        return "select * from trabajan where aplId = ?";
    }
    private function getFindTraParameter($dates = []){
        return [$dates[0]];        
    }
    /*---------------------------------------------------------------------*/
    public function createEntity($row) {
        return (new UsuarioModel())->findById($row["usuId"]);
    }
    protected function getCheckParameter($unique) { }    
    protected function getFindParameter($criterio = null) { }
    protected function getFindXIdQuery() {}
    protected function getCreateParameter($object) { }
    protected function getDeleteParameter($object) { }
    protected function getUpdateParameter($object) { }    
    protected function getUpdateQuery() { }
    protected function getCheckMessage() { }
    protected function getCheckQuery() { }
}