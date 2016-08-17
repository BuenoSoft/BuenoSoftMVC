<?php
namespace Model;
use \App\Session;
use \Clases\Notificacion;
class NotificacionModel extends AppModel
{
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
        $sql = "select * from notificaciones n "
                . "left join vehiculos v on n.vehId = v.vehId "
                . "left join usuarios u on n.usuId = u.usuId";
        if($criterio == null){
            if(Session::get("log_in")->getRol()->getNombre() != "Administrador" and Session::get("log_in")->getRol()->getNombre() != "Supervisor"){
                $sql .=" where n.usuId = :log";
            }
        } else {
            if(Session::get("log_in")->getRol()->getNombre() == "Administrador" or Session::get("log_in")->getRol()->getNombre() == "Supervisor"){
                $sql .=" where n.notMensaje like :filtro or v.vehMatricula like :filtro or u.usuNomReal like :filtro";
            } else {
                $sql .=" where (n.notMensaje like :filtro or v.vehMatricula like :filtro or u.usuNomReal like :filtro) and n.usuId = :log";
            }            
        }
        $sql .= " order by notEstado,notFecha desc";
        return $sql;
    }
    /*------------------------------------------------------------------------------------*/
    public function addNot($object){
        return $this->execute($this->getCreateQuery(),  $this->getCreateParameter($object));
    }   
    protected function getCreateParameter($object) {       
        return [$object->getMensaje(),$object->getFecha(),'N',$this->checkVehNull($object),$this->checkUsuNull($object)];
    }
    protected function getCreateQuery() {        
        return "insert into notificaciones(notMensaje,notFecha,notEstado,vehId,usuId) values (?,?,?,?,?)";
    } 
    /*------------------------------------------------------------------------------------*/
    public function modNot($object){
        return $this->execute($this->getUpdateQuery(), $this->getUpdateParameter($object));        
    }
    protected function getUpdateParameter($object) {
        return [
            $object->getMensaje(),$object->getFecha(),'L',$this->checkVehNull($object),
            $this->checkUsuNull($object),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update notificaciones set notMensaje = ?,notFecha = ?,notEstado = ?,vehId = ?,usuId = ? where notId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    private function checkVehNull($object){        
        return ($object->getVehiculo() == null) ? NULL : $object->getVehiculo()->getId();
    }
    private function checkUsuNull($object){        
        return ($object->getUsuario() == null) ? NULL : $object->getUsuario()->getId();
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
        $not->setMensaje($row["notMensaje"]); 
        $not->setFecha($row["notFecha"]);
        $not->setEstado($row["notEstado"]);
        $not->setVehiculo($veh);
        $not->setUsuario($usu);
        return $not;
    }
    /*------------------------------------------------------------------------------------*/
    private function getShowQuery(){
        $sql = "select * from notificaciones";
        if(Session::get("log_in")->getRol()->getNombre() == "Administrador" or Session::get("log_in")->getRol()->getNombre() == "Supervisor"){
            $sql.= " where date(notFecha) = date(now())";
        } else {
            $sql.=" where date(notFecha) = date(now()) and usuId = ?";
        }
        $sql.= " order by notEstado,notFecha desc limit 0,5";
        return $sql;
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
    /*------------------------------------------------------------------------------------*/         
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) { }
    protected function getCheckQuery() { }
}