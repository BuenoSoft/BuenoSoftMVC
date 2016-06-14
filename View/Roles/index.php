<h3><i class="fa fa-angle-right"></i>&nbsp;Mantenimiento de Roles</h3>
<p>
    <a href="index.php?c=access&a=index"><button class="btn btn-theme05" tabindex="1"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp; 
    <a href="index.php?c=roles&a=add"><button class="btn btn-theme05" tabindex="2"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>       
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <table class="table table-bordered table-striped table-condensed">
            <thead>               
                <th>Rol</th>
                <th>Nombre</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach($roles as $rol) { 
                    $style = ($rol->getEstado() == "D") ? "color: #BDBDBD;" : "";                    
                ?>
                    <tr style="<?php echo $style; ?>">
                        <td><?php echo $rol->getId(); ?></td>
                        <td><?php echo $rol->getNombre(); ?></td>
                        <td>
                            <a href="index.php?c=roles&a=edit&d=<?php echo $rol->getId(); ?>" title="Editar">
                                <i class="fa fa-edit" style="font-size: 22px;"></i>
                            </a>&nbsp;
                            <?php if($rol->getEstado() == "H") { ?>
                                <a href="index.php?c=roles&a=delete&d=<?php echo $rol->getId(); ?>" onclick="return confirm('¿Desea borrar el Rol seleccionado?');" title="Borrar">
                                    <i class="fa fa-minus-circle" style="font-size: 22px;"></i>
                                </a>
                            <?php } else { ?>
                                <a href="index.php?c=roles&a=active&d=<?php echo $rol->getId(); ?>" onclick="return confirm('¿Desea activar el Rol seleccionado?');" title="Activar">
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