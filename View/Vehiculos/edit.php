<h3><i class="fa fa-angle-right"></i>&nbsp;Editar Vehículo número&nbsp;<?php echo $vehiculo->getId(); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=vehiculos&a=edit&d=<?php echo \App\Session::get('vh'); ?>" name="frmedit" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos del Vehículo:</h4>
                <input type="hidden" name="hid" value="<?php echo $vehiculo->getId(); ?>" />
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Matrícula del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmat" class="form-control" required="required" placeholder="Ej: T458-BDD" maxlength="14" value="<?php echo $vehiculo->getMatricula(); ?>" tabindex="1" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón del Vehículo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" placeholder="Ej: 1109971" value="<?php echo $vehiculo->getPadron(); ?>" tabindex="2" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="tipo" name="tipo" required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Capacidad de Carga (lts)&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcap" class="form-control" required="required" placeholder="Ej: 25,8" value="<?php echo $vehiculo->getCapcarga(); ?>" tabindex="4" />
                    </div>
                </div>               
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Stock del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtstock" onkeypress="return validarNumeroPC(event); " class="form-control" required="required" placeholder="Ej: 25.8" tabindex="8" value="<?php echo $vehiculo->getStock(); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Modelo del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmodelo" class="form-control" required="required" placeholder="Ej: Gol G5" value="<?php echo $vehiculo->getModelo(); ?>" tabindex="6" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Marca del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmarca" class="form-control" required="required" placeholder="Ej: Wolkswagen" value="<?php echo $vehiculo->getMarca(); ?>" tabindex="7" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Año del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtanio" class="form-control" required="required" placeholder="Ej: 2010" onkeypress="return validarNumero(event);" value="<?php echo $vehiculo->getAnio(); ?>" tabindex="8" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Horas a recorrer</label>
                    <div class="col-sm-10">
                        <input type="text" name="txthoras" class="form-control" placeholder="Ej: 50" onkeypress="return validarNumero(event);" value="<?php echo $vehiculo->getHorasRec(); ?>" tabindex="9"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $vehiculo->getTaquiDif(); ?>&nbsp;
                        <a href="index.php?c=vehiculos&a=reiniciar&d=<?php echo $vehiculo->getId(); ?>" onclick="return confirm('¿Desea reiniciar el taquímetro del vehículo?')">
                            Reiniciar
                        </a>                        
                    </div>
                </div>  
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="12"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=vehiculos&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="13"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>            
        </div>        
    </div>
</form>
<script>
    $(function() {
        $('#tipo').magicSuggest({
            placeholder: 'Seleccione un Tipo de Vehículo',
            value: ['<?php echo $vehiculo->getTipo()->getNombre(); ?>'],            
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach($tipos as $tipo){ ?>
                     '<?php echo $tipo->getNombre(); ?>',
                <?php } ?>
            ]
        });
    });
</script>