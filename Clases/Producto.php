<?php
namespace Clases;
use \App\IPersiste;
use \Model\ProductoModel;
class Producto implements IPersiste
{
    private $id;
    private $codigo;
    private $nombre;
    private $marca;
    private $tipo;
    function getId() {
        return $this->id;
    }
    function getCodigo() {
        return $this->codigo;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getMarca() {
        return $this->marca;
    }
    function getTipo() {
        return $this->tipo;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setMarca($marca) {
        $this->marca = $marca;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function __construct() { }
    public function equals(Producto $obj){
        return $this->codigo == $obj->codigo;                
    }
    /*---------------------------------------------*/
    public function del() {
        return (new ProductoModel())->delete($this);
    }
    public function checkPro($ap){
        return (new ProductoModel())->checkPro([$ap, $this->id]);
    }
    public function find($criterio = null) {
        return (new ProductoModel())->find($criterio);
    }
    public function findById($id) {
        return (new ProductoModel())->findById($id);
    }
    public function findByTipo($tipo) {
        return (new ProductoModel())->findByTipo($tipo);
    }
    public function findByX($x) {        
        return (new ProductoModel())->findByX($x);
    }
    public function save() {
        return ($this->id == 0) ? (new ProductoModel())->create($this) : (new ProductoModel())->update($this); 
    }
}