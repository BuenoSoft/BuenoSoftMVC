<h3><i class="fa fa-angle-right"></i> Editar Tipo de Vehículo</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=tipov&a=edit&d=<?php echo \App\Session::get('tv');?>" name="frmedit">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Tipo:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número del Tipo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <input type="hidden" name="hid" value="<?php echo $tipo->getId(); ?>" /><?php echo $tipo->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnombre" class="form-control" required="required" placeholder="" onkeypress="return validarTextoyNum(event)" tabindex="1" value="<?php echo $tipo->getNombre(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Unidad de Medida&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="medida" list="unim" class="form-control" placeholder="Seleccione Unidad" required="required" value="<?php echo $tipo->getMedida(); ?>" tabindex="6" />
                        <datalist id="unim">
                            <option value="Kilometro">Km</option>
                            <option value="Horas de Vuelo">Hs Vuelo</option>                            
                        </datalist>
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="4"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=tipov&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="5"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>
