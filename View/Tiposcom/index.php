    <h3>Mantenimiento de Tipos de Compra</h3>
    <p>
        <a href="index.php?c=tiposcom&a=add">[Crear]</a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas">[Volver]</a>
    </p>    
    <table>
        <thead>
            <th colspan="2"></th>
            <th>Tipo</th>
            <th>Nombre</th>
        </thead>
        <tbody>
            <?php foreach ($tiposcom as $tipocom) { ?> 
                <tr> 
                    <td><a href="index.php?c=tiposcom&a=edit&p=<?php echo $tipocom->getId(); ?>">[Editar]</a></td>
                    <td><a href="index.php?c=tiposcom&a=delete&p=<?php echo $tipocom->getId(); ?>" onclick="return confirm('¿Desea eliminar el tipo seleccionado?');">[Borrar]</a></td>
                    <td><?php echo $tipocom->getId(); ?></td>
                    <td><?php echo $tipocom->getNombre(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>