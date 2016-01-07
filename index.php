<?php
    define("APPLICATION_PATH", dirname(__FILE__));
    define("DS", DIRECTORY_SEPARATOR);
    spl_autoload_register(function($clase){
        try {
            $rootPath = dirname(__FILE__);
            var_dump($clase);
            $file = realpath($rootPath . DS . str_replace("\\", DS, $clase) . ".php");
            require_once $file;        
        }  
        catch (Exception $ex){
            echo $ex->getMessage();
        }
    });
    set_include_path(implode(PATH_SEPARATOR, array(
        realpath(APPLICATION_PATH . '/Lib/fpdf/fpdf')
    )));
    echo '<br/>';
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