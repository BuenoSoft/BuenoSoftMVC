<h3><i class="fa fa-angle-right"></i>&nbsp;Ver Pista</h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos de la Pista:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número de la Pista</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $pista->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre de la Pista</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $pista->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de la Pista</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $pista->getCoordenadas(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>