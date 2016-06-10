<?php
namespace Model;
use \Clases\Pista;
class PistaModel extends AppModel
{
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
        return [$object->getNombre(), $object->getCoordenadas()];
    }
    protected function getCreateQuery() {
        return "insert into pistas(pisNombre,pisCoord) values(?,?)";
    }    
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from pistas";
        } else {
            return "select * from pistas where pisNombre like ?";         
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
        return $pista;
    }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }

}