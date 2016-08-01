<?php
namespace Clases;
class Movimiento 
{
    private $fecha;
    private $cantidad;
    private $emisor;
    private $receptor;
    private $usuario;
    function getFecha() {
        return $this->fecha;
    }
    function getCantidad() {
        return $this->cantidad;
    }
    function getEmisor() {
        return $this->emisor;
    }
    function getReceptor() {
        return $this->receptor;
    }
    function getUsuario() {
        return $this->usuario;
    }
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    function setEmisor($emisor) {
        $this->emisor = $emisor;
    }
    function setReceptor($receptor) {
        $this->receptor = $receptor;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    function __construct() { }
}