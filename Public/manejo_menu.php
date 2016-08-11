<section id="container" >
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Navegacion"></div>
        </div>        
        <!--logo start-->
        <a href="index.php" class="logo"><b>Bueno Servicios Aereos</b></a>
        <!--logo end-->
        <?php 
            function getSubString($string, $length=NULL) {
                //Si no se especifica la longitud por defecto es 50
                if ($length == NULL)
                    $length = 45;
                //Primero eliminamos las etiquetas html y luego cortamos el string
                $stringDisplay = substr(strip_tags($string), 0, $length);
                //Si el texto es mayor que la longitud se agrega puntos suspensivos
                if (strlen(strip_tags($string)) > $length)
                    $stringDisplay .= ' ...';
                return $stringDisplay;
            }
        ?>
        <div class="collapse navbar-collapse menubar">
            <ul class="nav navbar-nav navbar-right">
                <?php if(App\Session::get('log_in') != null and App\Session::get('log_in')->getRol()->getNombre() != "Cliente") { ?>
                    <li class='dropdown'>
                        <a href="#" class='dropdown-toggle' data-toggle='dropdown' style="font-size: 15px;">
                            <i class="fa fa-envelope"></i>&nbsp;Notificaciones
                            <?php if($cantNot > 0){?>
                                <span class="badge bg-theme"><?php echo $cantNot; ?></span>
                            <?php } ?>
                        </a>
                        <ul class='dropdown-menu' style="padding: 4px 4px 4px 4px; border: 2px;">
                            <?php 
                                foreach($notificaciones as $notificacion) { 
                                $style = ($notificacion->getEstado() == "N") ? "color: #2E9AFE;" : "";
                                ?>
                                <li class="dropdown-header">
                                    <a href="index.php?c=notificaciones&a=view&d=<?php echo $notificacion->getId(); ?>" title="Ver">
                                        <table style="<?php echo $style; ?>">
                                            <tr>
                                                <td rowspan="2" align="center">
                                                    <i class="fa fa-info-circle" style="font-size: 30px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                                               
                                                </td>                                                                                    
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <b style="font-size: 13px;">Mensaje:</b>&nbsp;
                                                    <br />
                                                    <i style="font-size: 13px;">                                             
                                                        <?php
                                                            if(strlen($notificacion->getMensaje()) > 45){
                                                                echo getSubString($notificacion->getMensaje(), 45); 
                                                            } else {
                                                                echo $notificacion->getMensaje();
                                                            }
                                                        ?>
                                                    </i>
                                                </td>
                                            </tr>
                                        </table>
                                    </a>                                                                    
                                </li>
                            <?php } ?>
                            <li class="divider"></li>
                            <li class="dropdown-header" style="text-align: center;">
                                <a href="index.php?c=notificaciones&a=index">
                                    <b>Ver Más</b>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
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
                    <a href="index.php?c=usuarios&a=view&d=<?php echo \App\Session::get('log_in')->getId(); ?>">
                        <?php if(\App\Session::get('log_in')->getAvatar() == null) { ?>
                            <img src="Public/img/manejo/profile_img.png" class="img-circle" width="80">
                        <?php } else { ?>
                            <img src="<?php echo \App\Session::get('log_in')->getAvatar(); ?>" class="imagencircular">
                        <?php } ?>                       
                    </a>
                </p>
                <h5 class="centered"><?php echo \App\Session::get('log_in')->getNombre(); ?></h5> 
                <br />
                <li class="sub-menu">
                    <a href="index.php?c=inicio&a=index">
                        <i class="fa fa-home"></i>&nbsp;Inicio
                    </a>
                </li> 
                <?php 
                    if(App\Session::get('log_in') != null) {
                        if(App\Session::get('log_in')->getRol()->getNombre() != "Chofer"){ ?>
                            <li class="sub-menu">
                                <a href="index.php?c=aplicaciones&a=index">
                                    <i class="fa fa-plane"></i>&nbsp;Aplicaciones
                                </a>
                            </li>                                    
                <?php   } 
                        if(App\Session::get('log_in')->getRol()->getNombre() != "Chofer" and App\Session::get('log_in')->getRol()->getNombre() != "Cliente"){ ?>            
                            <li class="sub-menu">
                                <a href="index.php?c=notificaciones&a=index">
                                    <i class="fa fa-warning"></i>&nbsp;Notificaciones
                                </a>
                            </li>
                <?php   } 
                        if((App\Session::get('log_in')->getRol()->getNombre() == "Administrador" or App\Session::get('log_in')->getRol()->getNombre() == "Supervisor")){ ?>                                
                            <li class="sub-menu">
                                <a href="index.php?c=estadisticas&a=index">
                                    <i class="fa fa-bar-chart"></i>&nbsp;Estadísticas
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
                                <a href="index.php?c=pistas&a=index">
                                    <i class="fa fa-road"></i>&nbsp;Pistas
                                </a>
                            </li>                                                        
                <?php   }
                        if(\App\Session::get('log_in')->getRol()->getNombre() == "Supervisor") { ?>
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
                            <li class="sub-menu">
                                <!--<a href="roles/index">-->
                                <a href="index.php?c=roles&a=index">
                                    <i class="fa fa-user"></i>&nbsp;Roles
                                </a>
                            </li>
                <?php   }                     
                    }
                ?>                                	
            </ul>
        </div>
    </aside>
</section>