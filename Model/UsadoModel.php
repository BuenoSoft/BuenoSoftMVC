<?php
namespace Model;
use \Clases\Usado;
class UsadoModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    protected function getCheckMessage() {
        return "Este vehículo ya está siendo usado";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getAplicacion()->getId(),$unique->getVehiculo()->getId()];
    }
    protected function getCheckQuery() {
        return "select * from utiliza where aplId = ? and vehId = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getAplicacion()->getId(),$object->getVehiculo()->getId(),$object->getConductor(),$object->getCapacidad()];
    }
    protected function getCreateQuery() {
        return "insert into utiliza(aplId,vehId,utiConductor,utiCapacidad) values(?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [$object->getConductor(),$object->getCapacidad(),$object->getAplicacion()->getId(),$object->getVehiculo()->getId()];
    }
    protected function getUpdateQuery() {
        return "update utiliza set utiConductor = ?,utiCapacidad = ? where aplId = ? and vehId = ?";
    }
    public function modUsu($object){
        return $this->executeQuery($this->getUpdateQuery(), $this->getUpdateParameter($object));
    }
    /*------------------------------------------------------------------------------------*/
    public function getUsados($dates = []){
        $datos= array();
        foreach($this->fetch($this->getFindQuery(), $this->getFindUsadoParameter($dates)) as $row){
            $obj = $this->createEntity($row); 
            array_push($datos, $obj);
        }
        return $datos;
    }
    private function getFindUsadoParameter($dates = []){
        return ["id" => $dates[0]];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from utiliza u inner join vehiculos v on u.vehId = v.vehId where u.aplId = :id";
    }
    /*------------------------------------------------------------------------------------*/
    public function getUsado($dates = []){
        return $this->findByCondition($this->getFindXIdQuery(), $this->getFindXIdParameter($dates));
    }
    private function getFindXIdParameter($dates = []) { 
        return [$dates[0], $dates[1]];
    }
    protected function getFindXIdQuery() { 
        return "select * from utiliza where aplId = ? and vehId = ?";
    }
    /*------------------------------------------------------------------------------------*/ 
    public function createEntity($row) {
        $apl = (new AplicacionModel())->findById($row["aplId"]);
        $veh = (new VehiculoModel())->findById($row["vehId"]);
        $usado = new Usado();
        $usado->setAplicacion($apl);
        $usado->setVehiculo($veh);
        $usado->setConductor($row["utiConductor"]);
        $usado->setCapacidad($row["utiCapacidad"]);        
        return $usado;
    }
    protected function getFindParameter($criterio = null) { }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
    /*-------------------------------------------------------------------------------*/
    public function addHis($his){
        return (new HistorialModel())->addHis($his);
    }
    public function getHistoriales($dates = []){
        return (new HistorialModel())->getHistoriales($dates);
    }
    public function getHistorial($dates = []){
        return (new HistorialModel())->getHistorial($dates);
    }
    public function modHis($his){
        return (new HistorialModel())->modHis($his);
    }
    public function delHis($his){
        return (new HistorialModel())->delete($his);
    }
}