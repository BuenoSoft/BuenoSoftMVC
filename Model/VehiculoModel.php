<?php
namespace Model;
use \Clases\Vehiculo;
class VehiculoModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    /*------------------------------------------------------------------------------------*/
    public function checkUsu($dates = []) {
        return $this->executeQuery($this->getCheckUsuQuery(),$this->getCheckUsuParameter($dates));
    }
    private function getCheckUsuQuery() {
        return "select * from utiliza where aplId = ? and vehId = ?";
    }
    public function getCheckUsuParameter($dates = []) {
        return [$dates[0],$dates[1]];
    }
    /*------------------------------------------------------------------------------------*/
    public function checkAplFin($object) {
        return $this->executeQuery($this->getCheckFinQuery(),$this->getCheckFinParameter($object));
    }
    protected function getCheckFinQuery() {
        return "select * from utiliza u inner join aplicaciones a on u.aplId = a.aplId "
        . "where u.vehId = ? and (a.aplFechaFin = '0000-00-00 00:00:00' or a.aplFechaFin is NULL)";
    }
    protected function getCheckFinParameter($object) {
        return [$object->getId()];
    }
    /*------------------------------------------------------------------------------------*/
    public function active($object){
        return $this->executeQuery($this->getDeleteQuery(false), $this->getActiveParameter($object));
    }
    /*------------------------------------------------------------------------------------*/
    protected function getCheckMessage() {
        return "El Vehículo ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getMatricula()];
    }
    protected function getCheckQuery() {
        return "select * from vehiculos where vehMatricula = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getCreateParameter($object) {
        return [
            $object->getMatricula(),$object->getPadron(),$object->getTipo()->getId(),$object->getMotor(),
            $object->getChasis(),$object->getCapcarga(),$object->getModelo(),$object->getMarca(),
            $object->getAnio(),'H',$object->getCombustible()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into vehiculos(vehMatricula,vehPadron,tvId,vehMotor,vehChasis,vehCapCarga,"
            . "vehModelo,vehMarca,vehAnio,vehEstado,comId) values(?,?,?,?,?,?,?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getDeleteParameter($object) {
        return ['D',$object->getId()];
    }
    protected function getActiveParameter($object) {
        return ['H',$object->getId()];
    }
    protected function getDeleteQuery($notUsed = true) {
        return "update vehiculos set vehEstado = ? where vehId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from vehiculos order by vehEstado, vehId";
        } else {
            return "select * from vehiculos where vehMatricula like ? order by vehEstado, vehId";         
        }
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindXIdQuery() {
        return "select * from vehiculos where vehId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [
            $object->getMatricula(),$object->getPadron(),$object->getTipo()->getId(),$object->getMotor(),
            $object->getChasis(),$object->getCapcarga(),$object->getModelo(),$object->getMarca(),
            $object->getAnio(),$object->getCombustible()->getId(), $object->getId()
        ];
    }
    protected function getUpdateQuery() {
        return "update vehiculos set vehMatricula = ?,vehPadron = ?,tvId = ?,vehMotor = ?,vehChasis = ?,"
            . "vehCapCarga = ?,vehModelo = ?,vehMarca = ?,vehAnio = ?,comId = ? where vehId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    public function createEntity($row) {
        $vehiculo = new Vehiculo();
        $vehiculo->setId($row["vehId"]);
        $vehiculo->setMatricula($row["vehMatricula"]);
        $vehiculo->setPadron($row["vehPadron"]);
        $vehiculo->setTipo((new TipoVehiculoModel())->findById($row["tvId"]));
        $vehiculo->setMotor($row["vehMotor"]);
        $vehiculo->setChasis($row["vehChasis"]);
        $vehiculo->setCapcarga($row["vehCapCarga"]);
        $vehiculo->setModelo($row["vehModelo"]);
        $vehiculo->setMarca($row["vehMarca"]);
        $vehiculo->setAnio($row["vehAnio"]);
        $vehiculo->setEstado($row["vehEstado"]);
        $vehiculo->setCombustible((new CombustibleModel())->findById($row["comId"]));
        return $vehiculo;
    }
}