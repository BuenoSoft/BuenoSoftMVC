<?php
namespace Clases;
use \App\IPersiste;
use \Model\ConsultaModel;
class Consulta implements IPersiste 
{
    function __construct() { }
    public function periodo($opcion){
        return (new ConsultaModel())->periodo($opcion);
    }

    public function del() { }
    public function find($criterio = null) { }
    public function findById($id) { }
    public function save() { }
}