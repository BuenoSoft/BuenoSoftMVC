<?php
namespace Model;
use \PDO;
use \App\Model;
use \Clases\Usuario;
use \Clases\Compra;
class CompraModel extends Model
{
    private $mod_r;
    private $mod_u;
    private $mod_m;
    private $mod_v;
    private $mod_tc;
    private $mod_tv;
    private $mod_p;
    function __construct() {
        parent::__construct();
        $this->mod_r = new RolModel();
        $this->mod_u = new UsuarioModel();
        $this->mod_tc = new TipocomModel();
        $this->mod_tv = new TipovehModel();
        $this->mod_v = new VehiculoModel();
        $this->mod_m = new ModeloModel();
        $this->mod_p = new PagoModel();
    }
    public function find($criterio = null){
        $datos= array();
        $sql="select c.comId as id, c.tcId as tipoc, c.usuId as usuario, c.vehId as veh, c.comFecha as fecha, "
                . "c.comCuotas as cuotas, c.comCantidad as cant from compras c inner join usuarios u on "
                . "c.usuId = u.usuId where u.usuNick like ?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(["%".$criterio."%"]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tc->findById($row['tipoc']);
            $user = $this->mod_u->findById($row['usuario']);
            $veh = $this->mod_v->findById($row['veh']);
            $com = new Compra($row['id'], $row['fecha'], $row['cuotas'], $row['cant'], $tipo, $user, $veh);
            $com->setPagos($this->find_pagos($com->getId()));
            array_push($datos, $com);          
        }
        return $datos;
    }
    public function findById($id){
        $consulta = $this->getBD()->prepare("SELECT * FROM compras WHERE comId = ?");
        $consulta->execute([$id]);
        if($consulta->rowCount() > 0) {
            $res = $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            $tipo = $this->mod_tc->findById($res['tcId']);
            $user = $this->mod_u->findById($res['usuId']);
            $veh = $this->mod_v->findById($res['vehId']);
            $com = new Compra($res['comId'], $res['comFecha'], $res['comCuotas'], $res['comCantidad'], $tipo, $user, $veh);
            $com->setPagos($this->find_pagos($com->getId()));
            return $com;
        }
        else {
            return null;
        }
    }
    public function findByClientes($criterio){
        $datos= array();        
        $sql="SELECT u.usuId as id, u.usuNick as nick, u.usuPass as pass, u.usuMail as mail, u.usuNombre as nom, "
                . "u.usuApellido as ape, u.usuStatus as status, u.rolId as rol from usuarios u "
                . "inner join roles r on u.rolId = r.rolId where u.usuStatus = 1 and not r.rolNombre = 'admin' "
                . "and u.usuNick like ? limit 0,10";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(["%".$criterio."%"]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $rol= $this->mod_r->findById($row['rol']);
            $usuario = new Usuario($row['id'], $row['nick'], $row['pass'], $row['mail'], $row['nom'],$row['ape'], $row['status'], $rol);
            array_push($datos,$usuario);
        }
        return $datos;
    }
    public function findByVeh($criterio){
        $datos= array();
        $sql="select * from vehiculos where vehCantidad > 0 and vehMatricula like ? limit 0,10";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute(["%".$criterio."%"]);
        foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            $tipo = $this->mod_tv->findById($row['tvId']); 
            $modelo = $this->mod_m->findById($row['modId']);
            $veh = new Vehiculo($row['vehId'], $row['vehMatricula'], $row['vehPrecio'], $row['vehCantidad'], $row['vehDescrip'],$row['vehFoto'],$row['vehStatus'], $modelo, $tipo);
            array_push($datos, $veh);
        }
        return $datos;
    }    
    public function create($compra){
        $sql="insert into compras(tcId,usuId,vehId,comFecha,comCuotas,comCantidad) values(?,?,?,?,?,?)";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute([$compra->getTipo()->getId(),$compra->getUser()->getId(),
            $compra->getVeh()->getId(),$compra->getFecha(),$compra->getCuotas(),$compra->getCant()]);
        return ($consulta->rowCount() > 0) ? $this->getBD()->lastInsertId() : null;
    }
    public function update($compra){
        $sql="update compras set tcId=?,usuId=?,vehId=?,comFecha=?,comCuotas=?,comCantidad=? where comId=?";
        $consulta = $this->getBD()->prepare($sql);
        $consulta->execute([$compra->getTipo()->getId(),$compra->getUser()->getId(),$compra->getVeh()->getId(),
            $compra->getFecha(),$compra->getCuotas(),$compra->getCant(),$compra->getId()]);
        return ($consulta->rowCount() > 0) ? $compra->getId() : null;
    }       
    public function add_pago($com,$pago){
        return $this->mod_p->add_pago($com, $pago);
    }
    public function del_pago($com,$pago){
        return $this->mod_p->del_pago($com, $pago);
    }
    public function find_pago($com_id,$pago_id){
        return $this->mod_p->find_pago($com_id, $pago_id);
    }
    public function find_max_pago($com){
        return $this->mod_p->find_max_pago($com);
    }
    public function find_pagos($com){
        return $this->mod_p->find_pagos($com);
    }
    public function check_fec_venc($com){
        return $this->mod_p->check_fec_venc($com);
    }
    public function delete($object, $notUsed = true) { }
}