<h3>Mostrar Compras por fechas</h3>
<p>
    <a href="index.php?c=consultas&a=index" title="Volver"><img src="Public/img/go_previous.png" /></a>
    <form action="index.php?c=consultas&a=cons3" method="post" name="frmcons3">
        <label for="fecini">Fecha de Inicio:</label>&nbsp;<input type="date" name="dtfecini" id="fecini" />&nbsp;
        <label for="fecfin">Fecha de Cierre:</label>&nbsp;<input type="date" name="dtfecfin" id="fecfin" />&nbsp;
        <input type="button" name="btnaceptar" value="Aceptar" onclick="frmcons3.submit();" />
    </form>    
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
        <a href="<?php echo 'index.php?c=consultas&a=cons3&p=' . $paginador['primero']; ?>" title="Primero"><img src="Public/img/go_first_page.png" /></a>        
    <?php } ?>
    &nbsp;
    <?php if($paginador['anterior']) { ?>	
        <a href="<?php echo 'index.php?c=consultas&a=cons3&p=' . $paginador['anterior']; ?>" title="Anterior"><img src="Public/img/go_previous_page.png" /></a>	
    <?php } ?>
    &nbsp;
    <?php if($paginador['siguiente']) { ?>	
        <a href="<?php echo 'index.php?c=consultas&a=cons3&p=' . $paginador['siguiente']; ?>" title="Siguiente"><img src="Public/img/go_next_page.png" /></a>
    <?php } ?>
    &nbsp;
    <?php if($paginador['ultimo']) { ?>	
        <a href="<?php echo 'index.php?c=consultas&a=cons3&p=' . $paginador['ultimo']; ?>" title="Último"><img src="Public/img/go_last_page.png" /></a>	
    <?php }     
    } ?>