<?php
namespace Model;
use \App\Session;
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
        return [$object->getLog(),$object->getFechaini(),$object->getFechafin(),$object->getFechaAct(),'N',$object->getVehiculo()->getId(),$object->getUsuario()->getId()];
    }
    protected function getCreateQuery() {        
        return "insert into notificaciones(notLog,notFechaIni,notFechaFin,notFechaAct,notEstado,vehId,usuId) values (?,?,?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) {
        if($criterio == null){
            if(Session::get("log_in")->getRol()->getNombre() != "Administrador" and Session::get("log_in")->getRol()->getNombre() != "Supervisor"){
                return ["log" => Session::get("log_in")->getId()];
            } 
        }
        else {
            if(Session::get("log_in")->getRol()->getNombre() == "Administrador" or Session::get("log_in")->getRol()->getNombre() == "Supervisor"){
                return ["filtro" => "%".$criterio."%"];
            } else {
                return ["filtro" => "%".$criterio."%", "log" => Session::get("log_in")->getId()];
            }
        }       
    }
    protected function getFindQuery($criterio = null) {
        $sql = "select * from notificaciones n inner join vehiculos v on n.vehId = v.vehId";
        if($criterio == null){
            if(Session::get("log_in")->getRol()->getNombre() == "Administrador" or Session::get("log_in")->getRol()->getNombre() == "Supervisor"){
                $sql .=" order by n.notFechaAct desc, n.notEstado desc";
            } else {
                $sql .=" where n.usuId = :log order by n.notFechaAct desc, n.notEstado desc";
            }
        } else {
            if(Session::get("log_in")->getRol()->getNombre() == "Administrador" or Session::get("log_in")->getRol()->getNombre() == "Supervisor"){
                $sql .=" where n.notLog like :filtro or v.vehMatricula like :filtro order by notFechaAct desc, notEstado desc";
            } else {
                $sql .=" where (n.notLog like :filtro or v.vehMatricula like :filtro) and n.usuId = :log order by notFechaAct desc, notEstado desc";
            }            
        }
        return $sql;
    }
    /*------------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [$object->getLog(),$object->getFechaini(),$object->getFechafin(),$object->getFechaAct(),'L',
            $object->getVehiculo()->getId(),
            $object->getUsuario()->getId(),
            $object->getId()];
    }
    protected function getUpdateQuery() {
        return "update notificaciones set notLog = ?,notFechaIni = ?,notFechaFin = ?,notFechaAct = ?,notEstado = ?,vehId = ?,usuId = ? where notId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getDeleteParameter($object) { 
        return [$object->getId()];
    }
    protected function getDeleteQuery($notUsed = true) { 
        return "delete from notificaciones where notId = ?";
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getFindXIdQuery() {
        return "select * from notificaciones where notId = ?";
    }
    public function createEntity($row) {
        $veh = (new VehiculoModel())->findById($row["vehId"]);
        $usu = (new UsuarioModel())->findById($row["usuId"]);
        $not = new Notificacion();
        $not->setId($row["notId"]);
        $not->setLog($row["notLog"]); 
        $not->setFechaini($row["notFechaIni"]);
        $not->setFechafin($row["notFechaFin"]);
        $not->setEstado($row["notEstado"]);
        $not->setVehiculo($veh);
        $not->setUsuario($usu);
        return $not;
    }
    /*------------------------------------------------------------------------------------*/
    private function getShowQuery(){
        if(Session::get("log_in")->getRol()->getNombre() == "Administrador" or Session::get("log_in")->getRol()->getNombre() == "Supervisor"){
            return "select * from notificaciones order by notFechaAct desc, notEstado desc limit 0,5";
        } else {
            return "select * from notificaciones where usuId = ? order by notFechaAct desc, notEstado desc limit 0,5";
        }       
    }
    private function getShowParam(){
        if(Session::get("log_in")->getRol()->getNombre() == "Administrador" and Session::get("log_in")->getRol()->getNombre() == "Supervisor"){
            return [];
        } else {
            return [Session::get("log_in")->getId()];
        }
    }
    public function getNotificaciones(){
       return $this->fetch($this->getShowQuery(), $this->getShowParam());
    }
    /*------------------------------------------------------------------------------------*/
    public function getCantNots(){
        $cant =0;
        foreach($this->getNotificaciones() as $not){
            if($not->getEstado() == "N"){
                $cant++;
            }
        }
        return $cant ++;
    }
}