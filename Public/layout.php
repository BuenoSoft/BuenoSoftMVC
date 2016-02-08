<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Proyecto Nuevo MVC con php</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <link href="Public/css/estilos.css" rel="stylesheet" type="text/css" />                
    </head>
    <body>
        <body>
            <div id="main">
                <div style="text-align: center; padding-bottom: 10px;">
                    <a href="index.php?c=main&a=index">Inicio</a>                    
                </div>
                <header>
                    <nav>
                        <ul>
                            <li><a href="#">Iniciar Sesión</a></li>
                            <li><a href="#">Registrarse</a></li>        
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