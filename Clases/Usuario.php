<?php
namespace Clases;
class Usuario 
{
    private $id;
    private $nick;
    private $pass;
    private $correo;
    private $nombre;
    private $apellido;
    private $status;
    private $rol;
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
    function __construct($xid, $xnick, $xpass, $xcorreo, $xnombre, $xapellido, $xstatus, $xrol) {
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
}