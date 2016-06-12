<section id="container" >
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Navegacion"></div>
        </div>
        <!--logo start-->
        <a href="index.php" class="logo"><b>Bueno Servicios Aereos</b></a>
        <!--logo end-->
        <div class="collapse navbar-collapse menubar">
            <ul class="nav navbar-nav navbar-right">
                <li class='dropdown'>
                    <a href="#" class='dropdown-toggle' data-toggle='dropdown' style="font-size: 15px;">
                        <i class="fa fa-envelope"></i>&nbsp;Notificaciones
                    </a>
                    <ul class='dropdown-menu'>
                        <li><a href="#">Megamenu</a></li>
                    </ul>
                </li>
                <li>
                    <a href="index.php?c=usuarios&a=logout" style="font-size: 15px;">
                        <i class="medium-icon fa fa-sign-out"></i>&nbsp;Salir</a>
                    </a>
                </li>
            </ul>          
        </div>
    </header>
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <br />        
                <p class="centered">
                    <a href="index.php?c=usuarios&a=view&p=<?php echo \App\Session::get('log_in')->getId(); ?>">
                        <?php if(\App\Session::get('log_in')->getAvatar() == null) { ?>
                            <img src="Public/img/manejo/profile_img.png" class="img-circle" width="60">
                        <?php } else { ?>
                            <img src="<?php echo \App\Session::get('log_in')->getAvatar(); ?>" class="img-rounded" width="90">
                        <?php } ?>                       
                    </a>
                </p>
                <h5 class="centered"><?php echo \App\Session::get('log_in')->getNombre(); ?></h5> 
                <br />
                <li class="sub-menu">
                    <a href="index.php?c=access&a=index">
                        <i class="fa fa-home"></i>&nbsp;Inicio
                    </a>
                </li> 
                <?php if(App\Session::get('log_in') != null and (App\Session::get('log_in')->getTipo() == "Administrador" or App\Session::get('log_in')->getTipo() == "Supervisor")) {?>            
                    <li class="sub-menu">
                        <a href="index.php?c=aplicaciones&a=index">
                            <i class="fa fa-plane"></i>&nbsp;Aplicaciones
                        </a>
                    </li>        
                    <li class="sub-menu">
                        <a href="index.php?c=usuarios&a=index">
                            <i class="fa fa-users"></i>&nbsp;Usuarios
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="index.php?c=productos&a=index">
                            <i class="fa fa-flask"></i>&nbsp;Productos
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="index.php?c=combustibles&a=index">
                            <i class="fa fa-fire"></i>&nbsp;Combustibles
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="index.php?c=vehiculos&a=index">
                            <i class="fa fa-car"></i>&nbsp;Vehículos
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="index.php?c=consultas&a=index">
                            <i class="fa fa-search"></i>&nbsp;Consultas
                        </a>
                    </li>               
                    <li class="sub-menu">
                        <a href="index.php?c=notificaciones&a=index">
                            <i class="fa fa-warning"></i>&nbsp;Notificaciones
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="index.php?c=pistas&a=index">
                            <i class="fa fa-road"></i>&nbsp;Pistas
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="index.php?c=tipop&a=index">
                            <i class="fa fa-flask"></i>&nbsp;Tipo de Producto
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="index.php?c=tipov&a=index">
                            <i class="fa fa-car"></i>&nbsp;Tipo de Vehículo
                        </a>
                    </li>
                <?php } else if(App\Session::get('log_in') != null and (App\Session::get('log_in')->getTipo() == "Usuario" or App\Session::get('log_in')->getTipo() == "Supervisor")) {?>
                <?php } ?>                	
            </ul>
        </div>
    </aside>
</section>