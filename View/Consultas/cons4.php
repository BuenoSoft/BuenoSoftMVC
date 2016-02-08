<h3>Mostrar Mis Compras y Pagos</h3>
<p>
    <a href="index.php?c=consultas&a=index" title="Volver"><img src="Public/img/go_previous.png" /></a>
</p>
<?php foreach($compras as $compra){?>
    <p>
        <details>
            <summary>
                <?php echo "Compra: ".$compra->getId()." Fecha: ".$compra->getFecha()." Vehículo: ".$compra->getVeh()->getMat(); ?>
            </summary> 
            <br />
            <table class="table1">
                <thead>
                    <th>Pago</th>
                    <th>Fecha de Pago</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Monto del Pago</th>
                </thead>
                <tbody>
                    <?php foreach ($compra->getPagos() as $pago){ ?>
                        <tr>
                            <td><?php echo $pago->getId(); ?></td>
                            <td><?php echo $pago->getFecpago(); ?></td>
                            <td><?php echo $pago->getFecvenc(); ?></td>
                            <td><?php echo $pago->getMonto(); ?></td>
                        </tr>
                   <?php }?>
                </tbody>
            </table>
        </details>
    </p>
<?php } ?>

