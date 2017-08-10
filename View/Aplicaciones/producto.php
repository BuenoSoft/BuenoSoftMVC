<h3><i class="fa fa-angle-right"></i>&nbsp;Ver Producto&nbsp;<?php echo $producto->getId(); ?></h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Producto:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Código del Producto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $producto->getCodigo(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Producto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $producto->getNombre(); ?>
                    </div>
                </div>                
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Marca del Producto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $producto->getMarca(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Producto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $producto->getTipo()->getNombre(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>