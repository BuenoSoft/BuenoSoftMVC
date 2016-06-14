<?php
namespace Model;
use \Clases\TipoProducto;
class TipoProductoModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    protected function getCheckMessage() {
        return "Este tipo de producto ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from tipo_producto where tpNombre = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getNombre(),"H"];
    }
    protected function getCreateQuery() {
        return "insert into tipo_producto(tpNombre,tpEstado) values(?,?)";
    }
    protected function getFindParameter($criterio = null) {
        return [$criterio];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from tipo_producto order by tpEstado, tpId";
    }
    protected function getFindXIdQuery() {
        return "select * from tipo_producto where tpId = ?";
    }
    protected function getUpdateParameter($object) {
        return [$object->getNombre(), $object->getId()];
    }
    protected function getUpdateQuery() {
        return "update tipo_producto set tpNombre = ? where tpId = ?";
    }
    public function createEntity($row) {
        $tp = new TipoProducto();
        $tp->setId($row["tpId"]);
        $tp->setNombre($row["tpNombre"]);
        $tp->setEstado($row["tpEstado"]);
        return $tp;
    }
    protected function getDeleteParameter($object) {
        if($object->getEstado() == "H"){
            return ['D',$object->getId()];
        } else {
            return ['H',$object->getId()];
        }
    }
    protected function getDeleteQuery($notUsed = true) { 
        return "update tipo_producto set tpEstado = ? where tpId = ?";
    }
}