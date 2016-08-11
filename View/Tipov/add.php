<h3><i class="fa fa-angle-right"></i>Crear Tipo de Vehículo</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=tipov&a=add" name="frmadd" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos del Tipo:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnombre" class="form-control" required="required" placeholder="Ej: Avión" autofocus="autofocus" onkeypress="return validarTexto(event);" pattern="[A-Za-z\s]*" tabindex="1"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Unidad de Medida&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="medida" id="medida" required="required" tabindex="2" />
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="3"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=tipov&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="4"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        $('#medida').magicSuggest({
            placeholder: 'Seleccione una Unidad',
            maxSelection: 1,
            data: [
                'Kilometro','Horas de Vuelo'
            ]
        });
    });
</script>