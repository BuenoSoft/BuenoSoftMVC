<?php
namespace Model;
use Clases\TipoVehiculo;
class TipoVehiculoModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
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
        return "select * from tipo_vehiculo order by tvEstado, tvId";
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
        $tv->setEstado($row["tvEstado"]);
        return $tv;
    }
    protected function getDeleteParameter($object) {
        if($object->getEstado() == "H"){
            return ['D',$object->getId()];
        } else {
            return ['H',$object->getId()];
        }
    }
    protected function getDeleteQuery($notUsed = true) { 
        return "update tipo_vehiculo set tvEstado = ? where tvId = ?";
    }
}