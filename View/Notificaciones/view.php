 <h3><i class="fa fa-angle-right"></i>&nbsp;Ver Notificación&nbsp;<?php echo $notificacion->getId(); ?></h3>
<p>
    <a href="index.php?c=notificaciones&a=index">
        <button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme05">
            <i class="fa fa-arrow-left"></i>&nbsp;Volver
        </button>
    </a>
</p>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos de la Notificación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Log de la Notificación</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $notificacion->getMensaje(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de la Notificación</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo ($notificacion->getFecha() == null or $notificacion->getFecha() == "0000-00-00") ? "" : $notificacion->inverseDateIni(); ?>
                    </div>
                </div>               
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo ($notificacion->getVehiculo() != null) ? $notificacion->getVehiculo()->getMatricula() : " "; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo ($notificacion->getUsuario()!= null) ? $notificacion->getUsuario()->getNomReal() : " "; ?>                        
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>