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
    public function active($object){
        return $this->executeQuery($this->getDeleteQuery(false), $this->getActiveParameter($object));
    }
    private function getLoginQuery(){
        return "select * from usuarios where usuNombre = ? and usuPass = ?";
    }
    private function getLoginParameter($datos = []){  
        return [$datos[0], md5($datos[1])];
    }
    protected function getCheckMessage() {
        return "El Usuario ya existe.";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }
    protected function getCheckQuery() {
        return "select * from usuarios where usuNombre = ?";
    }
    protected function getCreateParameter($object) {
        return [$object->getNombre(), md5($object->getPass()), $object->getTipo(),'H',$object->getDatoUsu()->getId()];
    }
    protected function getCreateQuery() {
        return "insert into usuarios(usuNombre,usuPass,usuTipo,usuEstado,datId) values(?,?,?,?,?)"; 
    }
    protected function getDeleteParameter($object) {
        return ['D',$object->getId()];
    }
    protected function getActiveParameter($object) {
        return ['H',$object->getId()];
    }
    protected function getDeleteQuery($notUsed = true) {
        return "update usuarios set usuEstado = ? where usuId = ?";
    }
    protected function getFindParameter($criterio = null) {
        return ["filtro" => "%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        return "select * from usuarios u inner join datosusu d on u.datId = d.datId where d.datNombre like :filtro or d.datDocumento like :filtro";
    }
    protected function getFindXIdQuery() {
        return "select * from usuarios where usuId = ?";
    }
    protected function getUpdateParameter($object) {
        return [$object->getNombre(), $object->getPass(), $object->getTipo(),$object->getDatoUsu()->getId(), $object->getId()];
    }
    protected function getUpdateQuery() {
        return "update usuarios set usuNombre = ?,usuPass = ?,usuTipo = ?,datId = ? where usuId = ?";
    }
    public function createEntity($row) {
        $datousu = (new DatosUsuModel())->findById($row['datId']);
        $usuario = new Usuario();
        $usuario->setId($row['usuId']);
        $usuario->setNombre($row['usuNombre']);
        $usuario->setPass($row['usuPass']);
        $usuario->setTipo($row['usuTipo']);
        $usuario->setEstado($row['usuEstado']);
        $usuario->setDatoUsu($datousu);
        return $usuario;
    }
}