<h3><i class="fa fa-angle-right"></i>&nbsp;Crear Movimiento</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=movimientos&a=add" name="frmadd" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12" style="width: auto;">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha y Hora&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="dtfecha" id="fecha" />
                    </div>                                        
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cantidad&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcant" class="form-control" maxlength="15" required="required" placeholder="Ej: 15.8" onkeypress="return validarNumeroP(event)" pattern="[\d\.]*" tabindex="2" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Stock Emisor&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="emi" id="emi" required="required" tabindex="3" />                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Stock Receptor&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="rec" id="rec" required="required" tabindex="3" />                        
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="3"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=movimientos&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="6"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>
<script>
    $(function(){
        $('#fecha').combodate({
            format: 'DD-MM-YYYY-HH-mm-ss',
            template: 'DD / MM / YYYY     HH : mm : ss'
        });
        $('#emi').magicSuggest({
            placeholder: 'Seleccione Stock Emisor',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach ($combustibles as $combustible) {  ?>
                     '<?php echo $combustible->getNombre()." ".$combustible->getStock()." L"; ?>',
                <?php } ?>
                <?php foreach ($vehiculos as $vehiculo) { ?>
                     '<?php echo $vehiculo->getMatricula()." ".$vehiculo->getStock()." L"; ?>',
                <?php } ?>
            ]
        });
        $('#rec').magicSuggest({
            placeholder: 'Seleccione Stock Receptor',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach ($combustibles as $combustible) {  ?>
                     '<?php echo $combustible->getNombre()." ".$combustible->getStock()." L"; ?>',
                <?php } ?>
                <?php foreach ($vehiculos as $vehiculo) {  ?>
                     '<?php echo $vehiculo->getMatricula()." ".$vehiculo->getStock()." L"; ?>',
                <?php } ?>
            ]
        });
    });
</script>