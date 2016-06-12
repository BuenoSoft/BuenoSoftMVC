<?php
namespace Clases;
use App\IPersiste;
use Model\TipoProductoModel;
class TipoProducto implements IPersiste
{
    private $id;
    private $nombre;
    private $estado;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
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
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function __construct() { }
    public function equals(TipoProducto $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function del() {
        return (new TipoProductoModel())->delete($this);
    }
    public function active() {
        return (new TipoProductoModel())->active($this);
    }
    public function find($criterio = null) {
        return (new TipoProductoModel())->find($criterio);
    }
    public function findById($id) {
        return (new TipoProductoModel())->findById($id);
    }
    public function save() {
        return ($this->id == 0 ) ? (new TipoProductoModel())->create($this) : (new TipoProductoModel())->update($this);
    }
}