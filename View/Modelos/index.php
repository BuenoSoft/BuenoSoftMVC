<h3>Mantenimiento de Modelos</h3>
    <p>
        <a href="index.php?c=modelos&a=add">[Crear]</a>&nbsp;
        <a href="index.php?c=usuarios&a=tareas">[Volver]</a>
        <form name="frmsearch" method="post" action="index.php?c=modelos&a=index"> 
            <label for="nick">Buscar por Nombre:</label>&nbsp;
            <input type="search" name="txtbuscador" id="nick" />&nbsp;
            <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
        </form>
    </p>
    <table>
        <thead>
            <th colspan="2"></th>
            <th>Modelo</th>
            <th>Nombre</th>
            <th>Marca</th>
        </thead>
        <tbody>
            <?php foreach ($modelos as $modelo) { ?>
            <tr>
                    <td><a href="index.php?c=modelos&a=edit&p=<?php echo $modelo->getId(); ?>">[Editar]</a></td>
                    <td>
                        <a 
                            href="index.php?c=modelos&a=delete&p=<?php echo $modelo->getId(); ?>" 
                            onclick="return confirm('¿Desea eliminar el modelo seleccionado?');">
                            [Borrar]
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
            <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['primero']; ?>">[Primero]</a>        
        <?php } ?>
        &nbsp;
        <?php if($paginador['anterior']) { ?>	
            <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['anterior']; ?>">[Anterior]</a>	
        <?php } ?>
        &nbsp;
        <?php if($paginador['siguiente']) { ?>	
            <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['siguiente']; ?>">[Siguiente]</a>
        <?php } ?>
        &nbsp;
        <?php if($paginador['ultimo']) { ?>	
            <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['ultimo']; ?>">[Último]</a>	
        <?php }     
        } 
    ?>