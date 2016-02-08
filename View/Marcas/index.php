    <h3>Mantenimiento de Marcas</h3>
    <p>
        <a href="index.php?c=marcas&a=add" title="Crear"><img src="Public/img/increase.png" /></a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas" title="Volver"><img src="Public/img/go_previous.png" /></a>&nbsp;
        <form name="frmsearch" method="post" action="index.php?c=marcas&a=index"> 
            <input type="search" name="txtbuscador" placeholder="Buscar por Nombre" />&nbsp;
            <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
        </form>
    </p>    
    <table class="table1">
        <thead>
            <th colspan="2"></th>
            <th>Marca</th>
            <th>Nombre</th>
        </thead>
        <tbody>
            <?php foreach ($marcas as $marca) { ?>
                <tr> 
                    <td><a href="index.php?c=marcas&a=edit&p=<?php echo $marca->getId(); ?>" title="Editar"><img src="Public/img/notebook_edit.png" /></a></td>
                    <td>
                        <a 
                            href="index.php?c=marcas&a=delete&p=<?php echo $marca->getId(); ?>" 
                            onclick="return confirm('¿Desea eliminar la marca seleccionada?');" title="Borrar">
                            <img src="Public/img/erase.png" />
                        </a>                            
                    </td>
                    <td><?php echo $marca->getId(); ?></td>
                    <td><?php echo $marca->getNombre(); ?></td>
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
    } ?>