<h3><i class="fa fa-angle-right"></i>&nbsp;Editar Pista número&nbsp;<?php echo $pista->getId(); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=pistas&a=edit&d=<?php echo \App\Session::get('pis');?>" name="frmedit">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Pista:</h4>
                <input type="hidden" name="hid" value="<?php echo $pista->getId(); ?>" />
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre de la Pista&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnombre" class="form-control" required="required" placeholder="Ej: Ruta 3" onkeypress="return validarTextoyNumPC(event);" pattern="[A-Za-z\s\d\.\,\/]*" maxlength="20" tabindex="1" value="<?php echo $pista->getNombre(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de la Pista</label>
                    <div class="col-sm-10">
                        <b>Sur</b>&nbsp<input name="txtsur" id="sur" type="text" placeholder="xx xx xx" tabindex="2" class="form-control" />
                        <br />
                        <b>Oeste</b>&nbsp<input name="txtoeste" id="oeste" type="text" placeholder="xxx xx xx" tabindex="3" class="form-control" />
                    </div>
                </div>
            </div>            
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="cliente" name="cliente" required="required" tabindex="2" />
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="4"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=pistas&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="4"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function() {
        $.mask.definitions['~'] = "[+-]";
        $("#sur").mask("99 99 99",{ 
            placeholder: "xx xx xx",
            autoclear: false }).val('<?php echo $pista->getGMDLat(); ?>');     
        $("#oeste").mask("999 99 99",{ 
            placeholder: "xxx xx xx",
            autoclear: false }).val('<?php echo $pista->getGMDLong(); ?>');
        $('#cliente').magicSuggest({
            placeholder: 'Seleccione Usuario',
            value: ['<?php echo $pista->getCliente()->getNomReal(); ?>'],
            maxSelection: 1,
            data: [
                <?php foreach ($usuarios as $usuario){
                    if($usuario->getRol()->getNombre() == "Cliente") { ?>
                        '<?php echo $usuario->getNomReal(); ?>',
                <?php } } ?>
            ]
        });
    });
</script>