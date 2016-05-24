<h3><i class="fa fa-angle-right"></i> Mantenimiento de Combustibles</h3>
<p>
    <a href="index.php?c=access&a=index"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <a href="index.php?c=combustibles&a=add"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>        
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=combustibles&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Nombre del Combustible" width="50" class="form-control_index" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th></th>
                <th>Combustible</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Fecha de Carga</th>
            </thead>
            <tbody>
                <?php foreach($combustibles as $combustible){ ?>
                    <tr>
                        <td>
                            <a href="index.php?c=combustibles&a=edit&p=<?php echo $combustible->getId(); ?>">Editar</a>&nbsp;
                            <?php if($combustible->getEstado() == 'H'){ ?>
                            <a href="index.php?c=combustibles&a=delete&p=<?php echo $combustible->getId(); ?>" onclick="return confirm('¿Desea borrar el combustible seleccionado?');">Borrar</a>
                        <?php } else {?>
                            <a href="index.php?c=combustibles&a=active&p=<?php echo $combustible->getId(); ?>" onclick="return confirm('¿Desea activar el combustible seleccionado?');">Activar</a>
                        <?php }?>
                        </td>
                        <td><?php echo $combustible->getId(); ?></td>
                        <td><?php echo $combustible->getNombre(); ?></td>
                        <td><?php echo $combustible->getStock(); ?></td>
                        <td><?php echo $combustible->getFecha(); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=combustibles&a=index&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=combustibles&a=index&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=combustibles&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=combustibles&a=index&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>