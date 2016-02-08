<h3>Mantenimiento de Compras</h3>
<p>
    <a href="index.php?c=compras&a=add" title="Crear"><img src="Public/img/increase.png" /></a>&nbsp;
    <a href="index.php?c=usuarios&a=tareas" title="Volver"><img src="Public/img/go_previous.png" /></a>
    <form name="frmsearch" method="post" action="index.php?c=compras&a=index">
        <input type="search" name="txtbuscador" placeholder="Buscar por Usuario" />&nbsp;
        <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
    </form>
</p>
<table class="table1">
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
                <td><a href="index.php?c=compras&a=view&p=<?php echo $compra->getId(); ?>" title="Ver"><img src="Public/img/black_view.png" /></a></td>
                <td><a href="index.php?c=compras&a=edit&p=<?php echo $compra->getId(); ?>" title="Editar"><img src="Public/img/notebook_edit.png" /></a></td>
                <td><a href="index.php?c=pagos&a=index&p=<?php echo $compra->getId(); ?>" title="Pagos"><img src="Public/img/cash.png" /></a></td>
                <td><?php echo $compra->getId(); ?></td>
                <td><?php echo $compra->getUser()->getNick(); ?></td>
                <td><?php echo $compra->getFecha(); ?></td>
                <td><?php echo $compra->obtenerCuotasPagadas()."/".$compra->getCuotas(); ?></td>
            </tr>
        <?php }?>
    </tbody>
</table>
<?php if ($paginador != null) { ?> 
    <br />
    <?php if($paginador['primero']) { ?>	
        <a href="<?php echo 'index.php?c=compras&a=index&p=' . $paginador['primero']; ?>" title="Primero"><img src="Public/img/go_first_page.png" /></a>        
    <?php } ?>
    &nbsp;
    <?php if($paginador['anterior']) { ?>	
        <a href="<?php echo 'index.php?c=compras&a=index&p=' . $paginador['anterior']; ?>" title="Anterior"><img src="Public/img/go_previous_page.png" /></a>	
    <?php } ?>
    &nbsp;
    <?php if($paginador['siguiente']) { ?>	
        <a href="<?php echo 'index.php?c=compras&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente"><img src="Public/img/go_next_page.png" /></a>
    <?php } ?>
    &nbsp;
    <?php if($paginador['ultimo']) { ?>	
        <a href="<?php echo 'index.php?c=compras&a=index&p=' . $paginador['ultimo']; ?>" title="Último"><img src="Public/img/go_last_page.png" /></a>	
    <?php }     
    } ?>