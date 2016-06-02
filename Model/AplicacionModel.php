<?php
namespace Model;
use \Clases\Aplicacion;
class AplicacionModel extends AppModel
{
    public function addApp($object){
        return $this->executeQuery($this->getCreateQuery(),  $this->getCreateParameter($object));
    }   
    protected function getCreateParameter($object) {
        return [
            $object->getCoordlat(), $object->getCoordlong(), $object->getAreaapl(), $object->getFaja(), 
            $object->getFechaIni(), $object->getFechaFin(), $object->getTratamiento(), 
            $object->getViento(), $object->getTaquiIni(), $object->getTaquiFin(), $object->getTipo(), 
            $object->getPadron(), $object->getCultivo(), $object->getCaudal(), $object->getImporte(),
            $object->getDosis(), $object->getHectareas(), $object->getCliente()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into aplicaciones(aplCoordLat,aplCoordLong, aplAreaAplicada,aplFaja,"
            . "aplFechaIni,aplFechaFin,aplTratamiento,aplViento,aplTaquiIni,aplTaquiFin,"
            . "aplTipo,aplPadron,aplCultivo,aplCaudal,aplImporte, aplDosis,aplHectareas,datId) "
            . "values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    public function modApp($object){
        return $this->executeQuery($this->getUpdateQuery(), $this->getUpdateParameter($object));        
    }
    protected function getUpdateQuery() {
        return "update aplicaciones set aplCoordLat = ?,aplCoordLong = ?,aplAreaAplicada = ?,"
            . "aplFaja = ?,aplFechaIni = ?,aplFechaFin = ?,aplTratamiento = ?,aplViento = ?,"
            . "aplTaquiIni = ?,aplTaquiFin = ?,aplTipo = ?,aplPadron = ?,aplCultivo = ?,"
            . "aplCaudal = ?,aplImporte = ?,aplDosis = ?,aplHectareas = ?,datId = ? where aplId = ?";
    }
    protected function getUpdateParameter($object) {
        return [
            $object->getCoordlat(), $object->getCoordlong(), $object->getAreaapl(), $object->getFaja(), 
            $object->getFechaIni(),$object->getFechaFin(), $object->getTratamiento(), $object->getViento(), 
            $object->getTaquiIni(), $object->getTaquiFin(), $object->getTipo(), $object->getPadron(), 
            $object->getCultivo(), $object->getCaudal(), $object->getImporte(),$object->getDosis(), 
            $object->getHectareas(), $object->getCliente()->getId(), $object->getId()
        ];
    }    
    
    protected function getFindParameter($criterio = null) {
        return ["filtro" => "%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from aplicaciones a inner join datosusu d on a.datId = d.datId";
        } else {
            return "select * from aplicaciones a inner join datosusu d on a.datId = d.datId where d.datDocumento like :filtro or d.datNombre like :filtro";
        }
        
    }
    protected function getFindXIdQuery() {
        return "select * from aplicaciones where aplId = ?";
    }
    
    public function createEntity($row) {
        $cliente = (new DatosUsuModel())->findById($row["datId"]);
        $aplicacion = new Aplicacion();
        $aplicacion->setId($row["aplId"]);
        $aplicacion->setCoordlat($row["aplCoordLat"]);
        $aplicacion->setCoordlong($row["aplCoordLong"]);
        $aplicacion->setAreaapl($row["aplAreaAplicada"]);
        $aplicacion->setFaja($row["aplFaja"]);
        $aplicacion->setFechaIni($row["aplFechaIni"]);
        $aplicacion->setFechaFin($row["aplFechaFin"]);
        $aplicacion->setTratamiento($row["aplTratamiento"]);
        $aplicacion->setViento($row["aplViento"]);
        $aplicacion->setTaquiIni($row["aplTaquiIni"]);
        $aplicacion->setTaquiFin($row["aplTaquiFin"]);
        $aplicacion->setTipo($row["aplTipo"]);
        $aplicacion->setPadron($row["aplPadron"]);
        $aplicacion->setCultivo($row["aplCultivo"]);
        $aplicacion->setCaudal($row["aplCaudal"]);
        $aplicacion->setImporte($row["aplImporte"]);
        $aplicacion->setDosis($row["aplDosis"]);
        $aplicacion->setHectareas($row["aplHectareas"]);
        $aplicacion->setCliente($cliente);
        return $aplicacion;
    }
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) { }
    protected function getCheckQuery() { }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
    /*-------------------------------------------------------------------------------*/
    public function addPro($dates = []){
        return (new TieneModel())->addPro($dates);
    }
    public function getProductos($dates = []){
        return (new TieneModel())->getProductos($dates);
    }
    public function delPro($dates = []){
        return (new TieneModel())->delPro($dates);
    }
    /*-------------------------------------------------------------------------------*/
    public function addUsu($usado) {
        return (new UsadoModel())->create($usado);    
    }
    public function getUsados($dates = []){
        return (new UsadoModel())->getUsados($dates);
    }
    public function getUsado($dates = []){
        return (new UsadoModel())->getUsado($dates);
    }
    public function modUsu($usado) {
        return (new UsadoModel())->modUsu($usado);    
    }
}