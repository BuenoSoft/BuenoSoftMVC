<?php
namespace Clases;
use App\IPersiste;
use Model\TipoProductoModel;
class TipoProducto implements IPersiste
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
    public function equals(TipoProducto $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function del() {
        return (new TipoProductoModel())->delete($this);
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
    public function findByX($x) {
        return (new TipoProductoModel())->findByX($x);
    }
}