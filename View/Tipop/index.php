<h3><i class="fa fa-angle-right"></i> Mantenimiento de Tipo de Producto</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="1"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp; 
    <a href="index.php?c=tipop&a=add"><button class="btn btn-theme05" tabindex="2"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>       
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <table class="table table-bordered table-striped table-condensed">
            <thead>               
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach($tipos as $tipo) { 
                    $style = ($tipo->getEstado() == "D") ? "color: #BDBDBD;" : "";                    
                ?>
                    <tr style="<?php echo $style; ?>">
                        <td><?php echo $tipo->getId(); ?></td>
                        <td><?php echo $tipo->getNombre(); ?></td>
                        <td>
                            <a href="index.php?c=tipop&a=edit&d=<?php echo $tipo->getId(); ?>" title="Editar">
                                <i class="fa fa-edit" style="font-size: 22px;"></i>
                            </a>&nbsp;
                            <?php if($tipo->getEstado() == "H") { ?>
                                <a href="index.php?c=tipop&a=delete&d=<?php echo $tipo->getId(); ?>" onclick="return confirm('¿Desea borrar el Tipo seleccionado?');" title="Borrar">
                                    <i class="fa fa-times-circle" style="font-size: 22px;"></i>
                                </a>
                            <?php } else { ?>
                                <a href="index.php?c=tipop&a=active&d=<?php echo $tipo->getId(); ?>" onclick="return confirm('¿Desea activar el Tipo seleccionado?');" title="Activar">
                                    <i class="fa fa-unlock-alt" style="font-size: 22px;"></i>
                                </a>
                            <?php }?>
                        </td>
                    </tr>
                <?php }?>                
            </tbody>            
        </table>
    </section>
</div>