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
    /*------------------------------------------------------------------------------------*/
    protected function getCreateParameter($object) {       
        return [$object->getLog(),$object->getFechaini(),$object->getFechafin(),$object->getFechaAct(),$object->getVehiculo()->getId()];
    }
    protected function getCreateQuery() {        
        return "insert into notificaciones(notLog,notFechaIni,notFechaFin,notFechaAct,vehId) values (?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) {
        return ["filtro" => "%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from notificaciones n inner join vehiculos v on n.vehId = v.vehId order by notId";
        } else {
            return "select * from notificaciones n inner join vehiculos v on n.vehId = v.vehId where n.notLog like :filtro or v.vehMatricula like :filtro order by notId";
        }        
    }
    /*------------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [$object->getLog(),$object->getFechaini(),$object->getFechafin(),$object->getFechaAct(),$object->getVehiculo()->getId(),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update notificaciones set notLog = ?,notFechaIni = ?,notFechaFin = ?,notFechaAct = ?,vehId = ? where notId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindXIdQuery() {
        return "select * from notificaciones where notId = ?";
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
    /*------------------------------------------------------------------------------------*/
    private function getShowQuery(){
        return "select * from notificaciones order by notFechaAct desc limit 0,5";
    }
    public function getNotificaciones(){
       return $this->fetch($this->getShowQuery(), []);
    }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
}