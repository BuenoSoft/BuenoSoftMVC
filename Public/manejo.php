<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <title>Bienvenido!</title>
        <!-- Bootstrap core CSS -->
        <link href="Public/css/manejo/bootstrap.css" rel="stylesheet">
        <!--external css-->
        <link href="Public/css/manejo/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="Public/css/manejo/zabuto_calendar.css">
        <link rel="stylesheet" type="text/css" href="Public/js/manejo/gritter/css/jquery.gritter.css" />
        <!-- Calendario -->
        <link href="Public/js/manejo/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
        <!-- Efecto de imagen -->
        <link href="Public/js/manejo/fancybox/jquery.fancybox.css" rel="stylesheet" />        
        <!-- Custom styles for this template -->
        <link href="Public/css/manejo/style.css" rel="stylesheet">
        <link href="Public/css/manejo/style-responsive.css" rel="stylesheet">
        <script src="Public/js/manejo/chart-master/Chart.js"></script>
        <!-- galeria -->
        <script src="assets/js/jquery.js"></script>    
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
                <?php
                    if (\App\Session::get('msg')!=null) {  
                        echo \App\Session::get('msg')."<br /><br />"; 
                        \App\Session::set('msg', "");                     
                    } 
                    echo $content;        
                ?>
            </section>            
        </section>        
    </body>
</html>    