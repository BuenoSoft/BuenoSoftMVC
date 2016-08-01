<?php
namespace Model;
use \Clases\Movimiento;
class MovimientoModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    public function addMov($object){
       return $this->execute($this->getCreateQuery(), $this->getCreateParameter($object)); 
    }
    protected function getCreateParameter($object) {
        return [
            $object->getEmisor()->getCombustible()->getId(),$object->getFecha(),$object->getCantidad(),
            $object->getEmisor()->getId(),$object->getReceptor()->getId(),$object->getUsuario()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into movimientos(comId,movFecha,movCant,vehEmi,vehRec,usuId) values (?,?,?,?,?,?)";
    }
    /*-------------------------------------------------------------------------------*/
    public function delMov($object){
        return $this->execute($this->getDeleteQuery(), $this->getDeleteParameter($object));
    }
    protected function getDeleteParameter($object) {
        return [$object->getEmisor()->getCombustible()->getId(),$object->getFecha()];
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