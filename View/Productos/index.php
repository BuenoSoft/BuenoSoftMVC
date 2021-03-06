<h3><i class="fa fa-angle-right"></i> Mantenimiento de Productos</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp; 
    <a href="index.php?c=productos&a=add"><button class="btn btn-theme05" tabindex="4"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>      
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=productos&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Nombre del Producto" width="50" class="form-control_index" tabindex="1" autofocus="autofocus" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" tabindex="2" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>                
                <th>Nombre</th>                
                <th>Código</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach($productos as $producto){ ?>
                <tr>                    
                    <td><?php echo $producto->getNombre(); ?></td>
                    <td><?php echo $producto->getCodigo(); ?></td>
                    <td><?php echo $producto->getMarca(); ?></td>
                    <td><?php echo $producto->getTipo()->getNombre(); ?></td>
                    <td>
                        <a href="index.php?c=productos&a=view&d=<?php echo $producto->getId(); ?>" title="Ver">
                            <i class="fa fa-eye" style="font-size: 22px;"></i>
                        </a>&nbsp;
                        <a href="index.php?c=productos&a=edit&d=<?php echo $producto->getId(); ?>" title="Editar">
                            <i class="fa fa-edit" style="font-size: 22px;"></i>
                        </a>&nbsp;
                        <a href="index.php?c=productos&a=delete&d=<?php echo $producto->getId(); ?>" onclick="return confirm('¿Desea borrar el producto seleccionado?');" title="Borrar">
                            <i class="fa fa-times-circle" style="font-size: 22px;"></i>
                        </a>                        
                    </td>
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