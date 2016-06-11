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
        return $this->executeQuery($this->getCheckTraQuery(),$this->getCheckTraParameter($dates));
    } 
    public function getCheckTraParameter($dates = []) {
        return [$dates[0],$dates[1]];
    }
    protected function getCheckTraQuery() {
        return "select * from trabajan where aplId = ? and usuId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    public function checkAplFin($object) {
        return $this->executeQuery($this->getCheckFinQuery(),$this->getCheckFinParameter($object));
    }
    protected function getCheckFinQuery() {
        return "select * from trabajan t inner join aplicaciones a on t.aplId = a.aplId "
        . "inner join usuarios u on t.usuId = u.usuId where t.usuId = ? and "
        . "(u.usuTipo = ? or u.usuTipo = ?) and (a.aplFechaFin = '0000-00-00 00:00:00' or a.aplFechaFin is NULL)";
    }
    protected function getCheckFinParameter($object) {
        return [$object->getId(),"Chofer","Piloto"];
    }
    /*------------------------------------------------------------------------------------*/
    public function funcionarios(){
        $datos= array();
        foreach($this->fetch("select * from usuarios where usuTipo = ? or usuTipo = ?", ["Chofer","Piloto"]) as $row){
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
    public function active($object){
        return $this->executeQuery($this->getDeleteQuery(false), $this->getActiveParameter($object));
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
        return [$object->getNombre(), md5($object->getPass()), $object->getTipo(),$object->getAvatar(),'H',$object->getDatoUsu()->getId()];
    }
    protected function getCreateQuery() {
        return "insert into usuarios(usuNombre,usuPass,usuTipo,usuAvatar,usuEstado,datId) values(?,?,?,?,?,?)"; 
    }
    /*------------------------------------------------------------------------------------*/
    public function getAvatar($object){
        return $this->executeQuery($this->getAvatarQuery(), $this->getAvatarParameter($object));
    }
    public function getAvatarQuery(){
        return "update usuarios set usuAvatar = ? where usuId = ?";
    }
    public function getAvatarParameter($object){
        return [$object->getAvatar(), $object->getId()];
    }
    /*------------------------------------------------------------------------------------*/
    protected function getDeleteParameter($object) {
        return ['D',$object->getId()];
    }
    protected function getActiveParameter($object) {
        return ['H',$object->getId()];
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
        return [$object->getNombre(), $object->getPass(), $object->getTipo(),$object->getDatoUsu()->getId(), $object->getId()];
    }
    protected function getUpdateQuery() {
        return "update usuarios set usuNombre = ?,usuPass = ?,usuTipo = ?,datId = ? where usuId = ?";
    }
    /*------------------------------------------------------------------------------------*/
    public function createEntity($row) {
        $usuario = new Usuario();
        $usuario->setId($row['usuId']);
        $usuario->setNombre($row['usuNombre']);
        $usuario->setPass($row['usuPass']);
        $usuario->setTipo($row['usuTipo']);
        $usuario->setAvatar($row['usuAvatar']);
        $usuario->setEstado($row['usuEstado']);
        $usuario->setDatoUsu((new DatosUsuModel())->findById($row['datId']));
        return $usuario;
    }
}