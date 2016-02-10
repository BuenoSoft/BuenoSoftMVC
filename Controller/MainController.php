<?php
namespace Controller;
class MainController extends AppController
{
    function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->redirect(array('index.php'));
    }   
}