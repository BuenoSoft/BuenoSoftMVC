<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;
use \App\Session;
/**
 * Description of AplicacionesController
 *
 * @author Tomás Alves Cardoso
 */
class AplicacionesController extends AppController
{
    public function index(){
        if($this->checkUser()){
            $this->redirect_administrador(['index.php']);
        }
    }
    public function add(){
        if($this->checkUser()){
            $this->redirect_administrador(['add.php']);
        }
    }
    protected function getRoles() {
        return ["Administrador","Supervisor"];
    }
    protected function getMessageRole() {
        return "administrador o supervisor";
    }
}
