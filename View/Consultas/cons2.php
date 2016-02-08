<h3>Mostrar Compras sin pagar</h3>
<p>
    <a href="index.php?c=consultas&a=index" title="Volver"><img src="Public/img/go_previous.png" /></a>    
</p>
<table class="table1">
    <thead>
        <th>Compra</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Cuotas</th>
    </thead>
    <tbody>
        <?php foreach($compras as $compra){?>
            <tr>
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
        <a href="<?php echo 'index.php?c=consultas&a=cons2&p=' . $paginador['primero']; ?>" title="Primero"><img src="Public/img/go_first_page.png" /></a>        
    <?php } ?>
    &nbsp;
    <?php if($paginador['anterior']) { ?>	
        <a href="<?php echo 'index.php?c=consultas&a=cons2&p=' . $paginador['anterior']; ?>" title="Anterior"><img src="Public/img/go_previous_page.png" /></a>	
    <?php } ?>
    &nbsp;
    <?php if($paginador['siguiente']) { ?>	
        <a href="<?php echo 'index.php?c=consultas&a=cons2&p=' . $paginador['siguiente']; ?>" title="Siguiente"><img src="Public/img/go_next_page.png" /></a>
    <?php } ?>
    &nbsp;
    <?php if($paginador['ultimo']) { ?>	
        <a href="<?php echo 'index.php?c=consultas&a=cons2&p=' . $paginador['ultimo']; ?>" title="Último"><img src="Public/img/go_last_page.png" /></a>	
    <?php }     
    } ?>