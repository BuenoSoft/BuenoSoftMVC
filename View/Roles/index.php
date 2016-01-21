    <h3>Mantenimiento de Roles</h3>
    <p>
        <a href="index.php?c=roles&a=add">[Crear]</a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas">[Volver]</a>
    </p>    
    <table> 
        <thead>
            <th colspan="2"></th>
            <th>Rol</th>
            <th>Nombre</th>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol) { ?> 
                <tr> 
                    <td><a href="index.php?c=roles&a=edit&p=<?php echo $rol->getId(); ?>">[Editar]</a></td>
                    <td><a href="index.php?c=roles&a=delete&p=<?php echo $rol->getId(); ?>" onclick="return confirm('¿Desea eliminar el rol seleccionado?');">[Borrar]</a></td>
                    <td><?php echo $rol->getId(); ?></td>
                    <td><?php echo $rol->getNombre(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>