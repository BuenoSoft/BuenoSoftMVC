<h3>Registrar Historial del Vehículo <?php echo $usado->getVehiculo()->getId(); ?>, de la Aplicación nro <?php echo $usado->getAplicacion()->getId(); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=historial&a=add&p=<?php echo \App\Session::get('id'); ?>&v=<?php echo \App\Session::get('v'); ?>" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-10">
                        
                    </div>                                        
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Carga Inicial</label>
                    <div class="col-sm-10">
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Carga Final</label>
                    <div class="col-sm-10">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div style="text-align: center;">
            <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
            <a href="index.php?c=historial&a=index&p=<?php echo $usado->getAplicacion()->getId(); ?>&v=<?php echo $usado->getVehiculo()->getId();?>"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
        </div>
    </div>
</form>