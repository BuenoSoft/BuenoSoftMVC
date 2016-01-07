<h3>Mantenimiento de Vehículos</h3>
<p>
    <a href="index.php?c=vehiculos&a=add">[Crear]</a>&nbsp;
    <a href="index.php?c=pdf&a=rep_vehiculos" target="_blank">[Reporte]</a>&nbsp;
    <a href="index.php?c=usuarios&a=tareas">[Volver]</a>
    <form name="frmsearch" method="post" action="index.php?c=vehiculos&a=index"> 
        <label for="nick">Buscar por Matrícula:</label>&nbsp;
        <input type="search" name="txtbuscador" id="nick" />&nbsp;
        <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
    </form>
</p>
<table>
    <thead>
        <th colspan="2"></th>
        <th>Vehículo</th>
        <th>Matrícula</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Descripción</th>
        <th>Foto</th>
        <th>Modelo</th>
        <th>Tipo Veh</th>
    </thead>
    <tbody>
        <?php foreach ($vehiculos as $vehiculo){ ?>
            <tr>
                <td><a href="index.php?c=vehiculos&a=edit&p=<?php echo $vehiculo->getId(); ?>">[Editar]</a></td>
                <td>
                    <?php if($vehiculo->getStatus() == 1){?>
                        <a href="index.php?c=vehiculos&a=delete&p=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea borrar el vehiculo seleccionado?');">[Borrar]</a>
                    <?php } else { ?>
                        <a href="index.php?c=vehiculos&a=reload&p=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea reactivar el vehiculo seleccionado?');">[Reactivar]</a>
                    <?php }  ?>
                </td>
                <td><?php echo $vehiculo->getId(); ?></td>
                <td><?php echo $vehiculo->getMat(); ?></td>
                <td><?php echo $vehiculo->getPrecio(); ?></td>
                <td><?php echo $vehiculo->getCant(); ?></td>
                <td><?php echo $vehiculo->getDescrip(); ?></td>
                <td><img src="<?php echo $vehiculo->getFoto(); ?>" width='150' height='100'></td>
                <td><?php echo $vehiculo->getModelo()->getNombre(); ?></td>
                <td><?php echo $vehiculo->getTipo()->getNombre(); ?></td>
            </tr>
        <?php }?>
    </tbody>
</table>
<?php if ($paginador != null) { ?> 
    <br />
    <?php if($paginador['primero']) { ?>	
        <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['primero']; ?>">[Primero]</a>        
    <?php } ?>
    &nbsp;
    <?php if($paginador['anterior']) { ?>	
        <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['anterior']; ?>">[Anterior]</a>	
    <?php } ?>
    &nbsp;
    <?php if($paginador['siguiente']) { ?>	
        <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['siguiente']; ?>">[Siguiente]</a>
    <?php } ?>
    &nbsp;
    <?php if($paginador['ultimo']) { ?>	
        <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['ultimo']; ?>">[Último]</a>	
    <?php }     
    } 
?>