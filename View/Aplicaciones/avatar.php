<h3><i class="fa fa-angle-right"></i>&nbsp;Cambiar Avatar de Aplicación&nbsp;<?php echo $aplicacion->getId(); ?></h3>
<a href="index.php?c=aplicaciones&a=edit&d=<?php echo \App\Session::get('app'); ?>">
    <button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme05">
        <i class="fa fa-arrow-left"></i>&nbsp;Volver
    </button>
</a>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=avatar" name="frmavatar" enctype="multipart/form-data">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Avatar Actual:</h4>
                <div style="text-align: center;">
                    <div class="form-group" style="display: inline-block;">
                        <div class="col-sm-10" >
                            <img src="<?php echo $aplicacion->getAvatar(); ?>" width='400' height='300'>
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