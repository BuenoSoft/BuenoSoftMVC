<h3><i class="fa fa-angle-right"></i> Mantenimiento de Notificaciones</h3>
<p>
    <a href="index.php?c=access&a=index"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;  
    <a href="index.php?c=notificaciones&a=add"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>      
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=notificaciones&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Log o Matrícula del Vehículo" width="50" class="form-control_index" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th></th>
                <th>Notificación</th>
                <th>Log</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Cierre</th>
                <th>Vehículo</th>
            </thead>
            <tbody>
                <?php foreach($notificaciones as $notificacion){ ?>
                    <tr>
                        <td><a href="index.php?c=notificaciones&a=edit&p=<?php echo $notificacion->getId(); ?>">Editar</a></td>
                        <td><?php echo $notificacion->getId(); ?></td>
                        <td><?php echo $notificacion->getLog(); ?></td>
                        <td><?php echo $notificacion->getFechaini(); ?></td>
                        <td><?php echo $notificacion->getFechafin(); ?></td>
                        <td><a href="index.php?c=notificaciones&a=veh&v=<?php echo $notificacion->getVehiculo()->getId(); ?>"><?php echo $notificacion->getVehiculo()->getMatricula(); ?></a></td>
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