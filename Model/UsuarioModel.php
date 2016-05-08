<?php
namespace Model;
use \Clases\Usuario;
class UsuarioModel extends AppModel
{
    function __construct() {
        parent::__construct();
    }
    public function login($datos = []){
        return $this->findByCondition($this->getLoginQuery(), $this->getLoginParameter($datos));
    }
    private function getLoginQuery(){
        return "select * from usuarios where usuNombre = ? and usuPass = ?";
    }
    private function getLoginParameter($datos = []){  
        return [$datos[0], md5($datos[1])];
    }
    protected function getCheckMessage() {
        
    }

    protected function getCheckParameter($unique) {
        
    }

    protected function getCheckQuery() {
        
    }

    protected function getCreateParameter($object) {
        
    }

    protected function getCreateQuery() {
        
    }

    protected function getDeleteParameter($object) {
        
    }

    protected function getDeleteQuery($notUsed = true) {
        
    }

    protected function getFindParameter($criterio = null) {
        
    }

    protected function getFindQuery($criterio = null) {
        
    }

    protected function getFindXIdQuery() {
        
    }

    protected function getUpdateParameter($object) {
        
    }

    protected function getUpdateQuery() {
        
    }

    public function createEntity($row) {
        $cliente = (new ClienteModel())->findById($row['cliId']);
        $usuario = new Usuario();
        $usuario->setId($row['usuId']);
        $usuario->setNombre($row['usuNombre']);
        $usuario->setPass($row['usuPass']);
        $usuario->setTipo($row['usuTipo']);
        $usuario->setCliente($cliente);
        return $usuario;
    }
}