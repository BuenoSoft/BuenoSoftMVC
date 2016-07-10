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
    private $motor;
    private $chasis;
    private $capcarga;
    private $modelo;
    private $marca;
    private $anio;
    private $estado;
    private $combustible;
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
    function getMotor() {
        return $this->motor;
    }
    function getChasis() {
        return $this->chasis;
    }
    function getCapcarga() {
        return $this->capcarga;
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
    function getEstado() {
        return $this->estado;
    }
    function getCombustible() {
        return $this->combustible;
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
    function setMotor($motor) {
        $this->motor = $motor;
    }
    function setChasis($chasis) {
        $this->chasis = $chasis;
    }
    function setCapcarga($capcarga) {
        $this->capcarga = $capcarga;
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
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function setCombustible($combustible) {
        $this->combustible = $combustible;
    }
    function __construct() { }
    public function equals(Vehiculo $obj){
        return $this->matricula == $obj->matricula;                
    }
    public function checkCap($capacidad){
        return $capacidad <= $this->capcarga;
    }
    /*------------------------------------------*/
    public function del() {
        return (new VehiculoModel())->delete($this);
    }
    public function checkUsu($ap){
        return (new VehiculoModel())->checkUsu([$ap,$this->id]);
    }
    public function checkFin(){
        return (new VehiculoModel())->checkAplFin($this);
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
    public function save() {
        return ($this->id == 0) ? (new VehiculoModel())->create($this) : (new VehiculoModel())->update($this); 
    }
}