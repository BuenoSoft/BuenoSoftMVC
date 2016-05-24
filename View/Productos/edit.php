<h3><i class="fa fa-angle-right"></i> Editar Producto</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=productos&a=edit&p=<?php echo \App\Session::get('id');?>" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Producto:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número del Producto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <input type="hidden" name="hid" value="<?php echo $producto->getId(); ?>" /><?php echo $producto->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Código del Producto</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcodigo" class="form-control" autofocus required placeholder="Ej: 835-514564" value="<?php echo $producto->getCodigo(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Producto</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnombre" class="form-control" required placeholder="Ej: Aceite" onkeypress="return validarTexto(event)" value="<?php echo $producto->getNombre(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Marca del Producto</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmarca" class="form-control" required placeholder="Ej: Castrol" value="<?php echo $producto->getMarca(); ?>" />
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=productos&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>