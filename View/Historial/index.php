<h3>Historial del Vehículo <?php echo $usado->getVehiculo()->getId(); ?>, de la Aplicación nro <?php echo $usado->getAplicacion()->getId(); ?></h3>
<p>
    <a href="index.php?c=usados&a=index&p=<?php echo $usado->getAplicacion()->getId(); ?>"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <a href="index.php?c=historial&a=add&p=<?php echo $usado->getAplicacion()->getId(); ?>&v=<?php echo $usado->getVehiculo()->getId(); ?>"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Registrar</button></a>
</p>