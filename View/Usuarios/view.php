<h3><i class="fa fa-angle-right"></i> Ver Usuario</h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Sujeto:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getSujeto()->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Documento del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getSujeto()->getDocumento(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getSujeto()->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dirección del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getSujeto()->getDireccion(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Teléfono del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getSujeto()->getTelefono(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Celular del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getSujeto()->getCelular(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getSujeto()->getTiposuj(); ?>
                    </div>
                </div>               
            </div>
        </div>        
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Usuario: </h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Usuario</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getNombre(); ?>
                    </div>
                </div>       
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Usuario</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getTipo(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <a href="index.php?c=usuarios&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</div>