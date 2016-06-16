<?php
namespace Model;
use \Clases\Usado;
class UsadoModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    /*------------------------------------------------------------------------------------*/
    public function getCheckUsuParameter($dates = []) {
        return [$dates[0],$dates[1],$dates[2]];
    }
    /*------------------------------------------------------------------------------------*/
    public function addUsu($dates = []){
        return $this->execute($this->getCreateQuery(), $this->getCheckUsuParameter($dates));
    }
    protected function getCreateQuery() {
        return "insert into utiliza(aplId,vehId,usuId) values(?,?,?)";
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
        return "select * from utiliza where aplId = :id";
    }
    /*------------------------------------------------------------------------------------*/ 
    public function delUsu($dates = []){
        return $this->execute($this->getDeleteQuery(false), $this->getCheckUsuParameter($dates));
    }
    protected function getDeleteQuery($notUsed = true) { 
        return "delete from utiliza where aplId = ? and vehId = ? and usuId = ?";
    }
    /*------------------------------------------------------------------------------------*/ 
    public function createEntity($row) {
        $apl = (new AplicacionModel())->findById($row["aplId"]);
        $veh = (new VehiculoModel())->findById($row["vehId"]);
        $usu = (new UsuarioModel())->findById($row["usuId"]);
        $usado = new Usado();
        $usado->setAplicacion($apl);
        $usado->setVehiculo($veh); 
        $usado->setUsuario($usu);
        return $usado;
    }    
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
    /*------------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) { }
    protected function getUpdateQuery() { }
    protected function getFindParameter($criterio = null) { }   
    protected function getFindXIdQuery() { }
    protected function getCreateParameter($dates = []) { }    
    protected function getDeleteParameter($object) { }
    protected function getCheckParameter($unique) { }
    protected function getCheckMessage() { }
    protected function getCheckQuery() { }    
}