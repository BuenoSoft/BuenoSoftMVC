<h3>Registrar Vehículo para Aplicación nro <?php echo $aplicacion->getId();?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=usados&a=add&p=<?php echo \App\Session::get('id'); ?>" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículo</label>
                    <div class="col-sm-10">                    
                        <input list="vehiculos" class="form-control_datalist" placeholder="Seleccione Vehículo" required="required" name="veh" />
                        <datalist id="vehiculos">
                            <?php 
                                foreach ($vehiculos as $vehiculo) { 
                                    if($vehiculo->getEstado() == "H"){ ?>
                                        <option value="<?php echo $vehiculo->getId(); ?>"><?php echo $vehiculo->getMatricula(); ?></option>
                            <?php   }                            
                                }
                            ?>                            
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Conductor</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcond" class="form-control" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Capacidad</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcap" class="form-control" required />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div style="text-align: center;">
            <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
            <a href="index.php?c=usados&a=index&p=<?php echo App\Session::get('id'); ?>"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
        </div>
    </div>
</form>