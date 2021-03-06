<h3><i class="fa fa-angle-right"></i>&nbsp;Mantenimiento de Vehículos</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp; 
    <a href="index.php?c=vehiculos&a=add"><button class="btn btn-theme05" tabindex="4"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>       
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=vehiculos&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Matrícula" width="50" class="form-control_index" tabindex="1" autofocus="autofocus" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" tabindex="2" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>               
                <th>Matrícula</th>
                <th>Tipo</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach ($vehiculos as $vehiculo) { ?>                    
                    <tr style="<?php echo $style; ?>">                                                    
                        <td><?php echo $vehiculo->getMatricula(); ?></td>
                        <td><?php echo $vehiculo->getTipo()->getNombre(); ?></td>
                        <td>
                            <a href="index.php?c=vehiculos&a=view&d=<?php echo $vehiculo->getId(); ?>" title="Ver">
                                <i class="fa fa-eye" style="font-size: 22px;"></i>
                            </a>&nbsp;
                            <a href="index.php?c=vehiculos&a=edit&d=<?php echo $vehiculo->getId(); ?>" title="Editar">
                                <i class="fa fa-edit" style="font-size: 22px;"></i>
                            </a>&nbsp;
                            <a href="index.php?c=vehiculos&a=delete&d=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea borrar el Vehículo seleccionado?');" title="Borrar">
                                <i class="fa fa-times-circle" style="font-size: 22px;"></i>
                            </a>                            
                        </td>
                    </tr>
                <?php } ?>
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