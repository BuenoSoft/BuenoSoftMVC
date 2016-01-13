<?php
/**
 * Description of Model
 *
 * @author detectivejd
 */
namespace App;
abstract class Model implements IModel
{
    protected $db;
    function __construct() {
        $this->db = new Database();
    }
    public function getBD(){
        return $this->db->getConnect();
    }
}
