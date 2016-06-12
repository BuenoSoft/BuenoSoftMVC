<h3><i class="fa fa-angle-right"></i> Mantenimiento de Tipo de Vehículo</h3>
<p>
    <a href="index.php?c=access&a=index"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp; 
    <a href="index.php?c=tipov&a=add"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>       
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <table class="table table-bordered table-striped table-condensed">
            <thead>               
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Unidad de Medida</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach($tipos as $tipo) { 
                    $style = ($tipo->getEstado() == "D") ? "color: #BDBDBD;" : "";                    
                ?>
                    <tr style="<?php echo $style; ?>">
                        <td><?php echo $tipo->getId(); ?></td>
                        <td><?php echo $tipo->getNombre(); ?></td>
                        <td><?php echo $tipo->getMedida(); ?></td>
                        <td>
                            <a href="index.php?c=tipov&a=edit&d=<?php echo $tipo->getId(); ?>">Editar</a>&nbsp;
                            <?php if($tipo->getEstado() == "H") { ?>
                                <a href="index.php?c=tipov&a=delete&d=<?php echo $tipo->getId(); ?>" onclick="return confirm('¿Desea borrar el Tipo seleccionado?');">Borrar</a>
                            <?php } else { ?>
                                <a href="index.php?c=tipov&a=active&d=<?php echo $tipo->getId(); ?>" onclick="return confirm('¿Desea activar el Tipo seleccionado?');">Activar</a>
                            <?php }?>
                        </td>
                    </tr>
                <?php }?>  
            </tbody>
        </table>
    </section>
</div>