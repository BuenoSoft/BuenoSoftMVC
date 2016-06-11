<h3>Mantenimiento de Aplicaciones</h3>
<p>
    <a href="index.php?c=access&a=index"><button class="btn btn-theme05"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <a href="index.php?c=aplicaciones&a=add"><button class="btn btn-theme05"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>    
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=aplicaciones&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Buscar por su documento único" width="50" class="form-control_index" tabindex="1" autofocus="autofocus" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" tabindex="2" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>                
                <th>Aplicación</th>                
                <th>Cliente</th>
                <th>Pista</th>
                <th>Estado</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach ($aplicaciones as $aplicacion) { ?>
                    <tr>
                        <td><?php echo $aplicacion->getId(); ?></td>
                        <td><a href="index.php?c=aplicaciones&a=cliente&v=<?php echo $aplicacion->getCliente()->getId(); ?>"><?php echo $aplicacion->getCliente()->getNombre(); ?></a></td>
                        <td><?php echo $aplicacion->getPista()->getNombre(); ?></td>
                        <td>
                            <?php  
                                if($aplicacion->getFechaFin() == null or $aplicacion->getFechaFin() == "0000-00-00 00:00:00"){
                                    if($aplicacion->getFechaIni() == "0000-00-00 00:00:00"){
                                        echo "En espera";
                                    }
                                    else {
                                        echo "Iniciado: ".$aplicacion->getFechaIni();
                                    }
                                }
                                else {
                                    echo "Finalizado: ".$aplicacion->getFechaFin();
                                }
                            ?>                        
                        </td>
                        <td>
                            <a href="index.php?c=aplicaciones&a=view&d=<?php echo $aplicacion->getId(); ?>">Ver</a>&nbsp;
                            <a href="index.php?c=aplicaciones&a=edit&d=<?php echo $aplicacion->getId(); ?>">Editar</a>&nbsp;
                            <a href="index.php?c=usados&a=index&d=<?php echo $aplicacion->getId(); ?>">Usados</a>&nbsp;
                        </td>
                        
                        
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