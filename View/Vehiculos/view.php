<h3><i class="fa fa-angle-right"></i>Ver Vehículo</h3>
<p>
    <a href="index.php?c=vehiculos&a=index">
        <button class="btn btn-theme05">
            <i class="fa fa-arrow-left"></i>&nbsp;Volver
        </button>
    </a>
</p>
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
                        <?php echo $vehiculo->getTipo()->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Motor del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getMotor(); ?>
                    </div>
                </div>                
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chasis del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getChasis(); ?>
                    </div>
                </div>
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
    </div>
</div>