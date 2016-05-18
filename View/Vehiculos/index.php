<h3><i class="fa fa-angle-right"></i> Mantenimiento de Vehículos</h3>
<p>
    <a href="index.php?c=access&a=index"><button>Volver</button></a>&nbsp; 
    <a href="index.php?c=vehiculos&a=add"><button>Crear</button></a>       
</p>
<div class="content-panel">
    <section id="unseen">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=vehiculos&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Nombre del Vehículo" width="50" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th></th>
                <th>Vehículo</th>
                <th>Matrícula</th>
                <th>Tipo</th>
                <th>Combustible</th>
            </thead>
            <tbody>
                <?php foreach ($vehiculos as $vehiculo) { ?>
                    <tr>
                        <td>
                            <a href="index.php?c=vehiculos&a=view&p=<?php echo $vehiculo->getId(); ?>">Ver</a>&nbsp;
                            <a href="index.php?c=vehiculos&a=edit&p=<?php echo $vehiculo->getId(); ?>">Editar</a>&nbsp;
                            <?php if($vehiculo->getEstado() == "H") { ?>
                                <a href="index.php?c=vehiculos&a=delete&p=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea borrar el Vehículo seleccionado?');">Borrar</a>
                            <?php } else { ?>
                                <a href="index.php?c=vehiculos&a=active&p=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea activar el Vehículo seleccionado?');">Activar</a>
                            <?php }?>
                        </td>
                        <td><?php echo $vehiculo->getId(); ?></td>
                        <td><?php echo $vehiculo->getMatricula(); ?></td>
                        <td><?php echo $vehiculo->getTipo(); ?></td>
                        <td><?php echo $vehiculo->getCombustible()->getNombre(); ?></td>                        
                    </tr>
                <?php }?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=vehiculos&a=index&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=vehiculos&a=index&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=vehiculos&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=vehiculos&a=index&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>