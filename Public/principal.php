<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Bueno Servicios</title>
    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <!-- font awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="Public/css/principal/bootstrap.min.css" />
    <!-- animate.css -->
    <link rel="stylesheet" href="Public/css/principal/animate.css" />
    <link rel="stylesheet" href="Public/css/principal/set.css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="Public/img/principal/favicon.png" type="Public/img/principal/x-icon">
    <link rel="icon" href="Public/img/principal/favicon.png" type="Public/img/principal/x-icon">
    <!-- popup -->
    <link rel="stylesheet" href="Public/css/principal/style.css">
    <link href="Public/css/principal/popup.css" rel="stylesheet" type='text/css'>
    <script src="Public/js/manejo/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="Public/js/manejo/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="Public/js/principal/popup.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
    function initialize() {
      var mapProp = {
        center:new google.maps.LatLng(51.508742,-0.120850),
        zoom:5,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script>
    $(function() {
            function abrir(){
                $("#popup").show();
           }
            $("#hrefAbrirPopup").click(function(){
                abrir();
            })
        });
    </script>
</head>
<body>
    <div class="topbar animated fadeInLeftBig"></div>
    <!-- Header Starts -->
    <div class="navbar-wrapper">
        <div class="container">
            <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
                <div class="container">
                    <div class="navbar-header">
                    <!-- Logo Starts -->
                        <a class="navbar-brand" href="#home"><img src="Public/img/principal/logo.png" alt="logo"></a>
                        <!-- #Logo Ends -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Nav Starts -->
                    <div class="navbar-collapse  collapse">
                        <ul class="nav navbar-nav navbar-right scroll">
                            <li class="active"><a href="#home">Inicio</a></li>
                            <li><a href="#about">Nosotros</a></li>
                            <li><a href="#works">Servicios</a></li>
                            <li><a href="#partners">De Interés</a></li>
                            <li><a href="#contact">Contacto</a></li>
                            <!-- PopUp -->
                            <?php if(\App\Session::isLoggedIn() == true){ ?>
                                <li>
                                    <a href="index.php?c=inicio&a=index">Acceso</a>
                                </li>
                            <?php } else {?>
                                <li>
                                    <a href="#" id="hrefAbrirPopup" data-type="zoomin">Iniciar Sesion</a>
                                    <div id="popup" class="overlay-container">
                                        <div class="popup-contenedor zoomin">
                                            <?php if(\App\Session::get('msg') != null) {?>
                                                <div id="resultado" class="alert alert-<?php echo \App\Session::get('msg')[0]; ?> fade in">
                                                    <i class="fa fa-<?php echo \App\Session::get('msg')[1]; ?>" style="font-size: 24px;"></i>&nbsp;
                                                    <?php echo \App\Session::get('msg')[2]; ?>
                                                </div>
                                            <?php } ?>
                                            <p class="popup-titulo">Iniciar Sesi&oacuten</p>
                                            <form action="index.php?c=usuarios&a=login" class="frm-login" method="post" name="frmlogin" id="login">
                                                <input name="txtuser" type="text" placeholder="Usuario" class="popup-textbox" autofocus="autofocus" required="required" />
                                                <input name="txtpass" type="password" placeholder="Contraseña"  class="popup-textbox" required="required" />
                                                <input name="btnaceptar" type="submit" value="Aceptar" class="popup-btn popup-hover-btn"/>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- #Nav Ends -->
                </div>
            </div>
        </div>
    </div>
    <!-- #Header Starts -->
    <div id="home">
        <!-- Slider Starts -->
        <div id="myCarousel" class="carousel slide banner-slider animated bounceInDown" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="Public/img/principal/back1.jpg" alt="banner" />
                </div>
                <div class="item">
                    <img src="Public/img/principal/back2.jpg" alt="banner">
                </div>
                <div class="item">
                    <img src="Public/img/principal/back3.jpg" alt="banner" />
                </div>
                <div class="item">
                    <img src="Public/img/principal/back4.jpg" alt="banner" />
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon-chevron-left">
                    <i class="fa fa-angle-left"></i>
                </span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon-chevron-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    <!-- #Slider Ends -->
    </div>
    <!-- Cirlce Starts -->
    <div id="about"  class="container spacer about">
        <h2 class="text-center wowload fadeInUp">BUENO Servicios A&eacutereos</h2>
        <div class="row">
            <div class="col-sm-6 wowload fadeInup">
                <p>En Bueno Servicios Aéreos tenemos como objetivo la satisfacci&oacuten de nuestros clientes, mediante el cuidado de sus cultivos y el cuidado del medio
                ambiente. M&aacutes de 30 años de trayectoria en el plano de la aviaci&oacuten agr&iacutecola abalan nuestros servicios, brindando confianza y seguridad
                a la hora de sobrevolar sus campos...</p>
            </div>
            <div class="col-sm-6 wowload fadeInRight">
                <p>Sumamos nuestra experiancia a una constante capacitaci&oacuten, y a los mejores avances tecnol&oacutegicos existentes para obtener los mejores resultados
                en cada servicio realizado. Asumimos el compromiso de una correcta intervenci&oacuten en su cultivo!</p>
            </div>
        </div>
        <div class="services"></div>
    </div>
    <div class="highlight-info">
        <div class="overlay spacer">
            <div class="container">
                <div class="row text-center  wowload fadeInDownBig">
                    <div class="col-sm-3 col-xs-6">
                        <i class="fa fa-tree  fa-5x"></i><h4>Responsabilidad Ambiental</h4>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <i class="fa fa-calendar fa-5x"></i><h4>Trabajos en Tiempo y Forma</h4>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <i class="fa fa-users  fa-5x"></i><h4>Personal Capacitado y Experimentado</h4>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <i class="fa fa-copy fa-5x"></i><h4>Registros Accesibles nuestros Clientes</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #Cirlce Ends -->
    <!-- works -->
    <div id="works"  class=" clearfix grid">
        <h2 class="text-center wowload fadeInUp">Nuestros Servicios</h2> 
        <figure class="effect-oscar  wowload fadeInUp">
            <img src="Public/img/principal/portfolio/1.jpg" alt="img01"/>
            <figcaption>
                <h2>APLICACIONES</h2>
                <p>Realizamos todo tipo de aplicaciones a&eacutereas, cuidamos de sus cultivos de manera eficiente y responsable.<br>       
               </figcaption>
            </figure>
            <figure class="effect-oscar  wowload fadeInUp">
               <img src="Public/img/principal/portfolio/2.jpg" alt="img02"/>
               <figcaption>
                   <h2>TRASLADOS</h2>
                   <p>Contamos en nuestra flota con Aeronaves de traslado de pasajeros, viaje r&aacutepido y seguro!<br>           
               </figcaption>
            </figure>
            <figure class="effect-oscar  wowload fadeInUp">
               <img src="Public/img/principal/portfolio/3.jpg" alt="img03"/>
               <figcaption>
                   <h2>FOTOGRAF&IacuteA</h2>
                   <p>Vuele con nosotros para tomar las mejores fotograf&iacuteas de su vida!<br>        
               </figcaption>
        </figure>
    </div>
    <!-- works -->
    <div id="partners" class="container spacer ">
        <h2 class="text-center  wowload fadeInUp">Contamos con los mejores recursos!</h2>
        <div class="clearfix">
            <div class="col-sm-6 partners  wowload fadeInLeft">
                <img src="Public/img/principal/partners/1.jpg" alt="partners">
                <img src="Public/img/principal/partners/2.jpg" alt="partners">
            </div>
            <div class="col-sm-6">
                <div id="carousel-testimonials" class="carousel slide testimonails  wowload fadeInRight" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active animated bounceInRight row">
                            <div  class="col-xs-10">
                                <p>Mediante la combinación de pronósticos del tiempo, herramientas como Google earth, aeronaves y equipos modernos, personal experimentado y dispuesto, es posible realizar una aplicación en el momento exacto para obtener la mayor efectividad y eficiencia, reduciendo así el porcentaje de evaporación de productos por temperatura y humedad relativa,
                                solucionando problemas de deriva por condiciones desfavorables de viento o por equipos con desperfectos y demás.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table width="100%">
        <tr>
            <td style="min-width:50%; vertical-align:top;">
                <h3 style="text-align: center; margin-top: 0px;">Efectividad Garantizada</h3>
                <p align="justify" style="max-width:90%; margin: 0 auto;">
                    Las aeronaves cuentan con sistemas de posicionamiento global modernos lo cual permiten tener una precisión inferior a los 50 centímetros entre "pasada y pasada".
                    Los equipos de aplicación tanto de sólidos como de líquidos son lo último en el mercado como boquillas de líquido tipo "CP" y díspersores de sólido tipo "SWATHMASTER" los cuales permiten un ancho de franja uniforme.
                    Los equipos de apoyo terrestres cuentan con herramientas eficientes para el abastecimiento del avión las cuales permiten ahorrar tiempo en preparar el caldo a aplicar en caso de ser líquidos cumpliendo con las normas del MGAP (triple lavado y destrucción de envases) y en el caso de sólidos con embudos y guinches de gran capacidad para evitar derrames y pérdidas.
                </p>
                <td width="50%">
                    <video style="width: 100%; height: 370px ;" controls>
                        <source src="Public/video/principal/video.webm" type="video/webm">
                    </video>
                </td>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <!-- About Starts -->
    <div class="highlight-info">
        <div class="overlay spacer">
            <div class="container">
                <h1 class="desmayusculado"><marquee direction="left" scrollamount="15">Este texto podría estar o no presente en la pagina, es una simple prueba...</marquee></h1>
                <style>
                    .desmayusculado{
                     text-transform:initial;

                    }
                </style>
            </div>
        </div>
    </div>
    <!-- About Ends -->
    <div id="contact" class="spacer">
        <!--Contact Starts-->
        <div class="container contactform center">
            <h2 class="text-center  wowload fadeInUp">P&oacutengase en contacto con nosotros!</h2>
            <table style="width:100%">
                <tr>
                    <td>
                        <h4><i class="fa fa-envelope-o" aria-hidden="true"></i><b>Email</b></h4>
                        <div class="info-de-contacto">buenoserviciosaereos@gmail.com</div><br><br>
                        <h4><i class="fa fa-phone" aria-hidden="true"></i><b>Telefono</b></h4>
                        <div class="info-de-contacto">4777 2138</div><br><br>
                        <h4><i class="fa fa-mobile" aria-hidden="true"></i><b>Celular</b></h4>
                        <div class="info-de-contacto"><p>099777131&nbsp;&nbsp;|&nbsp;&nbsp;099730994&nbsp;&nbsp;|&nbsp;&nbsp;099733969</p></div>
                        <h4><i class="fa fa-map-marker" aria-hidden="true"></i><b>Direccion</b></h4>
                        <div class="info-de-contacto">Ruta 30 km. 19500 Tom&aacutes Gomensoro, Artigas, Uruguay.</div><br>
                    </td>
                    <td>
                        <?php
                            //if "email" variable is filled out, send email
                            if (isset($_REQUEST['cf_email']))  {

                                //Email information
                                $admin_email = "info@buenoserviciosaereos.com.uy";
                                $email = $_REQUEST['cf_email'];
                                $subject = $_REQUEST['cf_name'];
                                $comment = $_REQUEST['cf_message'];

                                //send email
                                mail($admin_email, "$subject", $comment, "From:" . $email);

                                //Email information
                                $admin_email = "buenoserviciosaereos@gmail.com";

                                //send email
                                mail($admin_email, "$subject", $comment, "From:" . $email);

                                //Email response
                                echo "Gracias por contactarnos!";
                            }
                            //if "email" variable is not filled out, display the form
                            else  {
                        ?>
                                <h3 style="text-align:center">Envíenos su mensaje</h3>
                                <form action="http://buenoserviciosaereos.com.uy/#contact" method="post" id="form" class="contact-form">
                                    <div class="row wowload fadeInLeftBig">
                                        <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                                            <input type="text" placeholder="Nombre" name="cf_name" pattern="[a-zA-Z ]{4,25}" required>
                                            <input type="email" placeholder="Correo" name="cf_email" required>
                                            <textarea rows="5" placeholder="Mensaje" name="cf_message" required></textarea>
                                            <!--button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Enviar</button-->
                                            <input class="btn btn-primary" type="submit" class="form-control" value="ENVIAR MENSAJE">
                                        </div>
                                    </div>
                                </form>
                        <?php
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!--Contact Ends-->
    <!-- Footer Starts -->    
    <div class="footer text-center spacer">
        <p class="wowload flipInX">
            <a href="https://www.facebook.com/sharer/sharer.php?u=http://www.buenoserviciosaereos.com.uy"><i class="fa fa-facebook fa-2x"></i></a> 
            <a href="https://twitter.com/?status=Me gusta esta página http://www.buenoserviciosaereos.com.uy"><i class="fa fa-twitter fa-2x"></i></a>
            <a href="https://plus.google.com/share?url=http://www.buenoserviciosaereos.com.uy"><i class="fa fa-google-plus fa-2x"></i></a>
        </p>
        <img src="Public/img/principal/logofooter.png" alt="logo">
        <p>Desarrollado por Tecnicatura en Redes y Software 2016. Salto, Uruguay.</p>
    </div>
    <!-- # Footer Ends -->
    <a href="#home" class="gototop "><i class="fa fa-angle-up  fa-3x"></i></a>
    <!-- jquery -->
    <script src="Public/js/principal/jquery.js"></script>
    <!-- wow script -->
    <script src="Public/js/principal/wow.min.js"></script>
</body>
</html>