<h3>Mantenimiento de Aplicaciones</h3>
<p>
    <a href="index.php?c=access&a=index"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <a href="index.php?c=aplicaciones&a=add"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>    
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=aplicaciones&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Buscar por su documento único" width="50" class="form-control_index" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th></th>
                <th>Aplicación</th>
                <th>Fecha de Inicio</th>
                <th>Estado</th>
                <th>Cliente</th>
            </thead>
            <tbody>
                <?php foreach ($aplicaciones as $aplicacion) { ?>
                    <tr>
                        <td>
                            <a href="index.php?c=aplicaciones&a=view&p=<?php echo $aplicacion->getId(); ?>">Ver</a>&nbsp;
                            <a href="index.php?c=aplicaciones&a=edit&p=<?php echo $aplicacion->getId(); ?>">Editar</a>&nbsp;
                            <a href="index.php?c=tienes&a=index&p=<?php echo $aplicacion->getId(); ?>">Productos</a>&nbsp;
                            <a href="index.php?c=usados&a=index&p=<?php echo $aplicacion->getId(); ?>">Usados</a>&nbsp;
                        </td>
                        <td><?php echo $aplicacion->getId(); ?></td>
                        <td><?php echo $aplicacion->getFechaIni(); ?></td>
                        <td><?php echo $aplicacion->getEstado(); ?></td>
                        <td><a href="index.php?c=aplicaciones&a=cliente&v=<?php echo $aplicacion->getCliente()->getId(); ?>"><?php echo $aplicacion->getCliente()->getNombre(); ?></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=aplicaciones&a=index&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=aplicaciones&a=index&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=aplicaciones&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=aplicaciones&a=index&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>