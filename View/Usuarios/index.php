<h3><i class="fa fa-angle-right"></i> Mantenimiento de Usuarios</h3>
<p>
    <a href="index.php?c=access&a=index" class=""><button>Volver</button></a>&nbsp;    
    <a href="index.php?c=usuarios&a=add"><button>Crear</button></a>    
</p>
<div class="content-panel">
    <section id="unseen">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=usuarios&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Nombre del Usuario" width="50" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th></th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Cliente</th>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario) {?>
                    <tr>
                        <td>
                            <a href="index.php?c=usuarios&a=view&p=<?php echo $usuario->getId(); ?>">Ver</a>&nbsp;
                            <a href="index.php?c=usuarios&a=edit&p=<?php echo $usuario->getId(); ?>">Editar</a>&nbsp;
                            <?php if($usuario->getEstado() == 'H') {?>
                                <a href="index.php?c=usuarios&a=delete&p=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea borrar el usuario seleccionado?');">Borrar</a>
                            <?php } else { ?>
                                <a href="index.php?c=usuarios&a=active&p=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea activar el usuario seleccionado?');">Activar</a>
                            <?php } ?>
                        </td>
                        <td><?php echo $usuario->getId(); ?></td>
                        <td><?php echo $usuario->getNombre(); ?></td>
                        <td><?php echo $usuario->getTipo(); ?></td>
                        <td><?php echo $usuario->getSujeto()->getNombre(); ?></td>
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