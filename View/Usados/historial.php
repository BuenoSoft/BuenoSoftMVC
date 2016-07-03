<h3><i class="fa fa-angle-right"></i>&nbsp;Historial del Vehículo <?php echo $usado->getVehiculo()->getId(); ?>, de la Aplicación número&nbsp;<?php echo $usado->getAplicacion()->getId(); ?></h3>
<h4>
    <i class="fa fa-angle-right"></i>&nbsp;<?php echo "Capacidad del Vehículo: ".$usado->getVehiculo()->getCapcarga(); ?>
</h4>
<form class="form-horizontal style-form" method="post" action="index.php?c=usados&a=historial&d=<?php echo \App\Session::get('app'); ?>&v=<?php echo \App\Session::get('v'); ?>" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Combustible</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <p>
                            <?php echo "Nombre: ".$usado->getVehiculo()->getCombustible()->getNombre(); ?>                        
                        </p>
                        <p>
                            <?php echo "Stock Disponible: ".$usado->getVehiculo()->getCombustible()->getStock(); ?>
                        </p>
                        <p>
                            <?php echo "Stock Mínimo: ".$usado->getVehiculo()->getCombustible()->getStockMin(); ?>
                        </p>                        
                    </div>                                        
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha y Hora&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfecha" class="form-control" autofocus required="required" value="<?php echo date("Y-m-d\TH:i:s"); ?>" />
                    </div>                                        
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Recarga&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtrecarga" class="form-control" required="required" placeholder="Ej: -" onkeypress="return validarNumero(event);" />
                    </div>
                </div>                
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=usados&a=index&d=<?php echo $usado->getAplicacion()->getId(); ?>&v=<?php echo $usado->getVehiculo()->getId();?>"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="content-panel">
                <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <th>Recarga</th>
                        <th>Fecha</th>
                        <th>Opciones</th>                
                    </thead>
                    <tbody>
                        <?php foreach($historiales as $historial) { ?>
                            <tr>                       
                                <td><?php echo $historial->getRecarga();?></td>
                                <td><?php echo $historial->getFecha();?></td>                                
                                <td>
                                    <a href="index.php?c=usados&a=delete&d=<?php echo $usado->getAplicacion()->getId()?>&v=<?php echo $usado->getVehiculo()->getId()?>&m=<?php echo $historial->getCombustible()->getId();?>&f=<?php echo $historial->getFecha(); ?>" onclick="return confirm('¿Desea borrar este registro del historial?');" title="Borrar">
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
                        <a href="<?php echo 'index.php?c=historial&a=index&d='.$usado->getAplicacion()->getId().'&v='.$usado->getVehiculo()->getId().'&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
                    <?php } ?>
                    &nbsp;
                    <?php if($paginador['anterior']) { ?>	
                        <a href="<?php echo 'index.php?c=historial&a=index&d='.$usado->getAplicacion()->getId().'&v='.$usado->getVehiculo()->getId().'&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
                    <?php } ?>
                    &nbsp;
                    <?php if($paginador['siguiente']) { ?>	
                        <a href="<?php echo 'index.php?c=historial&a=index&d='.$usado->getAplicacion()->getId().'&v='.$usado->getVehiculo()->getId().'&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
                    <?php } ?>
                    &nbsp;
                    <?php if($paginador['ultimo']) { ?>	
                        <a href="<?php echo 'index.php?c=historial&a=index&d='.$usado->getAplicacion()->getId().'&v='.$usado->getVehiculo()->getId().'&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
                    <?php }     
                } ?>
            </div>            
        </div>
    </div>
</form>
