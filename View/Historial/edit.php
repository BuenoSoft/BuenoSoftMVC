<h3>Editar Registro de Historial del Vehículo <?php echo $historial->getUsado()->getVehiculo()->getId(); ?>, de la Aplicación número&nbsp;<?php echo $historial->getUsado()->getAplicacion()->getId(); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=historial&a=edit&d=<?php echo \App\Session::get('app'); ?>&v=<?php echo \App\Session::get('v'); ?>&m=<?php echo \App\Session::get('m'); ?>&f=<?php echo \App\Session::get('f'); ?>" name="frmedit">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $historial->getUsado()->getVehiculo()->getCombustible()->getNombre(); ?> 
                    </div>                                                          
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <input type="hidden" name="dtfecha" class="form-control" value="<?php echo $historial->getFecha(); ?>" /><?php echo $historial->getFecha(); ?>
                    </div>                                        
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Carga Inicial&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcargaini" class="form-control" required="required" placeholder="Ej: -" onkeypress="return validarNumero(event);" value="<?php echo $historial->getCargaIni(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Carga Final&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcargafin" class="form-control" required="required" placeholder="Ej: -" onkeypress="return validarNumero(event);" value="<?php echo $historial->getCargaFin(); ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div style="text-align: center;">
            <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
            <a href="index.php?c=historial&a=index&d=<?php echo $historial->getUsado()->getAplicacion()->getId(); ?>&v=<?php echo $historial->getUsado()->getVehiculo()->getId();?>"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
        </div>
    </div>
</form>