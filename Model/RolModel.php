<?php
namespace Model;
use \PDO;
use \App\Model;
use \App\Session;
use \Clases\Rol;
class RolModel extends Model
{
    function __construct() {
        parent::__construct();
    }
    public function find($criterio = null){
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
    public function create($rol){
        if($this->check($rol->getNombre())){
            Session::set('msg', 'El rol ya existe');
            return null;
        }
        $sql="insert into roles(rolNombre) values(?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($rol->getNombre()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function update($rol){
        $aux = $this->findById($rol->getId()); 
        if(!$rol->equals($aux)){
            if($this->check($rol->getNombre())){
                Session::set('msg', 'El rol ya existe');
                return null;
            }        
        }
        $sql="update roles set rolNombre=? where rolId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($rol->getNombre(),$rol->getId()));
        return ($consulta->rowCount() > 0) ? $rol->getId() : null;
    }
    private function check($unique) { 
        $query = 'SELECT rolId FROM roles WHERE rolNombre = ?'; 
        $consulta = $this->getBD()->prepare($query); 
        $consulta->execute([$unique]); 
        // Indicar si hay algo en la base de datos con este nombre 
        return $consulta->rowCount() > 0; 
    }
    public function delete($rol, $notUsed = true) {
        $sql = "DELETE FROM roles WHERE rolId = ?";
        if ($notUsed === true) {
            $sql .= ' AND rolId NOT IN (SELECT DISTINCT rolId FROM usuarios)';
        }
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($rol->getId()));
        return ($consulta->rowCount() > 0) ? $rol->getId() : null;
    }
    public function findById($id) {
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