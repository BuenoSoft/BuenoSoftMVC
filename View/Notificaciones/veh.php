<h3><i class="fa fa-angle-right"></i>Ver Vehículo</h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Vehículo:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Matrícula del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getMatricula(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getPadron(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getTipo(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Motor del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getMotor(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chasis del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getChasis(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Unidad de Medida</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getUnimedida(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Capacidad de Carga</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getCapcarga(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Modelo del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getModelo(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Marca del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getMarca(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Año del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getAnio(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Combustible</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getCombustible()->getNombre(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <a href="index.php?c=notificaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</div>