<?php
namespace Model;
use \Clases\Vehiculo;
class VehiculoModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindXQuery() {
        return "select * from vehiculos where vehMatricula = ?";
    }
    public function findByMat($mat) {        
        return $this->findByCondition($this->getFindXQuery(), [$mat]);
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
            $object->getMatricula(),$object->getPadron(),$object->getTipo()->getId(),
            $object->getCapcarga(),$object->getStock(),$object->getModelo(),$object->getMarca(),
            $object->getAnio(),0,$object->getCombustible()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into vehiculos(vehMatricula,vehPadron,tvId,vehCapCarga,vehStock,"
        . "vehModelo,vehMarca,vehAnio,vehTaquiDif,comId) values(?,?,?,?,?,?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getDeleteParameter($object) {
        return [$object->getId()];        
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from vehiculos where vehId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from vehiculos order by vehMatricula";
        } else {
            return "select * from vehiculos where vehMatricula like ? order by vehMatricula";         
        }
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindXIdQuery() {
        return "select * from vehiculos where vehId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [
            $object->getMatricula(),$object->getPadron(),$object->getTipo()->getId(),
            $object->getCapcarga(),$object->getStock(),$object->getModelo(),$object->getMarca(),
            $object->getAnio(),$object->getCombustible()->getId(), $object->getId()
        ];
    }
    protected function getUpdateQuery() {
        return "update vehiculos set vehMatricula = ?,vehPadron = ?,tvId = ?,vehCapCarga = ?,"
        . "vehStock = ?,vehModelo = ?,vehMarca = ?,vehAnio = ?,comId = ? where vehId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    private function getUpdateTaquiParameter($object) {
        return [$object->getTaquiDif(),$object->getId()];
    }
    private function getUpdateTaquiQuery() {
        return "update vehiculos set vehTaquiDif = ? where vehId = ?";
    }
    public function modTaquiDif($object){
        return $this->execute($this->getUpdateTaquiQuery(), $this->getUpdateTaquiParameter($object));
    }
    /*------------------------------------------------------------------------------------*/
    public function createEntity($row) {
        $vehiculo = new Vehiculo();
        $vehiculo->setId($row["vehId"]);
        $vehiculo->setMatricula($row["vehMatricula"]);
        $vehiculo->setPadron($row["vehPadron"]);
        $vehiculo->setTipo((new TipoVehiculoModel())->findById($row["tvId"]));
        $vehiculo->setCapcarga($row["vehCapCarga"]);
        $vehiculo->setStock($row["vehStock"]);
        $vehiculo->setModelo($row["vehModelo"]);
        $vehiculo->setMarca($row["vehMarca"]);
        $vehiculo->setAnio($row["vehAnio"]);
        $vehiculo->setTaquiDif($row["vehTaquiDif"]);
        $vehiculo->setCombustible((new CombustibleModel())->findById($row["comId"]));
        return $vehiculo;
    }
}