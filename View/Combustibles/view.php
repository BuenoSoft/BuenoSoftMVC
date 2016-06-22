<h3><i class="fa fa-angle-right"></i>Ver Combustible</h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Combustible:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número del Combustible</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $combustible->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Combustible</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $combustible->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Stock del Combustible</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $combustible->getStock(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Combustible</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $combustible->getTipo()->getNombre(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Stock Mínimo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $combustible->getStockMin(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Última Actualización</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo ($combustible->getFecUC() == null or $combustible->getFecUC() == "0000-00-00 00:00:00") ? "" : $combustible->getFecUC(); ?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>