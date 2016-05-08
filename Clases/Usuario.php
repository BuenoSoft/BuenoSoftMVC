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
        $this->nombre = strtoupper($nombre);
    }
    function setPass($pass) {
        $this->pass = $pass;
    }
    function setTipo($tipo) {
        $this->tipo = strtoupper($tipo);
    }
    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    function __construct() { }

    public function del() {
        
    }

    public function find($criterio = null) {
        
    }

    public function findById($id) {
        
    }

    public function save() {
        
    }
    public function login($datos = []){       
        return (new UsuarioModel())->login($datos);
    }
}