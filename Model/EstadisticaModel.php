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
    //Esta es la de Horas de vuelo por Persona. Osea va como la primera parte, la primera grafica
    private function getListHsXPiloto(){
        return "select distinct month(a.aplFechaIni) as mes, year(a.aplFechaIni)as anio, "
            . "sum((a.aplTaquiFin-a.aplTaquiIni)+v.vehHorasRec) as horas,u.usuNomReal as piloto "
            . "from usuarios u "
            . "inner join aplicaciones a on a.usuPiloto = u.usuId "
            . "inner join vehiculos v on a.vehAero = v.vehId "
            . "where a.aplFechaIni is not null and year(a.aplFechaIni) = year(now()) and a.aplTaquiIni > 0 " 
            . "group by month(a.aplFechaIni), a.usuPiloto "
            . "order by u.usuNomReal";
    }
    public function listHsXPiloto(){
        $datos = [];
        foreach ($this->fetchValues($this->getListHsXPiloto()) as $row){
            $dato = [];
            $dato[0]= $row["mes"];
            $dato[1]= $row["anio"];
            $dato[2]= $row["horas"];
            $dato[3]= $row["piloto"];
            //En efecto, pero esta el problema de que debe verse en una misma linea varios nombres de piloto
            array_push($datos, $dato);
        }
        return $datos;
    }
    private function getListHsXVehiculo(){
        return "select distinct month(a.aplFechaIni) as mes, year(a.aplFechaIni)as anio, " 
            . "sum((a.aplTaquiFin-a.aplTaquiIni)+v.vehHorasRec) as horas,v.vehMatricula as aeronave " 
            . "from vehiculos v inner join aplicaciones a on a.vehAero = v.vehId "
            . "where a.aplFechaIni is not null and year(a.aplFechaIni) = year(now()) and a.aplTaquiIni > 0 "
            . "group by month(a.aplFechaIni), a.vehAero "
            . "order by v.vehMatricula";
    }
    public function listHsXVehiculo(){
        $datos = [];
        foreach ($this->fetchValues($this->getListHsXVehiculo()) as $row){
            $dato = [];
            $dato[0]= $row["mes"];
            $dato[1]= $row["anio"];
            $dato[2]= $row["horas"];
            $dato[3]= $row["aeronave"];
            //En efecto, pero esta el problema de que debe verse en una misma linea varios nombres de piloto
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
