<?php
namespace Clases;
use \App\IPersiste;
use \Model\UsuarioModel;
class Usuario implements IPersiste
{
    private $id;
    private $nombre;
    private $pass;
    private $rol;
    private $avatar;
    private $documento;
    private $nomReal;
    private $direccion;
    private $telefono;
    private $celular;
    private $tipo;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getPass() {
        return $this->pass;
    }
    function getRol() {
        return $this->rol;
    }
    function getAvatar() {
        return $this->avatar;
    }
    function getDocumento() {
        return $this->documento;
    }
    function getNomReal() {
        return $this->nomReal;
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
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setPass($pass) {
        $this->pass = $pass;
    }
    function setRol($rol) {
        $this->rol = $rol;
    }
    function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
    function setDocumento($documento) {
        $this->documento = $documento;
    }
    function setNomReal($nomReal) {
        $this->nomReal = $nomReal;
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
    /*---------------------------------------------*/
    function __construct() { }
    public function equals(Usuario $obj){
        return ($this->nombre == $obj->nombre) or ($this->documento == $obj->documento);                
    }
    public function del() {
        return (new UsuarioModel())->delete($this);
    }
    public function funcionarios(){
        return (new UsuarioModel())->funcionarios();
    }
    public function find($criterio = null) {
        return (new UsuarioModel())->find($criterio);
    }
    public function avatar(){
        return (new UsuarioModel())->getAvatar($this);
    }
    public function findById($id) {
        return (new UsuarioModel())->findById($id);
    }
    public function findByNombre($nom) {
        return (new UsuarioModel())->findByNombre($nom);
    }
    public function save() {
        return ($this->id == 0) ? (new UsuarioModel())->create($this) : (new UsuarioModel())->update($this); 
    }
    public function login($datos = []){       
        return (new UsuarioModel())->login($datos);
    }
}