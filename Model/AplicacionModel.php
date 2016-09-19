<?php
namespace Model;
use \Clases\Aplicacion;
class AplicacionModel extends AppModel
{
    public function maxId(){
        return $this->fetchValues("select max(aplId) as maximo from aplicaciones",[])[0]['maximo'];
    }
    public function addApp($object){
        return $this->execute($this->getCreateQuery(),  $this->getCreateParameter($object));
    }   
    protected function getCreateParameter($object) {
        return [
            $object->getCoordCul(), $this->checkPista($object), $object->getAreaapl(), $object->getFaja(),
            $object->getFechaIni(), $object->getFechaFin(), $object->getTratamiento(), $object->getViento(), 
            $this->checkTipo($object), $object->getTaquiIni(), $object->getTaquiFin(), $object->getPadron(), 
            $object->getCultivo(), $object->getCaudal(), $object->getAvatar(),$object->getCliente()->getId(),
            $this->checkPiloto($object),$this->checkChofer($object),$this->checkAero($object),
            $this->checkTerr($object)
        ];
    }
    protected function getCreateQuery() {
        return "insert into aplicaciones(aplCoordCul,pisId,aplAreaAplicada,aplFaja,"
            . "aplFechaIni,aplFechaFin,aplTratamiento,aplViento,tpId,aplTaquiIni,"
            . "aplTaquiFin,aplPadron,aplCultivo,aplCaudal,aplAvatar,usuId,usuPiloto,"
            . "usuChofer,vehAero,vehTerr) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    }
    private function checkPista($object){
        return ($object->getPista() == null) ? NULL : $object->getPista()->getId();
    }
    private function checkPiloto($object){
        return ($object->getPiloto() == null) ? NULL : $object->getPiloto()->getId();
    }
    private function checkChofer($object){
        return ($object->getChofer() == null) ? NULL : $object->getChofer()->getId();
    }
    private function checkAero($object){
        return ($object->getAeronave() == null) ? NULL : $object->getAeronave()->getId();
    }
    private function checkTerr($object){
        return ($object->getTerrestre() == null) ? NULL : $object->getTerrestre()->getId();
    }
    private function checkTipo($object){
        return ($object->getTipo() == null) ? NULL : $object->getTipo()->getId();
    }
    /*------------------------------------------------------------------------------------*/
    public function modApp($object){
        return $this->execute($this->getUpdateQuery(), $this->getUpdateParameter($object));        
    }
    protected function getUpdateQuery() {
        return "update aplicaciones set aplCoordCul = ?,pisId = ?, aplAreaAplicada = ?, "
            . "aplFaja = ?,aplFechaIni = ?,aplFechaFin = ?,aplTratamiento = ?,aplViento = ?,"
            . "tpId = ?,aplTaquiIni = ?,aplTaquiFin = ?,aplPadron = ?,aplCultivo = ?, "
            . "aplCaudal = ?,aplAvatar = ?, usuId = ?,usuPiloto = ?,usuChofer = ?,"
            . "vehAero = ?,vehTerr = ? where aplId = ?";
    }
    protected function getUpdateParameter($object) {
        return [
            $object->getCoordCul(), $object->getPista()->getId(), $object->getAreaapl(), $object->getFaja(), 
            $object->getFechaIni(),$object->getFechaFin(), $object->getTratamiento(), $object->getViento(), 
            $object->getTipo()->getId(),$object->getTaquiIni(), $object->getTaquiFin(), $object->getPadron(), 
            $object->getCultivo(), $object->getCaudal(), $object->getAvatar(), $object->getCliente()->getId(),
            $object->getPiloto()->getId(),$object->getChofer()->getId(),$object->getAeronave()->getId(),
            $object->getTerrestre()->getId(),$object->getId()
        ];
    }
    /*------------------------------------------------------------------------------------*/
    public function getAvatar($object){
        return $this->execute($this->getAvatarQuery(), $this->getAvatarParameter($object));
    }
    public function getAvatarQuery(){
        return "update aplicaciones set aplAvatar = ? where aplId = ?";
    }
    public function getAvatarParameter($object){
        return [$object->getAvatar(), $object->getId()];
    }
    /*------------------------------------------------------------------------------------*/
    public function findAdvance($datos = []){                
        return $this->fetch($this->getFindQueryAdvance($datos), $this->getFindParameterAdvance($datos));
    }
    protected function getFindParameterAdvance($datos = []) {
        $rows = array();
        if($datos["aeronave"] != null){
            array_push($rows, (new VehiculoModel())->findByMat($datos["aeronave"])->getId());
        }                
        if($datos["piloto"] != null){
            array_push($rows, (new UsuarioModel())->findByNombre($datos["piloto"])->getId());
        }
        if($datos["tipo"] != null){
            array_push($rows, (new TipoProductoModel())->findByX($datos["tipo"])->getId());
        }
        if($datos["cliente"] != null){
            array_push($rows, (new UsuarioModel())->findByNombre($datos["cliente"])->getId());
        }
        if($datos["fec1"] != null and $datos["fec2"] != null){
            array_push($rows, $datos["fec1"]);
            array_push($rows, $datos["fec2"]);
        }
        return $rows;
    }   
    protected function getFindQueryAdvance($datos = []){                
        $where = false;
        $sql= "select * from aplicaciones a";
        if($datos["aeronave"] != null){
            $sql .= " where a.vehAero = ?";
            $where = true;
        }
        if($datos["piloto"] != null){
            if($where){
                $sql .= " and a.usuPiloto = ?";
            } else {
                $sql .= " where a.usuPiloto = ?";
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
        $sql .= " order by a.aplFechaIni desc";
        return $sql;
    }
    /*------------------------------------------------------------------------------------*/
    protected function getTotQueryAdvance($datos = []){                
        $where = false;
        $sql= "select sum(a.aplAreaAplicada) as tothec,sum(IF(a.aplTaquiIni > 0 and a.aplTaquiFin > 0, (a.aplTaquiFin-a.aplTaquiIni),0)) as horas "
                . "from aplicaciones a inner join vehiculos v on a.vehAero = v.vehId";
        if($datos["aeronave"] != null){
            $sql .= " where a.vehAero = ?";
            $where = true;
        }
        if($datos["piloto"] != null){
            if($where){
                $sql .= " and a.usuPiloto = ?";
            } else {
                $sql .= " where a.usuPiloto = ?";
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
        $sql .= " order by a.aplFechaIni desc";
        return $sql;
    }
    public function totAdvance($datos = []){
        $tot = [];
        array_push($tot, $this->fetchValues($this->getTotQueryAdvance($datos), $this->getFindParameterAdvance($datos))[0]['tothec']);
        array_push($tot, $this->fetchValues($this->getTotQueryAdvance($datos), $this->getFindParameterAdvance($datos))[0]['horas']);
        return $tot;
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindXIdQuery() {
        return "select * from aplicaciones where aplId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getDeleteParameter($object) { 
        return [$object->getId()];
    }
    protected function getDeleteQuery($notUsed = true) { 
        return "delete from aplicaciones where aplId = ?";
    }
    protected function getCheckDelete($object) {
        return true;
    }
    /*------------------------------------------------------------------------------------*/
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
        $aplicacion->setAvatar($row["aplAvatar"]);
        $aplicacion->setCliente((new UsuarioModel())->findById($row["usuId"]));
        $aplicacion->setPiloto((new UsuarioModel())->findById($row["usuPiloto"]));
        $aplicacion->setChofer((new UsuarioModel())->findById($row["usuChofer"]));
        $aplicacion->setAeronave((new VehiculoModel())->findById($row["vehAero"]));
        $aplicacion->setTerrestre((new VehiculoModel())->findById($row["vehTerr"]));
        return $aplicacion;
    }
    /*-------------------------------------------------------------------------------*/
    public function addTiene($tiene){
        return (new TieneModel())->addTiene($tiene);
    }
    public function checkTiene($tiene){
        return (new TieneModel())->checkTiene($tiene);
    }
    public function getTiene($id){
        return (new TieneModel())->getTiene($id);
    }
    public function delTiene($id){
        return (new TieneModel())->delTiene($id);
    }
    /*-------------------------------------------------------------------------------*/
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) { }
    protected function getCheckQuery() { }  
    protected function getFindQuery($criterio = null) { }
    protected function getFindParameter($criterio = null) { }
}