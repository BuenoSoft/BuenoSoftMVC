<h3><i class="fa fa-angle-right"></i> Mantenimiento de Usuarios</h3>
<p>
    <a href="index.php?c=usuarios&a=add">Crear</a>&nbsp;
    <a href="index.php?c=access&a=index">Volver</a>    
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
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Cliente</th>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario) {?>
                    <tr>
                        <td><?php echo $usuario->getId() ;?></td>
                        <td><?php echo $usuario->getNombre() ;?></td>
                        <td><?php echo $usuario->getTipo() ;?></td>
                        <td><?php echo $usuario->getCliente()->getId() ;?></td>
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