<h3>Mantenimiento de Vehículos</h3>
<p>
    <a href="index.php?c=vehiculos&a=add" title="Crear"><img src="Public/img/increase.png" /></a>&nbsp;
    <a href="index.php?c=pdf&a=rep_vehiculos" target="_blank" title="Reporte"><img src="Public/img/printer.png" /></a>&nbsp;
    <a href="index.php?c=usuarios&a=tareas" title="Volver"><img src="Public/img/go_previous.png" /></a>
    <form name="frmsearch" method="post" action="index.php?c=vehiculos&a=index"> 
        <input type="search" name="txtbuscador" placeholder="Buscar por Matrícula" />&nbsp;
        <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
    </form>
</p>
<?php foreach ($vehiculos as $vehiculo){ ?>
<p>
    <table class="table1">
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
                    <a href="index.php?c=vehiculos&a=edit&p=<?php echo $vehiculo->getId(); ?>" title="Editar"><img src="Public/img/notebook_edit.png" /></a>                        
                    <?php if($vehiculo->getStatus() == 1){?>
                        <a href="index.php?c=vehiculos&a=delete&p=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea borrar el vehiculo seleccionado?');" title="Borrar"><img src="Public/img/erase.png" /></a>
                    <?php } else { ?>
                        <a href="index.php?c=vehiculos&a=reload&p=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea reactivar el vehiculo seleccionado?');" title="Reactivar"><img src="Public/img/document_revert.png" /></a>
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
        <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['primero']; ?>" title="Primero"><img src="Public/img/go_first_page.png" /></a>        
    <?php } ?>
    &nbsp;
    <?php if($paginador['anterior']) { ?>	
        <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['anterior']; ?>" title="Anterior"><img src="Public/img/go_previous_page.png" /></a>	
    <?php } ?>
    &nbsp;
    <?php if($paginador['siguiente']) { ?>	
        <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente"><img src="Public/img/go_next_page.png" /></a>
    <?php } ?>
    &nbsp;
    <?php if($paginador['ultimo']) { ?>	
        <a href="<?php echo 'index.php?c=marcas&a=index&p=' . $paginador['ultimo']; ?>" title="Último"><img src="Public/img/go_last_page.png" /></a>	
    <?php }     
    } 
?>