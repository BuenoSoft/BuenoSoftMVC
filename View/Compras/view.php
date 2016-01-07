<h3>Ver Compra nro: <?php echo \App\Session::get('id'); ?></h3>
<table>
    <tr>
        <td>Fecha de la Compra:</td>
        <td><?php echo $compra->getFecha(); ?></td>
    </tr>
    <tr>
        <td>Cantidad de Cuotas:</td>
        <td><?php echo $compra->getCuotas(); ?></td>
    </tr>
    <tr>
        <td>Cantidad Comprada:</td>
        <td><?php echo $compra->getCant(); ?></td>
    </tr>
    <tr>
        <td>Tipo de Compra:</td>
        <td><?php echo $compra->getTipo()->getNombre(); ?></td>
    </tr>
    <tr>
        <td>Cliente:</td>
        <td><?php echo $compra->getUser()->getNick(); ?></td>
    </tr>
    <tr>
        <td>Vehículo</td>
        <td><?php echo $compra->getVeh()->getMat(); ?></td>
    </tr>
    
</table>
<p>     
    <a href="index.php?c=compras&a=index"><input type="button" value="Volver" /></a>
</p>