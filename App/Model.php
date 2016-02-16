<?php
/**
 * Description of Model
 *
 * @author detectivejd
 */
namespace App;
use \PDO;
use \App\Session;
abstract class Model implements IModel
{
    protected $db;
    function __construct() {
        $this->db = new Database();
    }
    public function getBD(){
        return $this->db->getConnect();
    }
    /*------------------------------------------------------------------------*/       
    protected function executeQuery($query, $parameter = array()){
        $consulta = $this->getBD()->prepare($query);
        $consulta->execute($parameter);  
        return ($consulta->rowCount() > 0) ? "Ok"  : null;
    }
    protected function findByCondition($query, $parameter = array()) {
        $consulta = $this->getBD()->prepare($query);
        $consulta->execute($parameter);
        if($consulta->rowCount() > 0) {
            $res= $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            return $this->createEntity($res); 
        }
        else {
            return null;
        }
    }
    protected function fetch($query, $parameter = array()){
        $consulta = $this->getBD()->prepare($query);
        $consulta->execute($parameter);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    /*------------------------------------------------------------------------*/
    private function check($unique) { 
        $consulta = $this->fetch(
            $this->getCheckQuery(),
            $this->getCheckParameter($unique)     
        );
        return ($consulta) > 0; 
    }
    abstract protected function getCheckQuery();
    abstract protected function getCheckParameter($unique);
    abstract protected function getCheckMessage();
    /*------------------------------------------------------------------------*/
    public function create($object) {
        if($this->check($object)){
            Session::set('msg', $this->getCheckMessage());
            return null;
        }
        return $this->executeQuery($this->getCreateQuery(), $this->getCreateParameter($object));
    }
    abstract protected function getCreateQuery();
    abstract protected function getCreateParameter($object);
    /*------------------------------------------------------------------------*/    
    public function update($object) {
       $aux = $this->findById($object->getId()); 
        if(!$object->equals($aux)){
            if($this->check($object)){
                Session::set('msg', $this->getCheckMessage());
                return null;
            }        
        }
        return $this->executeQuery($this->getUpdateQuery(), $this->getUpdateParameter($object)); 
    }
    abstract protected function getUpdateQuery();
    abstract protected function getUpdateParameter($object);
    /*------------------------------------------------------------------------*/
    public function delete($object, $notUsed = true) {
        return $this->executeQuery($this->getDeleteQuery($notUsed), $this->getDeleteParameter($object)); 
    }
    abstract protected function getDeleteQuery($notUsed = true);
    abstract protected function getDeleteParameter($object);
    /*--------------------------------------------------------------------*/
    public function find($criterio = null) {
        $datos= array();
        $consulta = $this->getBD()->prepare($this->getFindQuery($criterio));
        $consulta->execute($this->getFindParameter($criterio)); 
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $obj = $this->createEntity($row); 
            array_push($datos, $obj);
        }
        return $datos;
    }
    abstract protected function getFindQuery($criterio = null);
    abstract protected function getFindParameter($criterio = null);
    /*--------------------------------------------------------------------*/
    public function findById($id) {        
        return $this->findByCondition($this->getFindXIdQuery(), array($id));
    }
    abstract protected function getFindXIdQuery();
    /*--------------------------------------------------------------------*/    
    abstract function createEntity($row);
}