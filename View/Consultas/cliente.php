<h3><i class="fa fa-angle-right"></i> Ver Cliente</h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Sujeto:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Documento del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getDocumento(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dirección del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getDireccion(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Teléfono del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getTelefono(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Celular del Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getCelular(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Sujeto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getTipo(); ?>
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
    </div>
</div>