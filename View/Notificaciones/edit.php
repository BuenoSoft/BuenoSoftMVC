<h3><i class="fa fa-angle-right"></i>Editar Notificación</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=notificaciones&a=edit&p=<?php echo \App\Session::get('id'); ?>" name="frmedit">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Notificación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número de la Notificación</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="hid" value="<?php echo $notificacion->getId(); ?>" /><?php echo $notificacion->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Log de la Notificación</label>
                    <div class="col-sm-10">
                        <textarea name="txtlog" rows="10" class="form-control" autofocus required="required" placeholder="Ej: Cambio de las ruedas traseras"><?php echo $notificacion->getLog(); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de la Notificación</label>
                    <div class="col-sm-10">
                       <input type="datetime-local" name="dtfechaini" class="form-control" autofocus required="required" value="<?php echo $notificacion->mostrarDateTimeIni(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10">
                       <input type="datetime-local" name="dtfechafin" class="form-control" autofocus required="required" value="<?php echo ($notificacion->getFechafin() == null) ? date("Y-m-d\TH:i:s") : $notificacion->mostrarDateTimeFin(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo</label>
                    <div class="col-sm-10">
                        <input list="veh" class="form-control" placeholder="Seleccione Vehículo" required="required" name="cboxveh" value="<?php echo $notificacion->getVehiculo()->getId(); ?>" />
                        <datalist id="veh">
                            <?php 
                                foreach ($vehiculos as $vehiculo) { 
                                    if($vehiculo->getEstado() == "H"){ ?>
                                        <option value="<?php echo $vehiculo->getId(); ?>"><?php echo $vehiculo->getMatricula(); ?></option>
                            <?php   }                            
                                }
                            ?>                            
                        </datalist>&nbsp;
                        <input type="button" onclick="frmedit.submit();" value="Buscar" />
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div style="text-align: center;">
            <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
            <a href="index.php?c=notificaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
        </div>
    </div>
</form>