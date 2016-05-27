<?php
namespace Model;
use Clases\Historial;
class HistorialModel extends AppModel
{
    public function addHis($his){
        return $this->executeQuery($this->getCreateQuery(), $this->getCreateParameter($his)); 
    }
    protected function getCreateParameter($object) {
        return [
            $object->getUsado()->getAplicacion()->getId(),$object->getUsado()->getVehiculo()->getId(),
            $object->getCombustible()->getId(),$object->getFecha(),$object->getCargaIni(),$object->getCargaFin()
        ];
    }
    protected function getCreateQuery() {
        return "insert into historial(aplId,vehId,comId,hisFecha,hisCargaIni,hisCargaFin) values (?,?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    public function getHistoriales($dates = []){
        $datos= array();
        foreach($this->fetch($this->getFindQuery(), $this->getFindHisParameter($dates)) as $row){
            $obj = $this->createEntity($row); 
            array_push($datos, $obj);
        }
        return $datos;
    }
    protected function getFindQuery($criterio = null) { 
        return "select * from historial where aplId = ? and vehId = ?";
    }
    protected function getFindHisParameter($dates = []) {
        return [$dates[0],$dates[1]];
    }
    /*------------------------------------------------------------------------------------*/
    public function getHistorial($dates = []){
        return $this->findByCondition($this->getFindXIdQuery(), $this->getHistorialXIdParameter($dates)); 
    }
    protected function getHistorialXIdParameter($dates = []) {
        return [$dates[0],$dates[1],$dates[2],$dates[3]];
    }
    protected function getFindXIdQuery() {
        return "select * from historial where aplId = ? and vehId = ? and comId = ? and hisFecha = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [
            $object->getCargaIni(),$object->getCargaFin(),
            $object->getUsado()->getAplicacion()->getId(),$object->getUsado()->getVehiculo()->getId(),
            $object->getCombustible()->getId(),$object->getFecha()
        ];
    }
    protected function getUpdateQuery() {
        return "update historial set hisCargaIni = ?, hisCargaFin = ? where aplId = ? and vehId = ? and comId = ? and hisFecha = ?";
    }
    public function modHis($his){
        return $this->executeQuery($this->getUpdateQuery(), $this->getUpdateParameter($his));
    }
    /*------------------------------------------------------------------------------------*/
    protected function getDeleteParameter($object) {
        return [
            $object->getUsado()->getAplicacion()->getId(),$object->getUsado()->getVehiculo()->getId(),
            $object->getCombustible()->getId(),$object->getFecha()
        ];
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from historial where aplId = ? and vehId = ? and comId = ? and hisFecha = ?";
    }            
    public function createEntity($row) {
        $combustible = (new CombustibleModel())->findById($row["comId"]);
        $usado = (new UsadoModel())->getUsado([$row["aplId"],$row["vehId"]]);
        $historial = new Historial();
        $historial->setUsado($usado);
        $historial->setCombustible($combustible);
        $historial->setFecha($row["hisFecha"]);
        $historial->setCargaIni($row["hisCargaIni"]);
        $historial->setCargaFin($row["hisCargaFin"]);
        return $historial;
    }
    protected function getFindParameter($criterio = null) {}        
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) { }
    protected function getCheckQuery() { }
}