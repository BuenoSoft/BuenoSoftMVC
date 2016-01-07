<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Intento de MVC con php</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <link href="Public/css/estilos.css" rel="stylesheet" type="text/css" />                
    </head>
    <body>
        <body>
            <div id="main">
                <div id="header">
                    <div id="logo">
                        <h1><a href="index.php?c=main&a=index">1. MVC + php</a></h1>
                    </div>
                    <div id="menu">  
                        <div id="top_menu">
                            <ul>
                                <?php if(\App\Session::isLoggedIn() == true){ ?>
                                    <li><a href="index.php?c=usuarios&a=tareas">Tareas</a></li>
                                    <li><a href="index.php?c=usuarios&a=logout">Cerrar Sesión</a></li>                                   
                                <?php } else { ?>
                                    <li><a href="index.php?c=usuarios&a=login">Iniciar Sesión</a></li>
                                    <li><a href="index.php?c=usuarios&a=add">Registrarse</a></li>                                    
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="content">
                    <?php  
                        if (\App\Session::get('msg')!=null) {  
                            echo \App\Session::get('msg')."<br /><br />"; 
                            \App\Session::set('msg', "");                     
                        } 
                        echo $content;
                    ?>
                </div>
                <div id="footer">
                    Copyright &copy; 2015 --- Escuela T&eacute;cnica Superior
                </div>
        </div>
    </body>
</html>