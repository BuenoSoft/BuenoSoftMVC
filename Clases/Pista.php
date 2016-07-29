<?php
namespace Clases;
use \App\IPersiste;
use \Model\PistaModel;
class Pista implements IPersiste
{
    private $id;
    private $nombre;
    private $coordenadas;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getCoordenadas() {
        return $this->coordenadas;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setCoordenadas($coordenadas) {
        $this->coordenadas = $coordenadas;
    }
    function __construct() { }
    public function equals(Pista $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function getGMDLat(){
        $arr = explode(",", $this->coordenadas);
        $arr[0] *= -1;        
        $sur = explode(".",$arr[0]);
        $p1 = $sur[0];
        $p2= ($arr[0] - $p1) * 60;
        $arrp2 =  explode(".", $p2);
        $p3 = $arrp2[0];
        $p4 = ($p2 - $p3) * 60;
        $p5 = explode(".", $p4);
        return $p1." ".$p3." ".$p5[0];
    }
    public function getGMDLong(){
        $arr = explode(",", $this->coordenadas);
        $arr[1] *= -1;
        $oeste = explode(".",$arr[1]);
        $p1 = $oeste[0];
        $p2= ($arr[1] - $p1) * 60;
        $arrp2 =  explode(".", $p2);
        $p3 = $arrp2[0];
        $p4 = ($p2 - $p3) * 60;
        $p5 = explode(".", $p4);
        return $p1." ".$p3." ".$p5[0];
    }
    /*-----------------------------------------------------*/
    public function del() {
        return (new PistaModel())->delete($this);
    }
    public function find($criterio = null) {
        return (new PistaModel())->find($criterio);
    }
    public function findById($id) {
        return (new PistaModel())->findById($id);
    }
    public function save() {
        return ($this->id == 0) ? (new PistaModel())->create($this) : (new PistaModel())->update($this);  
    }
    public function findByX($x) {
        return (new PistaModel())->findByX($x);
    }
}