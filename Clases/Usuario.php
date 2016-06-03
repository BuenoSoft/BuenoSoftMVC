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
    private $avatar;
    private $estado;
    private $datousu;
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
    function getAvatar() {
        return $this->avatar;
    }
    function getEstado() {
        return $this->estado;
    }
    function getDatoUsu() {
        return $this->datousu;
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
    function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function setDatoUsu($datousu) {
        $this->datousu = $datousu;
    }
    function __construct() { }
    public function equals(Usuario $obj){
        return $this->nombre == $obj->nombre;                
    }
/*---------------------------------------------*/
    public function del() {
        return (new UsuarioModel())->delete($this);
    }
    public function active(){
        return (new UsuarioModel())->active($this);
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
    public function save() {
        return ($this->id == 0) ? (new UsuarioModel())->create($this) : (new UsuarioModel())->update($this); 
    }
    public function login($datos = []){       
        return (new UsuarioModel())->login($datos);
    }
}