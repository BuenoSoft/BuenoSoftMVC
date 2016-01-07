    <h3>Mantenimiento de Tipos de Vehículo</h3>
    <p>
        <a href="index.php?c=tiposveh&a=add">[Crear]</a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas">[Volver]</a>
    </p>    
    <table>
        <thead>
            <th colspan="2"></th>
            <th>Tipo de Vehiculo</th>
            <th>Nombre</th>
        </thead>
        <tbody>
            <?php foreach ($tiposveh as $tipoveh) { ?> 
                <tr> 
                    <td><a href="index.php?c=tiposveh&a=edit&p=<?php echo $tipoveh->getId(); ?>">[Editar]</a></td>
                    <td><a href="index.php?c=tiposveh&a=delete&p=<?php echo $tipoveh->getId(); ?>" onclick="return confirm('¿Desea eliminar el rol seleccionado?');">[Borrar]</a></td>
                    <td><?php echo $tipoveh->getId(); ?></td>
                    <td><?php echo $tipoveh->getNombre(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>