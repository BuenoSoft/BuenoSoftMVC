<section id="container" >
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Navegacion"></div>
        </div>
        <!--logo start-->
        <a href="index.php" class="logo"><b>Bueno Servicios Aereos</b></a>
        <!--logo end-->
        <div class="top-menu">            
            <a href="index.php?c=usuarios&a=logout" title="Cerrar Sesion">
                <i class="fa fa-sign-out" style="font-size: 40px; margin-top: 8px; margin-left: 8px; float: right;"></i>
            </a>                       
            <a href="#" title="Notificaciones">
                <i class="fa fa-envelope" style="font-size: 40px; margin-top: 8px; margin-left: 10px; float: right;"></i>
            </a>
        </div>
    </header>
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <br />        
                <p class="centered">
                    <a href="index.php?c=usuarios&a=view&p=<?php echo \App\Session::get('log_in')->getId(); ?>"><img src="Public/img/manejo/ui-sam.jpg" class="img-circle" width="60"></a>
                </p>
                <h5 class="centered"><?php echo \App\Session::get('log_in')->getNombre(); ?></h5> 
                <br />
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
                    <a href="index.php?c=consultas&a=periodo">
                        <i class="fa fa-calendar"></i>&nbsp;Aplicaciones por Período
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="index.php?c=notificaciones&a=index">
                        <i class="fa fa-warning"></i>&nbsp;Notificaciones
                    </a>
                </li>
                <?php } else if(App\Session::get('log_in') != null and (App\Session::get('log_in')->getTipo() == "Usuario" or App\Session::get('log_in')->getTipo() == "Supervisor")) {?>
                <?php } ?>                	
            </ul>
        </div>
    </aside>
</section>