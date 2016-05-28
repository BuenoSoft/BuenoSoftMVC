<h3><i class="fa fa-angle-right"></i>Crear Vehículo</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=vehiculos&a=add" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Vehículo:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Matrícula del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmat" class="form-control" autofocus required="required" placeholder="Ej: T458-BDD" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" required="required" placeholder="Ej: 1109971" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="tipov" class="form-control" placeholder="Seleccione Tipo" required="required" name="cboxtipo" />
                        <datalist id="tipov">
                            <option value="Camión">Camión</option>
                            <option value="Camioneta">Camioneta</option>
                            <option value="Auto">Auto</option>
                            <option value="Avión">Avión</option>
                        </datalist>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Motor del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmotor" class="form-control" required="required" placeholder="Ej: kawata78" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chasis del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtchasis" class="form-control" required="required" placeholder="Ej: 285514564" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Unidad de Medida&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="unim" class="form-control" placeholder="Seleccione Unidad" required="required" name="cboxuni" />
                        <datalist id="unim">
                            <option value="Kilometro">Km</option>
                            <option value="Hora de Vuelo">Hs Vuelo</option>                            
                        </datalist>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Capacidad de Carga&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcap" class="form-control" required="required" placeholder="Ej: 25,8" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Modelo del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmodelo" class="form-control" required="required" placeholder="Ej: Gol G5" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Marca del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmarca" class="form-control" required="required" placeholder="Ej: Wolkswagen" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Año del Vehículo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtanio" class="form-control" rrequired="required" placeholder="Ej: 2010" onkeypress="return validarNumero(event);" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Combustible&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="combustibles" class="form-control_datalist" placeholder="Seleccione Combustible" required="required" name="cboxcomb" />
                        <datalist id="combustibles">
                            <?php 
                                foreach ($combustibles as $combustible) {
                                    if($combustible->getEstado() == "H"){ ?>
                                        <option value="<?php echo $combustible->getId(); ?>"><?php echo $combustible->getNombre(); ?></option>
                            <?php   }
                                }
                            ?>                            
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=vehiculos&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>