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
<?php foreach ($vehiculos as $vehiculo){ ?>
<p>
    <table>
        <tr>
            <td rowspan="9">
                <img src="<?php echo $vehiculo->getFoto(); ?>" width='150' height='100'>
            </td>
            <tr>
                <td>
                    <strong>Vehículo:</strong><?php echo $vehiculo->getId(); ?>&nbsp;
                    <strong>Matrícula:</strong><?php echo $vehiculo->getMat(); ?>&nbsp;
                    <strong>Tipo:</strong><?php echo $vehiculo->getTipo()->getNombre(); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Precio:</strong><?php echo $vehiculo->getPrecio(); ?>&nbsp;
                    <strong>Cantidad:</strong><?php echo $vehiculo->getCant(); ?>&nbsp;
                    <strong>Modelo:</strong><?php echo $vehiculo->getModelo()->getNombre(); ?>&nbsp;
                </td>                       
            </tr>
            <tr>
                <td>
                    <strong>Descripción:</strong>
                    <p>
                        <?php echo $vehiculo->getDescrip(); ?>
                    </p>
                </td>                        
            </tr>
            <tr>
                <td style="text-align: center;">
                    <a href="index.php?c=vehiculos&a=edit&p=<?php echo $vehiculo->getId(); ?>">[Editar]</a>                        
                    <?php if($vehiculo->getStatus() == 1){?>
                        <a href="index.php?c=vehiculos&a=delete&p=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea borrar el vehiculo seleccionado?');">[Borrar]</a>
                    <?php } else { ?>
                        <a href="index.php?c=vehiculos&a=reload&p=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea reactivar el vehiculo seleccionado?');">[Reactivar]</a>
                    <?php }  ?>
                </td>
            </tr>
        </tr>
    </table>
</p>
<?php }
    if ($paginador != null) { ?> 
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