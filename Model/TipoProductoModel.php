<?php
namespace Model;
use \App\Session;
use \Clases\TipoProducto;
class TipoProductoModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    public function findByX($x) {        
        return $this->findByCondition($this->getCheckQuery(), [$x]);
    }
    /*------------------------------------------------------------------------------------*/
    protected function getCheckMessage() {
        return "Este tipo de producto ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from tipo_producto where tpNombre = ?";
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getCreateParameter($object) {
        return [$object->getNombre()];
    }
    protected function getCreateQuery() {
        return "insert into tipo_producto(tpNombre) values(?)";
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getFindParameter($criterio = null) {
        return [$criterio];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from tipo_producto order by tpNombre";
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getUpdateParameter($object) {
        return [$object->getNombre(), $object->getId()];
    }
    protected function getUpdateQuery() {
        return "update tipo_producto set tpNombre = ? where tpId = ?";
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getFindXIdQuery() {
        return "select * from tipo_producto where tpId = ?";
    }    
    public function createEntity($row) {
        $tp = new TipoProducto();
        $tp->setId($row["tpId"]);
        $tp->setNombre($row["tpNombre"]);
        return $tp;
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getDeleteParameter($object) {
        return [$object->getId()];        
    }
    protected function getDeleteQuery($notUsed = true) { 
        return "delete from tipo_producto where tpId = ?";
    }
    protected function getCheckDelete($object) {
        if($this->execute("select * from productos where tpId = ?", [$object->getId()])){
            Session::set("msg", Session::msgDanger("Hay productos utilizando este tipo"));
            return false;
        } else {
            return true;
        }
    }
}