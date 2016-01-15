<?php
namespace Model;
use \PDO;
use \App\Model;
use \App\Session;
use \Clases\Modelo;
use \Clases\Vehiculo;
class VehiculoModel extends Model
{
    private $mod_tv;
    private $mod_mar;
    private $mod_mod;
    function __construct() {
        parent::__construct();
        $this->mod_tv = new TipovehModel();
        $this->mod_mar = new MarcaModel();
        $this->mod_mod = new ModeloModel();
    }  
    public function find($criterio = null){
        $datos= array();
        if($criterio == null){
            $consulta = $this->getBD()->prepare("select * from vehiculos");
            $consulta->execute();
        }else {
            $consulta = $this->getBD()->prepare("select * from vehiculos where vehMatricula like ?");
            $consulta->execute(array("%".$criterio."%"));
        }        
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tv->findById($row['tvId']); 
            $modelo = $this->mod_mod->findById($row['modId']);
            $veh = new Vehiculo($row['vehId'], $row['vehMatricula'], $row['vehPrecio'], $row['vehCantidad'], $row['vehDescrip'],$row['vehFoto'],$row['vehStatus'], $modelo, $tipo);
            array_push($datos, $veh);
        }
        return $datos;
    }
    public function findById($id){
        $consulta = $this->getBD()->prepare("select * from vehiculos WHERE vehId = ?");
        $consulta->execute(array($id));
        if($consulta->rowCount() > 0) {
            $res = $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            $tipo = $this->mod_tv->findById($res['tvId']); 
            $modelo = $this->mod_mod->findById($res['modId']);
            return new Vehiculo($res['vehId'], $res['vehMatricula'], $res['vehPrecio'], $res['vehCantidad'], $res['vehDescrip'],$res['vehFoto'],$res['vehStatus'], $modelo, $tipo);
        }
        else {
            return null;
        }
    }
    public function findByModelos($criterio){
        $datos= array();
        $sql="select * from modelos where modNombre like ? limit 0,10";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array("%".$criterio."%"));
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $marca = $this->mod_mar->findById($row['marId']);
            $modelo = new Modelo($row['modId'], $row['modNombre'],$marca);
            array_push($datos,$modelo);
        }
        return $datos;
    }
    public function create($veh){
        if($this->check($veh->getMat())){
            Session::set('msg', 'El vehículo ya existe');
            return null;
        }
        $sql="insert into vehiculos(vehMatricula,vehPrecio,vehCantidad,vehDescrip,vehFoto,modId,tvId) values(?,?,?,?,?,?,?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($veh->getMat(),$veh->getPrecio(),$veh->getCant(),$veh->getDescrip(),$veh->getFoto(),$veh->getModelo()->getId(),$veh->getTipo()->getId()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function update($veh){
        $aux = $this->findById($veh->getId()); 
        if(!$veh->equals($aux)){
            if($this->check($veh->getMat())){
                Session::set('msg', 'El vehículo ya existe');
                return null;
            }        
        }
        $sql="update vehiculos set vehMatricula=?,vehPrecio=?,vehCantidad=?,vehDescrip=?,modId=?,tvId=? where vehId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($veh->getMat(),$veh->getPrecio(),$veh->getCant(),$veh->getDescrip(),$veh->getModelo()->getId(),$veh->getTipo()->getId(),$veh->getId()));
        return ($consulta->rowCount() > 0) ? $veh->getId() : null;
    }
    private function check($unique) { 
        $query = 'SELECT vehId FROM vehiculos WHERE vehMatricula = ?'; 
        $consulta = $this->getBD()->prepare($query); 
        $consulta->execute([$unique]); 
        // Indicar si hay algo en la base de datos con este nombre 
        return $consulta->rowCount() > 0; 
    }
    public function updateImg($veh){
        $sql="update vehiculos set vehFoto=? where vehId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($veh->getFoto(),$veh->getId()));
        return ($consulta->rowCount() > 0) ? $veh->getId() : null;
    }
    public function delete($veh,$notUsed = true){
        $sql="update vehiculos set vehStatus=0 where vehId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($veh->getId()));
        return ($consulta->rowCount() > 0) ? $veh->getId() : null;
    }   
    public function reactive($veh){
        $sql="update vehiculos set vehStatus=1 where vehId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($veh->getId()));
        return ($consulta->rowCount() > 0) ? $veh->getId() : null;
    }
        
}