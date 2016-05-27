<h3>Historial del Vehículo <?php echo $usado->getVehiculo()->getId(); ?>, de la Aplicación número&nbsp;<?php echo $usado->getAplicacion()->getId(); ?></h3>
<p>
    <a href="index.php?c=usados&a=index&p=<?php echo $usado->getAplicacion()->getId(); ?>"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <a href="index.php?c=historial&a=add&p=<?php echo $usado->getAplicacion()->getId(); ?>&v=<?php echo $usado->getVehiculo()->getId(); ?>"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Registrar</button></a>
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th>Combustible</th>
                <th>Carga Inicial</th>
                <th>Carga Final</th>
                <th>Fecha</th>
                <th>Opciones</th>                
            </thead>
            <tbody>
                <?php foreach($historiales as $historial) { ?>
                    <tr>                       
                        <td><a href="index.php?c=historial&a=comb&m=<?php echo $historial->getCombustible()->getId();?>"><?php echo $historial->getCombustible()->getNombre();?></a></td>
                        <td><?php echo $historial->getCargaIni();?></td>
                        <td><?php echo $historial->getCargaFin();?></td>
                        <td><?php echo $historial->getFecha();?></td>
                        <td>
                            <a href="index.php?c=historial&a=edit&p=<?php echo $usado->getAplicacion()->getId()?>&v=<?php echo $usado->getVehiculo()->getId()?>&m=<?php echo $historial->getCombustible()->getId();?>&f=<?php echo $historial->getFecha(); ?>">Editar</a>&nbsp;
                            <a href="index.php?c=historial&a=delete&p=<?php echo $usado->getAplicacion()->getId()?>&v=<?php echo $usado->getVehiculo()->getId()?>&m=<?php echo $historial->getCombustible()->getId();?>&f=<?php echo $historial->getFecha(); ?>" onclick="return confirm('¿Desea borrar este registro del historial?');">Borrar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>                            
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=historial&a=index&p='.$usado->getAplicacion()->getId().'&v='.$usado->getVehiculo()->getId().'&s=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=historial&a=index&p='.$usado->getAplicacion()->getId().'&v='.$usado->getVehiculo()->getId().'&s=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=historial&a=index&p='.$usado->getAplicacion()->getId().'&v='.$usado->getVehiculo()->getId().'&s=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=historial&a=index&p='.$usado->getAplicacion()->getId().'&v='.$usado->getVehiculo()->getId().'&s=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>