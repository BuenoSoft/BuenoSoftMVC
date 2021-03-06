<?php
namespace Clases;
use \App\IPersiste;
use \Model\CombustibleModel;
class Combustible implements IPersiste
{
    private $id;
    private $nombre;
    private $stock;
    private $stockMin;
    private $stockMax;
    private $fecUC;
    private $tipo;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getStock() {
        return $this->stock;
    }
    function getStockMin() {
        return $this->stockMin;
    }
    function getStockMax() {
        return $this->stockMax;
    }
    function getFecUC() {
        return $this->fecUC;
    }    
    function getTipo() {
        return $this->tipo;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setStock($stock) {
        $this->stock = $stock;
    }
    function setStockMin($stockMin) {
        $this->stockMin = $stockMin;
    }
    function setStockMax($stockMax) {
        $this->stockMax = $stockMax;
    }
    function setFecUC($fecUC) {
        $this->fecUC = $fecUC;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function __construct() { }
    public function equals(Combustible $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function mostrarDateTime(){
        $date = date_create($this->fecUC);
        return date_format($date, "Y-m-d\TH:i:s");
    }
    /*----------------------------------------*/    
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
    /*---------------------------------------*/
    public function regla3(){
        return round(($this->stock * 100) / $this->stockMax);
    }
    public function regla3Min(){
         return round(($this->stockMin * 100) / $this->stockMax);
    }
    public function isDown(){
        return $this->stock <= $this->stockMin;
    }
    public function isMedium(){
       return $this->regla3() > $this->regla3Min() and $this->regla3() < 60;
    }
    public function restaCombustible(){
        return 100 - $this->regla3();
    }
    public function restaGrafica(){
        return $this->getStockMax() - $this->getStock();
    }
    public function isExcellent(){
        return $this->regla3() >= 60 and $this->regla3() <= 100;
    }
    /*---------------------------------------*/
    public function del() {
        return (new CombustibleModel())->delete($this);
    }
    public function find($criterio = null) {
        return (new CombustibleModel())->find($criterio);
    }
    public function findById($id) {
        return (new CombustibleModel())->findById($id);
    }
    public function save() {
        return ($this->id == 0) ? (new CombustibleModel())->create($this) : (new CombustibleModel())->update($this);
    }
    public function findByX($x) {        
        return (new CombustibleModel())->findByX($x);
    }
}