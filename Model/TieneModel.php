<?php
namespace Model;
use \App\Session;
class TieneModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    /*---------------------------------------------------------------------*/
    public function checkPro($dates = []) {
        return $this->executeQuery($this->getCheckQuery(),$this->getCheckTieneParameter($dates));
    } 
    public function getCheckTieneParameter($dates = []) {
        return [$dates[0],$dates[1]];
    }
    public function getCheckQuery() {
        return "select * from tiene where aplId = ? and proId = ?";
    } 
    protected function getCheckMessage() { 
        return "Este producto ya fue Registrado";
    }
    /*---------------------------------------------------------------------*/
    public function addPro($dates = []){
        if($this->checkPro($dates)){ 
            Session::set('msg', $this->getCheckMessage());
            return null;
        }
        return $this->executeQuery($this->getCreateQuery(), $this->getAddTieneParameter($dates));
    }
    protected function getAddTieneParameter($dates = []) {
        return [$dates[0],$dates[1]];
    }
    protected function getCreateQuery() {
        return "insert into tiene(aplId,proId) values (?,?)";
    }
    /*---------------------------------------------------------------------*/
    public function delPro($dates = []){
        return $this->executeQuery($this->getDeleteQuery(false), $this->getDelTieneParameter($dates));
    }
    protected function getDelTieneParameter($dates = []) {
        return [$dates[0],$dates[1]];
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
    protected function getCreateParameter($object) { }
    protected function getDeleteParameter($object) { }
    protected function getFindParameter($criterio = null) { }
    protected function getFindXIdQuery() { }
    protected function getUpdateParameter($object) { }
    protected function getUpdateQuery() { }
}