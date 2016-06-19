<h3><i class="fa fa-angle-right"></i> Crear Combustible</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=combustibles&a=add" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Combustible:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Combustible&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnombre" class="form-control" required="required" placeholder="Ej: Gasoil" onkeypress="return validarTexto(event);" pattern="[A-Za-z\s]*" tabindex="1" autofocus />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Stock del Combustible&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtstock" class="form-control" required="required" placeholder="Ej: 15" onkeypress="return validarNumero(event);" pattern="[\d]*" tabindex="2" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input name="tipo" list="tipov" class="form-control" placeholder="Seleccione Tipo de Vehículo" required="required" tabindex="3" />
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
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="5"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=combustibles&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="6"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>