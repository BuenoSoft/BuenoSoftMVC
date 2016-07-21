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
<link rel="shortcut icon" href="Public/img/principal/favicon.ico" type="Public/img/principal/x-icon">
<link rel="icon" href="Public/img/principal/favicon.ico" type="Public/img/principal/x-icon">
<!-- popup -->   
<link rel="stylesheet" href="Public/css/principal/style.css">
<link href="Public/css/principal/popup.css" rel="stylesheet" type='text/css'>
<script src="Public/js/manejo/jquery-ui-1.9.2.custom.min.js"></script>
<script src="Public/js/manejo/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="Public/js/principal/popup.js"></script>
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
                 <li class="active"><a href="#home">Home</a></li>
                 <li ><a href="#about">About</a></li>
                 <li ><a href="#works">Works</a></li>
                 <li ><a href="#partners">Partners</a></li>
                 <li ><a href="#contact">Contact</a></li>
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
                                        <p class="popup-titulo">INICIAR SESION</p>
                                        <form action="index.php?c=usuarios&a=login" class="frm-login" method="post" name="frmlogin">
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
        <!-- Item 1 -->
        <div class="item active">
          <img src="Public/img/principal/back1.jpg" alt="banner">
        </div>
        <!-- #Item 1 -->

        <!-- Item 1 -->
        <div class="item">
          <img src="Public/img/principal/back2.jpg" alt="banner">
        </div>
        <!-- #Item 1 -->

        <!-- Item 1 -->
        <div class="item">
          <img src="Public/img/principal/back3.jpg" alt="banner">
        </div>
        <!-- #Item 1 -->

        <!-- Item 1 -->
        <div class="item">
          <img src="Public/img/principal/back4.jpg" alt="banner">
        </div>
        <!-- #Item 1 -->
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon-chevron-left"><i class="fa fa-angle-left"></i></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon-chevron-right"><i class="fa fa-angle-right"></i></span></a>
    </div>
<!-- #Slider Ends -->
</div>
<!-- Cirlce Starts -->
<div id="about"  class="container spacer about">
<h2 class="text-center wowload fadeInUp">Creative photographers of London</h2>  
  <div class="row">
  <div class="col-sm-6 wowload fadeInLeft">
    <h4><i class="fa fa-camera-retro"></i> Introduction </h4>
    <p>Creative digital agency for sleek and sophisticated solutions for mobile, websites and software designs, lead by passionate and uber progressive team that lives and breathes design. Creative digital agency for sleek and sophisticated solutions for mobile, websites and software designs.</p>
    

  </div>
  <div class="col-sm-6 wowload fadeInRight">
  <h4><i class="fa fa-coffee"></i> Passion</h4>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>    
  </div>
  </div>

  <div class="services">
  <h3 class="text-center wowload fadeInUp">Services</h3>
	<ul class="row text-center list-inline  wowload bounceInUp">
   		<li>
            <span><i class="fa fa-camera-retro"></i><b>Photography</b></span>
        </li>
        <li>
            <span><i class="fa fa-cube"></i><b>Studio</b></span>
        </li>
        <li>
            <span><i class="fa fa-graduation-cap"></i><b>Trainings</b></span>
        </li>
        <li>
            <span><i class="fa fa-umbrella"></i><b>Travel</b></span>
        </li>        
        <li>
            <span><i class="fa fa-heart-o"></i><b>Wedding</b></span>
        </li>
  	</ul>
  </div>
</div>
<!-- #Cirlce Ends -->


<!-- works -->
<div id="works"  class=" clearfix grid"> 
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/1.jpg" alt="img01"/>
        <figcaption>
            <h2>Nature</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/1.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
     <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/2.jpg" alt="img01"/>
        <figcaption>
            <h2>Events</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/2.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
     <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/3.jpg" alt="img01"/>
        <figcaption>
            <h2>music</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/3.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
     <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/4.jpg" alt="img01"/>
        <figcaption>
            <h2>Vintage</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/4.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
     <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/5.jpg" alt="img01"/>
        <figcaption>
            <h2>Typers</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/5.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
     
     <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/6.jpg" alt="img01"/>
        <figcaption>
            <h2>hotel</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/6.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/7.jpg" alt="img01"/>
        <figcaption>
            <h2>Chinese</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/7.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/8.jpg" alt="img01"/>
        <figcaption>
            <h2>Dicrap</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/8.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/9.jpg" alt="img01"/>
        <figcaption>
            <h2>Coffee</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/9.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/10.jpg" alt="img01"/>
        <figcaption>
            <h2>cameras</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/10.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/11.jpg" alt="img01"/>
        <figcaption>
            <h2>design</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/11.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
    <figure class="effect-oscar  wowload fadeInUp">
        <img src="Public/img/principal/portfolio/12.jpg" alt="img01"/>
        <figcaption>
            <h2>studio</h2>
            <p>Lily likes to play with crayons and pencils<br>
            <a href="Public/img/principal/portfolio/12.jpg" title="1" data-gallery>View more</a></p>            
        </figcaption>
    </figure>
    

     
</div>
<!-- works -->


<div id="partners" class="container spacer ">
	<h2 class="text-center  wowload fadeInUp">Some of our happy clients</h2>
  <div class="clearfix">
    <div class="col-sm-6 partners  wowload fadeInLeft">
         <img src="Public/img/principal/partners/1.jpg" alt="partners">
         <img src="Public/img/principal/partners/2.jpg" alt="partners">
         <img src="Public/img/principal/partners/3.jpg" alt="partners">
         <img src="Public/img/principal/partners/4.jpg" alt="partners">
    </div>
    <div class="col-sm-6">


    <div id="carousel-testimonials" class="carousel slide testimonails  wowload fadeInRight" data-ride="carousel">
    <div class="carousel-inner">  
      <div class="item active animated bounceInRight row">
      <div class="animated slideInLeft col-xs-2"><img alt="portfolio" src="Public/img/principal/team/1.jpg" width="100" class="img-circle img-responsive"></div>
      <div  class="col-xs-10">
      <p> I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. </p>      
      <span>Angel Smith - <b>eshop Canada</b></span>
      </div>
      </div>
      <div class="item  animated bounceInRight row">
      <div class="animated slideInLeft col-xs-2"><img alt="portfolio" src="Public/img/principal/team/2.jpg" width="100" class="img-circle img-responsive"></div>
      <div  class="col-xs-10">
      <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>
      <span>John Partic - <b>Crazy Pixel</b></span>
      </div>
      </div>
      <div class="item  animated bounceInRight row">
      <div class="animated slideInLeft  col-xs-2"><img alt="portfolio" src="Public/img/principal/team/3.jpg" width="100" class="img-circle img-responsive"></div>
      <div  class="col-xs-10">
      <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue.</p>
      <span>Harris David - <b>Jet London</b></span>
      </div>
      </div>
  </div>

   <!-- Indicators -->
   	<ol class="carousel-indicators">
    <li data-target="#carousel-testimonials" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-testimonials" data-slide-to="1"></li>
    <li data-target="#carousel-testimonials" data-slide-to="2"></li>
  	</ol>
  	<!-- Indicators -->
  </div>



    </div>
  </div>


<!-- team -->
<h3 class="text-center  wowload fadeInUp">Our team</h3>
<p class="text-center  wowload fadeInLeft">Our creative team that is making everything possible</p>
<div class="row grid team  wowload fadeInUpBig">	
	<div class=" col-sm-3 col-xs-6">
	<figure class="effect-chico">
        <img src="Public/img/principal/team/8.jpg" alt="img01" class="img-responsive" />
        <figcaption>
            <p><b>Barbara Husto</b><br>Senior Designer<br><br><a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a></p>            
        </figcaption>
    </figure>
    </div>

    <div class=" col-sm-3 col-xs-6">
	<figure class="effect-chico">
        <img src="Public/img/principal/team/10.jpg" alt="img01"/>
        <figcaption>            
            <p><b>Barbara Husto</b><br>Senior Designer<br><br><a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a></p>            
        </figcaption>
    </figure>
    </div>

    <div class=" col-sm-3 col-xs-6">
	<figure class="effect-chico">
        <img src="Public/img/principal/team/12.jpg" alt="img01"/>
        <figcaption>
            <p><b>Barbara Husto</b><br>Senior Designer<br><br><a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a></p>          
        </figcaption>
    </figure>
    </div>

    <div class=" col-sm-3 col-xs-6">
	<figure class="effect-chico">
        <img src="Public/img/principal/team/17.jpg" alt="img01"/>
        <figcaption>
            <p><b>Barbara Husto</b><br>Senior Designer<br><br><a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a></p>
        </figcaption>
    </figure>
    </div>

 
</div>
<!-- team -->

</div>
<!-- About Starts -->
<div class="highlight-info">
<div class="overlay spacer">
<div class="container">
<div class="row text-center  wowload fadeInDownBig">
	<div class="col-sm-3 col-xs-6">
	<i class="fa fa-smile-o  fa-5x"></i><h4>24 Clients</h4>
	</div>
	<div class="col-sm-3 col-xs-6">
	<i class="fa fa-rocket  fa-5x"></i><h4>75 Projects</h4>
	</div>
	<div class="col-sm-3 col-xs-6">
	<i class="fa fa-cloud-download  fa-5x"></i><h4>454 Downloads</h4>
	</div>
	<div class="col-sm-3 col-xs-6">
	<i class="fa fa-map-marker fa-5x"></i><h4>2 Offices</h4>
	</div>
</div>
</div>
</div>
</div>
<!-- About Ends -->
<div id="contact" class="spacer">
<!--Contact Starts-->
<div class="container contactform center">
<h2 class="text-center  wowload fadeInUp">Get in touch to start your project</h2>
  <div class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12">      
        <input type="text" placeholder="Name">
        <input type="text" placeholder="Company">
        <textarea rows="5" placeholder="Message"></textarea>
        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send</button>
      </div>
  </div>



</div>
</div>
<!--Contact Ends-->

<!-- Footer Starts -->
<div class="footer text-center spacer">
<p class="wowload flipInX"><a href="#"><i class="fa fa-facebook fa-2x"></i></a> <a href="#"><i class="fa fa-instagram fa-2x"></i></a> <a href="#"><i class="fa fa-twitter fa-2x"></i></a> <a href="#"><i class="fa fa-flickr fa-2x"></i></a> </p>
Copyright 2014 Cyrus Creative Studio. All rights reserved.
</div>
<!-- # Footer Ends -->
<a href="#home" class="gototop "><i class="fa fa-angle-up  fa-3x"></i></a>

<!-- jquery -->
<script src="Public/js/principal/jquery.js"></script>

<!-- wow script -->
<script src="Public/js/principal/wow.min.js"></script>


<!-- boostrap -->
<script src="Public/js/principal/bootstrap.js" type="text/javascript" ></script>

</body>
</html>
