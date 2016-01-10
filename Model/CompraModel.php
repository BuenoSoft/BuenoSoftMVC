<?php
namespace Model;
use \PDO;
use \App\Model;
use \Clases\Usuario;
use \Clases\Compra;
use \Clases\Pago;
class CompraModel extends Model
{
    private $mod_r;
    private $mod_u;
    private $mod_m;
    private $mod_v;
    private $mod_tc;
    private $mod_tv;
    function __construct() {
        parent::__construct();
        $this->mod_r = new RolModel();
        $this->mod_u = new UsuarioModel();
        $this->mod_tc = new TipocomModel();
        $this->mod_tv = new TipovehModel();
        $this->mod_v = new VehiculoModel();
        $this->mod_m = new ModeloModel();
    }
    public function obtenerListXCliente($criterio){
        $datos= array();        
        $sql="SELECT u.usuId as id, u.usuNick as nick, u.usuPass as pass, u.usuMail as mail, u.usuNombre as nom, "
                . "u.usuApellido as ape, u.usuStatus as status, u.rolId as rol from usuarios u "
                . "inner join roles r on u.rolId = r.rolId where u.usuStatus = 1 and not r.rolNombre = 'admin' "
                . "and u.usuNick like ? limit 0,10";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array("%".$criterio."%"));
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $rol= $this->mod_r->obtenerPorId($row['rol']);
            $usuario = new Usuario($row['id'], $row['nick'], $row['pass'], $row['mail'], $row['nom'],$row['ape'], $row['status'], $rol);
            array_push($datos,$usuario);
        }
        return $datos;
    }
    public function obtenerListXVeh($criterio){
        $datos= array();
        $sql="select * from vehiculos where vehCantidad > 0 and vehMatricula like ? limit 0,10";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array("%".$criterio."%"));
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tv->obtenerPorId($row['tvId']); 
            $modelo = $this->mod_m->obtenerPorId($row['modId']);
            $veh = new Vehiculo($row['vehId'], $row['vehMatricula'], $row['vehPrecio'], $row['vehCantidad'], $row['vehDescrip'],$row['vehFoto'],$row['vehStatus'], $modelo, $tipo);
            array_push($datos, $veh);
        }
        return $datos;
    }   
    public function obtenerXId($id){
        $consulta = $this->getBD()->prepare("SELECT * FROM compras WHERE comId = ?");
        $consulta->execute(array($id));
        if($consulta->rowCount() > 0) {
            $res = $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            $tipo = $this->mod_tc->obtenerPorId($res['tcId']);
            $user = $this->mod_u->obtenerPorId($res['usuId']);
            $veh = $this->mod_v->obtenerPorId($res['vehId']);
            $com = new Compra($res['comId'], $res['comFecha'], $res['comCuotas'], $res['comCantidad'], $tipo, $user, $veh);
            $com->setPagos($this->obtenerPagosXCompra($com));
            return $com;
        }
        else {
            return null;
        }
    }
    public function guardame($compra){
        $sql="insert into compras(tcId,usuId,vehId,comFecha,comCuotas,comCantidad) values(?,?,?,?,?,?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($compra->getTipo()->getId(),$compra->getUser()->getId(),$compra->getVeh()->getId(),$compra->getFecha(),$compra->getCuotas(),$compra->getCant()));
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function modificame($compra){
        $sql="update compras set tcId=?,usuId=?,vehId=?,comFecha=?,comCuotas=?,comCantidad=? where comId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array($compra->getTipo()->getId(),$compra->getUser()->getId(),$compra->getVeh()->getId(),$compra->getFecha(),$compra->getCuotas(),$compra->getCant(),$compra->getId()));
        return ($consulta->rowCount() > 0) ? $compra->getId() : null;
    }  
    public function buscador($criterio){
        $datos= array();
        $sql="select c.comId as id, c.tcId as tipoc, c.usuId as usuario, c.vehId as veh, c.comFecha as fecha, "
                . "c.comCuotas as cuotas, c.comCantidad as cant from compras c inner join usuarios u on "
                . "c.usuId = u.usuId where u.usuNick like ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(array("%".$criterio."%"));
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tc->obtenerPorId($row['tipoc']);
            $user = $this->mod_u->obtenerPorId($row['usuario']);
            $veh = $this->mod_v->obtenerPorId($row['veh']);
            $com = new Compra($row['id'], $row['fecha'], $row['cuotas'], $row['cant'], $tipo, $user, $veh);
            $com->setPagos($this->obtenerPagosXCompra($com));
            array_push($datos, $com);          
        }
        return $datos;
    }
    private function obtenerPagosXCompra($com){
        $datos = array();
        $consulta = $this->getBD()->prepare("SELECT * from pagos where comId = ? order by pagId desc");
        $consulta->execute(array($com->getId()));
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $pago = new Pago($row['pagId'], $row['pagFecPago'], $row['pagFecVenc'], $row['pagMonto']);
            array_push($datos, $pago); 
        } 
        return $datos;
    }
}