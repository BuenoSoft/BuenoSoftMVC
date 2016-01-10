<?php
namespace Controller;
use \App\Controller;
class MainController extends Controller
{
    function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->redirect(array('index.php'));
    }   
}