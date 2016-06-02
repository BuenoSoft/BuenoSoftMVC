<?php
namespace Model;
use \Clases\Vehiculo;
class VehiculoModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    public function active($object){
        return $this->executeQuery($this->getDeleteQuery(false), $this->getActiveParameter($object));
    }
    protected function getCheckMessage() {
        return "El Vehículo ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getMatricula()];
    }
    protected function getCheckQuery() {
        return "select * from vehiculos where vehMatricula = ?";
    }
    protected function getCreateParameter($object) {
        return [
            $object->getMatricula(),$object->getPadron(),$object->getTipo(),$object->getMotor(),$object->getChasis(),
            $object->getUnimedida(),$object->getCapcarga(),$object->getModelo(),$object->getMarca(),$object->getAnio(),
            'H',$object->getCombustible()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into vehiculos(vehMatricula,vehPadron,vehTipo,vehMotor,vehChasis,vehUniMedida,vehCapCarga,vehModelo,vehMarca,vehAnio,vehEstado,comId) values(?,?,?,?,?,?,?,?,?,?,?,?)";
    }
    protected function getDeleteParameter($object) {
        return ['D',$object->getId()];
    }
    protected function getActiveParameter($object) {
        return ['H',$object->getId()];
    }
    protected function getDeleteQuery($notUsed = true) {
        return "update vehiculos set vehEstado = ? where vehId = ?";
    }
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
    protected function getFindXIdQuery() {
        return "select * from vehiculos where vehId = ?";
    }
    protected function getUpdateParameter($object) {
        return [
            $object->getMatricula(),$object->getPadron(),$object->getTipo(),$object->getMotor(),$object->getChasis(),
            $object->getUnimedida(),$object->getCapcarga(),$object->getModelo(),$object->getMarca(),$object->getAnio(),
            $object->getCombustible()->getId(), $object->getId()
        ];
    }
    protected function getUpdateQuery() {
        return "update vehiculos set vehMatricula = ?,vehPadron = ?,vehTipo = ?,vehMotor = ?,vehChasis = ?,vehUniMedida = ?,vehCapCarga = ?,vehModelo = ?,vehMarca = ?,vehAnio = ?,comId = ? where vehId = ?";
    }
    public function createEntity($row) {
        $combustible =(new CombustibleModel())->findById($row["comId"]);
        $vehiculo = new Vehiculo();
        $vehiculo->setId($row["vehId"]);
        $vehiculo->setMatricula($row["vehMatricula"]);
        $vehiculo->setPadron($row["vehPadron"]);
        $vehiculo->setTipo($row["vehTipo"]);
        $vehiculo->setMotor($row["vehMotor"]);
        $vehiculo->setChasis($row["vehChasis"]);
        $vehiculo->setUnimedida($row["vehUniMedida"]);
        $vehiculo->setCapcarga($row["vehCapCarga"]);
        $vehiculo->setModelo($row["vehModelo"]);
        $vehiculo->setMarca($row["vehMarca"]);
        $vehiculo->setAnio($row["vehAnio"]);
        $vehiculo->setEstado($row["vehEstado"]);
        $vehiculo->setCombustible($combustible);
        return $vehiculo;
    }
}