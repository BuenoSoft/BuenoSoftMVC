<h3>Vehículos de la Aplicación nro <?php echo $aplicacion->getId();?></h3>
<p>
    <a href="index.php?c=aplicaciones&a=index"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <a href="index.php?c=usados&a=add&p=<?php echo $aplicacion->getId(); ?>"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Registrar</button></a>
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=usados&a=index&p=<?php echo $aplicacion->getId(); ?>"> 
                <input type="search" name="txtbuscador" placeholder="Matrícula o Conductor" width="50" class="form-control_index" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th></th>
                <th>Vehículo</th>
                <th>Conductor</th>
                <th>Capacidad</th>                
            </thead>
            <tbody>
                <?php foreach($usados as $usado) {?>
                    <tr>
                        <td>
                            <a href="index.php?c=usados&a=edit&p=<?php echo $usado->getAplicacion()->getId(); ?>&v=<?php echo $usado->getVehiculo()->getId();?>">Editar</a>&nbsp;
                            <a href="index.php?c=usados&a=delete&p=<?php echo $usado->getAplicacion()->getId(); ?>&v=<?php echo $usado->getVehiculo()->getId();?>" onclick="return confirm('¿Desea borrar el uso del vehículo seleccionado?')">Borrar</a>&nbsp;
                            <a href="index.php?c=historial&a=index&p=<?php echo $usado->getAplicacion()->getId(); ?>&v=<?php echo $usado->getVehiculo()->getId();?>">Historial</a>
                        </td>
                        <td><a href="index.php?c=usados&a=veh&v=<?php echo $usado->getVehiculo()->getId();?>"><?php echo $usado->getVehiculo()->getMatricula();?></a></td>
                        <td><?php echo $usado->getConductor(); ?></td>
                        <td><?php echo $usado->getCapacidad(); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=usados&a=index&p='.$aplicacion->getId().'&s=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=usados&a=index&p='.$aplicacion->getId().'&s=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=usados&a=index&p='.$aplicacion->getId().'&s=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=usados&a=index&p='.$aplicacion->getId().'&s=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>