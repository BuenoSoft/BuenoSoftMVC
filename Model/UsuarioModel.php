<?php
namespace Model;
use \PDO;
use \App\Model;
use \App\Session;
use \Clases\Usuario;
class UsuarioModel extends Model
{    
    private $mod_r;
    function __construct() {
        parent::__construct();
        $this->mod_r= new RolModel();
    }    
    
    public function create($usuario){
        if($this->check($usuario->getNick())){
            Session::set('msg', 'El usuario ya existe');
            return null;
        }
        $sql="insert into usuarios(usuNick,usuPass,usuMail,usuNombre,usuApellido,rolId) values(?,?,?,?,?,?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(
                array(
                    $usuario->getNick(),$usuario->getPass(),$usuario->getCorreo(),
                    $usuario->getNombre(),$usuario->getApellido(),$usuario->getRol()->getId()
                )
            );
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function update($usuario){
        $aux = $this->findById($usuario->getId()); 
        if(!$usuario->equals($aux)){
            if($this->check($usuario->getNombre())){
                Session::set('msg', 'El usuario ya existe');
                return null;
            }        
        }
        $sql="update usuarios set usuNick=?,usuPass=?,usuMail=?,usuNombre=?,usuApellido=?,rolId=? where usuId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(
                array(
                    $usuario->getNick(),$usuario->getPass(),$usuario->getCorreo(),
                    $usuario->getNombre(),$usuario->getApellido(),$usuario->getRol()->getId(),
                    $usuario->getId()
                )
            );
        return ($consulta->rowCount() > 0) ? $usuario->getId() : null;
    }
    private function check($unique) { 
        $query = 'SELECT usuId FROM usuarios WHERE usuNick = ?'; 
        $consulta = $this->getBD()->prepare($query); 
        $consulta->execute([$unique]); 
        // Indicar si hay algo en la base de datos con este nombre 
        return $consulta->rowCount() > 0; 
    }
    public function delete($usuario, $notUsed = true){
        $sql="update usuarios set usuStatus=0 where usuId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($usuario->getId()));
        return ($consulta->rowCount() > 0) ? $usuario->getId(): null;
    }
    public function reactive($usuario){
        $sql="update usuarios set usuStatus=1 where usuId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($usuario->getId()));
        return ($consulta->rowCount() > 0) ? $usuario->getId() : null;
    }
    public function find($criterio = null){
        $datos= array();        
        $sql="SELECT * FROM usuarios u where u.usuNick like ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array("%".$criterio."%"));
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $rol= $this->mod_r->findById($row['rolId']);
            $usuario = new Usuario($row['usuId'], $row['usuNick'], $row['usuPass'], $row['usuMail'], $row['usuNombre'],$row['usuApellido'], $row['usuStatus'], $rol);
            array_push($datos,$usuario);
        }
        return $datos;
    }
    public function findById($id) {
        $consulta = $this->getBD()->prepare("SELECT * FROM usuarios WHERE usuId = ?");
        $consulta->execute(array($id));
        if($consulta->rowCount() > 0) {
            $res= $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            $rol= $this->mod_r->findById($res['rolId']);
            return new Usuario($res['usuId'], $res['usuNick'], $res['usuPass'], $res['usuMail'], $res['usuNombre'], $res['usuApellido'], $res['usuStatus'], $rol);
        }
        else {
            return null;
        }
    }
    public function findBylogin($load = array()){
        $sql="select * from usuarios where usuNick = :user and usuPass = :pass and usuStatus = 1";
        $consulta = $this->getBD()->prepare($sql);        
        $consulta->execute(array('user' =>$load[0],'pass' => md5($load[1])));
        if ($consulta->rowCount() > 0) {            
            $res= $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            $rol= $this->mod_r->findById($res['rolId']);
            return new Usuario($res['usuId'], $res['usuNick'], $res['usuPass'], $res['usuMail'], $res['usuNombre'], $res['usuApellido'], $res['usuStatus'], $rol);
        }
        else {
            return null;
        }
    }    
}