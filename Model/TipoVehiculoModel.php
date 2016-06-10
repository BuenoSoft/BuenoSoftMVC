<?php
namespace Model;
use Clases\TipoVehiculo;
class TipoVehiculoModel extends AppModel
{
    protected function getCheckMessage() {
        return "Este tipo de vehículo ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from tipo_vehiculo where tvNombre = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getNombre(),$object->getMedida()];
    }
    protected function getCreateQuery() {
        return "insert into tipo_vehiculo(tvNombre,tvMedida) values(?,?)";
    }    
    protected function getFindParameter($criterio = null) {
        return [$criterio];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from tipo_vehiculo";
    }
    protected function getFindXIdQuery() {
        return "select * from tipo_vehiculo where tvId = ?";
    }
    protected function getUpdateParameter($object) {
        return [$object->getNombre(),$object->getMedida(), $object->getId()];
    }
    protected function getUpdateQuery() {
        return "update tipo_vehiculo set tvNombre = ?, tvMedida = ? where tvId = ?";
    }
    public function createEntity($row) {
        $tv = new TipoVehiculo();
        $tv->setId($row["tvId"]);
        $tv->setNombre($row["tvNombre"]);
        $tv->setMedida($row["tvMedida"]);
        return $tv;
    }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
}