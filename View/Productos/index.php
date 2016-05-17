<h3><i class="fa fa-angle-right"></i> Mantenimiento de Productos</h3>
<p>
    <a href="index.php?c=productos&a=add">Crear</a>&nbsp;
    <a href="index.php?c=access&a=index">Volver</a>    
</p>
<div class="content-panel">
    <section id="unseen">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=productos&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Nombre del Producto" width="50" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Aceptar" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th></th>
                <th>Producto</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Marca</th>
            </thead>
            <tbody>
                <?php foreach($productos as $producto){ ?>
                <tr>
                    <td>
                        <a href="index.php?c=productos&a=edit&p=<?php echo $producto->getId(); ?>">Editar</a>&nbsp;
                        <?php if($producto->getEstado() == 'H'){ ?>
                            <a href="index.php?c=productos&a=delete&p=<?php echo $producto->getId(); ?>" onclick="return confirm('¿Desea borrar el producto seleccionado?');">Borrar</a>
                        <?php } else {?>
                            <a href="index.php?c=productos&a=active&p=<?php echo $producto->getId(); ?>" onclick="return confirm('¿Desea activar el producto seleccionado?');">Activar</a>
                        <?php }?>
                    </td>
                    <td><?php echo $producto->getId(); ?></td>
                    <td><?php echo $producto->getCodigo(); ?></td>
                    <td><?php echo $producto->getNombre(); ?></td>
                    <td><?php echo $producto->getMarca(); ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=productos&a=index&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=productos&a=index&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=productos&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=productos&a=index&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>