<h3><i class="fa fa-angle-right"></i>Editar Vehículo</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=vehiculos&a=edit&p=<?php echo \App\Session::get('id'); ?>" name="frmedit">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Vehículo:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número del Vehículo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <input type="hidden" name="hid" value="<?php echo $vehiculo->getId(); ?>" /><?php echo $vehiculo->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Matrícula del Vehículo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmat" class="form-control" autofocus required placeholder="Ej: T458-BDD" value="<?php echo $vehiculo->getMatricula(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón del Vehículo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" required placeholder="Ej: 1109971" value="<?php echo $vehiculo->getPadron(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Vehículo</label>
                    <div class="col-sm-10">
                        <input list="tipov" class="form-control" placeholder="Seleccione Tipo" required="required" name="cboxtipo" value="<?php echo $vehiculo->getTipo(); ?>" />
                        <datalist id="tipov">
                            <option value="Camión">Camión</option>
                            <option value="Camioneta">Camioneta</option>
                            <option value="Auto">Auto</option>
                            <option value="Avión">Avión</option>
                        </datalist>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Motor del Vehículo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmotor" class="form-control" required placeholder="Ej: kawata78" value="<?php echo $vehiculo->getMotor(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chasis del Vehículo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtchasis" class="form-control" autofocus required placeholder="Ej: 285514564" value="<?php echo $vehiculo->getChasis(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Unidad de Medida</label>
                    <div class="col-sm-10">
                        <input list="unim" class="form-control" placeholder="Seleccione Unidad" required="required" name="cboxuni" value="<?php echo $vehiculo->getUnimedida(); ?>" />
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
                    <label class="col-sm-2 col-sm-2 control-label">Capacidad de Carga</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcap" class="form-control" required placeholder="Ej: 25,8" value="<?php echo $vehiculo->getCapcarga(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Modelo del Vehículo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmodelo" class="form-control" required placeholder="Ej: Gol G5" value="<?php echo $vehiculo->getModelo(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Marca del Vehículo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtmarca" class="form-control" required placeholder="Ej: Wolkswagen" value="<?php echo $vehiculo->getMarca(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Año del Vehículo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtanio" class="form-control" required placeholder="Ej: 2010" onkeypress="return validarNumero(event);" value="<?php echo $vehiculo->getAnio(); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Combustible</label>
                    <div class="col-sm-10">
                        <input list="combustibles" class="form-control" placeholder="Seleccione Combustible" required="required" name="cboxcomb" value="<?php echo $vehiculo->getCombustible()->getId(); ?>" />
                        <datalist id="combustibles">
                            <?php 
                                foreach ($combustibles as $combustible) {
                                    if($combustible->getEstado() == "H"){ ?>
                                        <option value="<?php echo $combustible->getId(); ?>"><?php echo $combustible->getNombre(); ?></option>
                            <?php   }
                                }
                            ?>                            
                        </datalist>&nbsp;
                        <input type="button" onclick="frmedit.submit();" value="Buscar" />
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