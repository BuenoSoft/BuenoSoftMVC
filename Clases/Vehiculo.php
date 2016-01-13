<?php
namespace Clases;
use \App\IPersiste;
use \Model\VehiculoModel;
class Vehiculo implements IPersiste
{
    private $id;
    private $mat;
    private $precio;
    private $cant;
    private $descrip;
    private $foto;
    private $status;
    private $modelo;
    private $tipo;
    private $xmodelo;
    function getId() {
        return $this->id;
    }
    function getMat() {
        return $this->mat;
    }
    function getPrecio() {
        return $this->precio;
    }
    function getCant() {
        return $this->cant;
    }
    function getDescrip() {
        return $this->descrip;
    }
    function getFoto() {
        return $this->foto;
    }
    function getStatus() {
        return $this->status;
    }
    function getModelo() {
        return $this->modelo;
    }
    function getTipo() {
        return $this->tipo;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setMat($mat) {
        $this->mat = $mat;
    }
    function setPrecio($precio) {
        $this->precio = $precio;
    }
    function setCant($cant) {
        $this->cant = $cant;
    }
    function setDescrip($descrip) {
        $this->descrip = strtoupper($descrip);
    }
    function setFoto($foto) {
        $this->foto = $foto;
    }
    function setStatus($status) {
        $this->status = $status;
    }
    function setModelo($modelo) {
        $this->modelo = $modelo;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function __construct($xid =0, $xmat = null, $xprecio = null, $xcant = null, $xdescrip = null, $xfoto = null, $xstatus = null, $xmodelo = null, $xtipo = null) {
        $this->id = $xid;
        $this->mat = $xmat;
        $this->precio = $xprecio;
        $this->cant = $xcant;
        $this->descrip = strtoupper($xdescrip);
        $this->foto = $xfoto;
        $this->status = $xstatus;
        $this->modelo = $xmodelo;
        $this->tipo = $xtipo;
    }
    public function equals(Vehiculo $obj){
        return $this->mat == $obj->mat;                
    }
    public function quitarStock($xcant){
        if($this->hayStock()){
            $this->cant -= $xcant;
        }
    }
    private function hayStock(){
        return $this->cant >0;
    }
    public function save(){
        $this->xmodelo = new VehiculoModel();
        return ($this->id == 0) ? $this->xmodelo->create($this) : $this->xmodelo->update($this); 
    }
    public function saveImg(){
        $this->xmodelo = new VehiculoModel();
        $this->xmodelo->updateImg($this);
    }
    public function del(){
        $this->xmodelo = new VehiculoModel();
        return $this->xmodelo->eliminame($this);
    }
    public function rec(){
        $this->xmodelo = new VehiculoModel();
        return $this->xmodelo->reactive($this);
    }
    public function find($criterio = null){
        $this->xmodelo = new VehiculoModel();
        return $this->xmodelo->find($criterio); 
    }
    public function findById($id){
        $this->xmodelo = new VehiculoModel();
        return $this->xmodelo->findById($id);
    }
    public function findByModelos($criterio){
        $this->xmodelo = new VehiculoModel();
        return $this->xmodelo->findByModelos($criterio); 
    }
}