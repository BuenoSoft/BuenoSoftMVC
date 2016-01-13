<?php
namespace Model;
use \PDO;
use \App\Model;
use \App\Session;
use \Clases\Marca;
use \Clases\Modelo;
class ModeloModel extends Model
{
    private $mod_mar;
    function __construct() {
        parent::__construct();
        $this->mod_mar = new MarcaModel();
    }
    public function findByMarcas($criterio){
        $datos= array();
        $sql="select * from marcas where marNombre like ? limit 0,10";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array("%".$criterio."%")); 
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $marca = new Marca($row['marId'], $row['marNombre']);
            array_push($datos,$marca);
        }
        return $datos;
    }
    public function find($criterio = null){
        $datos= array();
        $sql="select * from modelos where modNombre like ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array("%".$criterio."%")); 
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $marca = $this->mod_mar->findById($row['marId']);
            $modelo = new Modelo($row['modId'], $row['modNombre'],$marca);
            array_push($datos,$modelo);
        }
        return $datos;
    }
    public function findById($id) {
        $consulta = $this->getBD()->prepare("SELECT * FROM modelos WHERE modId = ?");
        $consulta->execute(array($id));
        if($consulta->rowCount() > 0) {
            $res= $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            $marca = $this->mod_mar->findById($res['marId']);
            return new Modelo($res['modId'], $res['modNombre'],$marca);
        }
        else {
            return null;
        }
    }   
    public function create($modelo){
        if($this->check($modelo->getNombre())){
            Session::set('msg', 'El Modelo ya existe');
            return null;
        }
        $sql="insert into modelos(modNombre,marId) values(?,?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($modelo->getNombre(),$modelo->getMarca()->getId()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function update($modelo){
        $aux = $this->obtenerPorId($modelo->getId()); 
        if(!$modelo->equals($aux)){
            if($this->check($modelo->getNombre())){
                Session::set('msg', 'El Modelo ya existe');
                return null;
            }        
        }
        $sql="update modelos set modNombre=?,marId=? where modId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($modelo->getNombre(),$modelo->getMarca()->getId(),$modelo->getId()));
        return ($consulta->rowCount() > 0) ? $modelo->getId() : null;
    }
    private function check($unique) { 
        $query = 'SELECT modId FROM modelos WHERE modNombre = ?'; 
        $consulta = $this->getBD()->prepare($query); 
        $consulta->execute([$unique]); 
        // Indicar si hay algo en la base de datos con este nombre 
        return $consulta->rowCount() > 0; 
    }
    public function delete($modelo, $notUsed = true){
        $sql="delete from modelos where modId=?";
        if ($notUsed === true) {
            $sql .= ' AND modId NOT IN (SELECT DISTINCT modId FROM vehiculos)';
        }
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($modelo->getId()));
        return ($consulta->rowCount() > 0) ? $modelo->getId() : null;
    }    
}