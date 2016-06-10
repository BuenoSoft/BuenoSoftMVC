<?php
namespace Clases;
use App\IPersiste;
class TipoVehiculo implements IPersiste
{
    private $id;
    private $nombre;
    private $medida;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getMedida() {
        return $this->medida;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setMedida($medida) {
        $this->medida = $medida;
    }
    function __construct() { }
    public function equals(TipoVehiculo $obj){
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