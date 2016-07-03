<h3><i class="fa fa-angle-right"></i>&nbsp;Crear Vehículo</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=vehiculos&a=add" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos del Vehículo:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Matrícula del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmat" class="form-control" autofocus required="required" placeholder="Ej: T458-BDD" maxlength="14" tabindex="1"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" required="required" placeholder="Ej: 1109971" tabindex="2"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="tipo" list="tipov" id="tipo" class="form-control" placeholder="Seleccione Tipo de Vehículo" required="required" tabindex="3" />
                        <datalist id="tipov">
                            <?php foreach($tipos as $tipo) {
                                    if($tipo->getEstado() == "H"){ ?>
                                        <option value="<?php echo $tipo->getId(); ?>"><?php echo $tipo->getNombre(); ?></option>
                            <?php   } 
                                }
                            ?>                            
                        </datalist>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Motor del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmotor" class="form-control" required="required" placeholder="Ej: kawata78" tabindex="4" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chasis del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtchasis" class="form-control" required="required" placeholder="Ej: 285514564" tabindex="5"/>
                    </div>
                </div>                
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Capacidad de Carga&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcap" onkeypress="return validarNumeroPC(event); " class="form-control" required="required" placeholder="Ej: 25.8" tabindex="7"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Modelo del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmodelo" class="form-control" required="required" placeholder="Ej: Gol G5" tabindex="8" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Marca del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmarca" class="form-control" required="required" placeholder="Ej: Wolkswagen" tabindex="9" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Año del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtanio" class="form-control" rrequired="required" placeholder="Ej: 2010" onkeypress="return validarNumero(event);" tabindex="10" />
                    </div>
                </div>                
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="13"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=vehiculos&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="14"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        $('form[name="frmadd"]').submit(function() {
            var val = $('#tipo').val();
            var selected = $('#tipov option').filter(function() { return this.value === val; }).attr('value');
            if(!selected){
                alert('Seleccione una de las opciones existentes');
                return false;
            } else {
                return true;
            }
        });
    });
</script>