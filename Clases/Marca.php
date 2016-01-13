<?php
namespace Clases;
use \App\IPersiste;
use \Model\MarcaModel;
class Marca implements IPersiste
{
    private $id;
    private $nombre;
    private $modelo;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }    
    function setNombre($nombre) {
        $this->nombre = strtoupper($nombre);
    }
    function __construct($xid = 0, $xnombre = null) {
        $this->id = $xid;
        $this->nombre = strtoupper($xnombre);
    }
    public function equals(Marca $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function save(){
        $this->modelo = new MarcaModel();
        return ($this->id == 0) ? $this->modelo->create($this) : $this->modelo->update($this); 
    }
    public function del(){
        $this->modelo = new MarcaModel();
        return $this->modelo->delete($this);
    }
    public function find($criterio = null){
        $this->modelo = new MarcaModel();
        return $this->modelo->find($criterio); 
    }
    public function findById($id){
        $this->modelo = new MarcaModel();
        return $this->modelo->findById($id);
    }
}