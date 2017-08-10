<?php
namespace Clases;
class Tiene 
{
    private $apl;
    private $producto;
    private $dosis;
    function getApl() {
        return $this->apl;
    }    
    function getProducto() {
        return $this->producto;
    }
    function getDosis() {
        return $this->dosis;
    }
    function setApl($apl) {
        $this->apl = $apl;
    }
    function setProducto($producto) {
        $this->producto = $producto;
    }
    function setDosis($dosis) {
        $this->dosis = $dosis;
    }
    function __construct() { }
}
