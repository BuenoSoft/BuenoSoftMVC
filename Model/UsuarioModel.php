<?php
namespace Model;
use \App\Session;
use \Clases\Usuario;
class UsuarioModel extends AppModel
{
    function __construct() {
        parent::__construct();
    }
    protected function getFindXNomDatoUsuQuery() {
        return "select * from usuarios u where u.usuNomReal = ?";
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
        return [$unique->getNombre(),$unique->getDocumento()];
    }    
    protected function getCheckQuery() {
        return "select * from usuarios where usuNombre = ? or usuDocumento = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getCreateParameter($object) {
        return [
                $object->getDocumento(), $object->getNombre(), $object->getNomReal(), 
                md5($object->getPass()), $object->getAvatar(), $object->getDireccion(),
                $object->getTelefono(), $object->getCelular(), $object->getTipo(),
                $object->getRol()->getId()
            ];
    }
    protected function getCreateQuery() {
        return "insert into usuarios(usuDocumento,usuNombre,usuNomReal,usuPass,usuAvatar,usuDireccion,"
        . "usuTelefono,usuCelular,usuTipo,rolId) values(?,?,?,?,?,?,?,?,?,?)"; 
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
        return [$object->getId()];        
    }
    protected function getDeleteQuery($notUsed = true) {
        return "delete from usuarios where usuId = ?";
    }
    protected function getCheckDelete($object) {
        if($this->execute("select * from pistas where usuId = ?", [$object->getId()])){
            Session::set("msg", Session::msgDanger("Este cliente tiene pistas a su nombre"));
            return false;
        } else if($this->execute("select * from aplicaciones where usuId = ?", [$object->getId()])){
            Session::set("msg", Session::msgDanger("Este cliente tiene aplicaciones solicitadas"));
            return false;
        } else if($this->execute("select * from aplicaciones where usuPiloto = ?", [$object->getId()])){
            Session::set("msg", Session::msgDanger("Este piloto está siendo usado en algunas aplicaciones"));
            return false;
        } else if($this->execute("select * from aplicaciones where usuChofer = ?", [$object->getId()])){
            Session::set("msg", Session::msgDanger("Este chofer está siendo usado en algunas aplicaciones"));
            return false;
        } else if($this->execute("select * from movimientos where usuId = ?", [$object->getId()])){
            Session::set("msg", Session::msgDanger("Este usuario realizó movimientos"));
            return false;
        } else {
            return true;        
        }
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindParameter($criterio = null) {
        return ["filtro" => "%".$criterio."%"];
    }
    protected function getFindQuery($criterio = null) {
        if($criterio == null){
            return "select * from usuarios u order by u.usuNombre";
        } else {
            return "select * from usuarios u where u.usuNomReal like :filtro or "
            . "u.usuDocumento like :filtro order by u.usuNombre";         
        }
    }
    /*------------------------------------------------------------------------------------*/
    protected function getFindXIdQuery() {
        return "select * from usuarios where usuId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    protected function getUpdateParameter($object) {
        return [
                $object->getDocumento(), $object->getNombre(), $object->getNomReal(), 
                $this->getCheckPass($object), $object->getAvatar(), $object->getDireccion(),
                $object->getTelefono(), $object->getCelular(), $object->getTipo(),
                $object->getRol()->getId(), $object->getId()
            ];
    }
    protected function getUpdateQuery() {
        return "update usuarios set usuDocumento = ?,usuNombre = ?,usuNomReal = ?,usuPass = ?,"
            . "usuAvatar = ?,usuDireccion = ?,usuTelefono = ?,usuCelular = ?,usuTipo = ?,"
            . "rolId = ? where usuId = ?";
    }
    private function getCheckPass($object){
        $usuario = $this->findById($object->getId());
        if($usuario->getPass() != $object->getPass()){
            return md5($object->getPass());
        } else {
            return $usuario->getPass(); 
        }
    }
    /*------------------------------------------------------------------------------------*/
    public function createEntity($row) {
        $usuario = new Usuario();
        $usuario->setId($row['usuId']);
        $usuario->setNombre($row['usuNombre']);
        $usuario->setPass($row['usuPass']);
        $usuario->setRol((new RolModel())->findById($row['rolId']));
        $usuario->setAvatar($row['usuAvatar']);
        $usuario->setNomReal($row['usuNomReal']);
        $usuario->setDocumento($row['usuDocumento']);
        $usuario->setDireccion($row['usuDireccion']);
        $usuario->getTelefono($row['usuTelefono']);
        $usuario->setCelular($row['usuCelular']);
        $usuario->setTipo($row['usuTipo']);
        return $usuario;
    }
}