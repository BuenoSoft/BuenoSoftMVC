<h3><i class="fa fa-angle-right"></i> Ver Usuario</h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos Personales:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número del Usuario</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Documento</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getDocumento(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dirección</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getDireccion(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getTelefono(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Celular</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getDatoUsu()->getCelular(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
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
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <?php if(\App\Session::get('log_in')->getTipo() != "Usuario") {?>
                    <a href="index.php?c=usuarios&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
                <?php } else { ?>
                    <a href="index.php?c=access&a=index" class=""><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>