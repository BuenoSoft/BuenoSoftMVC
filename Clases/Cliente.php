<?php
namespace Clases;
use \App\IPersiste;
use \Model\ClienteModel;
class Cliente implements IPersiste
{
    private $id;
    private $ruc;
    private $nombre;
    private $dirnombre;
    private $dirnumero;
    private $telefono;
    private $celular;
    function getId() {
        return $this->id;
    }

    function getRuc() {
        return $this->ruc;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDirnombre() {
        return $this->dirnombre;
    }

    function getDirnumero() {
        return $this->dirnumero;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCelular() {
        return $this->celular;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRuc($ruc) {
        $this->ruc = $ruc;
    }

    function setNombre($nombre) {
        $this->nombre = strtoupper($nombre);
    }

    function setDirnombre($dirnombre) {
        $this->dirnombre = strtoupper($dirnombre);
    }

    function setDirnumero($dirnumero) {
        $this->dirnumero = $dirnumero;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function __construct() { }
    /*---------------------------*/
    public function save() {
        return ($this->id == 0) ? (new ClienteModel())->create($this) : (new ClienteModel())->update($this);
    }        
    public function findById($id) {
        return (new ClienteModel())->findById($id);
    }
    public function del() { }
    public function find($criterio = null) { }
}