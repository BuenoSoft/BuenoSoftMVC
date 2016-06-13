<h3><i class="fa fa-angle-right"></i>Aplicaciones por período</h3>
<p>
    <a href="index.php?c=consultas&a=index"><button class="btn btn-theme05" tabindex="2"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
</p>
<p>
    <form method="post" action="index.php?c=consultas&a=periodo" name="frmperiodo">
        <input type="radio" name="rbtnperiodo" value="d"  /><b>&nbsp;Día</b>&nbsp;
        <input type="radio" name="rbtnperiodo" value="m"  /><b>&nbsp;Mes</b>&nbsp;
        <input type="radio" name="rbtnperiodo" value="a"  /><b>&nbsp;Año</b>&nbsp;
        <button name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="1"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
    </form>        
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <table class="table table-bordered table-striped table-condensed">
            <thead>                
                <th>Aplicación</th>                
                <th>Cliente</th>
                <th>Pista</th>
                <th>Estado</th>
            </thead>
            <tbody>
                <?php foreach ($aplicaciones as $aplicacion) { ?>
                    <tr>
                        <td><a href="index.php?c=aplicaciones&a=view&d=<?php echo $aplicacion->getId(); ?>" target="_blank"><?php echo $aplicacion->getId(); ?></a></td>
                        <td><a href="index.php?c=usuarios&a=view&d=<?php echo $aplicacion->getCliente()->getId(); ?>" target="_blank"><?php echo $aplicacion->getCliente()->getNombre(); ?></a></td>
                        <td><a href="index.php?c=pistas&a=view&d=<?php echo $aplicacion->getPista()->getId(); ?>" target="_blank"><?php echo $aplicacion->getPista()->getNombre(); ?></a></td>
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=consultas&a=periodo&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=consultas&a=periodo&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=consultas&a=periodo&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=consultas&a=periodo&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>      