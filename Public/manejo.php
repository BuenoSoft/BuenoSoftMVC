<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <title>Buenos Servicios</title>
        <!-- Bootstrap core CSS -->
        <link rel="shortcut icon" href="Public/img/manejo/favicom.png" type="image/png" />
        <link href="Public/css/manejo/bootstrap.css" rel="stylesheet" type="text/css" />
        <!--external css-->
        <link href="Public/css/manejo/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="Public/css/manejo/magicsuggest.css" rel="stylesheet" type="text/css" />
        <link href="Public/css/manejo/zabuto_calendar.css" rel="stylesheet" type="text/css" >
        <link href="Public/js/manejo/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"  />
        <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
        <!-- Calendario -->
        <link href="Public/js/manejo/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Efecto de imagen -->
        <link href="Public/js/manejo/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>        
        <!-- Custom styles for this template -->
        <link href="Public/css/manejo/style.css" rel="stylesheet" type="text/css">
        <link href="Public/css/manejo/style-responsive.css" rel="stylesheet" type="text/css">  
        <script src="Public/js/manejo/chart-master/Chart.js"></script>
        <!-- galeria -->
        <script src="Public/js/manejo/jquery.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php echo $menu; ?>
        <section id="main-content">
            <section class="wrapper">                
                <br />
                <?php// echo \App\Session::get('enlaces'); ?>
                <br /><br />
                <?php
                    if (\App\Session::get('msg')!=null) {  ?>
                        <div class="alert alert-<?php echo \App\Session::get('msg')[0]; ?> fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                            <i class="fa fa-<?php echo \App\Session::get('msg')[1]; ?>" style="font-size: 24px;"></i>&nbsp;
                            <?php echo \App\Session::get('msg')[2]; ?>
                        </div>                        
                <?php    
                        \App\Session::set('msg', "");                     
                    } 
                    echo $content;        
                ?>
            </section>            
        </section> 
        <!-- js placed at the end of the document so the pages load faster -->
         
        <script src="Public/js/manejo/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
        <script src="Public/js/manejo/bootstrap.min.js" type="text/javascript"></script>
        <script src="Public/js/manejo/combodate.js" type="text/javascript"></script>
        <script src="Public/js/manejo/moment.js" type="text/javascript"></script>
        <script src="Public/js/manejo/magicsuggest.js" type="text/javascript"></script>
        <script src="Public/js/manejo/jquery.dcjqaccordion.2.7.js" class="include" type="text/javascript"></script>
        <script src="Public/js/manejo/jquery.nicescroll.js" type="text/javascript"></script>
        <!--common script for all pages-->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js" type="text/javascript"></script>
 	<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js" type="text/javascript"></script>
        <script src="Public/js/manejo/common-scripts.js" type="text/javascript"></script>
        <script src="Public/js/manejo/gritter/js/jquery.gritter.js" type="text/javascript"></script>
        <script src="Public/js/manejo/gritter-conf.js" type="text/javascript"></script>
        <script src="Public/js/manejo/chequeos.js" type="text/javascript"></script>
    </body>
</html>    