<h3><i class="fa fa-angle-right"></i>&nbsp;Mantenimiento de Notificaciones</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;  
    <?php if(App\Session::get('log_in') != null and (\App\Session::get('log_in')->getRol()->getNombre() == "Administrador" or \App\Session::get('log_in')->getRol()->getNombre() == "Supervisor")) { ?>
        <a href="index.php?c=notificaciones&a=add"><button class="btn btn-theme05" tabindex="4"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>
    <?php } ?>     
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=notificaciones&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Log o Matrícula del Vehículo" width="50" class="form-control_index" tabindex="1" autofocus="autofocus" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" tabindex="2"/ >
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>                
                <th>Destinatario</th>
                <th>Mensaje</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Cierre</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach($notificaciones as $notificacion){ 
                    $style = ($notificacion->getEstado() == "N") ? "color: #2E9AFE;" : "";
                    ?>
                    <tr style="<?php echo $style; ?>">
                        <td>
                            <?php if($notificacion->getVehiculo() != null){ ?>
                                <a href="index.php?c=vehiculos&a=view&d=<?php echo $notificacion->getVehiculo()->getId(); ?>">
                                    <?php echo "Vehículo: ". $notificacion->getVehiculo()->getMatricula(); ?>
                                </a>
                            <?php } else { ?>
                                <a href="index.php?c=usuarios&a=view&d=<?php echo $notificacion->getUsuario()->getId(); ?>">
                                    <?php echo $notificacion->getUsuario()->getRol()->getNombre().": ". $notificacion->getUsuario()->getNomReal(); ?>
                                </a>
                            <?php } ?>
                        </td>                        
                        <td><?php echo $notificacion->getLog(); ?></td>
                        <td><?php echo ($notificacion->getFechaini() == null or $notificacion->getFechaini() == "0000-00-00") ? "" : $notificacion->inverseDateIni(); ?></td>
                        <td><?php echo ($notificacion->getFechafin() == null or $notificacion->getFechafin() == "0000-00-00") ? "" : $notificacion->inverseDateFin(); ?></td>
                        <td>
                            <a href="index.php?c=notificaciones&a=view&d=<?php echo $notificacion->getId(); ?>" title="Ver">
                                <i class="fa fa-eye" style="font-size: 22px;"></i>
                            </a>
                            <?php if(App\Session::get('log_in') != null and (\App\Session::get('log_in')->getRol()->getNombre() == "Administrador" or \App\Session::get('log_in')->getRol()->getNombre() == "Supervisor")) { ?>                        
                                &nbsp;
                                <a href="index.php?c=notificaciones&a=edit&d=<?php echo $notificacion->getId(); ?>" title="Editar">
                                    <i class="fa fa-edit" style="font-size: 22px;"></i>
                                </a>
                                &nbsp;
                                <a href="index.php?c=notificaciones&a=delete&d=<?php echo $notificacion->getId(); ?>" title="Borrar" onclick="return confirm('¿Desea borrar la notificación seleccionada?');">
                                    <i class="fa fa-times-circle" style="font-size: 22px;"></i>
                                </a>
                            <?php } ?>
                        </td> 
                         
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=notificaciones&a=index&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=notificaciones&a=index&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=notificaciones&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=notificaciones&a=index&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>    
</div>