<?php
namespace Model;
class ZafraModel extends AppModel
{
    public function __construct() {
        parent::__construct();
    }
    /*----------------------------------------------------------------------*/
    private function getAniosQuery(){
        return "select distinct year(a.aplFechaIni) as anio "
            . "from aplicaciones a "
            . "where a.aplFechaIni is not null "
            . "group by a.aplFechaIni "
            . "order by a.aplFechaIni desc";
    }
    public function anioList(){
        $datos = [];
        foreach ($this->fetchValues($this->getAniosQuery()) as $row){
            array_push($datos, $row["anio"]);
        }
        return $datos;
    }
    /*----------------------------------------------------------------------*/
    protected function getCheckDelete($object) { }
    protected function getCheckMessage() { }
    protected function getCheckParameter($unique) { }
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
    public function createEntity($row) { }

}