    <h3>Mantenimiento de Roles</h3>
    <p>
        <a href="index.php?c=roles&a=add" title="Crear"><img src="Public/img/increase.png" /></a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas" title="Volver"><img src="Public/img/go_previous.png" /></a>
    </p>    
    <table class="table1"> 
        <thead>
            <th colspan="2"></th>
            <th>Rol</th>
            <th>Nombre</th>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol) { ?> 
                <tr> 
                    <td><a href="index.php?c=roles&a=edit&p=<?php echo $rol->getId(); ?>" title="Editar"><img src="Public/img/notebook_edit.png" /></a></td>
                    <td><a href="index.php?c=roles&a=delete&p=<?php echo $rol->getId(); ?>" onclick="return confirm('¿Desea eliminar el rol seleccionado?');" title="Borrar"><img src="Public/img/erase.png" /></a></td>
                    <td><?php echo $rol->getId(); ?></td>
                    <td><?php echo $rol->getNombre(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>