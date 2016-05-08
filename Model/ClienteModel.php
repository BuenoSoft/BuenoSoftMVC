<?php
namespace Model;
use \Clases\Cliente;
class ClienteModel extends AppModel 
{
    public function __construct() {
        parent::__construct();
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
        $cliente->setDirnombre($row['cliDirNombre']);
        $cliente->setDirnumero($row['cliDirNumero']);
        $cliente->setTelefono($row['cliTelefono']);
        $cliente->setCelular($row['cliCelular']);
        return $cliente;
    }
    
    protected function getDeleteParameter($object) { }
    protected function getDeleteQuery($notUsed = true) { }
    protected function getFindParameter($criterio = null) { }
    protected function getFindQuery($criterio = null) { }    
}