<h3>Mantenimiento de Modelos</h3>
    <p>
        <a href="index.php?c=modelos&a=add" title="Crear"><img src="Public/img/increase.png" /></a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas" title="Volver"><img src="Public/img/go_previous.png" /></a>
        <form name="frmsearch" method="post" action="index.php?c=modelos&a=index"> 
            <input type="search" name="txtbuscador" placeholder="Buscar por Nombre" />&nbsp;
            <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
        </form>
    </p>
    <table class="table1">
        <thead>
            <th colspan="2"></th>
            <th>Modelo</th>
            <th>Nombre</th>
            <th>Marca</th>
        </thead>
        <tbody>
            <?php foreach ($modelos as $modelo) { ?>
            <tr>
                    <td><a href="index.php?c=modelos&a=edit&p=<?php echo $modelo->getId(); ?>" title="Editar"><img src="Public/img/notebook_edit.png" /></a></td>
                    <td>
                        <a 
                            href="index.php?c=modelos&a=delete&p=<?php echo $modelo->getId(); ?>" 
                            onclick="return confirm('¿Desea eliminar el modelo seleccionado?');" title="Borrar">
                            <img src="Public/img/erase.png" />
                        </a>
                    </td>
                    <td><?php echo $modelo->getId(); ?></td>
                    <td><?php echo $modelo->getNombre(); ?></td>
                    <td><?php echo $modelo->getMarca()->getNombre(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if ($paginador != null) { ?> 
        <br />
        <?php if($paginador['primero']) { ?>	
            <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['primero']; ?>" title="Primero"><img src="Public/img/go_first_page.png" /></a>        
        <?php } ?>
        &nbsp;
        <?php if($paginador['anterior']) { ?>	
            <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['anterior']; ?>" title="Anterior"><img src="Public/img/go_previous_page.png" /></a>	
        <?php } ?>
        &nbsp;
        <?php if($paginador['siguiente']) { ?>	
            <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente"><img src="Public/img/go_next_page.png" /></a>
        <?php } ?>
        &nbsp;
        <?php if($paginador['ultimo']) { ?>	
            <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['ultimo']; ?>" title="Último"><img src="Public/img/go_last_page.png" /></a>	
        <?php }     
        } 
    ?>