<section id="container" >
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Navegacion"></div>
        </div>
        <!--logo start-->
        <a href="index.php" class="logo"><b>Bueno Servicios Aereos</b></a>
        <!--logo end-->
        <div class="top-menu">            
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="index.php?c=usuarios&a=logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered">
                <a href="profile.html"><img src="Public/img/manejo/ui-sam.jpg" class="img-circle" width="60"></a>
            </p>
            <h5 class="centered">Perfil</h5> 
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-dashboard"></i>
                    <span>Servicios</span>
                </a>
                <ul class="sub">
                    <?php if(App\Session::get('log_in') != null and (App\Session::get('log_in')->getTipo() == "Administrador" or App\Session::get('log_in')->getTipo() == "Supervisor")) {?>
                        <li><a href="index.php?c=usuarios&a=index">Usuarios</a></li>
                    <?php } else if(App\Session::get('log_in') != null and (App\Session::get('log_in')->getTipo() == "Usuario" or App\Session::get('log_in')->getTipo() == "Supervisor")) {?>
                    <?php } ?>
                </ul>
            </li>	
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>