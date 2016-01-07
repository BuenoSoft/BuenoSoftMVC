<?php
namespace Clases;
class Pago 
{
    private $id;
    private $fecpago;
    private $fecvenc;
    private $monto;
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
    function __construct($xid, $xfecpago, $xfecvenc, $xmonto) {
        $this->id = $xid;
        $this->fecpago = $xfecpago;
        $this->fecvenc = $xfecvenc;
        $this->monto = $xmonto;
    }
}