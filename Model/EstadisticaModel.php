<?php
namespace Model;
class EstadisticaModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    private function getListQuery(){
        return "select  month(aplFechaIni) as mes, year(aplFechaIni) as anio, count(aplFechaIni) as cantMes  from aplicaciones where year(aplFechaIni) = year(now()) group by month(aplFechaIni)";
    }
    public function lists(){
        $datos = [];
        foreach ($this->fetchValues($this->getListQuery()) as $row){
            $dato = [];
            $dato[0]= $row["mes"];
            $dato[1]= $row["anio"];
            $dato[2]= $row["cantMes"];
            array_push($datos, $dato);
        }
        return $datos;
    }
    public function createEntity($row) { }
    protected function getCheckMessage() {}
    protected function getCheckParameter($unique) {}
    protected function getCheckQuery() { }
    protected function getCreateParameter($object) { }
    protected function getCreateQuery() { }
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
    protected function getFindParameter($criterio = null) { }
    protected function getFindQuery($criterio = null) { }
    protected function getFindXIdQuery() { }
    protected function getUpdateParameter($object) { }
    protected function getUpdateQuery() { }
    
}