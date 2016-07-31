<h3><i class="fa fa-angle-right"></i>&nbsp;Movimientos del Combustible&nbsp;<?php echo $combustible->getNombre(); ?></h3>
<h4>
    <i class="fa fa-angle-right"></i>&nbsp;Tipo:&nbsp;<?php echo $combustible->getTipo()->getNombre(); ?>
</h4>
<form class="form-horizontal style-form" method="post" action="index.php?c=combustibles&a=add_mov&d=<?php echo \App\Session::get('com'); ?>" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha y Hora&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="dtfecha" id="fecha" required="required" autofocus="autofocus" tabindex="1" />
                    </div>                                        
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cantidad&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcant" class="form-control" required="required" placeholder="Ej: -" onkeypress="return validarNumero(event);" tabindex="2" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo Emisor&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="vehemi" id="emi" required="required" tabindex="3" />                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo Receptor&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="vehrec" id="rec" required="required" tabindex="3" />                        
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="3"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=combustibles&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="6"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="content-panel">
                <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Emisor</th>
                        <th>Receptor</th>
                        <th>Opciones</th>                
                    </thead>
                    <tbody>
                        <?php foreach($movimientos as $movimiento) { ?>
                            <tr>                       
                                <td><?php echo $movimiento->getFecha();?></td>
                                <td><?php echo $movimiento->getCantidad();?></td>
                                <td><?php echo $movimiento->getEmisor()->getMatricula();?></td>
                                <td><?php echo $movimiento->getReceptor()->getMatricula();?></td>
                                <td>
                                    <a href="index.php?c=combustibles&a=del_mov&d=<?php echo $combustible->getId()?>&f=<?php echo $movimiento->getFecha(); ?>" onclick="return confirm('¿Desea borrar este movimiento?');" title="Borrar">
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
                        <a href="<?php echo 'index.php?c=combustibles&a=add_mov&d='.$combustible->getId().'&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
                    <?php } ?>
                    &nbsp;
                    <?php if($paginador['anterior']) { ?>	
                        <a href="<?php echo 'index.php?c=combustibles&a=add_mov&d='.$combustible->getId().'&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
                    <?php } ?>
                    &nbsp;
                    <?php if($paginador['siguiente']) { ?>	
                        <a href="<?php echo 'index.php?c=combustibles&a=add_mov&d='.$combustible->getId().'&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
                    <?php } ?>
                    &nbsp;
                    <?php if($paginador['ultimo']) { ?>	
                        <a href="<?php echo 'index.php?c=combustibles&a=add_mov&d='.$combustible->getId().'&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
                    <?php }     
                } ?>
            </div>            
        </div>
    </div>
</form>
<script>
    $(function(){
        $('#fecha').combodate();
        $('#emi').magicSuggest({
            placeholder: 'Seleccione un Vehículo',
            maxSelection: 1,
            data: [
                <?php foreach ($vehiculos as $vehiculo) { 
                    if($vehiculo->getCombustible()->equals($combustible)){ ?>
                     '<?php echo $vehiculo->getMatricula(); ?>',
                <?php }} ?>
            ]
        });
        $('#rec').magicSuggest({
            placeholder: 'Seleccione un Vehículo',
            maxSelection: 1,
            data: [
                <?php foreach ($vehiculos as $vehiculo) { 
                    if($vehiculo->getCombustible()->equals($combustible)){ ?>
                     '<?php echo $vehiculo->getMatricula(); ?>',
                <?php }} ?>
            ]
        });
    });
</script>