<h3><i class="fa fa-angle-right"></i> Cambiar Avatar de Usuario</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=usuarios&a=avatar" name="frmavatar" enctype="multipart/form-data">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Avatar Actual:</h4>
                <div style="text-align: center;">
                    <div class="form-group" style="display: inline-block;">
                        <div class="col-sm-10" >
                            <img src="<?php echo $usuario->getAvatar(); ?>" width='400' height='300'>
                            <br />
                            <br />
                            <input type="file" name="avatar" id="foto" />
                        </div>
                    </div>       
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=usuarios&a=edit&d=<?php echo \App\Session::get('usu'); ?>"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>        
    </div>
</form>