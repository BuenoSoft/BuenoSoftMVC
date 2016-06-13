<h3><i class="fa fa-angle-right"></i>Ver Aplicación número&nbsp;<?php echo $aplicacion->getId(); ?></h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículos</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php foreach ($aplicacion->getUsados() as $usado) { ?>
                            <a href="index.php?c=vehiculos&a=view&d=<?php echo $usado->getVehiculo()->getId();?>" target="_blank">
                                <?php echo "Matrícula: ". $usado->getVehiculo()->getMatricula()." Tipo: ".$usado->getVehiculo()->getTipo()->getNombre(); ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCliente()->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCultivo(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTratamiento(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada&nbsp;<font color="red">*</font></label>                                           
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getAreaapl(); ?>
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal&nbsp;<font color="red">*</font></label>                   
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCaudal(); ?>
                    </div>
                </div>
            </div> 
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTipo()->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Productos</label>
                    <div class="col-sm-10" style="text-align: center;">                        
                        <?php foreach ($aplicacion->getProductos() as $producto) { ?>
                                <a href="index.php?c=productos&a=view&d=<?php echo $producto->getId(); ?>" target="_blank">
                                    <?php echo $producto->getNombre(); ?>
                                </a>
                        <?php } ?>                                                    
                    </div>
                </div>                
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getViento(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Funcionarios</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php foreach ($aplicacion->getTrabajadores() as $funcionario) { ?>
                            <a href="index.php?c=usuarios&a=view&d=<?php echo $funcionario->getId(); ?>" target="_blank">
                                <?php echo $funcionario->getDatoUsu()->getNombre()." Tipo: ".$funcionario->getTipo(); ?>
                            </a>                            
                        <?php } ?>
                    </div>
                </div>                    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getPadron(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Cultivo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCoordCul(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Pista&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getPista()->getNombre(); ?>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getFaja(); ?>
                    </div>
                </div>                               
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getDosis(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo ($aplicacion->getFechaIni() == null or $aplicacion->getFechaIni() == "0000-00-00 00:00:00") ? "" : $aplicacion->mostrarDateTimeIni(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo ($aplicacion->getFechaFin() == null or $aplicacion->getFechaFin() == "0000-00-00 00:00:00") ? "" : $aplicacion->mostrarDateTimeFin(); ?>
                    </div>
                </div> 
            </div>
            <div class="showback">    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTaquiIni(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTaquiFin(); ?>
                    </div>
                </div> 
            </div> 
        </div>             
    </div>
</div>