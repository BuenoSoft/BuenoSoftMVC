<h3>Pagos de la Compra nro <?php echo \App\Session::get('id') ?></h3>
<p>
    <a href="index.php?c=pagos&a=add&p=<?php echo \App\Session::get('id'); ?>" title="Crear"><img src="Public/img/increase.png" /></a>&nbsp;
    <a href="index.php?c=compras&a=index" title="Volver"><img src="Public/img/go_previous.png" /></a>
</p>
<p>
    <strong>Pago Total:<?php echo " $".$compra->obtenerPagoTotal(); ?></strong>&nbsp;
    <strong>Pago Mínimo:<?php echo " $" .$compra->obtenerPagoMinimo(); ?></strong>&nbsp;
    <strong>Cuotas Restantes:<?php echo " " .$compra->obtenerCuotasRestantes(); ?></strong>
</p>
<table class="table1">
    <thead>
        <th></th>
        <th>Pago</th>
        <th>Fecha de Pago</th>
        <th>Fecha de Vencimiento</th>
        <th>Monto del Pago</th>
        <th>Cuotas Pagadas</th>
    </thead>
    <tbody>
        <?php foreach ($pagos as $pago) { ?>
            <tr>
                <td><a href="index.php?c=pagos&a=delete&p=<?php echo \App\Session::get('id'); ?>&pag=<?php echo $pago->getId(); ?>" onclick="return confirm('¿Desea Borrar el Pago Seleccionado?');" title="Borrar"><img src="Public/img/erase.png" /></a></td>
                <td><?php echo $pago->getId(); ?></td>
                <td><?php echo $pago->getFecpago(); ?></td>
                <td><?php echo $pago->getFecvenc(); ?></td>
                <td><?php echo "$".$pago->getMonto(); ?></td>
                <td><?php echo $pago->getCuotas(); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php if ($paginador != null) { ?> 
    <br />
    <?php if($paginador['primero']) { ?>	
        <a href="index.php?c=pagos&a=index&p=<?php echo \App\Session::get('id'); ?>&pg=<?php $paginador['primero']; ?>" title="Primero"><img src="Public/img/go_first_page.png" /></a>        
    <?php } ?>
    &nbsp;
    <?php if($paginador['anterior']) { ?>	
        <a href="index.php?c=pagos&a=index&p=<?php echo \App\Session::get('id'); ?>&pg=<?php $paginador['anterior']; ?>" title="Anterior"><img src="Public/img/go_previous_page.png" /></a>	
    <?php } ?>
    &nbsp;
    <?php if($paginador['siguiente']) { ?>	
        <a href="index.php?c=pagos&a=index&p=<?php echo \App\Session::get('id'); ?>&pg=<?php $paginador['siguiente']; ?>" title="Siguiente"><img src="Public/img/go_next_page.png" /></a>
    <?php } ?>
    &nbsp;
    <?php if($paginador['ultimo']) { ?>	
        <a href="index.php?c=pagos&a=index&p=<?php echo \App\Session::get('id'); ?>&pg=<?php $paginador['ultimo']; ?>" title="Último"><img src="Public/img/go_last_page.png" /></a>	
    <?php }     
    } 
?>