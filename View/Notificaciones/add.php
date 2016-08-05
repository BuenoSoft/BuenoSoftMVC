<h3><i class="fa fa-angle-right"></i>&nbsp;Crear Notificación</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=notificaciones&a=add" name="frmadd" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos de la Notificación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Mensaje de la Notificación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea name="txtlog" class="form-control" rows="5" cols="67" required="required" placeholder="Ej: Cambio de las ruedas traseras" tabindex="1"  autofocus="autofocus"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de la Notificación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="dtfechaini" id="fecini" required="required" name="dtfecini" tabindex="2" />
                    </div>
                </div>               
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo</label>
                    <div class="col-sm-10">
                        <input name="veh" id="v" required="required" tabindex="3" />                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dedicado a</label>
                    <div class="col-sm-10">
                        <input name="usu" id="u" required="required" tabindex="4" />                        
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="5"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=notificaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="6"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>    
</form>
<script>
    $(function() {
        $('#fecini').combodate({
            format: 'DD-MM-YYYY',
            template: 'DD-MM-YYYY'
        });
        $('#u').magicSuggest({
            placeholder: 'Seleccione un Usuario',
            maxSelection: 1,
            data: [
                <?php foreach ($usuarios as $usuario){ ?>
                     '<?php echo $usuario->getDatoUsu()->getNombre(); ?>',
                <?php } ?>
            ]
        });
        $('#v').magicSuggest({
            placeholder: 'Seleccione un Vehículo',
            maxSelection: 1,
            data: [
                <?php foreach ($vehiculos as $vehiculo) { ?>
                     '<?php echo $vehiculo->getMatricula(); ?>',
                <?php } ?>
            ]
        });
    });
</script>