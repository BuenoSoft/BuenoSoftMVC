<h3>Registrar Vehículo para Aplicación número&nbsp;<?php echo $usado->getAplicacion()->getId();?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=usados&a=edit&d=<?php echo \App\Session::get('app'); ?>&v=<?php echo \App\Session::get('v'); ?>" name="frmedit">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">                    
                        <input type="hidden" name="veh" value="<?php echo $usado->getVehiculo()->getId(); ?>" /><?php echo $usado->getVehiculo()->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Conductor&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcond" class="form-control" required="required" value="<?php echo $usado->getConductor(); ?>" tabindex="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div style="text-align: center;">
            <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="3"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
            <a href="index.php?c=usados&a=index&d=<?php echo App\Session::get('id'); ?>"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="4"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
        </div>
    </div>
</form>