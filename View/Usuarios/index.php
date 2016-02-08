    <h3>Mantenimiento de Usuarios</h3>
    <p>
        <a href="index.php?c=usuarios&a=add" title="Crear"><img src="Public/img/increase.png" /></a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas" title="Volver"><img src="Public/img/go_previous.png" /></a>&nbsp;
        <form name="frmsearch" method="post" action="index.php?c=usuarios&a=index"> 
            <input type="search" name="txtbuscador" placeholder="Buscar por username" />&nbsp;
            <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
        </form>
    </p>    
    <table class="table1">
        <thead>
            <th colspan="2"></th>
            <th>Usuario</th>
            <th>Username</th>
            <th>Correo</th>
            <th>Nombre Completo</th>
            <th>Rol</th>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) { ?>
                <tr> 
                    <td><a href="index.php?c=usuarios&a=edit&p=<?php echo $usuario->getId(); ?>" title="Editar"><img src="Public/img/notebook_edit.png" /></a></td>
                    <td>
                        <?php if($usuario->getStatus() == 1) { ?>
                            <a href="index.php?c=usuarios&a=delete&p=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea eliminar el usuario seleccionado?');" title="Borrar"><img src="Public/img/erase.png" /></a>
                        <?php } else { ?>
                            <a href="index.php?c=usuarios&a=reload&p=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea rehabiliar el usuario seleccionado?');" title="Rehabilitar"><img src="Public/img/document_revert.png" /></a>
                        <?php } ?>    
                    </td>
                    <td><?php echo $usuario->getId(); ?></td>
                    <td><?php echo $usuario->getNick(); ?></td>
                    <td><?php echo $usuario->getCorreo(); ?></td>
                    <td><?php echo $usuario->getNombre()." ".$usuario->getApellido(); ?></td>
                    <td><?php echo $usuario->getRol()->getNombre(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if ($paginador != null) { ?> 
        <br />
        <?php if($paginador['primero']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['primero']; ?>" title="Primero"><img src="Public/img/go_first_page.png" /></a>        
        <?php } ?>
        &nbsp;
        <?php if($paginador['anterior']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['anterior']; ?>" title="Anterior"><img src="Public/img/go_previous_page.png" /></a>	
        <?php } ?>
        &nbsp;
        <?php if($paginador['siguiente']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente"><img src="Public/img/go_next_page.png" /></a>
        <?php } ?>
        &nbsp;
        <?php if($paginador['ultimo']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['ultimo']; ?>" title="Último"><img src="Public/img/go_last_page.png" /></a>	
        <?php }     
        } 
    ?>