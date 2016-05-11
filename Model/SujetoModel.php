<?php
namespace Model;
use \Clases\Sujeto;
class SujetoModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    public function maxId(){
        return $this->fetch("select max(sujId) as maximo from sujetos",[])[0]['maximo'];
    }
    protected function getCheckMessage() {
        return "El Sujeto ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getDocumento()];
    }
    protected function getCheckQuery() {
        return "select * from sujetos where sujDocumento = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getDocumento(),$object->getNombre(),$object->getDireccion(),$object->getTelefono(), $object->getCelular(),$object->getTipoSuj()];
    }
    protected function getCreateQuery() {
        return "insert into sujetos(sujDocumento,sujNombre,sujDireccion,sujTelefono,sujCelular,sujTipoSuj) values(?,?,?,?,?,?)";
    }        
    protected function getUpdateParameter($object) { 
        
    }
    protected function getUpdateQuery() { 
        
    }
    
    protected function getFindXIdQuery() {
        return "select * from sujetos where sujId = ?";
    }
    
    public function createEntity($row) {
        $sujeto = new Sujeto();
        $sujeto->setId($row['sujId']);
        $sujeto->setDocumento($row['sujDocumento']);
        $sujeto->setNombre($row['sujNombre']);
        $sujeto->setDireccion($row['sujDireccion']);
        $sujeto->setTelefono($row['sujTelefono']);
        $sujeto->setCelular($row['sujCelular']);
        $sujeto->setTiposuj($row['sujTipoSuj']);
        return $sujeto;
    }
    
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
    protected function getFindParameter($criterio = null) { }
    protected function getFindQuery($criterio = null) { }    
}