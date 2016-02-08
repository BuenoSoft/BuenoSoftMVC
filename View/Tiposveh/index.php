    <h3>Mantenimiento de Tipos de Vehículo</h3>
    <p>
        <a href="index.php?c=tiposveh&a=add" title="Crear"><img src="Public/img/increase.png" /></a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas" title="Volver"><img src="Public/img/go_previous.png" /></a>
    </p>    
    <table class="table1">
        <thead>
            <th colspan="2"></th>
            <th>Tipo de Vehiculo</th>
            <th>Nombre</th>
        </thead>
        <tbody>
            <?php foreach ($tiposveh as $tipoveh) { ?> 
                <tr> 
                    <td><a href="index.php?c=tiposveh&a=edit&p=<?php echo $tipoveh->getId(); ?>" title="Editar"><img src="Public/img/notebook_edit.png" /></a></td>
                    <td><a href="index.php?c=tiposveh&a=delete&p=<?php echo $tipoveh->getId(); ?>" onclick="return confirm('¿Desea eliminar el rol seleccionado?');" title="Borrar"><img src="Public/img/erase.png" /></a></td>
                    <td><?php echo $tipoveh->getId(); ?></td>
                    <td><?php echo $tipoveh->getNombre(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>