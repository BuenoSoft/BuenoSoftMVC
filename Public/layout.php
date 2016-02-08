<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Amnesia -- MVC con php</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <link rel="icon" type="image/png" href="Public/img/car_key.png" />
        <link href="Public/css/estilos.css" rel="stylesheet" type="text/css" />                
    </head>
    <body>
        <body>
            <div id="main">
                <div style="text-align: center">
                    <a href="index.php?c=main&a=index" title="Inicio">
                        <img src="Public/img/audi-a3-cabrio.png" />
                    </a>                    
                </div>
                <header>
                    <nav>
                        <ul>
                            <?php if(\App\Session::isLoggedIn() == true){ ?>
                                <?php if(\App\Session::get("log_in")!= null and \App\Session::get("log_in")->getRol()->getNombre() == "ADMIN"){ ?>
                                    <li><a href="index.php?c=usuarios&a=tareas">Tareas</a></li>
                                <?php } else if(\App\Session::get("log_in")!= null and \App\Session::get("log_in")->getRol()->getNombre() == "NORMAL"){ ?>  
                                    <li><a href="index.php?c=consultas&a=index">Consultas</a></li>
                                <?php } ?>    
                                    <li><a href="index.php?c=usuarios&a=logout">Cerrar Sesión</a></li>                                   
                                <?php } else { ?>
                                    <li><a href="index.php?c=usuarios&a=login">Iniciar Sesión</a></li>
                                    <li><a href="index.php?c=usuarios&a=add">Registrarse</a></li>                                    
                            <?php } ?>    
                        </ul>
                    </nav>                    
                </header>
                <section>
                    <?php  
                        if (\App\Session::get('msg')!=null) {  
                            echo \App\Session::get('msg')."<br /><br />"; 
                            \App\Session::set('msg', "");                     
                        } 
                        echo $content;
                    ?>
                </section>
                <footer>
                    Copyright &copy; <?php echo date("Y"); ?> -- Reservados todos los derechos
                </footer>
            </div>
    </body>
</html>