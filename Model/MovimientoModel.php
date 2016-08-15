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
        if($object->getComEmi() != null){
            if(!$object->getComEmi()->hayStock($object->getCantidad())){
                Session::set("msg",Session::msgDanger("El stock emisor no cuenta con suficiente capacidad"));
                return false;
            } else {
                return $this->execute($this->getCreateQuery(), $this->getCreateParameter($object));
            }
        } else {
            if($object->getVehEmi() != null){
                if($object->getVehEmi()->getCapcarga() < $object->getCantidad()){
                    Session::set("msg",Session::msgDanger("El stock emisor no cuenta con suficiente capacidad"));
                    return false;
                } else {
                    return $this->execute($this->getCreateQuery(), $this->getCreateParameter($object));
                }
            }
        }        
    }
    protected function getCreateParameter($object) {
        return [
            $object->getFecha(),$object->getCantidad(), $this->checkComEmisor($object),
            $this->checkComReceptor($object), $this->checkVehEmisor($object), 
            $this->checkVehReceptor($object), $object->getUsuario()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into movimientos(movFecha,movCant,comEmi,comRec,vehEmi,vehRec,usuId) values (?,?,?,?,?,?,?)";
    }
    private function checkComEmisor($object){
        return ($object->getComEmi() == null) ? NULL : $object->getComEmi()->getId();
    }
    private function checkComReceptor($object){
        return ($object->getComRec() == null) ? NULL : $object->getComRec()->getId();
    }
    private function checkVehEmisor($object){
        return ($object->getVehEmi() == null) ? NULL : $object->getVehEmi()->getId();
    }
    private function checkVehReceptor($object){
        return ($object->getVehRec() == null) ? NULL : $object->getVehRec()->getId();
    }
    /*-------------------------------------------------------------------------------*/
    protected function getDeleteParameter($object) {
        return [$object->getId()];
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from movimientos where movId = ?";
    }
    /*-------------------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) { 
        return ["filtro" => "%".$criterio."%"];       
    }
    protected function getFindQuery($criterio = null) { 
        if($criterio == null){
            return "select * from movimientos order by movFecha";
        } else {
            return "select * from movimientos m "
            . "left join combustibles ce on m.comEmi = ce.comId "
            . "left join combustibles cr on m.comRec = cr.comId "
            . "left join vehiculos ve on m.vehEmi = ve.vehId "
            . "left join vehiculos vr on m.vehRec = vr.vehId "        
            . "where ce.comNombre like :filtro or "
            . "cr.comNombre like :filtro or "
            . "ve.vehMatricula like :filtro or "
            . "vr.vehMatricula like :filtro "
            . "order by m.movFecha";         
        }
    }
    /*-------------------------------------------------------------------------------*/
    protected function getFindXIdQuery() { 
        return "select * from movimientos where movId = ?";
    }
    public function createEntity($row) {
        $mov = new Movimiento();
        $mov->setId($row["movId"]);
        $mov->setFecha($row["movFecha"]);
        $mov->setCantidad($row["movCant"]);
        $mov->setComEmi((new CombustibleModel())->findById($row["comEmi"]));
        $mov->setComRec((new CombustibleModel())->findById($row["comRec"]));
        $mov->setVehEmi((new VehiculoModel())->findById($row["vehEmi"]));
        $mov->setVehRec((new VehiculoModel())->findById($row["vehRec"]));
        $mov->setUsuario((new UsuarioModel())->findById($row["usuId"]));
        return $mov;
    }
    /*-------------------------------------------------------------------------------*/    
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) {}
    protected function getCheckQuery() {}    
    protected function getUpdateParameter($object) { }
    protected function getUpdateQuery() { }
}