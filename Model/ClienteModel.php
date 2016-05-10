<?php
namespace Model;
use \Clases\Cliente;
class ClienteModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
    }
    public function maxId(){
        return $this->fetch("select max(cliId) as maximo from clientes",[])[0]['maximo'];
    }
    protected function getCheckMessage() {
        return "El Cliente ya existe";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getRuc()];
    }
    protected function getCheckQuery() {
        return "select * from clientes where cliRUC = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getRuc(),$object->getNombre(),$object->getDireccion(),$object->getTelefono(), $object->getCelular()  ];
    }
    protected function getCreateQuery() {
        return "insert into clientes(cliRUC,cliNombre,cliDireccion, cliTelefono, cliCelular) values(?,?,?,?,?)";
    }

    
    
    protected function getUpdateParameter($object) { 
        
    }
    protected function getUpdateQuery() { 
        
    }
    
    protected function getFindXIdQuery() {
        return "select * from clientes where cliId = ?";
    }
    
    public function createEntity($row) {
        $cliente = new Cliente();
        $cliente->setId($row['cliId']);
        $cliente->setRuc($row['cliRUC']);
        $cliente->setNombre($row['cliNombre']);
        $cliente->setDireccion($row['cliDireccion']);
        $cliente->setTelefono($row['cliTelefono']);
        $cliente->setCelular($row['cliCelular']);
        return $cliente;
    }
    
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
    protected function getFindParameter($criterio = null) { }
    protected function getFindQuery($criterio = null) { }    
}