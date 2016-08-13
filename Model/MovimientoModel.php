<?php
namespace Model;
use \App\Session;
use \Clases\Movimiento;
class MovimientoModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }    
    public function addMov($object){
        if($object->getEmisor() != null){
            if($object->getEmisor()->getCapcarga() < $object->getCantidad()){
                Session::set("msg",Session::msgDanger("El stock emisor no cuenta con suficiente capacidad"));
                return false;
            } else {
                return $this->execute($this->getCreateQuery(), $this->getCreateParameter($object));
            }
        } else if($object->getEmisor() == null){
            if($object->getReceptor()->getCombustible()->getStock() < $object->getCantidad()){
                Session::set("msg",Session::msgDanger("El stock emisor no cuenta con suficiente capacidad"));
                return false;
            } else {
                return $this->execute($this->getCreateQuery(), $this->getCreateParameter($object));
            }
        }               
    }
    protected function getCreateParameter($object) {
        return [
            $this->changeVeh($object)->getId(),$object->getFecha(),$object->getCantidad(),
            $this->checkEmisor($object),$this->checkReceptor($object),$object->getUsuario()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into movimientos(comId,movFecha,movCant,vehEmi,vehRec,usuId) values (?,?,?,?,?,?)";
    }
    private function changeVeh($object){
        if($object->getEmisor() != null){
            return $object->getEmisor()->getCombustible();
        } else {
            return $object->getReceptor()->getCombustible();
        }
    }
    private function checkEmisor($object){
        return ($object->getEmisor() == null) ? NULL : $object->getEmisor()->getId();
    }
    private function checkReceptor($object){
        return ($object->getReceptor() == null) ? NULL : $object->getReceptor()->getId();
    }
    /*-------------------------------------------------------------------------------*/
    public function delMov($object){
        return $this->execute($this->getDeleteQuery(), $this->getDeleteParameter($object));
    }
    protected function getDeleteParameter($object) {
        return [$this->changeVeh($object)->getId(),$object->getFecha()];
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from movimientos where comId = ? and movFecha = ?";
    }
    /*-------------------------------------------------------------------------------*/
    public function getMovimientos($comb){
        return $this->fetch($this->getMovimientosQuery(), $this->getMovimientosParam($comb));
    }
    public function getMovimientosQuery(){ 
        return "select * from movimientos where comId = ?";
    }
    public function getMovimientosParam($comb){ 
        return [$comb];
    }
    /*-------------------------------------------------------------------------------*/
    public function createEntity($row) {
        $mov = new Movimiento();
        $mov->setFecha($row["movFecha"]);
        $mov->setCantidad($row["movCant"]);
        $mov->setEmisor((new VehiculoModel())->findById($row["vehEmi"]));
        $mov->setReceptor((new VehiculoModel())->findById($row["vehRec"]));
        $mov->setUsuario((new UsuarioModel())->findById($row["usuId"]));
        return $mov;
    }
    /*-------------------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) { }
    protected function getFindQuery($criterio = null) { }
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) {}
    protected function getCheckQuery() {}
    protected function getFindXIdQuery() { }
    protected function getUpdateParameter($object) { }
    protected function getUpdateQuery() { }
}