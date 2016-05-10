<?php
namespace Clases;
use \App\IPersiste;
use \Model\UsuarioModel;
class Usuario implements IPersiste
{
    private $id;
    private $nombre;
    private $pass;
    private $tipo;
    private $cliente;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getPass() {
        return $this->pass;
    }
    function getTipo() {
        return $this->tipo;
    }
    function getCliente() {
        return $this->cliente;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setPass($pass) {
        $this->pass = $pass;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    function __construct() { }

    public function del() {
        
    }

    public function find($criterio = null) {
        return (new UsuarioModel())->find($criterio);
    }

    public function findById($id) {
        return (new UsuarioModel())->findById($id);
    }

    public function save() {
        return ($this->id == 0) ? (new UsuarioModel())->create($this) : (new UsuarioModel())->update($this); 
    }
    public function login($datos = []){       
        return (new UsuarioModel())->login($datos);
    }
}