<h3><i class="fa fa-angle-right"></i>&nbsp;Editar Producto número&nbsp;<?php echo $producto->getId(); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=productos&a=edit&d=<?php echo \App\Session::get('prod');?>" name="frmedit" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Producto:</h4>
                <input type="hidden" name="hid" value="<?php echo $producto->getId(); ?>" />
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Código del Producto&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcodigo" class="form-control" required="required" onkeypress="return  validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" placeholder="Ej: FG101" value="<?php echo $producto->getCodigo(); ?>" tabindex="1"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Producto&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnombre" class="form-control" required="required" placeholder="Ej: Aceite" onkeypress="return validarTexto(event);" value="<?php echo $producto->getNombre(); ?>" tabindex="2" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Marca del Producto&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmarca" class="form-control" required="required" onkeypress="return  validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" placeholder="Ej: Castrol" value="<?php echo $producto->getMarca(); ?>" tabindex="3" />
                    </div>
                </div>                
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Producto&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="tipo" name="tipo" required="required" />
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="4"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=productos&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="5"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        $('#tipo').magicSuggest({
            placeholder: 'Seleccione un Tipo de Producto',
            value: ['<?php echo $producto->getTipo()->getNombre(); ?>'],            
            maxSelection: 1,
            data: [
                <?php foreach($tipos as $tipo){ ?>
                     '<?php echo $tipo->getNombre(); ?>',
                <?php } ?>
            ]
        });
    });
</script>