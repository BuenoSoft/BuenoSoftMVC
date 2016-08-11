<h3><i class="fa fa-angle-right"></i>&nbsp;Editar Notificación número&nbsp;<?php echo $notificacion->getId(); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=notificaciones&a=edit&d=<?php echo \App\Session::get('not'); ?>" name="frmedit" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos de la Notificación:</h4>
                <input type="hidden" name="hid" value="<?php echo $notificacion->getId(); ?>" />
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Mensaje de la Notificación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea name="txtlog" rows="5" cols="67" required="required" placeholder="Ej: Cambio de las ruedas traseras" class="form-control" tabindex="1"><?php echo $notificacion->getMensaje(); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de la Notificación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="dtfechaini" id="fecini" required="required" name="dtfecini" value="<?php echo $notificacion->mostrarDateIni(); ?>" tabindex="2" />
                    </div>
                </div>                               
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="veh" id="v" class="form-control_datalist" required="required" tabindex="3" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dedicado a&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="usu" id="u" required="required" tabindex="4" />                        
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="6"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=notificaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="7"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>   
</form>
<script>
    $(function() {
        $('#fecini').combodate({
            //value: '',
            format: 'DD-MM-YYYY',
            template: 'DD / MM / YYYY'           
        });
        $('#fecfin').combodate({
            //value: '',
            format: 'DD-MM-YYYY',
            template: 'DD / MM / YYYY'        
        });
        $('#u').magicSuggest({
            placeholder: 'Seleccione un Usuario',
            value: ['<?php echo ($notificacion->getUsuario() != null) ? $notificacion->getUsuario()->getNomReal() : null; ?>'],
            maxSelection: 1,
            maxDropHeight: 150,            
            data: [
                <?php foreach ($usuarios as $usuario){ ?>
                     '<?php echo $usuario->getNomReal(); ?>',
                <?php } ?>
            ]
        });
        $('#v').magicSuggest({
            placeholder: 'Seleccione un Vehículo',
            value: ['<?php echo ($notificacion->getVehiculo() != null) ? $notificacion->getVehiculo()->getMatricula() : null ; ?>'], 
            maxSelection: 1,
            maxDropHeight: 150,            
            data: [
                <?php foreach ($vehiculos as $vehiculo) { ?>
                     '<?php echo $vehiculo->getMatricula(); ?>',
                <?php } ?>
            ]
        });
    });
</script>