<?php
namespace Clases;
use \App\IPersiste;
use \Model\VehiculoModel;
class Vehiculo implements IPersiste
{
    private $id;
    private $matricula;
    private $padron;
    private $tipo;
    private $capcarga;
    private $stock;
    private $modelo;
    private $marca;
    private $anio;
    private $taquiDif;
    private $horasRec;
    function getId() {
        return $this->id;
    }
    function getMatricula() {
        return $this->matricula;
    }
    function getPadron() {
        return $this->padron;
    }
    function getTipo() {
        return $this->tipo;
    }
    function getCapcarga() {
        return $this->capcarga;
    }
    function getStock() {
        return $this->stock;
    }
    function getModelo() {
        return $this->modelo;
    }
    function getMarca() {
        return $this->marca;
    }
    function getAnio() {
        return $this->anio;
    }
    function getTaquiDif() {
        return $this->taquiDif;
    }
    function getHorasRec() {
        return $this->horasRec;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }
    function setPadron($padron) {
        $this->padron = $padron;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function setCapcarga($capcarga) {
        $this->capcarga = $capcarga;
    }
    function setStock($stock) {
        $this->stock = $stock;
    }
    function setModelo($modelo) {
        $this->modelo = $modelo;
    }
    function setMarca($marca) {
        $this->marca = $marca;
    }
    function setAnio($anio) {
        $this->anio = $anio;
    }
    function setTaquiDif($taquiDif) {
        $this->taquiDif = $taquiDif;
    }
    function setHorasRec($horasRec) {
        $this->horasRec = $horasRec;
    }
    /*------------------------------------------*/    
    function __construct() { }
    public function equals(Vehiculo $obj){
        return $this->matricula == $obj->matricula;                
    }
    public function addStock($cant){
        $this->stock += $cant;
        $this->save();
    }
    public function delStock($cant){
        if($this->hayStock($cant)){            
            $this->stock -= $cant;
            $this->save();
            return true;
        } else {
            return false;
        }
    }
    public function hayStock($cant){
        return $this->stock >= $cant;
    }
    public function addTaqui($cant){
        $this->taquiDif += $cant;
        $this->change();
    }
    /*------------------------------------------*/
    public function del() {
        return (new VehiculoModel())->delete($this);
    }
    public function find($criterio = null) {
        return (new VehiculoModel())->find($criterio);
    }
    public function findById($id) {
        return (new VehiculoModel())->findById($id);
    }
    public function findByMat($mat) {
        return (new VehiculoModel())->findByMat($mat);
    }
    public function change() {
        return (new VehiculoModel())->modTaquiDif($this);
    }
    public function save() {
        return ($this->id == 0) ? (new VehiculoModel())->create($this) : (new VehiculoModel())->update($this); 
    }
}