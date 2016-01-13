<?php
namespace Clases;
use \App\IPersiste;
use \Model\UsuarioModel;
class Usuario implements IPersiste
{
    private $id;
    private $nick;
    private $pass;
    private $correo;
    private $nombre;
    private $apellido;
    private $status;
    private $rol;
    private $modelo;
    function getId() {
        return $this->id;
    }
    function getNick() {
        return $this->nick;
    }
    function getPass() {
        return $this->pass;
    }
    function getCorreo() {
        return $this->correo;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getApellido() {
        return $this->apellido;
    }
    function getStatus() {
        return $this->status;
    }
    function getRol() {
        return $this->rol;
    }
    function setNick($nick) {
        $this->nick = $nick;
    }
    function setPass($pass) {
        $this->pass = $pass;
    }
    function setCorreo($correo) {
        $this->correo = $correo;
    }
    function setNombre($nombre) {
        $this->nombre = strtoupper($nombre);
    }
    function setApellido($apellido) {
        $this->apellido = strtoupper($apellido);
    }
    function setStatus($status) {
        $this->status = $status;
    }
    function setRol($rol) {
        $this->rol = $rol;
    }
    function __construct($xid = 0, $xnick = null, $xpass = null, $xcorreo = null, $xnombre = null, $xapellido = null, $xstatus = null, $xrol = null) {
        $this->id = $xid;
        $this->nick = $xnick;
        $this->pass = $xpass;
        $this->correo = $xcorreo;
        $this->nombre = strtoupper($xnombre);
        $this->apellido = strtoupper($xapellido);
        $this->status = $xstatus;
        $this->rol = $xrol;
    }
    public function equals(Usuario $obj){
        return $this->nick == $obj->nick;                
    }  
    public function save(){
        $this->modelo = new UsuarioModel();
        return ($this->id == 0) ? $this->modelo->create($this) : $this->modelo->update($this); 
    }
    public function del(){
        $this->modelo = new UsuarioModel();
        return $this->modelo->delete($this);
    }
    public function rec(){
        $this->modelo = new UsuarioModel();
        return $this->modelo->reactive($this);
    }
    public function find($criterio = null){
        $this->modelo = new UsuarioModel();
        return $this->modelo->find($criterio); 
    }
    public function findById($id){
        $this->modelo = new UsuarioModel();
        return $this->modelo->findById($id);
    }
    public function findByLogin($dates = array()){
        $this->modelo = new UsuarioModel();
        return $this->modelo->findBylogin($dates);
    }
}