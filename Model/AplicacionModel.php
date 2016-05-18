<?php
namespace Model;
use \Clases\Aplicacion;
class AplicacionModel extends AppModel
{
    protected function getCheckMessage() {
        return "La Aplicación ya fue hecha";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getRuc()];
    }
    protected function getCheckQuery() {
        return "select * from aplicaciones where aplRuc = ?";
    }
    protected function getCreateParameter($object) {
        return [
            $object->getCoordlat(), $object->getCoordlong(), $object->getRuc(), $object->getAreaapl(), 
            $object->getFaja(), $object->getFecha(), $object->getEstado(), $object->getTratamiento(), 
            $object->getViento(), $object->getTaquiIni(), $object->getTaquiFin(), $object->getTipo(),
            $object->getPadron(), $object->getHoraIni(), $object->getHoraFin(), $object->getCultivo(), 
            $object->getCaudal(), $object->getImporte(),$object->getDosis(), $object->getHectareas(), 
            $object->getCliente()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into aplicaciones(aplCoordLat,aplCoordLong,aplRUC,aplAreaAplicada,aplFaja,"
            . "aplFecha,aplEstado,aplTratamiento,aplViento,aplTaquiIni,aplTaquiFin,aplTipo,aplPadron,"
            . "aplHoraIni,aplHoraFin,aplCultivo,aplCaudal, aplImporte, aplDosis,aplHectareas,sujId) "
            . "values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    }    
    protected function getFindParameter($criterio = null) {
        return ["filtro" => "%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from aplicaciones a inner join sujetos s on a.sujId = s.sujId where a.aplRUC like :filtro or s.sujDocumento like :filtro";
    }
    protected function getFindXIdQuery() {
        return "select * from aplicaciones where aplId = ?";
    }
    protected function getUpdateParameter($object) {
        return [
            $object->getCoordlat(), $object->getCoordlong(), $object->getRuc(), $object->getAreaapl(), 
            $object->getFaja(), $object->getFecha(), $object->getEstado(), $object->getTratamiento(), 
            $object->getViento(), $object->getTaquiIni(), $object->getTaquiFin(), $object->getTipo(),
            $object->getPadron(), $object->getHoraIni(), $object->getHoraFin(), $object->getCultivo(), 
            $object->getCaudal(), $object->getImporte(),$object->getDosis(), $object->getHectareas(), 
            $object->getCliente()->getId(), $object->getId()
        ];
    }
    protected function getUpdateQuery() {
        return "update aplicaciones set aplCoordLat = ?,aplCoordLong = ?,aplRUC = ?,aplAreaAplicada = ?, "
            . "aplFaja = ?,aplFecha = ?,aplEstado = ?,aplTratamiento = ?,aplViento = ?, aplTaquiIni = ?,"
            . "aplTaquiFin = ?,aplTipo = ?,aplPadron = ?,aplHoraIni = ?,aplHoraFin = ?,aplCultivo = ?,"
            . "aplCaudal = ?,aplImporte = ?,aplDosis = ?,aplHectareas = ?,sujId = ? where aplId = ?";
    }
    public function createEntity($row) {
        $cliente = (new SujetoModel())->findById($row["sujId"]);
        $aplicacion = new Aplicacion();
        $aplicacion->setId($row["aplId"]);
        $aplicacion->setCoordlat($row["aplCoordLat"]);
        $aplicacion->setCoordlong($row["aplCoordLong"]);
        $aplicacion->setRuc($row["aplRUC"]);
        $aplicacion->setAreaapl($row["aplAreaAplicada"]);
        $aplicacion->setFaja($row["aplFaja"]);
        $aplicacion->setFecha($row["aplFecha"]);
        $aplicacion->setEstado($row["aplEstado"]);
        $aplicacion->setTratamiento($row["aplTratamiento"]);
        $aplicacion->setViento($row["aplViento"]);
        $aplicacion->setTaquiIni($row["aplTaquiIni"]);
        $aplicacion->setTaquiFin($row["aplTaquiFin"]);
        $aplicacion->setTipo($row["aplTipo"]);
        $aplicacion->setPadron($row["aplPadron"]);
        $aplicacion->setHoraIni($row["aplHoraIni"]);
        $aplicacion->setHoraFin($row["aplHoraFin"]);
        $aplicacion->setCultivo($row["aplCultivo"]);
        $aplicacion->setCaudal($row["aplCaudal"]);
        $aplicacion->setImporte($row["aplImporte"]);
        $aplicacion->setDosis($row["aplDosis"]);
        $aplicacion->setHectareas($row["aplHectareas"]);
        $aplicacion->setCliente($cliente);
        return $aplicacion;
    }    
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
}