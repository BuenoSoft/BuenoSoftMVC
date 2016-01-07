<?php
namespace Model;
use \PDO;
use \App\Model;
use \Clases\Rol;
class RolModel extends Model
{
    function __construct() {
        parent::__construct();
    }
    public function obtenerTodos(){
        $sql="select * from roles";
        $datos= array();
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute();
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $rol = new Rol($row['rolId'], $row['rolNombre']);
            array_push($datos, $rol);
        }
        return $datos;
    }
    public function guardame($rol){
        $sql="insert into roles(rolNombre) values(?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($rol->getNombre()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function modificame($rol){
        $sql="update roles set rolNombre=? where rolId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($rol->getNombre(),$rol->getId()));
        return ($consulta->rowCount() > 0) ? $rol->getId() : null;
    }
    public function eliminame($rol){
        $sql="delete from roles where rolId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($rol->getId()));
        return ($consulta->rowCount() > 0) ? $rol->getId() : null;
    }
    public function obtenerPorId($id) {
        $consulta = $this->getBD()->prepare("SELECT * FROM roles WHERE rolId = ?");
        $consulta->execute(array($id));
        if($consulta->rowCount() > 0) {
            $res= $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            return new Rol($res['rolId'], $res['rolNombre']);
        }
        else {
            return null;
        }
    }
}