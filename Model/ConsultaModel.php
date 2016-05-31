<?php
namespace Model;
class ConsultaModel extends AppModel
{
    public function periodo($opcion){
        if($opcion == "d"){
            return $this->periodoDias();
        } else if( $opcion == "m"){
            return $this->periodoMeses();
        } else {
            return $this->periodoAnios();
        }
    }
    private function periodoDias(){
        $datos= array();
        $consulta = $this->fetch("select * from aplicaciones where date(aplFechaIni) = date(now())");
        foreach($consulta as $row){
            $app = (new AplicacionModel())->createEntity($row);
            array_push($datos, $app);          
        }
        return $datos;
    }
    private function periodoMeses(){
        $datos= array();
        $consulta = $this->fetch("select * from aplicaciones where month(aplFechaIni) = month(now()) and year(aplFechaIni) = year(now())");
        foreach($consulta as $row){
            $app = (new AplicacionModel())->createEntity($row);
            array_push($datos, $app);          
        }
        return $datos;
    }
    private function periodoAnios(){
        $datos= array();
        $consulta = $this->fetch("select * from aplicaciones where year(aplFechaIni) = year(now())");
        foreach($consulta as $row){
            $app = (new AplicacionModel())->createEntity($row);
            array_push($datos, $app);          
        }
        return $datos;
    }
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