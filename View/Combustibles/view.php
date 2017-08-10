<h3><i class="fa fa-angle-right"></i>&nbsp;Ver Combustible número&nbsp;<?php echo $combustible->getId(); ?></h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Combustible:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Combustible</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $combustible->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Stock del Combustible</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $combustible->getStock()." L"; ?>
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
                        <?php echo $combustible->getStockMin()." L"; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Stock Máximo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $combustible->getStockMax()." L"; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Última Actualización</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo ($combustible->getFecUC() == null or $combustible->getFecUC() == "0000-00-00 00:00:00") ? "" : $combustible->getFecUC(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="panel-body">
                        <div id="hero-donut" class="graph"></div>
                    </div>
                    <div style="text-align: center;">
                        <p style="font-size: 125%;">Combustible utilizado:&nbsp;<?php echo $combustible->restaGrafica();?>&nbsp;L</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var Script = function () {
     $(function () {
        Morris.Donut({
            element: 'hero-donut',
            data: [
              {label: 'COMBUSTIBLE PARA UTILIZAR', value: <?php echo $combustible->regla3(); ?> },
              {label: 'COMBUSTIBLE UTILIZADO', value: <?php echo $combustible->restaCombustible(); ?> },
              ],
              colors: ['#1E90FF', '#192d70'],
            formatter: function (y) { return y + "%"} 
          });
        });
}();
</script>