<?php
namespace Model;
use \Clases\Rol;
class RolModel extends AppModel
{
    function __construct() {
        parent::__construct();
    }
    public function findByX($x) {        
        return $this->findByCondition($this->getCheckQuery(), [$x]);
    }
    /*------------------------------------------------------------------------------------*/
    protected function getCheckMessage() {
        return "El rol ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from roles where rolNombre = ?";
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getCreateParameter($object) {
        return [$object->getNombre()];
    }
    protected function getCreateQuery() {
        return "insert into roles(rolNombre) values (?)";
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getDeleteParameter($object) {
        return [$object->getId()];        
    }
    protected function getDeleteQuery($notUsed = true) {
        $sql ="delete from roles where rolId = ?";
        if($notUsed){
            $sql .= "and rolId not in (select distinct rolId from usuarios)";
        }
        return $sql;
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getFindParameter($criterio = null) {
        return [$criterio];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from roles order by rolNombre";
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getUpdateParameter($object) {
        return [$object->getNombre(),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update roles set rolNombre = ? where rolId = ?";        
    }
    /*------------------------------------------------------------------------------------*/    
    protected function getFindXIdQuery() {
        return "select * from roles where rolId = ?";
    }
    public function createEntity($row) {
        $rol = new Rol();
        $rol->setId($row["rolId"]);
        $rol->setNombre($row["rolNombre"]);
        return $rol;
    }
}