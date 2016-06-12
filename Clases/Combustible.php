<?php
namespace Clases;
use \App\IPersiste;
use \Model\CombustibleModel;
class Combustible implements IPersiste
{
    private $id;
    private $nombre;
    private $stock;
    private $fecha;
    private $tipo;
    private $estado;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getStock() {
        return $this->stock;
    }
    function getFecha() {
        return $this->fecha;
    }
    function getTipo() {
        return $this->tipo;
    }
    function getEstado() {
        return $this->estado;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setStock($stock) {
        $this->stock = $stock;
    }
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function __construct() { }
    public function equals(Combustible $obj){
        return $this->nombre == $obj->nombre;                
    }
    /*---------------------------------------*/
    public function del() {
        return ($this->estado == "H") ? (new CombustibleModel())->delete($this) : (new CombustibleModel())->active($this);
    }
    public function find($criterio = null) {
        return (new CombustibleModel())->find($criterio);
    }
    public function findById($id) {
        return (new CombustibleModel())->findById($id);
    }
    public function findByTipo($tipo) {
        return (new CombustibleModel())->findByTipo($tipo);
    }
    public function save() {
        return ($this->id == 0) ? (new CombustibleModel())->create($this) : (new CombustibleModel())->update($this);
    }
}