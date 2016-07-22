<?php
namespace Model;
use \Clases\Usuario;
class UsuarioModel extends AppModel
{
    function __construct() {
        parent::__construct();
    }
    protected function getFindXNomDatoUsuQuery() {
        return "select * from usuarios u inner join datosusu d on u.datId = d.datId where d.datNombre = ?";
    }
    public function findByNombre($nom) {        
        return $this->findByCondition($this->getFindXNomDatoUsuQuery(), [$nom]);
    }
    /*------------------------------------------------------------------------------------*/
    public function login($datos = []){
        return $this->findByCondition($this->getLoginQuery(), $this->getLoginParameter($datos));
    }
    private function getLoginQuery(){
        return "select * from usuarios where usuNombre = ? and usuPass = ?";
    }
    private function getLoginParameter($datos = []){  
        return [$datos[0], md5($datos[1])];
    }
    /*------------------------------------------------------------------------------------*/
    protected function getCheckMessage() {
        return "El Usuario ya existe.";
    }
    protected function getCheckParameter($unique) {
        return [$unique->getNombre()];
    }    
    protected function getCheckQuery() {
        return "select * from usuarios where usuNombre = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getCreateParameter($object) {
        return [$object->getNombre(), md5($object->getPass()), $object->getRol()->getId(),$object->getAvatar(),'H',$object->getDatoUsu()->getId()];
    }
    protected function getCreateQuery() {
        return "insert into usuarios(usuNombre,usuPass,rolId,usuAvatar,usuEstado,datId) values(?,?,?,?,?,?)"; 
    }
    /*------------------------------------------------------------------------------------*/
    public function getAvatar($object){
        return $this->execute($this->getAvatarQuery(), $this->getAvatarParameter($object));
    }
    public function getAvatarQuery(){
        return "update usuarios set usuAvatar = ? where usuId = ?";
    }
    public function getAvatarParameter($object){
        return [$object->getAvatar(), $object->getId()];
    }
    /*------------------------------------------------------------------------------------*/
    protected function getDeleteParameter($object) {
        if($object->getEstado() == "H"){
            return ['D',$object->getId()];
        } else {
            return ['H',$object->getId()];
        }
    }
    protected function getDeleteQuery($notUsed = true) {
        return "update usuarios set usuEstado = ? where usuId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) {
        return ["filtro" => "%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from usuarios u inner join datosusu d on u.datId = d.datId order by u.usuEstado,u.usuId";
        } else {
            return "select * from usuarios u inner join datosusu d on u.datId = d.datId where d.datNombre like :filtro or d.datDocumento like :filtro order by u.usuEstado,u.usuId";         
        }
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindXIdQuery() {
        return "select * from usuarios where usuId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [$object->getNombre(), $object->getPass(), $object->getRol()->getId(),$object->getDatoUsu()->getId(), $object->getId()];
    }
    protected function getUpdateQuery() {
        return "update usuarios set usuNombre = ?,usuPass = ?,rolId = ?,datId = ? where usuId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    public function createEntity($row) {
        $usuario = new Usuario();
        $usuario->setId($row['usuId']);
        $usuario->setNombre($row['usuNombre']);
        $usuario->setPass($row['usuPass']);
        $usuario->setRol((new RolModel())->findById($row['rolId']));
        $usuario->setAvatar($row['usuAvatar']);
        $usuario->setEstado($row['usuEstado']);
        $usuario->setDatoUsu((new DatosUsuModel())->findById($row['datId']));
        return $usuario;
    }
}