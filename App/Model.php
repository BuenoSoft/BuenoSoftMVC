<?php
namespace App;
use \PDO;
use \Exception;
use \App\Session;
abstract class Model implements IModel
{
    protected $db;
    function __construct() {
        $this->db = new Database();
    }
    protected function getBD(){
        return $this->db->getConnect();
    }    
    protected function execute($query, $parameter = []){
        try {
            $consulta = $this->getBD()->prepare($query);
            $consulta->execute($parameter);  
            return ($consulta->rowCount() > 0) ? true  : false;         
        }  catch (Exception $ex){
            //echo $ex->getMessage();
        }
    }
    protected function findByCondition($query, $parameter = []) {
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
    protected function fetchValues($query, $parameter = []){
        $consulta = $this->getBD()->prepare($query);
        $consulta->execute($parameter);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function fetch($query, $parameter = []){
        $datos= array();
        $consulta = $this->getBD()->prepare($query);
        $consulta->execute($parameter);        
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $obj = $this->createEntity($row); 
            array_push($datos, $obj);
        }
        return $datos;
    }
    /*------------------------------------------------------------------------*/
    private function check($unique) { 
        return $this->execute($this->getCheckQuery(), $this->getCheckParameter($unique));
    }
    /*------------------------------------------------------------------------*/
    public function create($object) {
        if($this->check($object)){
            Session::set('msg', Session::msgDanger($this->getCheckMessage()));
            return false;
        }
        $ok = $this->execute($this->getCreateQuery(), $this->getCreateParameter($object));
        if($ok){
            return true;
        } else {
            Session::set('msg', Session::msgDanger($this->getCheckMessage()));
            return false;
        }
    }
    /*------------------------------------------------------------------------*/    
    public function update($object) {
        $aux = $this->findById($object->getId()); 
        if(!$object->equals($aux)){
            if($this->check($object)){
                Session::set('msg', Session::msgDanger($this->getCheckMessage()));
                return false;
            }        
        }
        $ok = $this->execute($this->getUpdateQuery(), $this->getUpdateParameter($object)); 
        if($ok){
            return true;
        } else {
            Session::set('msg', Session::msgDanger($this->getCheckMessage()));
            return false;
        }
    }
    /*------------------------------------------------------------------------*/
    public function delete($object, $notUsed = true) {        
        return $this->execute($this->getDeleteQuery($notUsed), $this->getDeleteParameter($object));        
    }
    /*--------------------------------------------------------------------*/
    public function find($criterio = null) {
       return $this->fetch($this->getFindQuery($criterio), $this->getFindParameter($criterio));
    }
    /*--------------------------------------------------------------------*/
    public function findById($id) {        
        return $this->findByCondition($this->getFindXIdQuery(), [$id]);
    }
    /*--------------------------------------------------------------------*/    
    abstract protected function getCheckQuery();
    abstract protected function getCheckParameter($unique);
    abstract protected function getCheckMessage();
    abstract protected function getCreateQuery();
    abstract protected function getCreateParameter($object);    
    abstract protected function getUpdateQuery();
    abstract protected function getUpdateParameter($object);    
    abstract protected function getDeleteQuery($notUsed = true);
    abstract protected function getDeleteParameter($object);
    abstract protected function getFindQuery($criterio = null);
    abstract protected function getFindParameter($criterio = null);    
    abstract protected function getFindXIdQuery();
    abstract function createEntity($row);
}