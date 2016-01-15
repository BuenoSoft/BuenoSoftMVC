<h3>Mostrar Compras por período</h3>
<p>
    <a href="index.php?c=consultas&a=index">[Volver]</a>
    <form action="index.php?c=consultas&a=cons1" method="post" name="frmcons1">
        <input type="radio" name="rbtnperiodo" value="d" /><b>Día</b>&nbsp;
        <input type="radio" name="rbtnperiodo" value="m" /><b>Mes</b>&nbsp;
        <input type="radio" name="rbtnperiodo" value="a" /><b>Año</b>&nbsp;
        <input type="button" name="btnaceptar" value="Aceptar" onclick="frmcons1.submit();" />
    </form>
</p>
<table>
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