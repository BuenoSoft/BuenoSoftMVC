<?php
namespace Model;
use \Clases\Usuario;
class UsuarioModel extends AppModel
{
    function __construct() {
        parent::__construct();
    }
    /*------------------------------------------------------------------------------------*/
    public function checkTra($dates = []) {
        return $this->execute($this->getCheckTraQuery(),$this->getCheckTraParameter($dates));
    } 
    public function getCheckTraParameter($dates = []) {
        return [$dates[0],$dates[1]];
    }
    protected function getCheckTraQuery() {
        return "select * from trabajan where aplId = ? and usuId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    public function checkAplFin($object) {
        return $this->execute($this->getCheckFinQuery(),$this->getCheckFinParameter($object));
    }
    protected function getCheckFinQuery() {
        return "select * from trabajan t inner join aplicaciones a on t.aplId = a.aplId "
        . "inner join usuarios u on t.usuId = u.usuId "
        . "inner join roles r on u.rolId = r.rolId "
        . "where t.usuId = ? and (r.rolNombre = ? or r.rolNombre = ?) "
        . "and (a.aplFechaFin = '0000-00-00 00:00:00' or a.aplFechaFin is NULL)";
    }
    protected function getCheckFinParameter($object) {
        return [$object->getId(),"Chofer","Piloto"];
    }
    /*------------------------------------------------------------------------------------*/
    public function funcionarios(){
        $datos= array();
        $sql = "select * from usuarios u inner join roles r on u.rolId = r.rolId "
        . "where r.rolNombre = ? or r.rolNombre = ?";
        foreach($this->fetch($sql, ["Chofer","Piloto"]) as $row){
            $obj = $this->createEntity($row); 
            array_push($datos, $obj);
        }
        return $datos;
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