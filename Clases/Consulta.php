<?php
namespace Clases;
use \App\IPersiste;
use \Model\ConsultaModel;
class Consulta implements IPersiste
{
    private $modelo;
    function __construct() {
        $this->modelo = new ConsultaModel();
    }
    public function cons1ByDay($user_id){
        return $this->modelo->cons1ByDay($user_id);
    }
    public function cons1ByMonth($user_id){
        return $this->modelo->cons1ByMonth($user_id);
    }
    public function cons1ByYear($user_id){
        return $this->modelo->cons1ByYear($user_id);
    }
    public function cons2($user_id){
        return $this->modelo->cons2($user_id); 
    }
    public function cons3($fec_ini,$fec_fin,$user_id){
        return $this->modelo->cons3($fec_ini, $fec_fin, $user_id); 
    }
    public function cons4($user_id){
        return $this->modelo->cons4($user_id);
    }
    public function del() { }
    public function find($criterio = null) { }
    public function findById($id) { }
    public function save() { }
}