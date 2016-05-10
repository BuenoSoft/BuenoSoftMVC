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
        return "El Usuario ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from usuarios where usuNombre = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getNombre(), md5($object->getPass()), $object->getTipo(), $object->getCliente()->getId()];
    }
    protected function getCreateQuery() {
        return "insert into usuarios(usuNombre,usuPass,usuTipo,cliId) values(?,?,?,?)"; 
    }
    protected function getDeleteParameter($object) {
        
    }

    protected function getDeleteQuery($notUsed = true) {
        
    }

    protected function getFindParameter($criterio = null) {
        return ["%".$criterio."%"];
    }

    protected function getFindQuery($criterio = null) {
        return "select * from usuarios where usuNombre like ?";
    }

    protected function getFindXIdQuery() {
        return "select * from usuarios where usuId = ?";
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