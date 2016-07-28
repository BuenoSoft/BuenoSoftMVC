<?php
namespace Clases;
use \App\IPersiste;
use \Model\RolModel;
class Rol implements IPersiste
{
    private $id;
    private $nombre;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function __construct() { }
    public function equals(Rol $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function del() {
        return (new RolModel())->delete($this);
    }
    public function find($criterio = null) {
        return (new RolModel())->find($criterio);
    }
    public function findById($id) {
        return (new RolModel())->findById($id);
    }
    public function save() {
        return ($this->id == 0) ? (new RolModel())->create($this) : (new RolModel())->update($this);
    }
    public function findByX($x) {
        return (new RolModel())->findByX($x);
    }
}