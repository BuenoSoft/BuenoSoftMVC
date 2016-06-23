<?php
namespace Model;
use \Clases\DatosUsu;
class DatosUsuModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    public function maxId(){
        return $this->fetchValues("select max(datId) as maximo from datosusu",[])[0]['maximo'];
    }
    protected function getCheckMessage() {
        return "El Dato de ese usuario ya existe.";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getDocumento()];
    }
    protected function getCheckQuery() {
        return "select * from datosusu where datDocumento = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getDocumento(),$object->getNombre(),$object->getDireccion(),$object->getTelefono(), $object->getCelular(),$object->getTipo()];
    }
    protected function getCreateQuery() {
        return "insert into datosusu(datDocumento,datNombre,datDireccion,datTelefono,datCelular,datTipo) values(?,?,?,?,?,?)";
    }        
    protected function getUpdateParameter($object) { 
        return [$object->getDocumento(), $object->getNombre(), $object->getDireccion(), $object->getTelefono(), $object->getCelular(), $object->getTipo(), $object->getId()];
    }
    protected function getUpdateQuery() { 
       return "update datosusu set datDocumento = ?,datNombre = ?,datDireccion = ?,datTelefono = ?,datCelular = ?,datTipo = ? where datId = ?"; 
    }    
    protected function getFindXIdQuery() {
        return "select * from datosusu where datId = ?";
    }    
    public function createEntity($row) {
        $datousu = new DatosUsu();
        $datousu->setId($row['datId']);
        $datousu->setDocumento($row['datDocumento']);
        $datousu->setNombre($row['datNombre']);
        $datousu->setDireccion($row['datDireccion']);
        $datousu->setTelefono($row['datTelefono']);
        $datousu->setCelular($row['datCelular']);
        $datousu->setTipo($row['datTipo']);
        return $datousu;
    }
    
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
    protected function getFindParameter($criterio = null) { }
    protected function getFindQuery($criterio = null) { }    
}