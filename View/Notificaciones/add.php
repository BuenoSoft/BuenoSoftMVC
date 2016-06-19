<h3><i class="fa fa-angle-right"></i>Crear Notificación</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=notificaciones&a=add" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Notificación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Log de la Notificación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea name="txtlog" class="form-control" rows="5" cols="67" required="required" placeholder="Ej: Cambio de las ruedas traseras" tabindex="1"  autofocus="autofocus"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de la Notificación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechaini" class="form-control" required="required" value="<?php echo date( "Y-m-d\TH:i:s");?>" tabindex="2"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="veh" class="form-control_datalist" placeholder="Seleccione Vehículo" required="required" name="cboxveh" tabindex="3" />
                        <datalist id="veh">
                            <?php 
                                foreach ($vehiculos as $vehiculo) { 
                                    if($vehiculo->getEstado() == "H"){ ?>
                                        <option value="<?php echo $vehiculo->getId(); ?>"><?php echo $vehiculo->getMatricula(); ?></option>
                            <?php   }                            
                                }
                            ?>                            
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="4" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div style="text-align: center;">
            <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="5"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
            <a href="index.php?c=notificaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="6"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
        </div>
    </div>
</form>