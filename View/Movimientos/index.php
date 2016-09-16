<h3><i class="fa fa-angle-right"></i>&nbsp;Mantenimiento de Movimientos</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp; 
    <a href="index.php?c=movimientos&a=add"><button class="btn btn-theme05" tabindex="4"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>       
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=movimientos&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Emisor o Receptor" width="50" class="form-control_index" tabindex="1" autofocus="autofocus" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" tabindex="2" />
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Emisor</th>
                <th>Receptor</th>
                <th>Usuario</th>
                <th>Opciones</th>                
            </thead>
            <tbody>
                <?php foreach($movimientos as $movimiento) { ?>
                    <tr>                       
                        <td><?php echo $movimiento->inverseDateIni();?></td>
                        <td><?php echo $movimiento->getCantidad();?></td>
                        <td>
                            <?php if($movimiento->getComEmi() != null && $movimiento->getVehEmi() == null) { ?>
                                <a href="index.php?c=movimientos&a=combustible&d=<?php echo $movimiento->getComEmi()->getId(); ?>">
                                    <?php echo $movimiento->getComEmi()->getNombre(); ?>
                                </a>
                            <?php } else if($movimiento->getComEmi() == null && $movimiento->getVehEmi() != null) {?>
                                <a href="index.php?c=movimientos&a=vehiculo&d=<?php echo $movimiento->getVehEmi()->getId(); ?>">
                                    <?php echo $movimiento->getVehEmi()->getMatricula(); ?>
                                </a>
                            <?php } else {
                                    echo "Compra";
                                }
                            ?>
                        </td>
                        <td>
                            <?php if($movimiento->getComRec() != null) { ?>
                                <a href="index.php?c=movimientos&a=combustible&d=<?php echo $movimiento->getComRec()->getId(); ?>"">
                                    <?php echo $movimiento->getComRec()->getNombre() ; ?>
                                </a>
                            <?php } else {?>
                                <a href="index.php?c=movimientos&a=vehiculo&d=<?php echo $movimiento->getVehRec()->getId(); ?>">
                                    <?php echo $movimiento->getVehRec()->getMatricula(); ?>
                                </a>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="index.php?c=movimientos&a=usuario&d=<?php echo $movimiento->getUsuario()->getId(); ?>">
                                <?php echo $movimiento->getUsuario()->getNomReal(); ?>
                            </a>                            
                        </td>
                        <td>
                            <a href="index.php?c=movimientos&a=delete&d=<?php echo $movimiento->getId()?>" onclick="return confirm('¿Desea borrar este movimiento?');" title="Borrar">
                                <i class="fa fa-times-circle" style="font-size: 22px;"></i>
                            </a>
                        </td> 
                    </tr>
                <?php } ?>
            </tbody>                            
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=movimientos&a=index&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=movimientos&a=index&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=movimientos&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=movimientos&a=index&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>