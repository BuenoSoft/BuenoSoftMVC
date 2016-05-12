<?php
namespace Clases;
use \App\IPersiste;
use \Model\SujetoModel;
class Sujeto implements IPersiste
{
    private $id;
    private $documento;
    private $nombre;
    private $direccion;
    private $telefono;
    private $celular;
    private $tiposuj;
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
    function getTiposuj() {
        return $this->tiposuj;
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
    function setTiposuj($tiposuj) {
        $this->tiposuj = $tiposuj;
    }
    function __construct() { }
    public function equals(Sujeto $obj){
        return $this->documento == $obj->documento;                
    }
    /*---------------------------*/
    public function save() {
        return ($this->id == 0) ? (new SujetoModel())->create($this) : (new SujetoModel())->update($this);
    }        
    public function findById($id) {
        return (new SujetoModel())->findById($id);
    }
    public function maxID(){
        return (new SujetoModel())->maxId();
    }
    public function del() { }
    public function find($criterio = null) { }
}