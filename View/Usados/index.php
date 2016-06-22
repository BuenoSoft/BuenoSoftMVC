<h3>Vehículos de la Aplicación número&nbsp;<?php echo $aplicacion->getId();?></h3>
<p>
    <a href="index.php?c=aplicaciones&a=index"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <table class="table table-bordered table-striped table-condensed">
            <thead>                
                <th>Vehículo</th>
                <th>Usuario</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach($usados as $usado) {?>
                    <tr>                        
                        <td>
                            <a href="index.php?c=vehiculos&a=view&d=<?php echo $usado->getVehiculo()->getId();?>" target="_blank">
                                <?php echo $usado->getVehiculo()->getMatricula();?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?c=usuarios&a=view&d=<?php echo $usado->getUsuario()->getId(); ?>" target="_blank">
                                <?php echo $usado->getUsuario()->getDatoUsu()->getNombre();?>
                            </a>                            
                        </td>
                        <td>
                            <a href="index.php?c=usados&a=historial&d=<?php echo $usado->getAplicacion()->getId(); ?>&v=<?php echo $usado->getVehiculo()->getId();?>" title="Historial">
                                <i class="fa fa-info-circle" style="font-size: 22px;"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=usados&a=index&d='.$aplicacion->getId().'&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=usados&a=index&d='.$aplicacion->getId().'&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=usados&a=index&d='.$aplicacion->getId().'&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=usados&a=index&d='.$aplicacion->getId().'&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>