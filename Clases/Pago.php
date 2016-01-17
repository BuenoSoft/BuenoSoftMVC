<?php
namespace Clases;
class Pago {
    private $id;
    private $fecpago;
    private $fecvenc;
    private $monto;
    private $cuotas;
    function getId() {
        return $this->id;
    }
    function getFecpago() {
        return $this->fecpago;
    }
    function getFecvenc() {
        return $this->fecvenc;
    }
    function getMonto() {
        return $this->monto;
    }
    function setFecpago($fecpago) {
        $this->fecpago = $fecpago;
    }
    function setFecvenc($fecvenc) {
        $this->fecvenc = $fecvenc;
    }
    function setMonto($monto) {
        $this->monto = $monto;
    }
    function getCuotas() {
        return $this->cuotas;
    }
    function setCuotas($cuotas) {
        $this->cuotas = $cuotas;
    }
    function __construct($id, $fecpago, $fecvenc, $monto, $cuotas) {
        $this->id = $id;
        $this->fecpago = $fecpago;
        $this->fecvenc = $fecvenc;
        $this->monto = $monto;
        $this->cuotas = $cuotas;
    }
}