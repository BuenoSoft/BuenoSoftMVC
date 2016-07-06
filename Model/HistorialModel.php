<?php
namespace Model;
use Clases\Historial;
class HistorialModel extends AppModel
{
    public function addHis($his){
        return $this->execute($this->getCreateQuery(), $this->getCreateParameter($his)); 
    }
    protected function getCreateParameter($object) {
        return [
            $object->getUsado()->getAplicacion()->getId(),
            $object->getUsado()->getVehiculo()->getId(),
            $object->getCombustible()->getId(),
            $object->getFecha(),
            $object->getRecarga()
        ];
    }
    protected function getCreateQuery() {
        return "insert into historial(aplId,vehId,comId,hisFecha,hisRecarga) values (?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    public function getHistoriales($dates = []){
        return $this->fetch($this->getFindQuery(), $this->getFindHisParameter($dates));
    }
    protected function getFindQuery($criterio = null) { 
        return "select * from historial where aplId = ? and vehId = ?";
    }
    protected function getFindHisParameter($dates = []) {
        return [$dates[0],$dates[1]];
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
        $usado = $this->getUsado($row);
        $historial = new Historial();
        $historial->setUsado($usado);
        $historial->setCombustible($combustible);
        $historial->setFecha($row["hisFecha"]);
        $historial->setRecarga($row["hisRecarga"]);
        return $historial;
    }
    private function getUsado($row){
        $apl = (new AplicacionModel())->findById($row["aplId"]);
        $veh = (new VehiculoModel())->findById($row["vehId"]);
        foreach($apl->getUsados() as $usado){
            if($usado->getVehiculo() == $veh){
                return $usado;
            }
        }
        return null;
    }
    protected function getFindXIdQuery() { }
    protected function getFindParameter($criterio = null) {}        
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) { }
    protected function getCheckQuery() { }
    protected function getUpdateParameter($object) { }
    protected function getUpdateQuery() { }    
}