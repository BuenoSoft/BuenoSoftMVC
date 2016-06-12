<?php
namespace Model;
use \Clases\Pista;
class PistaModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    public function active($object){
        return $this->executeQuery($this->getDeleteQuery(false), $this->getActiveParameter($object));
    }
    protected function getCheckMessage() {
        return "Esta pista ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from pistas where pisNombre = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getNombre(), $object->getCoordenadas(),'H'];
    }
    protected function getCreateQuery() {
        return "insert into pistas(pisNombre,pisCoord,pisEstado) values(?,?,?)";
    }    
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from pistas order by pisEstado, pisId";
        } else {
            return "select * from pistas where pisNombre like ? order by pisEstado, pisId";         
        }
    }
    protected function getFindXIdQuery() {
        return "select * from pistas where pisId = ?";
    }
    protected function getUpdateParameter($object) {
        return [$object->getNombre(), $object->getCoordenadas(), $object->getId()];
    }
    protected function getUpdateQuery() {
        return "update pistas set pisNombre = ?, pisCoord = ? where pisId = ?";
    }
    public function createEntity($row) {
        $pista = new Pista();
        $pista->setId($row["pisId"]);
        $pista->setNombre($row["pisNombre"]);
        $pista->setCoordenadas($row["pisCoord"]);
        $pista->setEstado($row["pisEstado"]);
        return $pista;
    }
    protected function getDeleteParameter($object) {
        return ['D',$object->getId()];
    }
    protected function getActiveParameter($object) {
        return ['H',$object->getId()];
    }
    protected function getDeleteQuery($notUsed = true) { 
        return "update pistas set pisEstado = ? where pisId = ?";
    }
}