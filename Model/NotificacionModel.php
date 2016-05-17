<?php
namespace Model;
use \Clases\Notificacion;
class NotificacionModel extends AppModel
{
    protected function getCheckMessage() {
        return "Esta notificación ya fue hecha";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getLog(), $unique->getVehiculo()->getId()];
    }
    protected function getCheckQuery() {
        return "select * from notificaciones where notLog = ? and vehId = ?";
    }
    protected function getFindXIdQuery() {
        return "select * from notificaciones where notId = ?";
    }
    protected function getCreateParameter($object) {       
        return [$object->getLog(),$object->getFechaini(),$object->getFechafin(),$object->getVehiculo()->getId()];
    }
    protected function getCreateQuery() {        
        return "insert into notificaciones(notLog,notFechaIni,notFechaFin,vehId) values (?,?,?,?)";
    }   
    protected function getFindParameter($criterio = null) {
        return ["filtro" => "%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from notificaciones n inner join vehiculos v on n.vehId = v.vehId where n.notLog like :filtro or v.vehMatricula like :filtro";
    }    
    protected function getUpdateParameter($object) {
        return [$object->getLog(),$object->getFechaini(),$object->getFechafin(),$object->getVehiculo()->getId(),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update notificaciones set notLog = ?,notFechaIni = ?,notFechaFin = ?,vehId = ? where notId = ?";
    }
    public function createEntity($row) {
        $veh = (new VehiculoModel())->findById($row["vehId"]);
        $not = new Notificacion();
        $not->setId($row["notId"]);
        $not->setLog($row["notLog"]); 
        $not->setFechaini($row["notFechaIni"]);
        $not->setFechafin($row["notFechaFin"]);
        $not->setVehiculo($veh);
        return $not;
    }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
}