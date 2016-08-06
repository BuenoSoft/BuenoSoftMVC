<?php
namespace Model;
use \Clases\Producto;
class ProductoModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    public function findByX($x) {        
        return $this->findByCondition("select * from productos where proNombre = ?", [$x]);
    }
    /*---------------------------------------------------------------------*/
    public function checkPro($dates = []) {
        return $this->execute($this->getCheckProQuery(),$this->getCheckTieneParameter($dates));
    } 
    private function getCheckTieneParameter($dates = []) {
        return [$dates[0],$dates[1]];
    }
    private function getCheckProQuery() {
        return "select * from tiene where aplId = ? and proId = ?";
    } 
    /*---------------------------------------------------------------------*/
    public function findByTipo($tipo){
        return $this->fetch("select * from productos where tpId = ?", [$tipo]);
    }
    /*---------------------------------------------------------------------*/
    protected function getCheckMessage() {
        return "El Producto ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getCodigo()];
    }
    protected function getCheckQuery() {
        return "select * from productos where proCodigo = ?";
    }
    /*---------------------------------------------------------------------*/
    protected function getCreateParameter($object) {
        return [$object->getCodigo(), $object->getNombre(), $object->getMarca(),$object->getTipo()->getId()];
    }
    protected function getCreateQuery() {
        return "insert into productos(proCodigo,proNombre,proMarca,tpId) values(?,?,?,?)";
    }
    /*---------------------------------------------------------------------*/
    protected function getDeleteParameter($object) {
        return [$object->getId()];        
    }
    protected function getDeleteQuery($notUsed = true) {
        $sql ="delete from productos where proId = ?";
        if($notUsed){
            $sql .="and proId not in (select distinct proId from tiene)";
        }
        return $sql;
    }
    /*---------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from productos order by proNombre";
        } else {
            return "select * from productos where proNombre like ? order by proNombre";
        }        
    }
    /*---------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [$object->getCodigo(),$object->getNombre(),$object->getMarca(),$object->getTipo()->getId(),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update productos set proCodigo = ?, proNombre = ?, proMarca = ?, tpId = ? where proId = ?";
    }
    /*---------------------------------------------------------------------*/
    protected function getFindXIdQuery() {
        return "select * from productos where proId = ?";
    }
    public function createEntity($row) {
        $producto = new Producto();
        $producto->setId($row['proId']);
        $producto->setCodigo($row['proCodigo']);
        $producto->setNombre($row['proNombre']);
        $producto->setMarca($row['proMarca']);
        $producto->setTipo((new TipoProductoModel())->findById($row["tpId"]));
        return $producto;
    }
}