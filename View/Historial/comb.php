<h3><i class="fa fa-angle-right"></i> Ver Combustible</h3>
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
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Carga</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $combustible->getFecha(); ?>
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <a href="index.php?c=historial&a=index&p=<?php echo \App\Session::get('id'); ?>&v=<?php echo \App\Session::get('v'); ?>"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</div>