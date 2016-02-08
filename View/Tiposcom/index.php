    <h3>Mantenimiento de Tipos de Compra</h3>
    <p>
        <a href="index.php?c=tiposcom&a=add" title="Crear"><img src="Public/img/increase.png" /></a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas" title="Volver"><img src="Public/img/go_previous.png" /></a>
    </p>    
    <table class="table1">
        <thead>
            <th colspan="2"></th>
            <th>Tipo</th>
            <th>Nombre</th>
        </thead>
        <tbody>
            <?php foreach ($tiposcom as $tipocom) { ?> 
                <tr> 
                    <td><a href="index.php?c=tiposcom&a=edit&p=<?php echo $tipocom->getId(); ?>" title="Editar"><img src="Public/img/notebook_edit.png" /></a></td>
                    <td><a href="index.php?c=tiposcom&a=delete&p=<?php echo $tipocom->getId(); ?>" onclick="return confirm('¿Desea eliminar el tipo seleccionado?');" title="Borrar"><img src="Public/img/erase.png" /></a></td>
                    <td><?php echo $tipocom->getId(); ?></td>
                    <td><?php echo $tipocom->getNombre(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>