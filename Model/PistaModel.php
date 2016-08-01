<?php
namespace Model;
use \Clases\Pista;
class PistaModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    public function findByX($x) {        
        return $this->findByCondition($this->getCheckQuery(), [$x]);
    }
    /*------------------------------------------------------------------------------------*/
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
        return [$object->getNombre(), $object->getCoordenadas(), $object->getCliente()->getId()];
    }
    protected function getCreateQuery() {
        return "insert into pistas(pisNombre,pisCoord,usuId) values(?,?,?)";
    }    
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from pistas order by pisNombre";
        } else {
            return "select * from pistas where pisNombre like ? order by pisNombre";         
        }
    }
    protected function getFindXIdQuery() {
        return "select * from pistas where pisId = ?";
    }
    protected function getUpdateParameter($object) {
        return [$object->getNombre(), $object->getCoordenadas(), $object->getCliente()->getId(), $object->getId()];
    }
    protected function getUpdateQuery() {
        return "update pistas set pisNombre = ?, pisCoord = ?, usuId = ? where pisId = ?";
    }
    public function createEntity($row) {
        $pista = new Pista();
        $pista->setId($row["pisId"]);
        $pista->setNombre($row["pisNombre"]);
        $pista->setCoordenadas($row["pisCoord"]);
        $pista->setCliente((new UsuarioModel())->findById($row["usuId"]));
        return $pista;
    }
    protected function getDeleteParameter($object) {
        return [$object->getId()];        
    }
    protected function getDeleteQuery($notUsed = true) { 
        return "delete from pistas where pisId = ?";
    }
}