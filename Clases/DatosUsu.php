<?php
namespace Clases;
use \App\IPersiste;
use \Model\DatosUsuModel;
class DatosUsu implements IPersiste
{
    private $id;
    private $documento;
    private $nombre;
    private $direccion;
    private $telefono;
    private $celular;
    private $tipo;
    function getId() {
        return $this->id;
    }
    function getDocumento() {
        return $this->documento;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getDireccion() {
        return $this->direccion;
    }
    function getTelefono() {
        return $this->telefono;
    }
    function getCelular() {
        return $this->celular;
    }
    function getTipo() {
        return $this->tipo;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setDocumento($documento) {
        $this->documento = $documento;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }       
    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    function setCelular($celular) {
        $this->celular = $celular;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function __construct() { }
    public function equals(DatosUsu $obj){
        return $this->documento == $obj->documento;                
    }
    /*---------------------------*/
    public function save() {
        return ($this->id == 0) ? (new DatosUsuModel())->create($this) : (new DatosUsuModel())->update($this);
    }        
    public function findById($id) {
        return (new DatosUsuModel())->findById($id);
    }
    public function maxID(){
        return (new DatosUsuModel())->maxId();
    }
    public function del() { }
    public function find($criterio = null) { }
}