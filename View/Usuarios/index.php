<h3><i class="fa fa-angle-right"></i> Mantenimiento de Usuarios</h3>
<p>
    <a href="index.php?c=access&a=index" class=""><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;    
    <a href="index.php?c=usuarios&a=add"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>    
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=usuarios&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Nombre del Usuario" width="50" class="form-control_index" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th>Usuario</th>
                <th>Nombre de Usuario</th>
                <th>Nombre Real</th>
                <th>Tipo</th>
                <th>Opciones</th>                
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario) {?>
                    <tr>                        
                        <td><?php echo $usuario->getId(); ?></td>
                        <td><?php echo $usuario->getNombre(); ?></td>
                        <td><?php echo $usuario->getDatoUsu()->getNombre(); ?></td>
                        <td><?php echo $usuario->getTipo(); ?></td>                        
                        <td>
                            <a href="index.php?c=usuarios&a=view&p=<?php echo $usuario->getId(); ?>">Ver</a>&nbsp;
                            <a href="index.php?c=usuarios&a=edit&p=<?php echo $usuario->getId(); ?>">Editar</a>&nbsp;
                            <?php if($usuario->getEstado() == 'H') {?>
                                <a href="index.php?c=usuarios&a=delete&p=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea borrar el usuario seleccionado?');">Borrar</a>
                            <?php } else { ?>
                                <a href="index.php?c=usuarios&a=active&p=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea activar el usuario seleccionado?');">Activar</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
        <br />
        <?php if($paginador['primero']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
        <?php } ?>
        &nbsp;
        <?php if($paginador['anterior']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
        <?php } ?>
        &nbsp;
        <?php if($paginador['siguiente']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
        <?php } ?>
        &nbsp;
        <?php if($paginador['ultimo']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
        <?php }     
        } 
    ?>
    </section>
</div>