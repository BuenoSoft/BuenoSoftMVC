<h3><i class="fa fa-angle-right"></i> Crear Producto</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=productos&a=add" name="frmadd" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Producto:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Código del Producto&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcodigo" class="form-control" autofocus="autofocus" required="required" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" placeholder="Ej: FG101" tabindex="1" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Producto&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnombre" class="form-control" required="required" placeholder="Ej: Aceite" onkeypress="return validarTexto(event);" pattern="[A-Za-z\s]*" tabindex="2" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Marca del Producto&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmarca" class="form-control" required="required" onkeypress="return  validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" placeholder="Ej: Castrol" tabindex="3" />
                    </div>
                </div>                
            </div>            
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Producto&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="tipo" name="tipo" required="required" tabindex="4"/>
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="5"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=productos&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="6"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        $('#tipo').magicSuggest({
            placeholder: 'Seleccione un Tipo de Producto',
            maxSelection: 1,
            data: [
                <?php foreach($tipos as $tipo){ ?>
                     '<?php echo $tipo->getNombre(); ?>',
                <?php } ?>
            ]
        });
    });
</script>