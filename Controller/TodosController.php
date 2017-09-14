<?php
namespace Controller;
class TodosController extends AppController
{
    function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->redirect_todos(['index.php']);
    }   
}