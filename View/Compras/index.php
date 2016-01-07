<h3>Mantenimiento de Compras</h3>
<p>
    <a href="index.php?c=compras&a=add">[Crear]</a>&nbsp;
    <a href="index.php?c=usuarios&a=tareas">[Volver]</a>
    <form name="frmsearch" method="post" action="index.php?c=compras&a=index">
        <label for="nick">Buscar por Usuario:</label>&nbsp;
        <input type="search" name="txtbuscador" id="nick" />&nbsp;
        <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
    </form>
</p>
<table>
    <thead>
        <th colspan="3"></th>
        <th>Compra</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Cuotas</th>
    </thead>
    <tbody>
        <?php foreach($compras as $compra){?>
            <tr>
                <td><a href="index.php?c=compras&a=view&p=<?php echo $compra->getId(); ?>">[Ver]</a></td>
                <td><a href="index.php?c=compras&a=edit&p=<?php echo $compra->getId(); ?>">[Editar]</a></td>
                <td><a href="index.php?c=pagos&a=index&p=<?php echo $compra->getId(); ?>">[Pagos]</a></td>
                <td><?php echo $compra->getId(); ?></td>
                <td><?php echo $compra->getUser()->getNick(); ?></td>
                <td><?php echo $compra->getFecha(); ?></td>
                <td><?php echo count($compra->getPagos())."/".$compra->getCuotas(); ?></td>
            </tr>
        <?php }?>
    </tbody>
</table>
<?php if ($paginador != null) { ?> 
    <br />
    <?php if($paginador['primero']) { ?>	
        <a href="<?php echo 'index.php?c=compras&a=index&p=' . $paginador['primero']; ?>">[Primero]</a>        
    <?php } ?>
    &nbsp;
    <?php if($paginador['anterior']) { ?>	
        <a href="<?php echo 'index.php?c=compras&a=index&p=' . $paginador['anterior']; ?>">[Anterior]</a>	
    <?php } ?>
    &nbsp;
    <?php if($paginador['siguiente']) { ?>	
        <a href="<?php echo 'index.php?c=compras&a=index&p=' . $paginador['siguiente']; ?>">[Siguiente]</a>
    <?php } ?>
    &nbsp;
    <?php if($paginador['ultimo']) { ?>	
        <a href="<?php echo 'index.php?c=compras&a=index&p=' . $paginador['ultimo']; ?>">[Último]</a>	
    <?php }     
    } ?>