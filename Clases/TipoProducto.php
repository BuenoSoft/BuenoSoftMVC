<?php
namespace Clases;
use App\IPersiste;
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
        
    }

    public function find($criterio = null) {
        
    }

    public function findById($id) {
        
    }

    public function save() {
        
    }
}
