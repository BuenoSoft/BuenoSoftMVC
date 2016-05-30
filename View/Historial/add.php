<h3>Registrar Historial del Vehículo <?php echo $usado->getVehiculo()->getId(); ?>, de la Aplicación número&nbsp;<?php echo $usado->getAplicacion()->getId(); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=historial&a=add&p=<?php echo \App\Session::get('id'); ?>&v=<?php echo \App\Session::get('v'); ?>" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Combustible</label>
                    <div class="col-sm-10">
                        <input list="combustibles" class="form-control_datalist" placeholder="Seleccione Combustible" required="required" name="comb" />
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
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfecha" class="form-control" autofocus required="required" value="<?php echo date("Y-m-d\TH:i:s"); ?>" />
                    </div>                                        
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Carga Inicial</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcargaini" class="form-control" required="required" placeholder="Ej: -" onkeypress="return validarNumero(event);" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Carga Final</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcargafin" class="form-control" required="required" placeholder="Ej: -" onkeypress="return validarNumero(event);" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div style="text-align: center;">
            <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
            <a href="index.php?c=historial&a=index&p=<?php echo $usado->getAplicacion()->getId(); ?>&v=<?php echo $usado->getVehiculo()->getId();?>"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
        </div>
    </div>
</form>