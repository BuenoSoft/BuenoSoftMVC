<h3><i class="fa fa-angle-right"></i>&nbsp;Editar Notificación número&nbsp;<?php echo $notificacion->getId(); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=notificaciones&a=edit&d=<?php echo \App\Session::get('not'); ?>" name="frmedit" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos de la Notificación:</h4>
                <input type="hidden" name="hid" value="<?php echo $notificacion->getId(); ?>" />
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Log de la Notificación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea name="txtlog" rows="5" cols="67" required="required" placeholder="Ej: Cambio de las ruedas traseras" class="form-control" tabindex="1"><?php echo $notificacion->getLog(); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de la Notificación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechaini" class="form-control" required="required" value="<?php echo ($notificacion->getFechaini() == null) ? "" : $notificacion->mostrarDateTimeIni(); ?>" tabindex="2" />
                    </div>
                </div>                               
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10">
                       <input type="datetime-local" name="dtfechafin" class="form-control" value="<?php echo ($notificacion->getFechafin() == null) ? "" : $notificacion->mostrarDateTimeFin(); ?>" tabindex="3" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="veh" id="v" class="form-control_datalist" placeholder="Seleccione Vehículo" required="required" name="cboxveh" value="<?php echo $notificacion->getVehiculo()->getMatricula(); ?>" tabindex="4" />
                        <datalist id="veh">
                            <?php 
                                foreach ($vehiculos as $vehiculo) { 
                                    if($vehiculo->getEstado() == "H"){ ?>
                                        <option value="<?php echo $vehiculo->getMatricula(); ?>" />
                            <?php   }                            
                                }
                            ?>                            
                        </datalist>
                        <input type="button" onclick="frmedit.submit();" tabindex="5" value="Buscar" class="btn btn-theme01" />
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
        $('form[name="frmedit"]').submit(function() {
            var val = $('#v').val();
            var selected = $('#veh option').filter(function() { return this.value === val; }).attr('value');
            if(!selected){
                alert('Seleccione una de las opciones existentes');
                return false;
            } else {
                return true;
            }
        });
    });
</script>