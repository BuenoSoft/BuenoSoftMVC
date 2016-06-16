<?php
namespace Model;
use \Clases\Aplicacion;
class AplicacionModel extends AppModel
{
    public function maxId(){
        return $this->fetch("select max(aplId) as maximo from aplicaciones",[])[0]['maximo'];
    }
    public function addApp($object){
        return $this->execute($this->getCreateQuery(),  $this->getCreateParameter($object));
    }   
    protected function getCreateParameter($object) {
        return [
            $object->getCoordCul(), $object->getPista()->getId(), $object->getAreaapl(), $object->getFaja(),
            $object->getFechaIni(), $object->getFechaFin(), $object->getTratamiento(), $object->getViento(), 
            $object->getTipo()->getId(), $object->getTaquiIni(), $object->getTaquiFin(), $object->getPadron(), 
            $object->getCultivo(), $object->getCaudal(), $object->getDosis(), $object->getCliente()->getId()
        ];
    }
    protected function getCreateQuery() {
        return "insert into aplicaciones(aplCoordCul,pisId,aplAreaAplicada,aplFaja,"
            . "aplFechaIni,aplFechaFin,aplTratamiento,aplViento,tpId,aplTaquiIni,"
            . "aplTaquiFin,aplPadron,aplCultivo,aplCaudal,aplDosis,usuId)"
            . "values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    }
    /*------------------------------------------------------------------------------------*/
    public function modApp($object){
        return $this->execute($this->getUpdateQuery(), $this->getUpdateParameter($object));        
    }
    protected function getUpdateQuery() {
        return "update aplicaciones set aplCoordCul = ?,pisId = ?, aplAreaAplicada = ?, "
            . "aplFaja = ?,aplFechaIni = ?,aplFechaFin = ?,aplTratamiento = ?,aplViento = ?,"
            . "tpId = ?,aplTaquiIni = ?,aplTaquiFin = ?,aplPadron = ?,aplCultivo = ?, "
            . "aplCaudal = ?, aplDosis = ?,usuId = ? where aplId = ?";
    }
    protected function getUpdateParameter($object) {
        return [
            $object->getCoordCul(), $object->getPista()->getId(), $object->getAreaapl(), $object->getFaja(), 
            $object->getFechaIni(),$object->getFechaFin(), $object->getTratamiento(), $object->getViento(), 
            $object->getTipo()->getId(),$object->getTaquiIni(), $object->getTaquiFin(), $object->getPadron(), 
            $object->getCultivo(), $object->getCaudal(),$object->getDosis(), $object->getCliente()->getId(), 
            $object->getId()
        ];
    }
    public function findAdvance($datos = []){
        $rows= array();
        foreach($this->fetch($this->getFindQueryAdvance($datos), $this->getFindParameterAdvance($datos)) as $row){
            $obj = $this->createEntity($row); 
            array_push($rows, $obj);
        }
        return $rows;
    }
    protected function getFindParameterAdvance($datos = []) {
        return $datos;
    }
    
    protected function getFindQueryAdvance($datos = []){
        $where = false;
        $sql= "select *,a.usuId as cliente,uv.usuId as piloto from aplicaciones a "
            . "inner join utiliza uv on a.aplId = uv.aplId "
            . "inner join usuarios u on uv.usuId = u.usuId and u.rolId = 4";
        if($datos["aeronave"] != null){
            $sql .= " where uv.vehId = ?";
            $where = true;
        }
        if($datos["piloto"] != null){
            if($where){
                $sql .= " and uv.usuId = ?";
            } else {
                $sql .= " where uv.usuId = ?";
                $where = true;
            }
        }
        if($datos["tipo"] != null){
            if($where){
                $sql .= " and a.tpId = ?";
            } else {
                $sql .= " where a.tpId = ?";
                $where = true;
            }
        }
        if($datos["cliente"] != null){
            if($where){
                $sql .= " and a.usuId = ?";
            } else {
                $sql .= " where a.usuId = ?";
                $where = true;
            }
        }
        if($datos["fec1"] != null and $datos["fec2"] != null){
            if($where){
                $sql .= " and date(a.aplFechaIni) between date(?) and date(?)";
            } else {
                $sql .= " where date(a.aplFechaIni) between date(?) and date(?)";
                $where = true;
            }
        }
        return $sql;
    }
    protected function getFindXIdQuery() {
        return "select * from aplicaciones where aplId = ?";
    }    
    public function createEntity($row) {
        $aplicacion = new Aplicacion();
        $aplicacion->setId($row["aplId"]);
        $aplicacion->setCoordCul($row["aplCoordCul"]);
        $aplicacion->setPista((new PistaModel())->findById($row["pisId"]));
        $aplicacion->setAreaapl($row["aplAreaAplicada"]);
        $aplicacion->setFaja($row["aplFaja"]);
        $aplicacion->setFechaIni($row["aplFechaIni"]);
        $aplicacion->setFechaFin($row["aplFechaFin"]);
        $aplicacion->setTratamiento($row["aplTratamiento"]);
        $aplicacion->setViento($row["aplViento"]);
        $aplicacion->setTipo((new TipoProductoModel())->findById($row["tpId"]));
        $aplicacion->setTaquiIni($row["aplTaquiIni"]);
        $aplicacion->setTaquiFin($row["aplTaquiFin"]);
        $aplicacion->setPadron($row["aplPadron"]);
        $aplicacion->setCultivo($row["aplCultivo"]);
        $aplicacion->setCaudal($row["aplCaudal"]);
        $aplicacion->setDosis($row["aplDosis"]);
        $aplicacion->setCliente((new UsuarioModel())->findById($row["cliente"]));
        return $aplicacion;
    }
    /*-------------------------------------------------------------------------------*/
    public function addPro($dates = []){
        return (new TieneModel())->addPro($dates);
    }
    public function checkPro($dates = []){
        return (new TieneModel())->checkPro($dates);
    }
    public function getProductos($dates = []){
        return (new TieneModel())->getProductos($dates);
    }
    public function delPro($dates = []){
        return (new TieneModel())->delPro($dates);
    }
    /*-------------------------------------------------------------------------------*/
    public function addUsu($usado) {
        return (new UsadoModel())->addUsu($usado);    
    }
    public function getUsados($dates = []){
        return (new UsadoModel())->getUsados($dates);
    }
    public function delUsu($usado){
        return (new UsadoModel())->delUsu($usado);
    }
    /*-------------------------------------------------------------------------------*/
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) { }
    protected function getCheckQuery() { }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
    protected function getFindQuery($criterio = null) { }
    protected function getFindParameter($criterio = null) { }
}