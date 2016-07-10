<?php
namespace Clases;
use \App\IPersiste;
use \Model\TipoVehiculoModel;
class TipoVehiculo implements IPersiste
{
    private $id;
    private $nombre;
    private $medida;
    private $estado;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getMedida() {
        return $this->medida;
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
    function setMedida($medida) {
        $this->medida = $medida;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function __construct() { }
    public function equals(TipoVehiculo $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function del() {
        return (new TipoVehiculoModel())->delete($this);
    }
    public function find($criterio = null) {
        return (new TipoVehiculoModel())->find();
    }
    public function findById($id) {
        return (new TipoVehiculoModel())->findById($id);
    }
    public function save() {
        return ($this->id == 0) ? (new TipoVehiculoModel())->create($this) : (new TipoVehiculoModel())->update($this); 
    }
    public function findByX($x) {
        return (new TipoVehiculoModel())->findByX($x);
    }
}