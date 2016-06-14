<?php
namespace Model;
use \Clases\Aplicacion;
class AplicacionModel extends AppModel
{
    public function maxId(){
        return $this->fetch("select max(aplId) as maximo from aplicaciones",[])[0]['maximo'];
    }
    public function addApp($object){
        return $this->execute($this->getCreateQuery(),  $this->getCreateParameter($object));
    }   
    protected function getCreateParameter($object) {
        return [
            $object->getCoordCul(), $object->getPista()->getId(), $object->getAreaapl(), $object->getFaja(),
            $object->getFechaIni(), $object->getFechaFin(), $object->getTratamiento(), $object->getViento(), 
            $object->getTipo()->getId(), $object->getTaquiIni(), $object->getTaquiFin(), $object->getPadron(), 
            $object->getCultivo(), $object->getCaudal(), $object->getDosis(), $object->getCliente()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into aplicaciones(aplCoordCul,pisId,aplAreaAplicada,aplFaja,"
            . "aplFechaIni,aplFechaFin,aplTratamiento,aplViento,tpId,aplTaquiIni,"
            . "aplTaquiFin,aplPadron,aplCultivo,aplCaudal,aplDosis,usuId)"
            . "values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    public function modApp($object){
        return $this->execute($this->getUpdateQuery(), $this->getUpdateParameter($object));        
    }
    protected function getUpdateQuery() {
        return "update aplicaciones set aplCoordCul = ?,pisId = ?, aplAreaAplicada = ?, "
            . "aplFaja = ?,aplFechaIni = ?,aplFechaFin = ?,aplTratamiento = ?,aplViento = ?,"
            . "tpId = ?,aplTaquiIni = ?,aplTaquiFin = ?,aplPadron = ?,aplCultivo = ?, "
            . "aplCaudal = ?, aplDosis = ?,usuId = ? where aplId = ?";
    }
    protected function getUpdateParameter($object) {
        return [
            $object->getCoordCul(), $object->getPista()->getId(), $object->getAreaapl(), $object->getFaja(), 
            $object->getFechaIni(),$object->getFechaFin(), $object->getTratamiento(), $object->getViento(), 
            $object->getTipo()->getId(),$object->getTaquiIni(), $object->getTaquiFin(), $object->getPadron(), 
            $object->getCultivo(), $object->getCaudal(),$object->getDosis(), $object->getCliente()->getId(), 
            $object->getId()
        ];
    }    
    
    protected function getFindParameter($criterio = null) {
        return ["filtro" => "%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from aplicaciones a inner join usuarios u on a.usuId = u.usuId "
            . "inner join datosusu d on u.datId = d.datId";
        } else {
            return "select * from aplicaciones a inner join usuarios u on a.usuId = u.usuId "
            . "inner join datosusu d on u.datId = d.datId where d.datDocumento "
            . "like :filtro or d.datNombre like :filtro";
        }
        
    }
    protected function getFindXIdQuery() {
        return "select * from aplicaciones where aplId = ?";
    }    
    public function createEntity($row) {
        $aplicacion = new Aplicacion();
        $aplicacion->setId($row["aplId"]);
        $aplicacion->setCoordCul($row["aplCoordCul"]);
        $aplicacion->setPista((new PistaModel())->findById($row["pisId"]));
        $aplicacion->setAreaapl($row["aplAreaAplicada"]);
        $aplicacion->setFaja($row["aplFaja"]);
        $aplicacion->setFechaIni($row["aplFechaIni"]);
        $aplicacion->setFechaFin($row["aplFechaFin"]);
        $aplicacion->setTratamiento($row["aplTratamiento"]);
        $aplicacion->setViento($row["aplViento"]);
        $aplicacion->setTipo((new TipoProductoModel())->findById($row["tpId"]));
        $aplicacion->setTaquiIni($row["aplTaquiIni"]);
        $aplicacion->setTaquiFin($row["aplTaquiFin"]);
        $aplicacion->setPadron($row["aplPadron"]);
        $aplicacion->setCultivo($row["aplCultivo"]);
        $aplicacion->setCaudal($row["aplCaudal"]);
        $aplicacion->setDosis($row["aplDosis"]);
        $aplicacion->setCliente((new UsuarioModel())->findById($row["usuId"]));
        return $aplicacion;
    }
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
    public function addTra($dates = []){
        return (new TrabajaModel())->addTra($dates);
    }
    public function checkTra($dates = []){
        return (new TrabajaModel())->checkTra($dates);
    }
    public function getTrabajadores($dates = []){
        return (new TrabajaModel())->getTrabajadores($dates);
    }
    public function delTra($dates = []){
        return (new TrabajaModel())->delTra($dates);
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
    public function delUsu($usado){
        return (new UsadoModel())->delUsu($usado);
    }
    /*-------------------------------------------------------------------------------*/
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) { }
    protected function getCheckQuery() { }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }    
}