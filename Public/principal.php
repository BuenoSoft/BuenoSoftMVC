<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bueno Servicios</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- para el popup -->
        <link href="Public/css/principal/popup.css" rel="stylesheet" type='text/css'>         
       <!-- para el sitio-->
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
        <link href="Public/css/principal/bootstrap.min.css" rel="stylesheet" type='text/css'>
        <link href="Public/css/principal/flexslider.css" rel="stylesheet" type='text/css'>
        <link href="Public/css/principal/estilo-pagina-principal.css" rel="stylesheet" type='text/css'>
        <link href="Public/css/principal/queries.css" rel="stylesheet" type='text/css'>
        <link href="Public/css/principal/animate.css" rel="stylesheet" type='text/css'>       
    </head>
    <body id="top">
        <header id="home">
            <nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
                            <nav class="pull">
                                <ul class="top-nav">
                                    <?php if(\App\Session::isLoggedIn() == true){ ?>
                                        <li>
                                            <a href="index.php?c=access&a=index" class="mybutton"><h3>Acceso</h3></a>
                                            
                                        </li>
                                    <?php } else {?>
                                        <li>                                            
                                            <a href="#" class="mybutton" data-type="zoomin"><h3>Iniciar Sesion</h3></a>
                                            <div id="popup" class="overlay-container">
                                                <div class="window-container zoomin">
                                                    <p style="color: red; font-weight: bold;">
                                                    <?php 
                                                        if (\App\Session::get('msg')!=null) {  
                                                            echo \App\Session::get('msg')."<br /><br />"; 
                                                            \App\Session::set('msg', "");                     
                                                        } 
                                                    ?>
                                                    </p>
                                                    <h1 class="poph"><b>Iniciar Sesion</b></h1>
                                                    <form action="index.php?c=usuarios&a=login" method="post" name="frmlogin">
                                                        <input name="txtuser" type="text" placeholder="Usuario" class="estilo-textbox-login" autofocus />
                                                        <input name="txtpass" type="password" placeholder="Contraseña"  class="estilo-textbox-login" />
                                                        <input name="btnaceptar" type="submit" value="Aceptar" class="closed"/>
                                                    </form>                                        
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <ul class="top-nav">
                                    <li><a href="#intro">Acerca Nuestro<span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                                    <li><a href="#features">Nuestra Propuesta<span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                                    <li><a href="#portfolio">Trabajos realizados<span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                                    <li><a href="#team">Equipo de trabajo<span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                                    <li><a href="#contact">Contacto<span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
            <section class="hero" id="hero">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-right navicon">
                            <a id="nav-toggle" class="nav_slide_button" href="#"><span></span></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center inner">
                            <h1 class="animated fadeInDown">BUENO<span>Servicios</span></h1>
                            <p class="animated fadeInUp delay-05s">Empresa de Servicios de aplicación aérea</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <a href="#" class="learn-more-btn">Solicitarnos</a>
                        </div>
                    </div>
                </div>
            </section>
        </header>
        <?php echo $content; ?>
        <footer>
            <!-- para el popup -->
            <script>!window.jQuery && document.write(unescape('%3Cscript src="Public/js/principal/jquery-popup.js"%3E%3C/script%3E'))</script>
            <script type="text/javascript" src="Public/js/principal/popup.js"></script>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="Public/js/principal/waypoints.min.js"></script>
            <script src="Public/js/principal/bootstrap.min.js"></script>
            <script src="Public/js/principal/scripts.js"></script>
            <script src="Public/js/principal/jquery.flexslider.js"></script>
            <script src="Public/js/principal/modernizr.js"></script>
            <script src="Public/js/manejo/jquery-ui-1.9.2.custom.min.js"></script>
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="legals">
                            <li><a href="#" onkeydown="compruebaTecla();" > Condiciones reservadas</a></li>
                            <li><a href="#">Legales</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 credit">
                        <p>Desarrollado por estudiantes de Tecnicatura Redes y Software 2015-2016 <a href="https://www.facebook.com/groups/213981735462986/">Tecnicatura TF3</a> exlusividad <a href="http://code.uy/"><em> CODE </em></a></p>
                    </div>
                </div>
            </div>
        </footer>           
    </body>
</html>