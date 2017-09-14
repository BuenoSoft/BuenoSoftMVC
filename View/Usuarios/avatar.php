<h3><i class="fa fa-angle-right"></i>&nbsp;Cambiar Avatar de Usuario&nbsp;<?php echo $usuario->getId(); ?></h3>
<a href="index.php?c=usuarios&a=edit&d=<?php echo \App\Session::get('usu'); ?>">
    <button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme05">
        <i class="fa fa-arrow-left"></i>&nbsp;Volver
    </button>
</a>
<br />
<br />
<font size='2.5px;'>
    NOTA: Para ver su imagen subida en su avatar de perfil debe volver a iniciar sesión.
</font>
<form class="form-horizontal style-form" method="post" action="index.php?c=usuarios&a=avatar" name="frmavatar" enctype="multipart/form-data">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Avatar Actual:</h4>
                <div style="text-align: center;">
                    <div class="form-group" style="display: inline-block;">
                        <div class="col-sm-10" >
                            <img src="<?php echo $usuario->getAvatar(); ?>" width='400' height='300'>
                            <br />
                            <br />
                            <table>
                                <tr>
                                    <td><input type="file" name="avatar" id="foto" /></td>
                                    <td>
                                        <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" id="btn" style="display:none;">
                                            <i class="fa fa-upload"></i>&nbsp;Subir
                                        </button>
                                    </td>
                                </tr>
                            </table>                                                        
                        </div>
                    </div>       
                </div>
            </div>
        </div>        
    </div>
</form>
<script type="text/javascript">
    $("#foto").click(function(){
        $("#btn").show();
    });
</script>