<?php
namespace Clases;
use \App\IPersiste;
use \Model\RolModel;
class Rol implements IPersiste 
{
    private $id;
    private $nombre;
    private $modelo;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }    
    function setNombre($nombre) {
        $this->nombre = strtoupper($nombre);
    }
    function __construct($xid = 0, $xnombre = null) {
        $this->id = $xid;
        $this->nombre = strtoupper($xnombre);
    }
    public function equals(Rol $obj) {
        return $this->nombre == $obj->nombre;                
    }
    public function save(){
        $this->modelo = new RolModel();
        return ($this->id == 0) ? $this->modelo->create($this) : $this->modelo->update($this); 
    }
    public function del(){
        $this->modelo = new RolModel();
        return $this->modelo->delete($this);
    }
    public function find($criterio = null){
        $this->modelo = new RolModel();
        return $this->modelo->find();
    }
    public function findById($id){
        $this->modelo = new RolModel();
        return $this->modelo->findById($id);
    }
}