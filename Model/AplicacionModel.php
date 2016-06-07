<?php
namespace Model;
use \Clases\Aplicacion;
class AplicacionModel extends AppModel
{
    public function maxId(){
        return $this->fetch("select max(aplId) as maximo from aplicaciones",[])[0]['maximo'];
    }
    public function addApp($object){
        return $this->executeQuery($this->getCreateQuery(),  $this->getCreateParameter($object));
    }   
    protected function getCreateParameter($object) {
        return [
            $object->getCultivoLat(), $object->getCultivoLong(),$object->getPistaLat(), 
            $object->getPistaLong(), $object->getAreaapl(), $object->getFaja(), 
            $object->getFechaIni(), $object->getFechaFin(), $object->getTratamiento(), 
            $object->getViento(), $object->getTaquiIni(), $object->getTaquiFin(), $object->getTipo(), 
            $object->getPadron(), $object->getCultivo(), $object->getCaudal(),
            $object->getDosis(), $object->getCliente()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into aplicaciones(aplCultivoLat,aplCultivoLong,aplPistaLat,aplPistaLong,"
            . "aplAreaAplicada,aplFaja,aplFechaIni,aplFechaFin,aplTratamiento,aplViento,"
            . "aplTaquiIni,aplTaquiFin,aplTipo,aplPadron,aplCultivo,aplCaudal,aplDosis,datId)"
            . "values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    public function modApp($object){
        return $this->executeQuery($this->getUpdateQuery(), $this->getUpdateParameter($object));        
    }
    protected function getUpdateQuery() {
        return "update aplicaciones set aplCultivoLat = ?,aplCultivoLong = ?,aplPistaLat = ?,"
            . "aplPistaLong = ?, aplAreaAplicada = ?, aplFaja = ?,aplFechaIni = ?,aplFechaFin = ?,"
            . "aplTratamiento = ?,aplViento = ?,aplTaquiIni = ?,aplTaquiFin = ?,aplTipo = ?,"
            . "aplPadron = ?,aplCultivo = ?, aplCaudal = ?,aplDosis = ?,datId = ? where aplId = ?";
    }
    protected function getUpdateParameter($object) {
        return [
            $object->getCultivoLat(), $object->getCultivoLong(),$object->getPistaLat(), 
            $object->getPistaLong(), $object->getAreaapl(), $object->getFaja(), 
            $object->getFechaIni(),$object->getFechaFin(), $object->getTratamiento(), $object->getViento(), 
            $object->getTaquiIni(), $object->getTaquiFin(), $object->getTipo(), $object->getPadron(), 
            $object->getCultivo(), $object->getCaudal(),$object->getDosis(), $object->getCliente()->getId(), $object->getId()
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
        $aplicacion->setCultivoLat($row["aplCultivoLat"]);
        $aplicacion->setCultivoLong($row["aplCultivoLong"]);
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
        $aplicacion->setDosis($row["aplDosis"]);
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
    public function checkPro($dates = []){
        return (new TieneModel())->checkPro($dates);
    }
    public function getProductos($dates = []){
        return (new TieneModel())->getProductos($dates);
    }
    public function delPro($dates = []){
        return (new TieneModel())->delPro($dates);
    }
    /*-------------------------------------------------------------------------------*/
    public function addUsu($usado) {
        return (new UsadoModel())->addUsu($usado);    
    }
    public function checkUsu($dates = []) {
        return (new UsadoModel())->checkUsu($dates);
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
    public function delUsu($usado){
        return (new UsadoModel())->delUsu($usado);
    }
}