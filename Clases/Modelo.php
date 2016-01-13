<?php
namespace Clases;
use \App\IPersiste;
use \Model\ModeloModel;
class Modelo implements IPersiste
{
    private $id;
    private $nombre;
    private $marca;
    private $modelo;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getMarca() {
        return $this->marca;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNombre($nombre) {
        $this->nombre = strtoupper($nombre);
    }
    function setMarca($marca) {
        $this->marca = $marca;
    }
    function __construct($xid =0, $xnombre = null, $xmarca= null) {
        $this->id = $xid;
        $this->nombre = strtoupper($xnombre);
        $this->marca = $xmarca;
    }
    public function equals(Modelo $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function save(){
        $this->modelo = new ModeloModel();
        return ($this->id == 0) ? $this->modelo->create($this) : $this->modelo->update($this); 
    }
    public function del(){
        $this->modelo = new ModeloModel();
        return $this->modelo->delete($this);
    }
    public function find($criterio = null){
        $this->modelo = new ModeloModel();
        return $this->modelo->find($criterio); 
    }
    public function findById($id){
        $this->modelo = new ModeloModel();
        return $this->modelo->findById($id);
    }
    public function findByMarcas($criterio){
        $this->modelo = new ModeloModel();
        return $this->modelo->findByMarcas($criterio); 
    }
}