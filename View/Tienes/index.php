<h3>Productos de la Aplicación número&nbsp;<?php echo $aplicacion->getId();?></h3>
<p>
    <a href="index.php?c=aplicaciones&a=index"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <a href="index.php?c=tienes&a=add&p=<?php echo $aplicacion->getId(); ?>"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Registrar</button></a>
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=tienes&a=index&p=<?php echo $aplicacion->getId(); ?>"> 
                <input type="search" name="txtbuscador" placeholder="Nombre del Producto" width="50" class="form-control_index" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>                
                <th>Producto</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Marca</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach($productos as $producto){ ?>
                <tr>                    
                    <td><?php echo $producto->getId(); ?></td>
                    <td><?php echo $producto->getNombre(); ?></td>
                    <td><?php echo $producto->getCodigo(); ?></td>
                    <td><?php echo $producto->getMarca(); ?></td>
                    <td>
                        <a href="index.php?c=tienes&a=delete&ap=<?php echo $aplicacion->getId();?>&p=<?php echo $producto->getId(); ?>" onclick="return confirm('¿Desea borrar el producto seleccionado?');">Borrar</a>                        
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=tienes&a=index&p='.$aplicacion->getId().'&s=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=tienes&a=index&p='.$aplicacion->getId().'&s=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=tienes&a=index&p='.$aplicacion->getId().'&s=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=tienes&a=index&p='.$aplicacion->getId().'&s=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>