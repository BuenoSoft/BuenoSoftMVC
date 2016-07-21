<h3><i class="fa fa-angle-right"></i>&nbsp;Ver Usuario número&nbsp;<?php echo $usuario->getId(); ?></h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos Personales:</h4>
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
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos del Usuario:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Usuario</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getNombre(); ?>
                    </div>
                </div>       
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Rol</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $usuario->getRol()->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group" style="text-align: center;">
                    <label class="col-sm-2 col-sm-2 control-label">Avatar</label>
                    <div class="col-sm-10">
                        <?php if($usuario->getAvatar() == null) { ?>
                            <img src="Public/img/manejo/profile_img.png" width='175' height='125' />&nbsp;&nbsp;
                        <?php } else { ?>
                            <img src="<?php echo $usuario->getAvatar(); ?>" width='175' height='125' />&nbsp;&nbsp;
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>