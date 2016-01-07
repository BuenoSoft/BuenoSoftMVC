    <h3>Mantenimiento de Usuarios</h3>
    <p>
        <a href="index.php?c=usuarios&a=add">[Crear]</a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas">[Volver]</a>&nbsp;
        <form name="frmsearch" method="post" action="index.php?c=usuarios&a=index"> 
            <label for="nick">Buscar por username:</label>&nbsp;
            <input type="search" name="txtbuscador" id="nick" />&nbsp;
            <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
        </form>
    </p>    
    <table>
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
                    <td><a href="index.php?c=usuarios&a=edit&p=<?php echo $usuario->getId(); ?>">[Editar]</a></td>
                    <td>
                        <?php if($usuario->getStatus() == 1) { ?>
                            <a href="index.php?c=usuarios&a=delete&p=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea eliminar el usuario seleccionado?');">[Borrar]</a>
                        <?php } else { ?>
                            <a href="index.php?c=usuarios&a=reload&p=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea rehabiliar el usuario seleccionado?');">[Rehabilitar]</a>
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
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['primero']; ?>">[Primero]</a>        
        <?php } ?>
        &nbsp;
        <?php if($paginador['anterior']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['anterior']; ?>">[Anterior]</a>	
        <?php } ?>
        &nbsp;
        <?php if($paginador['siguiente']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['siguiente']; ?>">[Siguiente]</a>
        <?php } ?>
        &nbsp;
        <?php if($paginador['ultimo']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['ultimo']; ?>">[Último]</a>	
        <?php }     
        } 
    ?>