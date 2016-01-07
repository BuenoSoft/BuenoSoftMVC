<h3>Pagos de la Compra nro <?php echo \App\Session::get('id') ?></h3>
<p>
    <a href="index.php?c=pagos&a=add&p=<?php echo \App\Session::get('id'); ?>">[Crear]</a>&nbsp;
    <a href="index.php?c=compras&a=index">[Volver]</a>
</p>
<table>
    <thead>
        <th></th>
        <th>Pago</th>
        <th>Fecha de Pago</th>
        <th>Fecha de Vencimiento</th>
        <th>Monto del Pago</th>
    </thead>
    <tbody>
        <?php foreach ($pagos as $pago) { ?>
            <tr>
                <td><a href="index.php?c=pagos&a=delete&p=<?php echo \App\Session::get('id'); ?>&pag=<?php echo $pago->getId(); ?>" onclick="return confirm('¿Desea Borrar el Pago Seleccionado?');">[Eliminar]</a></td>
                <td><?php echo $pago->getId(); ?></td>
                <td><?php echo $pago->getFecpago(); ?></td>
                <td><?php echo $pago->getFecvenc(); ?></td>
                <td><?php echo $pago->getMonto(); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php if ($paginador != null) { ?> 
    <br />
    <?php if($paginador['primero']) { ?>	
        <a href="index.php?c=pagos&a=index&p=<?php echo \App\Session::get('id'); ?>&pg=<?php $paginador['primero']; ?>">[Primero]</a>        
    <?php } ?>
    &nbsp;
    <?php if($paginador['anterior']) { ?>	
        <a href="index.php?c=pagos&a=index&p=<?php echo \App\Session::get('id'); ?>&pg=<?php $paginador['anterior']; ?>">[Anterior]</a>	
    <?php } ?>
    &nbsp;
    <?php if($paginador['siguiente']) { ?>	
        <a href="index.php?c=pagos&a=index&p=<?php echo \App\Session::get('id'); ?>&pg=<?php $paginador['siguiente']; ?>">[Siguiente]</a>
    <?php } ?>
    &nbsp;
    <?php if($paginador['ultimo']) { ?>	
        <a href="index.php?c=pagos&a=index&p=<?php echo \App\Session::get('id'); ?>&pg=<?php $paginador['ultimo']; ?>">[Último]</a>	
    <?php }     
    } 
?>