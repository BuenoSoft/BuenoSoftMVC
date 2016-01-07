<?php
namespace App;
class Session 
{   
    public static function set($clave, $valor) {
        $_SESSION["$clave"] = $valor;
    }
    public static function get($clave) {
        return (isset($_SESSION["$clave"])) ? $_SESSION["$clave"] : null ;
    }
    public static function login() {        
        $_SESSION['logged_in'] = true;
    }
    public static function logout() {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }
    public static function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
    }
}