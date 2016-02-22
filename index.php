<?php
    define("APPLICATION_PATH", dirname(__FILE__));
    define("DS", DIRECTORY_SEPARATOR);
    spl_autoload_register(function($clase){
        try {
            require_once realpath(APPLICATION_PATH . DS . str_replace("\\", DS, $clase) . ".php");        
        }  
        catch (Exception $ex){
            echo $ex->getMessage();
        }
    });
    $controlador = (!empty($_GET['c'])) ? ucwords($_GET['c']) . 'Controller' : "MainController";
    $accion = (!empty($_GET['a'])) ? $_GET['a'] : "index";
    try{
        $controlador = "Controller\\" . $controlador;        
        $controlo = new $controlador();
        $controlo->$accion();
    }
    catch (Exception $ex) {
        echo $ex->getMessage();
    }