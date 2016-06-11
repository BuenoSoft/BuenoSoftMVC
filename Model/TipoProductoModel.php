<?php
namespace Model;
use \Clases\TipoProducto;
class TipoProductoModel extends AppModel
{
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
        return [$object->getNombre()];
    }
    protected function getCreateQuery() {
        return "insert into tipo_producto(tpNombre) values(?)";
    }
    protected function getFindParameter($criterio = null) {
        return [$criterio];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from tipo_producto";
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
        return $tp;
    }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
}