<?php
namespace Model;
use \Clases\Rol;
class RolModel extends AppModel
{
    function __construct() {
        parent::__construct();
    }
    protected function getCheckMessage() {
        return "El rol ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from roles where rolNombre = ?";
    }    
    protected function getCreateParameter($object) {
        return [$object->getNombre(),"H"];
    }
    protected function getCreateQuery() {
        return "insert into roles(rolNombre,rolEstado) values (?,?)";
    }
    protected function getDeleteParameter($object) {
        if($object->getEstado() == "H"){
            return ['D',$object->getId()];
        } else {
            return ['H',$object->getId()];
        }
    }
    protected function getDeleteQuery($notUsed = true) {
        return "update roles set rolEstado = ? where rolId = ?";
    }
    protected function getFindParameter($criterio = null) {
        return [$criterio];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from roles order by rolEstado, rolId";
    }
    protected function getFindXIdQuery() {
        return "select * from roles where rolId = ?";
    }
    protected function getUpdateParameter($object) {
        return [$object->getNombre(),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update roles set rolNombre = ? where rolId = ?";        
    }
    public function createEntity($row) {
        $rol = new Rol();
        $rol->setId($row["rolId"]);
        $rol->setNombre($row["rolNombre"]);
        $rol->setEstado($row["rolEstado"]);
        return $rol;
    }
}