<?php
namespace Model;
use \Clases\Producto;
class ProductoModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    public function active($object){
        return $this->executeQuery($this->getDeleteQuery(false), $this->getActiveParameter($object));
    }
    protected function getCheckMessage() {
        return "El Producto ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getCodigo()];
    }
    protected function getCheckQuery() {
        return "select * from productos where proCodigo = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getCodigo(), $object->getNombre(), $object->getMarca(),'H'];
    }
    protected function getCreateQuery() {
        return "insert into productos(proCodigo,proNombre,proMarca,proEstado) values(?,?,?,?)";
    }
    protected function getDeleteParameter($object) {
        return ['D',$object->getId()];
    }
    protected function getActiveParameter($object) {
        return ['H',$object->getId()];
    }
    protected function getDeleteQuery($notUsed = true) {
        return "update productos set proEstado = ? where proId = ?";
    }
    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from productos order by proEstado, proId";
        } else {
            return "select * from productos where proNombre like ? order by proEstado, proId";
        }        
    }
    protected function getFindXIdQuery() {
        return "select * from productos where proId = ?";
    }
    protected function getUpdateParameter($object) {
        return [$object->getCodigo(),$object->getNombre(),$object->getMarca(),$object->getId()];
    }
    protected function getUpdateQuery() {
        return "update productos set proCodigo = ?, proNombre = ?, proMarca = ? where proId = ?";
    }
    public function createEntity($row) {
        $producto = new Producto();
        $producto->setId($row['proId']);
        $producto->setCodigo($row['proCodigo']);
        $producto->setNombre($row['proNombre']);
        $producto->setMarca($row['proMarca']);
        $producto->setEstado($row['proEstado']);
        return $producto;
    }
}